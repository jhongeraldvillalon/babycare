<?php

class Contacts extends Controller
{
    public function index($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        $errors = [];
        $contacts = new Contact();

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


        $child = new Contact();
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
        $contacts = new Contact();

        if (count($_POST) > 0) {
            $contacts = new Contact();

            if ($contacts->validate($_POST)) {
                $_POST['child_id'] = $id;
                $contacts = new Contact();
                $contacts->insertAndGetId($_POST);

                $this->redirect('contacts');
            } else {
                $errors = $contacts->errors;
            }
        }

        $row = $contacts->where('id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'contacts.add',
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
        $contacts = new Contact();

        if (count($_POST) > 0) {

            if ($contacts->validate($_POST)) {
                $row = $contacts->where('child_id', $id);

                $contacts->updateContact($id, $row[0]->contact_id, $_POST);

                $this->redirect('childrensingle/' . $id);
            } else {
                $errors = $contacts->errors;
            }
        }

        $row = $contacts->where('child_id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'contacts.edit',
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
        $contacts = new Contact();

        if (count($_POST) > 0) {
            $contacts->delete($id);
            $this->redirect('contacts');
        }

        $row = $contacts->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'contacts.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
