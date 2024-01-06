<?php

class ChildrenSingle extends Controller
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
            $this->redirect('children'); // Redirect to an error page
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


        $childPrint = new ChildPrint();
        $image = $childPrint->first('child_id', $id); // Fetching the first record based on 'child_id'

        // If you want an array instead of an object
        $images = ($image !== false) ? [$image] : [];
        $data['images'] = $images; // Pass the fetched images to the view

        // errors from milestones tracker

        $milestones = new Milestone();
        // for Milestone Tracker
        $milestoneTracker = new MilestoneTracker();

        $children = new Child();
        $child_row = $children->first('child_id', $id);
        if (!$child_row) {
            $this->redirect('childrensingle/' . $id);
        }

        // Calculate the age of the child in months
        if ($child_row) {
            $birthDate = new DateTime($child_row->birth_date);
            $currentDate = new DateTime();
            $interval = $birthDate->diff($currentDate);
            $ageInMonths = $interval->y * 12 + $interval->m;
        }

        if ($child_row) {

            $query = "SELECT * FROM milestones WHERE disabled = 0 ";

            if ($ageInMonths <= 1) {
                $query .= "AND age_range in ('1')";
            } else if ($ageInMonths < 2) {
                $query .= "AND age_range in ('1', '2')";
            } else if ($ageInMonths < 4) {
                $query .= "AND age_range in ('1', '2', '4')";
            } else if ($ageInMonths < 6) {
                $query .= "AND age_range in ('1', '2', '4', '6')";
            } else if ($ageInMonths < 8) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8')";
            } else if ($ageInMonths < 10) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10')";
            } else if ($ageInMonths < 12) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12')";
            } else if ($ageInMonths < 18) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18')";
            } else if ($ageInMonths < 24) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24')";
            } else if ($ageInMonths < 36) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', '36')";
            } else if ($ageInMonths < 48) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', 36', '48')";
            } else if ($ageInMonths < 60) {
                $query .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', 36', '48', '60')";
            }

            $requiredMilestones = $milestones->query($query);

            if (is_iterable($requiredMilestones)) {
                foreach ($requiredMilestones as $milestone) {
                    // Check if the milestone has been accomplished
                    $milestoneCheck = $milestoneTracker->query("SELECT * FROM milestones_tracker WHERE child_id = :child_id AND milestone_id = :milestone_id AND accomplished = 1", [
                        'child_id' => $id,
                        'milestone_id' => $milestone->milestone_id
                    ]);

                    // If not accomplished, add an error message
                    if (!$milestoneCheck) {
                        $errors[] = "You haven't accomplished the milestone: " . $milestone->name . " for this child.";
                    }
                }
            }
        }

        // END OF ERRORS IN MILESTONE TRACKER

        echo $this->view('includes/header');
        echo $this->view('includes/nav');

        $data['row'] = $row;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['milestone_errors'] = $errors;
        $data['pager'] = $pager;


        echo $this->view('childrensingle', $data);
        echo $this->view('includes/footerChildren', $data);
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

                    // Updated query to select only staffs associated with the child
                    $query = "SELECT users.* FROM users 
                              JOIN child_staffs ON users.user_id = child_staffs.user_id 
                              WHERE child_staffs.child_id = :child_id 
                              AND child_staffs.disabled = 0
                              AND (users.first_name LIKE :name OR users.last_name LIKE :name) 
                              AND users.approve = '1' 
                              AND users.user_role NOT IN ('admin', 'super_admin', 'parent') 
                              LIMIT 10";

                    $results = $user->query($query, [
                        "child_id" => $id,
                        "name" => $name,
                    ]);
                } else {
                    $errors[] = "Please type something to search for a name.";
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
