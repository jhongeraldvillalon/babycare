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
        $data['user_id'] = random_string(60);
        return $data;
    }

    public function make_hospital_id($data)
    {

        $data['hospital_id'] = random_string(60);
        return $data;
    }
}
