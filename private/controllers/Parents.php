<?php

class Parents extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $user = new User();

        $data = $user->query("select * from users where user_role in ('parent') order by id desc ");

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('parents', [
            'rows' => $data
        ]);
        echo $this->view('includes/footer');
    }
}
