<?php

class Dental extends Model
{

    protected $table = 'dentals';
    protected $allowedColumns = [
        'tooth_number',
        'date',
        'last_checkup_date',
        'observations',
        'tooth_removal',
        'root_canal_therapy',
        'is_erupt',
        'fillings',
        'crowns',
        'bridges',
        'dental_implants',
    ];
    protected $beforeInsert = [
        'make_dental_id',
    ];

    public function validate($DATA)
    {
        $this->errors = [];

        // Validate tooth_number as an integer
        if (empty($DATA['tooth_number']) || !filter_var(intval($DATA['tooth_number']), FILTER_VALIDATE_INT)) {
            $this->errors['tooth_number'] = 'Tooth Number: Empty or Invalid tooth number.';
        }

        if (empty($DATA['date']) || !$this->isValidDate($DATA['date'])) {
            $this->errors['date'] = 'Date: Invalid date format or date is not valid.';
        }

        if (empty($DATA['last_checkup_date']) || !$this->isValidDate($DATA['last_checkup_date'])) {
            $this->errors['last_checkup_date'] = 'Last Checkup Date: Invalid date format or date is not valid.';
        }

        if (empty($DATA['observations']) || !preg_match("/^[a-zA-Z0-9.\/&,\\\\@()]+(?:\s+[a-zA-Z0-9.\/&,\\\\@()]+)*$/", $DATA['observations'])) {
            $this->errors['observations'] = 'Observation: Only letters, numbers, and special characters (./&,\\@()) are allowed in this field, with no leading or trailing spaces';
        }

        if (!isset($DATA['tooth_removal']) || !in_array($DATA['tooth_removal'], ['0', '1'])) {
            $this->errors['tooth_removal'] = 'Tooth Removal: Please select a valid option.';
        }

        if (!isset($DATA['root_canal_therapy']) || !in_array($DATA['root_canal_therapy'], ['0', '1'])) {
            $this->errors['root_canal_therapy'] = 'Root Canal Therapy: Please select a valid option.';
        }

        if (!isset($DATA['is_erupt']) || !in_array($DATA['is_erupt'], ['0', '1'])) {
            $this->errors['is_erupt'] = 'Erupted: Please select a valid option.';
        }

        // Have other input

        $fillings = [
            'amalgam',
            'composite',
            'ceramic',
            'glass_ionomer',
            'gold',
            'temporary',
            'Other'
        ];

        // Check if the 'Other' option is selected and validate 'customVaccine'
        if (isset($DATA['fillingSelect']) && $DATA['fillingSelect'] == 'Other') {
            if (empty($DATA['customFilling'])) {
                $this->errors['customFilling'] = 'Custom Vaccine name is required';
            }
        } else {
            // Validate 'fillingSelect' if 'Other' is not selected
            if (empty($DATA['fillingSelect']) || !in_array($DATA['fillingSelect'], $fillings)) {
                $this->errors['fillingSelect'] = 'Selected Vaccine is not valid';
            }
        }

        // End of have other input


        // Have other input

        $crowns = [
            'stainless_steel',
            'metal',
            'porcelain_fused_to_metal',
            'all_resin',
            'all_ceramic',
            'zirconia',
            'e_max',
            'temporary',
            'Other'
        ];

        // Check if the 'Other' option is selected and validate 'customCrown'
        if (isset($DATA['crownSelect']) && $DATA['crownSelect'] == 'Other') {
            if (empty($DATA['customCrown'])) {
                $this->errors['customCrown'] = 'Custom Crown name is required';
            }
        } else {
            // Validate 'crownSelect' if 'Other' is not selected
            if (empty($DATA['crownSelect']) || !in_array($DATA['crownSelect'], $crowns)) {
                $this->errors['crownSelect'] = 'Selected Crown is not valid';
            }
        }

        // End of have other input

        // Have other input

        $bridges = [
            'traditional',
            'cantilever',
            'maryland_bonded',
            'implant_supported',
            'composite',
            'temporary',
            'Other'
        ];

        // Check if the 'Other' option is selected and validate 'customBridge'
        if (isset($DATA['bridgeSelect']) && $DATA['bridgeSelect'] == 'Other') {
            if (empty($DATA['customBridge'])) {
                $this->errors['customBridge'] = 'Custom Bridge name is required';
            }
        } else {
            // Validate 'bridgeSelect' if 'Other' is not selected
            if (empty($DATA['bridgeSelect']) || !in_array($DATA['bridgeSelect'], $bridges)) {
                $this->errors['bridgeSelect'] = 'Selected Bridge is not valid';
            }
        }

        // End of have other input

        // Have other input

        $dentalImplants = [
            'endosteal',
            'subperiosteal',
            'all_on_4',
            'mini',
            'immediate_load',
            'zygomatic',
            'implant_supported_bridge',
            'implant_retained_denture',
            'Other'
        ];

        // Check if the 'Other' option is selected and validate 'customDentalImplant'
        if (isset($DATA['dentalImplantSelect']) && $DATA['dentalImplantSelect'] == 'Other') {
            if (empty($DATA['customDentalImplant'])) {
                $this->errors['customDentalImplant'] = 'Custom Bridge name is required';
            }
        } else {
            // Validate 'dentalImplantSelect' if 'Other' is not selected
            if (empty($DATA['dentalImplantSelect']) || !in_array($DATA['dentalImplantSelect'], $dentalImplants)) {
                $this->errors['dentalImplantSelect'] = 'Selected Bridge is not valid';
            }
        }

        // End of have other input


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

    public function make_dental_id($data)
    {

        $data['dental_id'] = random_string(60);
        return $data;
    }

    public function insertAndGetId($data)
    {
        $data = $this->make_dental_id($data);


        // Encapsulate column names with backticks
        $keys = array_keys($data);
        $columns = '`' . implode("`,`", $keys) . '`';
        $values = ':' . implode(",:", $keys);


        $query = "INSERT INTO `$this->table` ($columns) VALUES ($values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the dental_id after insertion
        return $data['dental_id'];
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

    public function updateDentals($id, $dental_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            // Enclose the column name in backticks
            $str .= "`" . $key . "`=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['dental_id'] = $dental_id;

        $query = "UPDATE `$this->table` SET $str WHERE `dental_id` = :dental_id AND `child_id` = :child_id";
        return $this->query($query, $data);
    }
}
