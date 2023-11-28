<?php

class Milestones extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $milestones = new Milestone();

        $limit = 3;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        if (Auth::access('admin')) {
            $query = "select * from milestones order by id desc limit $limit offset $offset";
            $arr = [];

            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select * from milestones where (name like :find) order by id desc limit $limit offset $offset";
                $arr['find'] = $find;
            }

            $data = $milestones->query($query, $arr);
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('milestones', [
            'rows' => $data,
            'pager' => $pager,
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
            $milestones = new Milestone();

            if ($milestones->validate($_POST)) {

                $_POST['disabled'] = '1';

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
