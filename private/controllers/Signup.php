<?php

class Signup extends Controller
{
    public function index()
    {
        $errors = [];
        if (count($_POST) > 0) {
            $user = new User();

            if ($user->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");

                // $arr['email'] = $_POST['email'];

                $user->insert($_POST);
                $this->redirect('users');
            } else {
                $errors = $user->errors;
            }
        }
        $mode = isset($_GET['mode']) ? $_GET['mode'] : '';
        echo $this->view('includes/header');
        echo $this->view('signup', [
            'errors' => $errors,
            'mode' => $mode
        ]);
        echo $this->view('includes/footer');
    }
}
