<?php

class ChildPrint extends Model
{

    protected $table = 'child_prints';

    protected $allowedColumns = [
        'child_id',
        'date',
        'left_hand',
        'right_hand',
        'left_foot',
        'right_foot'
    ];
    protected $beforeInsert = [];

    protected $afterInsert = [];

    public function validate($DATA)
    {
        $allowedTypes = ["image/jpeg", "image/png"];

        foreach ($_FILES as $key => $file) {
            if ($file['error'] == 0 && !in_array($file['type'], $allowedTypes)) {
                $this->errors[$key] = 'Invalid file type for ' . $key;
            }
        }

        foreach ($this->errors as $error) {
            if (!empty($error)) {
                return false; // Return false if any error is encountered
            }
        }


        $has_image = false;
        if (count($_FILES) > 0) {
            $allowed[] = "image/jpeg";
            $allowed[] = "image/png";

            if ($_FILES['left_hand']['error'] == 0 && in_array($_FILES['left_hand']['type'], $allowed)) {
                $folder = "uploads/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $_FILES['left_hand']['name'];
                move_uploaded_file($_FILES["left_hand"]["tmp_name"], $destination);
                $_POST['left_hand'] = $destination;
            }

            if ($_FILES['right_hand']['error'] == 0 && in_array($_FILES['right_hand']['type'], $allowed)) {
                $folder = "uploads/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $_FILES['right_hand']['name'];
                move_uploaded_file($_FILES["right_hand"]["tmp_name"], $destination);
                $_POST['right_hand'] = $destination;
            }

            if ($_FILES['left_foot']['error'] == 0 && in_array($_FILES['left_foot']['type'], $allowed)) {
                $folder = "uploads/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $_FILES['left_foot']['name'];
                move_uploaded_file($_FILES["left_foot"]["tmp_name"], $destination);
                $_POST['left_foot'] = $destination;
            }

            if ($_FILES['right_foot']['error'] == 0 && in_array($_FILES['right_foot']['type'], $allowed)) {
                $folder = "uploads/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $_FILES['right_foot']['name'];
                move_uploaded_file($_FILES["right_foot"]["tmp_name"], $destination);
                $_POST['right_foot'] = $destination;
            }
        }

        $this->errors = [];
        if (empty($_FILES['left_hand'])) {
            $this->errors['left_hand'] = 'Please upload left hand print';
        }
        if (empty($_FILES['right_hand'])) {
            $this->errors['right_hand'] = 'Please upload right hand print';
        }
        if (empty($_FILES['left_foot'])) {
            $this->errors['left_foot'] = 'Please upload left foot print';
        }
        if (empty($_FILES['right_foot'])) {
            $this->errors['right_foot'] = 'Please upload right foot print';
        }


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }
}
