<?php

class User extends Model
{
    protected $allowedColumns = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'date',
        'gender',
        'password',
        'user_role',
        'id_card',
        'approve'
    ];
    protected $beforeInsert = [
        'make_user_id',
        'hash_password'
    ];

    public function validate($DATA)
    {
        $this->errors = [];
        if (empty($DATA['first_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['first_name'])) {
            $this->errors['first_name'] = 'First Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (!empty($DATA['middle_name']) && !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['middle_name'])) {
            $this->errors['middle_name'] = 'Middle Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['last_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['last_name'])) {
            $this->errors['last_name'] = 'Last Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid';
        }

        if ($this->where('email', $DATA['email'])) {
            $this->errors['email'] = 'Please try a different email';
        }

        if (empty($DATA['password']) || $DATA['password'] != $DATA['password2']) {
            $this->errors['password'] = 'Password do not match';
        }

        if (strlen($DATA['password']) < 8) {
            $this->errors['password'] = 'Password length must be at least 8 characters';
        }

        $genders = ['female', 'male'];

        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = 'Gender is not valid';
        }

        $user_roles = [
            'parent', 'gynecologist', 'obstetrician', 'dentist',
            'pediatrician', 'admin', 'super_admin'
        ];

        if (empty($DATA['user_role']) || !in_array($DATA['user_role'], $user_roles)) {
            $this->errors['user_role'] = 'role is not valid';
        }

        if (!empty($_FILES['id_card']['tmp_name'])) {
            // Handle file upload
            $imageData = $this->handleImageUpload('id_card');
            if (!$imageData) {
                $this->errors['id_card'] = 'Error uploading image';
            } else {
                $DATA['id_card'] = $imageData;
            }
        } else {
            $this->errors['id_card'] = 'Please upload an image';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    protected function handleImageUpload($fieldName)
    {
        $targetDir = ASSETS . "/id/";
        $targetFile = $targetDir . basename($_FILES[$fieldName]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow only specific file types (e.g., jpg, jpeg, png)
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (!in_array($imageFileType, $allowedExtensions)) {
            $this->errors['id_card'] = 'Invalid file type. Please upload a valid image file.';
            return false;
        }

        $data = file_get_contents($_FILES[$fieldName]["tmp_name"]);
        $base64 = 'data:image/' . $imageFileType . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function make_user_id($data)
    {
        $data['user_id'] = random_string(60);
        return $data;
    }

    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }
}
