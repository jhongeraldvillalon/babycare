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
        $health_logs = new HealthLog();
        $errors = [];

        $query = "select * from health_logs order by id asc";
        $arr = [];

        $data = $health_logs->query($query, $arr);


        $errors = [];
        $health_logs = new HealthLog();

        if (count($_POST) > 0) {
            $health_logs = new HealthLog();

            if ($health_logs->validate($_POST)) {
                $_POST['child_id'] = $id;
                $_POST['is_consult'] = isset($_POST['is_consult']) ? 1 : 0;
                if ($_POST['is_consult'] == 0) {
                    $_POST['result'] = 'N/A'; // Set result to null if not consulted
                }
                $health_logs = new HealthLog();
                $health_logs->insertAndGetId($_POST);

                $this->redirect('healthLogs/' . $id);
            } else {
                $errors = $health_logs->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('healthLogs', [
            'errors' => $errors,
            'rows' => $data,
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
        $healthLog = new HealthLog();
        $healthLog_row = $healthLog->first('health_log_id', child_id_URL());

        $children = new Child();
        $child_row = $children->first('child_id', $healthLog_row->child_id);
        if (count($_POST) > 0) {

            if ($healthLog->validate($_POST)) {

                $_POST['child_id'] = $id;
                $_POST['is_consult'] = isset($_POST['is_consult']) ? 1 : 0;
                if ($_POST['is_consult'] == 0) {
                    $_POST['result'] = 'N/A'; // Set result to null if not consulted
                }

                $healthLog->updateHealthLogs($child_row->child_id, $healthLog_row->health_log_id, $_POST);
                $this->redirect('healthLogs/' . $child_row->child_id);
            } else {
                $errors = $healthLog->errors;
            }
        }

        $row = $healthLog->where('child_id', $child_row->child_id);
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
