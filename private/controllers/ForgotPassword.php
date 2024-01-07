<?php

class ForgotPassword extends Controller
{
    public function index()
    {
        $data['errors'] = [];

        // Check the mode from URL parameter
        $mode = isset($_GET['mode']) ? $_GET['mode'] : 'enter_email';

        switch ($mode) {
            case 'enter_email':
                $this->processEnterEmail($data);
                break;
            case 'enter_code':
                $this->processEnterCode($data);
                break;
            case 'enter_password':
                $this->processEnterPassword($data);
                break;
        }

        // Load the appropriate view based on the mode
        echo $this->view('includes/header.lr');
        echo $this->view("forgotPassword." . $mode, $data);
    }

    private function processEnterEmail(&$data)
    {
        if (count($_POST) > 0) {

            $user = new User();

            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors'][] = "Please enter a valid email";
            } elseif (!$user->first("email", $email)) {
                $data['errors'][] = "That email was not found";
            } else {
                $_SESSION['forgot']['email'] = $email;
                $this->send_email($email);

                header("Location: " . ROOT . "/forgotPassword?mode=enter_code");
                die;
            }
        }
    }

    private function processEnterCode(&$data)
    {
        if (count($_POST) > 0) {

            $code = $_POST['code'];
            $result = $this->is_code_correct($code);

            if ($result == "the code is correct") {
                $_SESSION['forgot']['code'] = $code;
                header("Location:" . ROOT . "/forgotPassword?mode=enter_password");
                die;
            } else {
                $data['errors'][] = $result;
            }
        }
    }

    private function processEnterPassword(&$data)
    {
        // Implement the password change logic
        if (count($_POST) > 0) {
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if ($password !== $password2) {
                $data['errors'][] = "Passwords do not match";
            } elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
                header("Location:" . ROOT . "/forgotPassword");
                die;
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $email = $_SESSION['forgot']['email'];

                // Prepare the update query
                $codeModel = new Code();
                $query = "UPDATE users SET password = :password WHERE email = :email LIMIT 1";
                $codeModel->query($query, ['password' => $hashed_password, 'email' => $email]);

                // Clear the session variables
                if (isset($_SESSION['forgot'])) {
                    unset($_SESSION['forgot']);
                }

                // Redirect to the login page
                header("Location:" . ROOT . "/login");
                die;
            }
        }
    }

    private function is_code_correct($code)
    {
        $codesModel = new Code();

        $expire = time();
        $email = $_SESSION['forgot']['email'] ?? '';

        $query = "SELECT * FROM codes WHERE email = :email ORDER BY id DESC LIMIT 1";
        $result = $codesModel->query($query, ['email' => $email]);

        if ($result) {
            $row = $result[0];
            if ($row->code == $code) {  // Accessing properties of the object
                if ($row->expire > $expire) {
                    return "the code is correct";
                } else {
                    return "the code is expired";
                }
            } else {
                return "the code is incorrect";
            }
        }

        return "the code is incorrect";
    }

    private function send_email($email)
    {
        // Implement email sending logicfunction send_email($email)
        $codes = new Code();
        $expire = time() + (60 * 1);
        $code = rand(10000, 99999);

        $data = [
            'email' => $email,
            'code' => $code,
            'expire' => $expire
        ];
        $codes->insert($data);

        //send email here
        EmailService::sendMail($email, 'Password reset', "Your code is " . $code);
    }
}
