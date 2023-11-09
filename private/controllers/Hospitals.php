<?php

class Hospitals extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $hospital = new Hospital();

        $data = $hospital->findAll();

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('hospitals', ['rows' => $data]);
        echo $this->view('includes/footer');
    }
}
