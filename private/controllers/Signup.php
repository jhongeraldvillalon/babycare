<?php

class Signup extends Controller
{
    public function index()
    {
        echo $this->view('includes/header');
        echo $this->view('signup');
        echo $this->view('includes/footer');
    }
}
