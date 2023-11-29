<?php

class MilestoneTracker extends Model
{

    protected $table = 'milestones_tracker';

    protected $allowedColumns = [
        'child_id',
        'milestone_id',
        'accomplished_date',
        'accomplished'
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
            '6', '12', '18',
            '24', '36', '48'
        ];

        if (empty($DATA['age_range']) || !in_array($DATA['age_range'], $age_range)) {
            $this->errors['age_range'] = 'Range is not valid';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }
}
