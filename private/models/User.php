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
        'user_role'
    ];
    protected $beforeInsert = [
        'make_user_id',
        'make_hospital_id',
        'hash_password'
    ];

    public function validate($DATA)
    {
        $this->errors = [];
        if (empty($DATA['first_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['first_name'])) {
            $this->errors['first_name'] = 'First Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['middle_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['middle_name'])) {
            $this->errors['middle_name'] = 'Middle Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['last_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['last_name'])) {
            $this->errors['last_name'] = 'Last Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid';
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

        $user_roles = ['student', 'reception', 'lecturer', 'admin', 'super_admin'];

        if (empty($DATA['user_role']) || !in_array($DATA['user_role'], $user_roles)) {
            $this->errors['user_role'] = 'role is not valid';
        }


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        $data['user_id'] = $this->random_string(60);
        return $data;
    }

    public function make_hospital_id($data)
    {
        if (isset($_SESSION['USER']->hospital_id)) {
            $data['hospital_id'] = $_SESSION['USER']->hospital_id;
        }
        return $data;
    }

    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    private function random_string($length)
    {
        $array = array(
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );

        $text = '';

        for ($i = 0; $i < $length; $i++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }

        return $text;
    }
}
