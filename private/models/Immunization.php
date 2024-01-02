<?php

class Immunization extends Model
{

    protected $table = 'immunizations';
    protected $allowedColumns = [
        'vaccine',
        'dose',
        'type',
        'lot',
        'expiration',
        'date_administered',
        'administered_by',
        'route_site_note',
    ];
    protected $beforeInsert = [
        'make_immunization_id',
    ];

    public function validate($DATA)
    {
        $this->errors = [];

        $vaccines = [
            'BCG',
            'Hepatitis B',
            'Ditheria, Tetanus, Pertussis (DTP)',
            'Haemophius Influenzae Type B (Hib)',
            'Polio (IPV/OPV)',
            'Measles',
            'Measles, Mumps, Rubella (MMR)',
            'Varicella',
            'Hepatitis A',
            'Pneumococcal (PCV/PPV)',
            'Meningocal A+C',
            'Rotavirus',
            'Typhoid Fever',
            'Human Papillomavirus (HPV)',
            'Influenza',
            'Other'
        ];

        // Check if the 'Other' option is selected and validate 'customVaccine'
        if (isset($DATA['vaccineSelect']) && $DATA['vaccineSelect'] == 'Other') {
            if (empty($DATA['customVaccine'])) {
                $this->errors['customVaccine'] = 'Custom Vaccine name is required';
            }
        } else {
            // Validate 'vaccineSelect' if 'Other' is not selected
            if (empty($DATA['vaccineSelect']) || !in_array($DATA['vaccineSelect'], $vaccines)) {
                $this->errors['vaccineSelect'] = 'Selected Vaccine is not valid';
            }
        }

        $doseOptions = [
            "1", "2", "3", "4", "5", "6", "7",
            "Booster", "Booster 1", "Booster 2", "Booster 3",
            "Booster 4", "Booster 5", "Booster 6"
        ];

        if (empty($DATA['doseSelect']) || !in_array($DATA['doseSelect'], $doseOptions)) {
            $this->errors['doseSelect'] = 'Dose is not valid.';
        }

        if (empty($DATA['type']) || !preg_match("/^[a-zA-Z0-9.\\/&,\\\\@()]+(?:\\s[a-zA-Z0-9.\\/&,\\\\@()]+)*$/", $DATA['type'])) {
            $this->errors['type'] = 'Type: Only letters, numbers, and special characters (./&,\\@()) are allowed in this field, with no leading or trailing spaces';
        }


        if (empty($DATA['lot']) || !preg_match("/^[a-zA-Z0-9.\\/&,\\\\@()]+(?:\\s[a-zA-Z0-9.\\/&,\\\\@()]+)*$/", $DATA['lot'])) {
            $this->errors['lot'] = 'Lot: Only letters, numbers, and special characters (./&\\,@()) are allowed in this field, with no leading or trailing spaces';
        }

        if (empty($DATA['administered_by']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['administered_by'])) {
            $this->errors['administered_by'] = 'Administered by: Only letters are allowed in this field and no leading or trailing spaces';
        }

        if (empty($DATA['route_site_note']) || !preg_match("/^[a-zA-Z0-9.\\/&,\\\\@()]+(?:\\s[a-zA-Z0-9.\\/&,\\\\@()]+)*$/", $DATA['route_site_note'])) {
            $this->errors['route_site_note'] = 'Route Site / Notes: Only letters, numbers, and special characters (./&\\,@()) are allowed in this field, with no leading or trailing spaces';
        }

        if (empty($DATA['date_administered']) || !$this->isValidDate($DATA['date_administered'])) {
            $this->errors['date_administered'] = 'Date Administered: Invalid date format or date is not valid.';
        }

        if (empty($DATA['expiration']) || !$this->isValidDate($DATA['expiration'])) {
            $this->errors['expiration'] = 'Expiration Date: Invalid date format or date is not valid.';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    private function isValidDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
    public function make_immunization_id($data)
    {

        $data['immunization_id'] = random_string(60);
        return $data;
    }

    public function insertAndGetId($data)
    {
        $data = $this->make_immunization_id($data);

        // Perform the insertion
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the immunization_id after insertion
        return $data['immunization_id'];
    }

    public function where($column, $value, $order = 'asc')
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value order by id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        if (is_array($data)) {
            if (property_exists($this, "afterSelect")) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }

    public function updateImmunizations($id, $immunization_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['immunization_id'] = $immunization_id;
        $query = "update $this->table set $str where immunization_id = :immunization_id AND child_id = :child_id";
        // dd2($data, $query);
        return $this->query($query, $data);
    }

    public function isVaccineAdministered($child_id, $vaccine, $dose)
    {
        // Check if the specific dose of the vaccine has been administered
        $query = "SELECT * FROM immunizations WHERE child_id = :child_id AND vaccine = :vaccine AND dose = :dose";
        $result = $this->query($query, ['child_id' => $child_id, 'vaccine' => $vaccine, 'dose' => $dose]);
        return !empty($result);
    }
}
