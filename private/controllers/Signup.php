<?php

class Signup extends Controller
{
    public function index()
    {
        $mode = isset($_GET['mode']) ? $_GET['mode'] : '';
        $errors = [];
        if (count($_POST) > 0) {
            $user = new User();
            if ($user->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");

                if ($_POST['user_role'] == 'parent') {
                    $_POST['approve'] = '1';
                }

                $user->insert($_POST);
                $redirect = $mode == 'parents' ? 'parents' : 'users';
                $this->redirect($redirect);
            } else {
                $errors = $user->errors;
            }
        }

        echo $this->view('includes/header.lr');
        echo $this->view('signup', [
            'errors' => $errors,
            'mode' => $mode
        ]);
        // echo $this->view('includes/footer');
    }
}
