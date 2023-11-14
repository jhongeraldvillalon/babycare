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
        $has_image = false;
        if (count($_FILES) > 0) {
            $allowed[] = "image/jpeg";
            $allowed[] = "image/png";

            if ($_FILES['id_card']['error'] == 0 && in_array($_FILES['id_card']['type'], $allowed)) {
                $folder = "uploads/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $_FILES['id_card']['name'];
                move_uploaded_file($_FILES["id_card"]["tmp_name"], $destination);
                $_POST['id_card'] = $destination;
            }
        }

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
            'parent', 'obgyne', 'dentist',
            'pediatrician', 'admin', 'super_admin'
        ];

        if (empty($DATA['user_role']) || !in_array($DATA['user_role'], $user_roles)) {
            $this->errors['user_role'] = 'role is not valid';
        }

        if (empty($_FILES['id_card'])) {
            $this->errors['id_card'] = 'Please upload an image';
        }
        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }


    public function make_user_id($data)
    {
        // $data['user_id'] = random_string(60);
        $data['user_id'] = strtolower(str_replace(" ", "_", $data['first_name']))
            . "." .
            strtolower(str_replace(" ", "_", $data['last_name']));

        while ($this->where('user_id', $data['user_id'])) {
            $data['user_id'] .= rand(10, 9999);
        }
        return $data;
    }

    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }
}
