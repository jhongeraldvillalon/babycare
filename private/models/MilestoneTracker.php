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

    public function validate($DATA)
    {
        $this->errors = [];
       

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function updateMilestoneTracker($id, $milestone_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['milestone_id'] = $milestone_id;
        $query = "update $this->table set $str where milestone_id = :milestone_id AND child_id = :child_id";
        // dd2($data, $query);
        return $this->query($query, $data);
    }
}
