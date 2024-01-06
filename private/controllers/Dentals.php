<?php

class Dentals extends Controller
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

        $dentals = new Dental();
        $errors = [];

        $query = "select * from dentals order by id asc";
        $arr = [];

        $data = $dentals->query($query, $arr);


        $errors = [];
        $dentals = new Dental();

        if (count($_POST) > 0) {

            $dentals = new Dental();

            if ($dentals->validate($_POST)) {
                $_POST['child_id'] = $id;

                // Handling custom filling other input
                if ($_POST['fillingSelect'] == 'Other' && !empty($_POST['customFilling'])) {
                    $_POST['fillings'] = sanitize_input($_POST['customFilling']);
                } else {
                    $_POST['fillings'] = sanitize_input($_POST['fillingSelect']);
                }
                // End of handling filling other input

                // Handling custom filling other input
                if ($_POST['crownSelect'] == 'Other' && !empty($_POST['customCrown'])) {
                    $_POST['crowns'] = sanitize_input($_POST['customCrown']);
                } else {
                    $_POST['crowns'] = sanitize_input($_POST['crownSelect']);
                }
                // End of handling filling other input

                // Handling custom filling other input
                if ($_POST['bridgeSelect'] == 'Other' && !empty($_POST['customBridge'])) {
                    $_POST['bridges'] = sanitize_input($_POST['customBridge']);
                } else {
                    $_POST['bridges'] = sanitize_input($_POST['bridgeSelect']);
                }
                // End of handling filling other input

                // Handling custom filling other input
                if ($_POST['dentalImplantSelect'] == 'Other' && !empty($_POST['customDentalImplant'])) {
                    $_POST['dental_implants'] = sanitize_input($_POST['customDentalImplant']);
                } else {
                    $_POST['dental_implants'] = sanitize_input($_POST['dentalImplantSelect']);
                }
                // End of handling filling other input
                $_POST['tooth_number'] = intval($_POST['tooth_number']);
                $insertData = [
                    'child_id' => $id,
                    'tooth_number' => $_POST['tooth_number'],
                    'date' => $_POST['date'],
                    'last_checkup_date' => $_POST['last_checkup_date'],
                    'observations' => $_POST['observations'],
                    'tooth_removal' => $_POST['tooth_removal'],
                    'root_canal_therapy' => $_POST['root_canal_therapy'],
                    'is_erupt' => $_POST['is_erupt'],
                    // Have Others Field
                    'fillings' => $_POST['fillings'],
                    'crowns' => $_POST['crowns'],
                    'bridges' => $_POST['bridges'],
                    'dental_implants' => $_POST['dental_implants']
                    // End of have Others field
                ];

                $dentals = new Dental();
                $dentals->insertAndGetId($insertData);

                $this->redirect('dentals/' . $id);
            } else {
                $errors = $dentals->errors;
            }
        }

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('dentals', [
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
        $dentals = new Dental();
        $dental = new Dental();
        $dental_row = $dental->first('dental_id', child_id_URL());

        $children = new Child();
        $child_row = $children->first('child_id', $dental_row->child_id);
        if (count($_POST) > 0) {

            if ($dentals->validate($_POST)) {

                // Handling custom filling other input
                if ($_POST['fillingSelect'] == 'Other' && !empty($_POST['customFilling'])) {
                    $_POST['fillings'] = sanitize_input($_POST['customFilling']);
                } else {
                    $_POST['fillings'] = sanitize_input($_POST['fillingSelect']);
                }
                // End of handling filling other input

                // Handling custom filling other input
                if ($_POST['crownSelect'] == 'Other' && !empty($_POST['customCrown'])) {
                    $_POST['crowns'] = sanitize_input($_POST['customCrown']);
                } else {
                    $_POST['crowns'] = sanitize_input($_POST['crownSelect']);
                }
                // End of handling filling other input

                // Handling custom filling other input
                if ($_POST['bridgeSelect'] == 'Other' && !empty($_POST['customBridge'])) {
                    $_POST['bridges'] = sanitize_input($_POST['customBridge']);
                } else {
                    $_POST['bridges'] = sanitize_input($_POST['bridgeSelect']);
                }
                // End of handling filling other input

                // Handling custom filling other input
                if ($_POST['dentalImplantSelect'] == 'Other' && !empty($_POST['customDentalImplant'])) {
                    $_POST['dental_implants'] = sanitize_input($_POST['customDentalImplant']);
                } else {
                    $_POST['dental_implants'] = sanitize_input($_POST['dentalImplantSelect']);
                }
                // End of handling filling other input

                $insertData = [
                    'child_id' => $id,
                    'tooth_number' => $_POST['tooth_number'],
                    'date' => $_POST['date'],
                    'last_checkup_date' => $_POST['last_checkup_date'],
                    'observations' => $_POST['observations'],
                    'tooth_removal' => $_POST['tooth_removal'],
                    'root_canal_therapy' => $_POST['root_canal_therapy'],
                    'is_erupt' => $_POST['is_erupt'],
                    // Have Others Field
                    'fillings' => $_POST['fillings'],
                    'crowns' => $_POST['crowns'],
                    'bridges' => $_POST['bridges'],
                    'dental_implants' => $_POST['dental_implants']
                    // End of have Others field
                ];


                $dentals->updateDentals($child_row->child_id, $dental_row->dental_id, $insertData);
                $this->redirect('dentals/' . $child_row->child_id);
            } else {
                $errors = $dentals->errors;
            }
        }

        $row = $dentals->where('child_id', $child_row->child_id);
        if (Auth::access('parent') || Auth::i_own_content($row)) {

            echo $this->view('includes/header');
            echo $this->view('includes/nav');
            echo $this->view(
                'dentals.edit',
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
        $dentals = new Dental();

        if (count($_POST) > 0) {
            $dentals->delete($id);
            $this->redirect('dentals');
        }

        $row = $dentals->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'dentals.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
