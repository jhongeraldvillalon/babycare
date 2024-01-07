<?php
class Accounts extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!(Auth::isAdmin() || Auth::isParent()) && !Auth::isApprove(1)) {
            $this->redirect("login");
        }

        $user = new User();
        $data = $user->first('email', Auth::getEmail());

        $errors = [];
        $account = new Account();

        if (count($_POST) > 0) {
            if ($account->validate($_POST, Auth::getId())) {
                // Update user information
                $account->updateUserInfo(Auth::getId(), $_POST);

                Auth::updateSessionData(Auth::getId());

                $this->redirect('accounts');
            } else {
                $errors = $account->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('accounts', [
            'errors' => $errors,
            'rows' => $data,
        ]);
        echo $this->view('includes/footer');
    }

    public function password()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!(Auth::isAdmin() || Auth::isParent()) && !Auth::isApprove(1)) {
            $this->redirect("login");
        }

        $user = new User();
        $data = $user->first('email', Auth::getEmail());
        $errors = [];
        $account = new Password();
        if (count($_POST) > 0) {
            if ($account->validateForPasswordUpdate($_POST, Auth::getId())) {
                // Separate password update logic
                if (!empty($_POST['password']) && !empty($_POST['password2'])) {
                    if ($_POST['password'] == $_POST['password2']) {
                        $account->updatePassword(Auth::getId(), $_POST['password']);
                    } else {
                        $errors['password'] = "Passwords do not match";
                    }
                }

                $this->redirect('accounts');
            } else {
                $errors = $account->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('accounts.password', [
            'errors' => $errors,
            'rows' => $data,
        ]);
        echo $this->view('includes/footer');
    }
}
