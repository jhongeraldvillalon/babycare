<?php

class Approve extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        $approve = new Approved();

        $data = $approve->query("select * from users where approve not in ('1') and user_role not in ('admin')");

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('approve', [
            'rows' => $data
        ]);
        echo $this->view('includes/footer');
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];
        $approve = new Approved();

        if (count($_POST) > 0) {


            if ($approve->validate($_POST)) {

                $approve->update($id, $_POST);
                $this->redirect('approve');
            } else {
                $errors = $approve->errors;
            }
        }

        $row = $approve->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'approve.edit',
            [
                'row' => $row,
                'errors' => $errors,

            ]
        );
        echo $this->view('includes/footer');
    }

    public function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];
        $approve = new Approved();

        if (count($_POST) > 0) {
            $approve->delete($id);
            $this->redirect('approve');
        }

        $row = $approve->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'approve.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
