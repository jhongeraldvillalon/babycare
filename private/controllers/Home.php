<?php

class Home extends Controller
{
    public function index()
    {
        $user = new User();
        $data = $user->findAll();
        // $data = $user->where("first_name", 'Jhon Gerald');
         
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('home', ['rows'=> $data]);
        echo $this->view('includes/footer');
    }
}
