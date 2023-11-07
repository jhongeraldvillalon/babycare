<?php

class Login extends Controller
{
    public function index()
    {
        echo $this->view('includes/header');
        echo $this->view('login');
        echo $this->view('includes/footer');
    }
}
