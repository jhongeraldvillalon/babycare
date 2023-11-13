<?php

class Home extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        } 

        if (!(Auth::isAdmin() || Auth::isParent()) && !Auth::isApprove('1')) {
            
            $this->redirect("login");
        }

        $user = new User();

        $data = $user->findAll();

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('home', ['rows' => $data]);
        echo $this->view('includes/footer');
    }
}
