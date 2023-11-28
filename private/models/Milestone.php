<?php

class Milestone extends Model
{

    protected $table = 'milestones';

    protected $allowedColumns = [
        'name',
        'description',
        'age_range',
        'disabled',
    ];
    protected $beforeInsert = [
        'make_milestone_id',
    ];


    public function validate($DATA)
    {
        $this->errors = [];
        if (empty($DATA['name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['name'])) {
            $this->errors['name'] = 'Name: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (!empty($DATA['description']) && !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['description'])) {
            $this->errors['description'] = 'Description: Only letters are allowed in this field and no leading or trailing spaces';
        }

        $age_range = [
            '1-6 months', '7-12 months', '13-18 months',
            '19-24 months', '25-36 months', '37-48 months'
        ];

        if (empty($DATA['age_range']) || !in_array($DATA['age_range'], $age_range)) {
            $this->errors['age_range'] = 'Range is not valid';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_milestone_id($data)
    {

        $data['milestone_id'] = random_string(60);
        return $data;
    }


    public function insertAndGetId($data)
    {
        $data = $this->make_milestone_id($data);

        // Perform the insertion
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the milestone_id after insertion
        return $data['milestone_id'];
    }
}
