<?php

class Users extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $user = new User();
        $data = $user->query("select * from users where user_role not in ('parent') or approve not in ('1')");

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('users', [
            'rows' => $data,

        ]);
        echo $this->view('includes/footer');
    }
}
