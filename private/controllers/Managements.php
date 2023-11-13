<?php

class Managements extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        $management = new Management();

        $data = $management->findAll();

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('management', [
            // 'crumbs' => $crumbs,
            'rows' => $data
        ]);
        echo $this->view('includes/footer');
    }

    public function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];

        if (count($_POST) > 0) {

            $management = new Management();

            if ($management->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");


                $management->insert($_POST);
                $this->redirect('management');
            } else {
                $errors = $management->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('management.add', [
            'errors' => $errors,
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
        $management = new Management();

        if (count($_POST) > 0) {


            if ($management->validate($_POST)) {

                $management->update($id, $_POST);
                $this->redirect('management');
            } else {
                $errors = $management->errors;
            }
        }

        $row = $management->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'management.edit',
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
        $management = new Management();

        if (count($_POST) > 0) {
            $management->delete($id);
            $this->redirect('management');
        }

        $row = $management->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'management.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
