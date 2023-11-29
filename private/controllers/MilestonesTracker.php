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
        $arr = [];
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
        $milestones = new Milestone();

        // Check if the ID exists in the children table
        $children = new Child();
        $child_row = $children->first('child_id', $id);
        if (!$child_row) {
            $this->redirect('childrensingle/' . $id);
        }

        $milestones = new Milestone();
        $query = "SELECT * FROM milestones 
                  INNER JOIN milestones_tracker ON milestones.milestone_id = milestones_tracker.milestone_id 
                  WHERE milestones.disabled = 0 
                  AND milestones_tracker.accomplished = 1";

        if ($page_tab == '1') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '1'";
        } else if ($page_tab == '2') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '2'";
        } else if ($page_tab == '4') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '4'";
        } else if ($page_tab == '6') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '6'";
        } else if ($page_tab == '8') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '8'";
        } else if ($page_tab == '10') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '10'";
        } else if ($page_tab == '12') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '12'";
        } else if ($page_tab == '18') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '18'";
        } else if ($page_tab == '24') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '24'";
        } else if ($page_tab == '36') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '36'";
        } else if ($page_tab == '48') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '48'";
        } else if ($page_tab == '60') {
            $milestones = new Milestone();
            $query = "select * from milestones where disabled = 0 && age_range = '60'";
        } else {
            $milestones = new Milestone();
            $query = "SELECT * FROM milestones 
                      INNER JOIN milestones_tracker ON milestones.milestone_id = milestones_tracker.milestone_id 
                      WHERE milestones.disabled = 0 
                      AND milestones_tracker.accomplished = 1";
        }

        if ($page_tab == "completed") {
        }
        $milestoneTracker = new MilestoneTracker();
        $milestoneTrackerRow = $milestoneTracker->where('child_id', $id);

        $data = $milestones->query($query, $arr);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('milestonestracker', [
            'rows' => $data,
            'milestoneTrackerRow' => $milestoneTrackerRow,
            'errors' => $errors,
            'page_tab' => $page_tab,
            'child_id' => $id
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
            $milestonesTracker = new MilestoneTracker();

            $query = "SELECT accomplished FROM milestones_tracker WHERE milestone_id = :milestone_id AND child_id = :child_id LIMIT 1";
            $check = $milestonesTracker->query($query, [
                'milestone_id' => $_POST['milestone_id'],
                'child_id' => $id,
            ]);

            if (!$check) {
                // No record found, insert new record
                $arr = [
                    'milestone_id' => $_POST['milestone_id'],
                    'child_id' => $id,
                    'accomplished' => 1,
                    'accomplished_date' => date("Y-m-d H:i:s"),
                ];

                $milestonesTracker->insert($arr);
                $this->redirect('milestonestracker/' . $id);
            } else {
                // Record found, update the existing record if necessary
                $accomplishedStatus = $check[0]->accomplished;

                if ($accomplishedStatus === 1) {
                    // $errors[] = "That milestone was already accomplished by this child.";
                    $arr = [
                        'accomplished' => 0,
                    ];

                    $milestonesTracker->updateMilestoneTracker($id, $_POST['milestone_id'], $arr);
                    $this->redirect('milestonestracker/' . $id);
                } else {
                    // If accomplished is 0, set it to 1
                    $arr = [
                        'accomplished' => 1,
                    ];

                    $milestonesTracker->updateMilestoneTracker($id, $_POST['milestone_id'], $arr);
                    $this->redirect('milestonestracker/' . $id);
                }
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('milestonestracker', [
            'errors' => $errors,
        ]);
        echo $this->view('includes/footer');
    }
}
