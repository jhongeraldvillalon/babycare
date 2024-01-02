<?php

class GrowthCharts extends Controller
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

        $growthcharts = new GrowthChart();
        $errors = [];

        $query = "select * from growth_charts order by id asc";
        $arr = [];


        $data = $growthcharts->query($query, $arr);

        if (count($_POST) > 0) {

            $growthcharts = new GrowthChart();

            if ($growthcharts->validate($_POST)) {
                $_POST['child_id'] = $id;


                if ($_POST['weight_metrics'] == 'pounds') {
                    $pounds = sanitize_input($_POST["weight"]);
                    $kilograms = $pounds / 2.20462;
                    $_POST['weight'] = $kilograms;
                } else {
                    $_POST['weight'] = sanitize_input($_POST["weight"]);
                }

                $_POST['length_metrics'] = sanitize_input($_POST["length_metrics"]);

                if ($_POST['length_metrics'] == 'inches') {
                    $inches = sanitize_input($_POST["length"]);
                    $centimeters = $inches * 2.54;
                    $_POST["length"] = $centimeters;
                } else {
                    $_POST["length"] = sanitize_input($_POST["length"]);
                }

                $growthcharts = new GrowthChart();
                $growthcharts->insertAndGetId($_POST);

                $this->redirect('growthcharts/' . $id);
            } else {
                $errors = $growthcharts->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('growthcharts', [
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

        $errors = [];
        $growthcharts = new GrowthChart();
        $growth_chart = new GrowthChart();
        $growth_chart_row = $growth_chart->first('growth_chart_id', child_id_URL());

        $children = new Child();
        $child_row = $children->first('child_id', $growth_chart_row->child_id);
        if (count($_POST) > 0) {

            if ($growthcharts->validate($_POST)) {

                $growthcharts->updategrowth_chart($child_row->child_id, $growth_chart_row->growth_chart_id, $_POST);
                $this->redirect('growthcharts/' . $child_row->child_id);
            } else {
                $errors = $growthcharts->errors;
            }
        }

        $row = $growthcharts->where('child_id', $child_row->child_id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'growthcharts.edit',
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

        $errors = [];
        $growthcharts = new GrowthChart();

        if (count($_POST) > 0) {
            $growthcharts->delete($id);
            $this->redirect('growthcharts');
        }

        $row = $growthcharts->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'growthcharts.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
