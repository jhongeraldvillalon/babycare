<?php

class Dentals extends Controller
{
    public function index($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (empty($id)) {
            // Redirect or show an error message indicating an invalid ID
            $this->redirect('children'); // Redirect to an error page
        }

        // Check if the ID exists in the children table
        $children = new Child();
        $child_row = $children->first('child_id', $id);

        if (!$child_row) {
            // If the ID doesn't exist in the database, redirect or show an error message
            $this->redirect('children'); // Redirect to an error page
        }

        $dentals = new Dental();
        $errors = [];

        $query = "select * from dentals order by id asc";
        $arr = [];

        $data = $dentals->query($query, $arr);


        $errors = [];
        $dentals = new Dental();

        if (count($_POST) > 0) {
            $dentals = new Dental();

            if ($dentals->validate($_POST)) {

                $_POST['child_id'] = $id;
                // $_POST['is_consult'] = isset($_POST['is_consult']) ? 1 : 0;
                // if ($_POST['is_consult'] == 0) {
                //     $_POST['result'] = 'N/A'; // Set result to null if not consulted
                // }

                $dentals = new Dental();
                $dentals->insertAndGetId($_POST);

                $this->redirect('dentals/' . $id);
            } else {
                $errors = $dentals->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('dentals', [
            'errors' => $errors,
            'rows' => $data,
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
        $dental = new Dental();
        $dental_row = $dental->first('dental_log_id', child_id_URL());

        $children = new Child();
        $child_row = $children->first('child_id', $dental_row->child_id);
        if (count($_POST) > 0) {

            if ($dental->validate($_POST)) {

                $_POST['child_id'] = $id;
                $_POST['is_consult'] = isset($_POST['is_consult']) ? 1 : 0;
                if ($_POST['is_consult'] == 0) {
                    $_POST['result'] = 'N/A'; // Set result to null if not consulted
                }

                $dental->updateDentals($child_row->child_id, $dental_row->dental_log_id, $_POST);
                $this->redirect('dentals/' . $child_row->child_id);
            } else {
                $errors = $dental->errors;
            }
        }

        $row = $dental->where('child_id', $child_row->child_id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'healthLogs.edit',
                [
                    'row' => $row,
                    'errors' => $errors,
                ]
            );
            echo $this->view('includes/footer');
        }
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
        $dentals = new Dental();

        if (count($_POST) > 0) {
            $dentals->delete($id);
            $this->redirect('dentals');
        }

        $row = $dentals->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'dentals.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
