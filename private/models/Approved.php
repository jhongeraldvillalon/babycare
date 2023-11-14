<?php

class Approved extends Model
{

    protected $table = 'users';

    protected $allowedColumns = [
        'email',
        'approve',
    ];
    protected $beforeInsert = [];

    public function validate($DATA)
    {
        $this->errors = [];

        if (empty($DATA['approve'])) {
            $this->errors['approve'] = 'Approve: Please fill this in';
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
