<?php

class Anthropometrics extends Controller
{
    public function index($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        $errors = [];
        $anthropometrics = new Anthropometric();

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

        
        $child = new Anthropometric();
        $exists = $child->first('child_id', $id);
        
        if ($exists) {
            $this->edit($id);
            return; // Exit the method to prevent further execution
        } else {
            $this->add($id);
            return; // Exit the method to prevent further execution
        }
    }

    public function add($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];
        $anthropometrics = new Anthropometric();

        if (count($_POST) > 0) {
            $anthropometrics = new Anthropometric();

            if ($anthropometrics->validate($_POST)) {
                $_POST['child_id'] = $id;
                $_POST['date_recorded'] = date('Y-m-d H:i:s');
                $anthropometrics = new Anthropometric();
                $anthropometrics->insertAndGetId($_POST);

                $this->redirect('anthropometrics');
            } else {
                $errors = $anthropometrics->errors;
            }
        }

        $row = $anthropometrics->where('id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'anthropometrics.add',
                [
                    'row' => $row,
                    'errors' => $errors,

                ]
            );
            echo $this->view('includes/footer');
        }
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
        $feedback = [];
        $anthropometrics = new Anthropometric();

        if (count($_POST) > 0) {

            if ($anthropometrics->validate($_POST)) {
                $row = $anthropometrics->where('child_id', $id);
               
                $anthropometrics->updateAnthropometric($id, $row[0]->anthropometric_id, $_POST);
                
                $this->redirect('childrensingle/' . $id);
            } else {
                $errors = $anthropometrics->errors;
            }
        }

        $row = $anthropometrics->where('child_id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'anthropometrics.edit',
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
        $anthropometrics = new Anthropometric();

        if (count($_POST) > 0) {
            $anthropometrics->delete($id);
            $this->redirect('anthropometrics');
        }

        $row = $anthropometrics->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'anthropometrics.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
