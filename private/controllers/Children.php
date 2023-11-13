<?php

class Children extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        $children = new Child();

        $data = $children->findAll();

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('children', [
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
            $children = new Child();

            if ($children->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");


                $children->insert($_POST);
                $this->redirect('children');
            } else {
                $errors = $children->errors;
            }
        }
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('children.add', [
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
        $children = new Child();

        if (count($_POST) > 0) {


            if ($children->validate($_POST)) {

                $children->update($id, $_POST);
                $this->redirect('children');
            } else {
                $errors = $children->errors;
            }
        }

        $row = $children->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'children.edit',
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
        $children = new Child();

        if (count($_POST) > 0) {
            $children->delete($id);
            $this->redirect('children');
        }

        $row = $children->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'children.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
