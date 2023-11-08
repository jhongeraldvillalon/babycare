<?php

class Home extends Controller
{
    public function index()
    {
        $user = new User();

        // $user->insert($arr);
        // $user->update(3, $arr);
        $user->delete(3);

        $data = $user->findAll();
        // $data = $user->where("first_name", 'Jhon Gerald');

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('home', ['rows' => $data]);
        echo $this->view('includes/footer');
    }
}
