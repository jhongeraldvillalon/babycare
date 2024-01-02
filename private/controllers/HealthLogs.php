<?php

class HealthLogs extends Controller
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

        $child = new HealthLog();
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
        $health_logs = new HealthLog();

        if (count($_POST) > 0) {
            $health_logs = new HealthLog();

            if ($health_logs->validate($_POST)) {
                $_POST['child_id'] = $id;
                $health_logs = new HealthLog();
                $health_logs->insertAndGetId($_POST);

                $this->redirect('childrensingle/' . $id);
            } else {
                $errors = $health_logs->errors;
            }
        }

        $row = $health_logs->where('child_id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'healthLogs.add',
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
        $healthLog = new HealthLog();

        if (count($_POST) > 0) {

            if ($healthLog->validate($_POST)) {
                $row = $healthLog->where('child_id', $id);

                $healthLog->updateHealthLogs($id, $row[0]->health_assessment_id, $_POST);

                // $this->redirect('childrensingle/' . $id);
            } else {
                $errors = $healthLog->errors;
            }
        }

        $row = $healthLog->where('child_id', $id);
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
        $healthLogs = new HealthLog();

        if (count($_POST) > 0) {
            $healthLogs->delete($id);
            $this->redirect('healthAssessments');
        }

        $row = $healthLogs->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'healthLogs.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
