<?php

class Users extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $user = new User();
        $hospital_id = Auth::getHospital_id();
        $data = $user->query("select * from users where hospital_id = :hospital_id", ['hospital_id' => $hospital_id]);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('users', ['rows' => $data]);
        echo $this->view('includes/footer');
    }
}
