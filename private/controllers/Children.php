<?php

class Children extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $children = new Child();

        $limit = 3;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        if (Auth::access('admin')) {
            $query = "select * from children order by id desc limit $limit offset $offset";
            $arr = [];

            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select * from children where  (first_name like :find || middle_name like :find || last_name like :find) order by id desc limit $limit offset $offset";
                $arr['find'] = $find;
            }

            $data = $children->query($query, $arr);
        } else {
            // CODE TO CHECK IF THEY ARE INCLUDED IN CHILD_STAFFS
            $child = new Child();
            $mytable = "child_staffs";
            if (Auth::access('parent')) {
                $mytable = "child_parents";
            }

            $query = "select * from $mytable where user_id = :user_id && disabled = 0 limit $limit offset $offset";
            $arr['user_id'] = Auth::getUser_id();

            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select children.first_name,children.middle_name,children.last_name, {$mytable}.* from $mytable join children on children.child_id = {$mytable}.child_id where {$mytable}.user_id = :user_id && {$mytable}.disabled = 0 && (children.first_name like :find || children.last_name like :find || children.middle_name like :find) limit $limit offset $offset";
                $arr['find'] = $find;
            }

            $arr['children_parents'] = $child->query($query, $arr);

            $data = array();
            if ($arr['children_parents']) {
                foreach ($arr['children_parents'] as $key => $arow) {
                    // code...
                    $data[] = $child->first('child_id', $arow->child_id);
                }
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('children', [
            // 'crumbs' => $crumbs,
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
            $children = new Child();

            if ($children->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");

                // $children->insert($_POST);

                $children = new Child();
                $childId = $children->insertAndGetId($_POST);

                $childParent = new ChildParent();
                $childParentData = [
                    'user_id' => $_SESSION['USER']->user_id,
                    'child_id' => $childId,
                    'disabled' => 0,
                    'date' => date("Y-m-d H:i:s")
                ];

                $childParent->insert($childParentData);

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
        if (Auth::access('parent') || Auth::i_own_content($row)) {

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
