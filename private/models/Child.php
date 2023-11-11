<?php

class Child extends Model
{

    protected $table = 'children';

    protected $allowedColumns = [
        'first_name',
        'middle_name',
        'last_name',
        'date'
    ];
    protected $beforeInsert = [
        'make_hospital_id',
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

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_hospital_id($data)
    {
        if (isset($_SESSION['USER']->hospital_id)) {
            $data['hospital_id'] = $_SESSION['USER']->hospital_id;
        }
        return $data;
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
