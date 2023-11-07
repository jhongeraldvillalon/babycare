<?php

class Home extends Controller
{
    public function index()
    {
        $db = new Database();
        $data = $db->query("select * from users");
         
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('home', ['rows'=> $data]);
        echo $this->view('includes/footer');
    }
}
