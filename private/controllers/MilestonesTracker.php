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
        // for Milestone Tracker
        $milestoneTracker = new MilestoneTracker();
        $milestoneTrackerRow = $milestoneTracker->where('child_id', $id);

        // Check if the ID exists in the children table
        $children = new Child();
        $child_row = $children->first('child_id', $id);
        if (!$child_row) {
            // If the ID doesn't exist in the database, redirect or show an error message
            $this->redirect('children'); // Redirect to an error page
        }

        // Calculate the age of the child in months
        if ($child_row) {
            $birthDate = new DateTime($child_row->birth_date);
            $currentDate = new DateTime();
            $interval = $birthDate->diff($currentDate);
            $ageInMonths = $interval->y * 12 + $interval->m;
        }

        if ($page_tab == "goals") {

            if ($ageInMonths <= 1) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1')";
            } else if ($ageInMonths < 2) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2')";
            } else if ($ageInMonths < 4) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4')";
            } else if ($ageInMonths < 6) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6')";
            } else if ($ageInMonths < 8) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8')";
            } else if ($ageInMonths < 10) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10')";
            } else if ($ageInMonths < 12) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10', '12')";
            } else if ($ageInMonths < 18) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10', '12', '18')";
            } else if ($ageInMonths < 24) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24')";
            } else if ($ageInMonths < 36) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', '36')";
            } else if ($ageInMonths < 48) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', 36', '48')";
            } else if ($ageInMonths < 60) {
                $query = "select * from milestones where disabled = 0 && age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', 36', '48', '60')";
            }
        } else {
            $query = "SELECT * FROM milestones 
            JOIN milestones_tracker ON milestones.milestone_id = milestones_tracker.milestone_id 
            WHERE milestones.disabled = 0 && milestones_tracker.accomplished = '1' && milestones_tracker.child_id = '$id'";
        }

        if ($child_row) {
            $queryError = "SELECT * FROM milestones WHERE disabled = 0 ";

            if ($ageInMonths <= 1) {
                $queryError .= "AND age_range in ('1')";
            } else if ($ageInMonths < 2) {
                $queryError .= "AND age_range in ('1', '2')";
            } else if ($ageInMonths < 4) {
                $queryError .= "AND age_range in ('1', '2', '4')";
            } else if ($ageInMonths < 6) {
                $queryError .= "AND age_range in ('1', '2', '4', '6')";
            } else if ($ageInMonths < 8) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8')";
            } else if ($ageInMonths < 10) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10')";
            } else if ($ageInMonths < 12) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12')";
            } else if ($ageInMonths < 18) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18')";
            } else if ($ageInMonths < 24) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24')";
            } else if ($ageInMonths < 36) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', '36')";
            } else if ($ageInMonths < 48) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', 36', '48')";
            } else if ($ageInMonths < 60) {
                $queryError .= "AND age_range in ('1', '2', '4', '6', '8', '10', '12', '18', '24', 36', '48', '60')";
            }

            $requiredMilestones = $milestones->query($queryError);

            if (is_iterable($requiredMilestones)) {
                foreach ($requiredMilestones as $milestone) {
                    // Check if the milestone has been accomplished
                    $milestoneCheck = $milestoneTracker->query("SELECT * FROM milestones_tracker WHERE child_id = :child_id AND milestone_id = :milestone_id AND accomplished = 1", [
                        'child_id' => $id,
                        'milestone_id' => $milestone->milestone_id
                    ]);

                    // If not accomplished, add an error message
                    if (!$milestoneCheck) {
                        $errors[] = "You haven't accomplished the milestone: <b>" . $milestone->name . "</b> for this child.";
                    }
                }
            }
        }

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
        echo $this->view('includes/footerMilestone', ['milestone_errors' => $errors]);
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
