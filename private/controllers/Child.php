<?php

class Child extends Controller
{
    public function index($id = '')
    {
        $user = new User();
        $row = $user->first('user_id', $id);
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('child', [
            'row' => $row,

        ]);
        echo $this->view('includes/footer');
    }
}
