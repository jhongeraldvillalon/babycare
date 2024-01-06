<?php

class ChildStaff extends Model
{

    protected $table = 'child_staffs';

    protected $allowedColumns = [
        'user_id',
        'child_id',
        'disabled',
        'date'
    ];
    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_user'
    ];

    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {

            if (isset($row->user_id)) {

                $result = $user->where('user_id', $row->user_id);

                $data[$key]->user = is_array($result) ? $result[0] : false;
            }
        }
        return $data;
    }
    
}
