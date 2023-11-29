<?php

class MilestonesTracker extends Controller
{
    public function index($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        if (empty($id)) {
            $this->redirect('children');
        }
        $errors = [];
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : '';

        // Check if the ID exists in the children table
        $children = new Child();
        $child_row = $children->first('child_id', $id);

        if (!$child_row) {
            // If the ID doesn't exist in the database, redirect or show an error message
            $this->redirect('childrensingle/' . $id);
        }
        $arr = [];



        $milestones = new MilestoneTracker();
        $query = "select * from milestones_tracker";
        if ($page_tab == '6') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '6'";
        } else if ($page_tab == '6') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '6'";
        }
        $data = $milestones->query($query, $arr);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('milestonestracker', [
            'rows' => $data,
            'errors' => $errors,
            'page_tab' => $page_tab,
        ]);
        echo $this->view('includes/footer');
    }

    public function add($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];

        if (count($_POST) > 0) {
            $milestones = new Milestone();

            if ($milestones->validate($_POST)) {

                $_POST['accomplished'] = '1';

                $milestones = new Milestone();
                $milestoneId = $milestones->insertAndGetId($_POST);

                $this->redirect('milestones');
            } else {
                $errors = $milestones->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('milestones.add', [
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
        $milestones = new milestone();

        if (count($_POST) > 0) {

            if ($milestones->validate($_POST)) {

                $milestones->update($id, $_POST);
                $this->redirect('milestones');
            } else {
                $errors = $milestones->errors;
            }
        }

        $row = $milestones->where('id', $id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'milestones.edit',
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
        $milestones = new Milestone();

        if (count($_POST) > 0) {
            $milestones->delete($id);
            $this->redirect('milestones');
        }

        $row = $milestones->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'milestones.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
