<?php

class Hospitals extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $hospital = new Hospital();

        $data = $hospital->findAll();

        // $crumbs[] = ['Dashboard', ''];
        // $crumbs[] = ['Hospitals', 'hospitals'];

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('hospitals', [
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

        $errors = [];

        if (count($_POST) > 0) {

            $hospital = new Hospital();

            if ($hospital->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");

                // $arr['email'] = $_POST['email'];

                $hospital->insert($_POST);
                $this->redirect('hospitals');
            } else {
                $errors = $hospital->errors;
            }
        }
        // $crumbs[] = ['Dashboard', ''];
        // $crumbs[] = ['Hospitals', 'hospitals'];
        // $crumbs[] = ['Add', 'hospitals/add'];

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('hospitals.add', [
            'errors' => $errors,
            // 'crumbs' => $crumbs
        ]);
        echo $this->view('includes/footer');
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $errors = [];
        $hospital = new Hospital();

        if (count($_POST) > 0) {


            if ($hospital->validate($_POST)) {

                $hospital->update($id, $_POST);
                $this->redirect('hospitals');
            } else {
                $errors = $hospital->errors;
            }
        }

        $row = $hospital->where('id', $id);
        // $crumbs[] = ['Dashboard', ''];
        // $crumbs[] = ['Hospitals', 'hospitals'];
        // $crumbs[] = ['Edit', 'hospitals/edit'];
        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'hospitals.edit',
            [
                'row' => $row,
                'errors' => $errors,
                // 'crumbs' => $crumbs

            ]
        );
        echo $this->view('includes/footer');
    }

    public function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $errors = [];
        $hospital = new Hospital();

        if (count($_POST) > 0) {
            $hospital->delete($id);
            $this->redirect('hospitals');
        }

        $row = $hospital->where('id', $id);

        // $crumbs[] = ['Dashboard', ''];
        // $crumbs[] = ['Hospitals', 'hospitals'];
        // $crumbs[] = ['Delete', 'hospitals/delete'];

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'hospitals.delete',
            [
                'row' => $row,
                // 'crumbs' => $crumbs
            ]
        );
        echo $this->view('includes/footer');
    }
}
