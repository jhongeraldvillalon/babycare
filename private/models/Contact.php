<?php

class Contact extends Model
{

    protected $table = 'contacts';
    public $feedback = [];
    protected $allowedColumns = [
        'hospital',
        'hospital_contact',
        'hospital_address',
        'pharmacy',
        'pharmacy_contact',
        'pharmacy_address',
        'ambulance',
        'ambulance_contact',
        'ambulance_address',
        'poison_control_center',
        'poison_control_center_contact',
        'poison_control_center_address',
        'burn_center',
        'burn_center_contact',
        'burn_center_address'
    ];
    protected $beforeInsert = [
        'make_contact_id',
    ];


    public function validate($DATA)
    {


        $this->errors = [];

        if (empty($DATA['hospital']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['hospital'])) {
            $this->errors['hospital'] = 'Hospital: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['hospital_contact']) || !preg_match("/^[0-9\-+]+$/", $DATA['hospital_contact'])) {
            $this->errors['hospital_contact'] = 'Hospital Contact Number: Only numbers, -, +, are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['hospital_address']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['hospital_address'])) {
            $this->errors['hospital_address'] = 'Hospital Address: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['pharmacy']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['pharmacy'])) {
            $this->errors['pharmacy'] = 'Pharmacy: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['pharmacy_contact']) || !preg_match("/^[0-9\-+]+$/", $DATA['pharmacy_contact'])) {
            $this->errors['pharmacy_contact'] = 'Pharmacy Contact Number: Only numbers, -, +, are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['pharmacy_address']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['pharmacy_address'])) {
            $this->errors['pharmacy_address'] = 'Pharmacy Address: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['ambulance']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['ambulance'])) {
            $this->errors['ambulance'] = 'Ambulance: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['ambulance_contact']) || !preg_match("/^[0-9\-+]+$/", $DATA['ambulance_contact'])) {
            $this->errors['ambulance_contact'] = 'Ambulance Contact Number: Only numbers, -, +, are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['ambulance_address']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['ambulance_address'])) {
            $this->errors['ambulance_address'] = 'Ambulance Address: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['poison_control_center']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['poison_control_center'])) {
            $this->errors['poison_control_center'] = 'Poison Control Center: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['poison_control_center_contact']) || !preg_match("/^[0-9\-+]+$/", $DATA['poison_control_center_contact'])) {
            $this->errors['poison_control_center_contact'] = 'Poison Control Center Contact Number: Only numbers, -, +, are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['poison_control_center_address']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['poison_control_center_address'])) {
            $this->errors['poison_contron_center_address'] = 'Poison Control Center Address: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['burn_center']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['burn_center'])) {
            $this->errors['burn_center'] = 'Burn Center: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['burn_center_contact']) || !preg_match("/^[0-9\-+]+$/", $DATA['burn_center_contact'])) {
            $this->errors['burn_center_contact'] = 'Burn Center Contact Number: Only numbers, -, +, are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['burn_center_address']) || !preg_match("/^[a-zA-Z0-9 ]+$/", $DATA['burn_center_address'])) {
            $this->errors['burn_center_address'] = 'Burn Center Address: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }


    public function make_contact_id($data)
    {

        $data['contact_id'] = random_string(60);
        return $data;
    }


    public function insertAndGetId($data)
    {
        $data = $this->make_contact_id($data);

        // Perform the insertion
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the contact_id after insertion
        return $data['contact_id'];
    }

    public function updatecontact($id, $contact_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['contact_id'] = $contact_id;
        $query = "update $this->table set $str where contact_id = :contact_id AND child_id = :child_id";
        // dd2($data, $query);
        return $this->query($query, $data);
    }
}
