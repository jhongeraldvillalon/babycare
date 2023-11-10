<?php

class Hospital extends Model
{
    protected $allowedColumns = [
        'hospital',
        'date'
    ];
    protected $beforeInsert = [
        'make_hospital_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user'
    ];

    public function validate($DATA)
    {
        $this->errors = [];
        if (empty($DATA['hospital']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['hospital'])) {
            $this->errors['hospital'] = 'Hospital: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        if (isset($_SESSION['USER']->hospital_id)) {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_hospital_id($data)
    {

        $data['hospital_id'] = random_string(60);
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
