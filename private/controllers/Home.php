<?php

class Home extends Controller
{
    public function index()
    {
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('home');
        echo $this->view('includes/footer');
    }
}
