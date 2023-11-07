<?php

class Profile extends Controller
{
    public function index()
    {
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('profile');
        echo $this->view('includes/footer');
    }
}
