<?php

class Immunizations extends Controller
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

        $immunizations = new Immunization();
        $errors = [];

        $query = "select * from immunizations order by id asc";
        $arr = [];


        $data = $immunizations->query($query, $arr);

        if (count($_POST) > 0) {

            $immunizations = new Immunization();

            if ($immunizations->validate($_POST)) {
                $_POST['child_id'] = $id;

                // Handling custom vaccine input
                if ($_POST['vaccineSelect'] == 'Other' && !empty($_POST['customVaccine'])) {
                    $_POST['vaccine'] = sanitize_input($_POST['customVaccine']);
                } else {
                    $_POST['vaccine'] = sanitize_input($_POST['vaccineSelect']);
                }

                $insertData = [
                    'child_id' => $id,
                    'vaccine' => $_POST['vaccine'],
                    'dose' => $_POST['doseSelect'],
                    'type' => $_POST['type'],
                    'lot' => $_POST['lot'],
                    'expiration' => $_POST['expiration'],
                    'date_administered' => $_POST['date_administered'],
                    'administered_by' => $_POST['administered_by'],
                    'route_site_note' => $_POST['route_site_note'],
                ];

                $immunizations = new Immunization();
                $immunizations->insertAndGetId($insertData);

                $this->redirect('immunizations/' . $id);
            } else {
                $errors = $immunizations->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('immunizations', [
            'errors' => $errors,
            'rows' => $data,

        ]);
        echo $this->view('includes/footerImmunization');
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
        $immunizations = new Immunization();
        $immunization = new Immunization();
        $immunization_row = $immunization->first('immunization_id', child_id_URL());

        $children = new Child();
        $child_row = $children->first('child_id', $immunization_row->child_id);
        if (count($_POST) > 0) {

            if ($immunizations->validate($_POST)) {

                // Handling custom vaccine input
                if ($_POST['vaccineSelect'] == 'Other' && !empty($_POST['customVaccine'])) {
                    $_POST['vaccine'] = sanitize_input($_POST['customVaccine']);
                } else {
                    $_POST['vaccine'] = sanitize_input($_POST['vaccineSelect']);
                }

                $insertData = [
                    'child_id' => $immunization_row->child_id,
                    'vaccine' => $_POST['vaccine'],
                    'dose' => $_POST['doseSelect'],
                    'type' => $_POST['type'],
                    'lot' => $_POST['lot'],
                    'expiration' => $_POST['expiration'],
                    'date_administered' => $_POST['date_administered'],
                    'administered_by' => $_POST['administered_by'],
                    'route_site_note' => $_POST['route_site_note'],
                ];
                $immunizations->updateImmunizations($child_row->child_id, $immunization_row->immunization_id, $insertData);
                $this->redirect('immunizations/' . $child_row->child_id);
            } else {
                $errors = $immunizations->errors;
            }
        }

        $row = $immunizations->where('child_id', $child_row->child_id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'immunizations.edit',
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
        $immunizations = new Immunization();

        if (count($_POST) > 0) {
            $immunizations->delete($id);
            $this->redirect('immunizations');
        }

        $row = $immunizations->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'immunizations.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
