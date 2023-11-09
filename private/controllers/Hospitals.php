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

    public function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $errors = [];

        $hospital = new Hospital();

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('hospitals.add', ['errors' => $errors]);
        echo $this->view('includes/footer');
    }
}
