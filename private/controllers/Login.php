<?php

class Login extends Controller
{
    public function index()
    {
        $errors = [];
        if (count($_POST) > 0) {
            $user = new User();
            if ($row = $user->where('email', $_POST['email'])) {
                $row = $row[0];
                if (password_verify($_POST['password'], $row->password)) {
                    Auth::authenticate($row);
                    $this->redirect('/home');
                }
            }
            $errors['email'] = "Wrong email or password";
        }
        echo $this->view('includes/header.lr');
        echo $this->view('login', ['errors' => $errors,]);
        echo $this->view('includes/footer');
    }
}
