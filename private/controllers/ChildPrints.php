<?php

class ChildPrints extends Controller
{
    public function index($id = '')
    {
        $errors = [];
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
            $this->redirect('childrensingle/' . $id); // Redirect to an error page
        }

        if (count($_FILES) > 0) {
            $child_prints = new ChildPrint();
            if ($child_prints->validate($_FILES)) {
                $data = [
                    'child_id' => $id,
                    'date' => date('Y-m-d H:i:s'),
                    'left_hand' => $_POST['left_hand'], // Adjust this to store the file path or name
                    'right_hand' => $_POST['right_hand'], // Adjust this to store the file path or name
                    'left_foot' => $_POST['left_foot'], // Adjust this to store the file path or name
                    'right_foot' => $_POST['right_foot'], // Adjust this to store the file path or name
                ];
                $data['child_id'];
                $child_prints->insert($data);
                $this->redirect('childprints');
            } else {
                $errors = $child_prints->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        $data['errors'] = $errors;
        echo $this->view('childprints', $data);
        echo $this->view('includes/footer');
    }
}
