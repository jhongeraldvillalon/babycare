<?php

class ChildrenSingle extends Controller
{
    public function index($id = '')
    {
        $errors = [];
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $children = new Child();

        $row = $children->first('child_id', $id);

        $limit = 9;
        $pager = new Pager($limit);
        $offset =   $pager->offset;

        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
        $child_staff = new ChildStaff();
        $child_parent = new ChildStaff();
        $results = false;

        if ($page_tab == 'staffs') {
            $query = "select * from child_staffs where child_id = :child_id && disabled = 0 order by id desc limit $limit offset $offset";
            $staffs = $child_staff->query($query, ['child_id' => $id]);
            $data['staffs'] = $staffs;
        } else if ($page_tab == 'parents') {
            $query = "select * from child_parents where child_id = :child_id && disabled = 0 order by id desc limit $limit offset $offset";
            $parents = $child_parent->query($query, ['child_id' => $id]);
            $data['parents'] = $parents;
        }
        echo $this->view('includes/header');
        echo $this->view('includes/nav');

        $data['row'] = $row;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['errors'] = $errors;
        $data['pager'] = $pager;


        echo $this->view('childrensingle', $data);
        echo $this->view('includes/footer');
    }

    public function staffs_add($id = '')
    {
        $errors = [];
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $children = new Child();

        $row = $children->first('child_id', $id);

        $page_tab = 'staffs_add';
        $child_staff = new ChildStaff();
        $results = false;

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . '%';
                    $query = "SELECT * FROM users 
            WHERE (first_name LIKE CONCAT('%', :fname, '%') OR last_name LIKE CONCAT('%', :lname, '%')) 
            AND approve = '1' 
            AND user_role NOT IN ('admin', 'super_admin', 'parent') 
            LIMIT 10";
                    $results = $user->query($query, [
                        "fname" => $name,
                        "lname" => $name,
                    ]);
                } else {
                    $errors[] = "Please type something to search for a name";
                }
            } else if (isset($_POST["selected"])) {
                // Add Staff
                $query = "select disabled, id from child_staffs where user_id = :user_id && child_id = :child_id limit 1";

                if (!$check = $child_staff->query($query, [
                    'user_id' => $_POST['selected'],
                    'child_id' => $id,
                ])) {
                    $arr = [];
                    $arr['user_id'] = $_POST['selected'];
                    $arr['child_id'] = $id;
                    $arr['disabled'] = 0;
                    $arr['date'] = date("Y-m-d H:i:s");

                    $child_staff->insert($arr);
                    $this->redirect("childrensingle/" . $id . "?tab=staffs");
                } else {
                    if (isset($check[0]->disabled)) {

                        if ($check[0]->disabled) {


                            $arr = [];
                            $arr['disabled'] = 0;

                            $child_staff->update($check[0]->id, $arr);
                            $this->redirect("childrensingle/" . $id . "?tab=staffs");
                        } else {
                            $errors[] = "That staff was already assigned to this child.";
                        }
                    } else {

                        $errors[] = "That staff was already assigned to this child.";
                    }
                }
            }
        }


        echo $this->view('includes/header');
        echo $this->view('includes/nav');

        $data['row'] = $row;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['errors'] = $errors;


        echo $this->view('childrensingle', $data);
        echo $this->view('includes/footer');
    }

    public function staffs_remove($id = '')
    {
        $errors = [];
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $children = new Child();

        $row = $children->first('child_id', $id);

        $page_tab = 'staffs_remove';
        $child_staff = new ChildStaff();
        $results = false;

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . '%';
                    $query = "SELECT * FROM users 
            WHERE (first_name LIKE CONCAT('%', :fname, '%') OR last_name LIKE CONCAT('%', :lname, '%')) 
            AND approve = '1' 
            AND user_role NOT IN ('admin', 'super_admin', 'parent') 
            LIMIT 10";
                    $results = $user->query($query, [
                        "fname" => $name,
                        "lname" => $name,
                    ]);
                } else {
                    $errors[] = "Please type something to search for a name";
                }
            } else if (isset($_POST["selected"])) {
                // remove Staff
                $query = "select id from child_staffs where user_id = :user_id && child_id = :child_id && disabled = 0 limit 1";

                if ($row = $child_staff->query($query, [
                    'user_id' => $_POST['selected'],
                    'child_id' => $id,
                ])) {
                    $arr = [];

                    $arr['disabled'] = 1;

                    $child_staff->update($row[0]->id, $arr);
                    $this->redirect("childrensingle/" . $id . "?tab=staffs");
                } else {
                    $errors[] = "That staff might not be assigned at this child thus you cant remove the staff";
                }
            }
        }


        echo $this->view('includes/header');
        echo $this->view('includes/nav');

        $data['row'] = $row;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['errors'] = $errors;


        echo $this->view('childrensingle', $data);
        echo $this->view('includes/footer');
    }

    public function parents_add($id = '')
    {
        $errors = [];
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $children = new Child();

        $row = $children->first('child_id', $id);

        $page_tab = 'parents_add';
        $child_parent = new ChildParent();
        $results = false;

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . '%';
                    $query = "SELECT * FROM users 
            WHERE (first_name LIKE CONCAT('%', :fname, '%') OR last_name LIKE CONCAT('%', :lname, '%')) 
            AND approve = '1' 
            AND user_role NOT IN ('admin', 'super_admin', 'pediatrician', 'obgyne', 'dentist') 
            LIMIT 10";
                    $results = $user->query($query, [
                        "fname" => $name,
                        "lname" => $name,
                    ]);
                } else {
                    $errors[] = "Please type something to search for a name";
                }
            } else if (isset($_POST["selected"])) {
                // Add parent
                $query = "select id, disabled from child_parents where user_id = :user_id && child_id = :child_id limit 1";

                if (!$check = $child_parent->query($query, [
        
                    'user_id' => $_POST['selected'],
                    'child_id' => $id,
                ])) {
                    $arr = [];
                    $arr['user_id'] = $_POST['selected'];
                    $arr['child_id'] = $id;
                    $arr['disabled'] = 0;
                    $arr['date'] = date("Y-m-d H:i:s");

                    $child_parent->insert($arr);
                    $this->redirect("childrensingle/" . $id . "?tab=parents");
                } else {


                    if (isset($check[0]->disabled)) {

                        if ($check[0]->disabled) {


                            $arr = [];
                            $arr['disabled'] = 0;

                            $child_parent->update($check[0]->id, $arr);
                            $this->redirect("childrensingle/" . $id . "?tab=parents");
                        } else {
                            $errors[] = "That parent was already assigned to this child.";
                        }
                    } else {

                        $errors[] = "That parent was already assigned to this child.";
                    }
                    $errors[] = "That parent was already assigned to this child.";
                }
            }
        }


        echo $this->view('includes/header');
        echo $this->view('includes/nav');

        $data['row'] = $row;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['errors'] = $errors;


        echo $this->view('childrensingle', $data);
        echo $this->view('includes/footer');
    }

    public function parents_remove($id = '')
    {
        $errors = [];
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $children = new Child();

        $row = $children->first('child_id', $id);

        $page_tab = 'parents_remove';
        $child_parent = new ChildParent();
        $results = false;

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . '%';
                    $query = "SELECT * FROM users 
            WHERE (first_name LIKE CONCAT('%', :fname, '%') OR last_name LIKE CONCAT('%', :lname, '%')) 
            AND approve = '1' 
            AND user_role NOT IN ('admin', 'super_admin', 'dentist', 'obgyne', 'pediatrician') 
            LIMIT 10";
                    $results = $user->query($query, [
                        "fname" => $name,
                        "lname" => $name,
                    ]);
                } else {
                    $errors[] = "Please type something to search for a name";
                }
            } else if (isset($_POST["selected"])) {
                // remove parent
                $query = "select id from child_parents where user_id = :user_id && child_id = :child_id && disabled = 0 limit 1";

                if ($row = $child_parent->query($query, [
                    'user_id' => $_POST['selected'],
                    'child_id' => $id,
                ])) {
                    $arr = [];

                    $arr['disabled'] = 1;

                    $child_parent->update($row[0]->id, $arr);
                    $this->redirect("childrensingle/" . $id . "?tab=parents");
                } else {
                    $errors[] = "That parent might not be assigned at this child thus you cant remove the staff";
                }
            }
        }


        echo $this->view('includes/header');
        echo $this->view('includes/nav');

        $data['row'] = $row;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['errors'] = $errors;


        echo $this->view('childrensingle', $data);
        echo $this->view('includes/footer');
    }
}
