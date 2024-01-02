<?php

class HealthAssessments extends Controller
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

        $child = new HealthAssessment();
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
        $health_assessments = new HealthAssessment();

        if (count($_POST) > 0) {
            $health_assessments = new HealthAssessment();

            if ($health_assessments->validate($_POST)) {
                $_POST['child_id'] = $id;
                $health_assessments = new HealthAssessment();
                $health_assessments->insertAndGetId($_POST);

                $this->redirect('childrensingle/' . $id);
            } else {
                $errors = $health_assessments->errors;
            }
        }

        $row = $health_assessments->where('child_id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'healthAssessments.add',
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
        $healthAssessment = new HealthAssessment();

        if (count($_POST) > 0) {

            if ($healthAssessment->validate($_POST)) {
                $row = $healthAssessment->where('child_id', $id);

                $healthAssessment->updateHealthAssessments($id, $row[0]->health_assessment_id, $_POST);

                // $this->redirect('childrensingle/' . $id);
            } else {
                $errors = $healthAssessment->errors;
            }
        }

        $row = $healthAssessment->where('child_id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'healthAssessments.edit',
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
        $healthAssessments = new HealthAssessment();

        if (count($_POST) > 0) {
            $healthAssessments->delete($id);
            $this->redirect('healthAssessments');
        }

        $row = $healthAssessments->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'healthAssessments.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
