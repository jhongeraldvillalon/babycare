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

        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'staffs';
        $child_staff = new ChildStaff();
        $results = false;
        if ($page_tab == 'staffs-add' && count($_POST) > 0) {
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
                $query = "select id from child_staffs where user_id = :user_id && child_id = :child_id limit 1";
                if (!$child_staff->query($query, [
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
                    $errors[] = "That staff was already assigned to this child.";
                }
            }
        } else if ($page_tab == 'staffs') {
            $staffs = $child_staff->where('child_id', $id);
            $data['staffs'] = $staffs;
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
