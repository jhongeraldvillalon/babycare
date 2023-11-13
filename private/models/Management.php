<?php

class Management extends Model
{
    protected $table = 'children';
    protected $allowedColumns = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date',
        'birth_date',
        'blood_type',
        'birth_place',
        'birth_type',
        'multiple',
        'mother',
        'father',
        'delivery',
    ];
    protected $beforeInsert = [
        'make_child_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user'
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

        if (empty($DATA['blood_type']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['blood_type'])) {
            $this->errors['blood_type'] = 'Blood Type: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['birth_place']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['birth_place'])) {
            $this->errors['birth_place'] = 'Birth Place: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['multiple'])) {
            $this->errors['multiple'] = 'Multiple: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (!empty($DATA['mother']) && !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['mother'])) {
            $this->errors['mother'] = 'Mother Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (!empty($DATA['father']) && !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['father'])) {
            $this->errors['father'] = 'Father Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['delivery']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['delivery'])) {
            $this->errors['delivery'] = 'Delivery: Only letters are allowed in this field and no leading or trailing spaces';
        }
        if (empty($DATA['birth_date'])) {
            $this->errors['birth_date'] = 'Birth Date: Please fill this in';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        if (isset($_SESSION['USER']->user_id)) {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_child_id($data)
    {

        $data['child_id'] = random_string(60);
        return $data;
    }

    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {
            $result = $user->where('user_id', $row->user_id);

            $data[$key]->user = is_array($result) ? $result[0] : false;
        }
        return $data;
    }
}
