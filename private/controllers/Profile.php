<?php

class Profile extends Controller
{
    public function index($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;

        $row = $user->first('user_id', $id);

        if ($row) {

            $child = new Child();
            $parent = new ChildParent();
            $mytable = 'child_staffs';
            $query = "select * from $mytable where user_id = :user_id && disabled = 0";

            $data['child_parent'] = $child->query($query, ['user_id' => $id]);
            $data['child_parents'] = [];

            if ($data['child_parent']) {
                foreach ($data['child_parent'] as $key => $arow) {
                    $childParentData = $child->first('child_id', $arow->child_id);
                    if ($childParentData) {
                        $data['child_parents'][] = $childParentData;
                    }
                }
            }
        }
        $data['row'] = $row;

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('profile', $data);
        echo $this->view('includes/footer');
    }

    public function edit($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;

        $row = $user->first('user_id', $id);

        $data['row'] = $row;

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('profile_edit', $data);
        echo $this->view('includes/footer');
    }
}
