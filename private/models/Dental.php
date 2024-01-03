<?php

class Dental extends Model
{

    protected $table = 'dentals';
    protected $allowedColumns = [
        // 'vaccine',
        // 'dose',
        // 'type',
        // 'lot',
        // 'expiration',
        // 'date_administered',
        // 'administered_by',
        // 'route_site_note',
    ];
    protected $beforeInsert = [
        'make_dental_id',
    ];

    public function validate($DATA)
    {
        $this->errors = [];

        if (empty($DATA['date']) || !$this->isValidDate($DATA['date'])) {
            $this->errors['date'] = 'Date: Invalid date format or date is not valid.';
        }

        $typeOptions = [
            "sickness", "accident"
        ];

        if (empty($DATA['type']) || !in_array($DATA['type'], $typeOptions)) {
            $this->errors['type'] = 'Type is not valid.';
        }

        if (empty($DATA['condition']) || !preg_match("/^[a-zA-Z0-9.\\/&,\\\\@()]+(?:\\s[a-zA-Z0-9.\\/&,\\\\@()]+)*$/", $DATA['condition'])) {
            $this->errors['condition'] = 'Condition: Only letters, numbers, and special characters (./&,\\@()) are allowed in this field, with no leading or trailing spaces';
        }


        $consultedChecked = isset($DATA['is_consult']) && $DATA['is_consult'] == '1';

        if ($consultedChecked) {
            if (empty($DATA['result']) || !preg_match("/^[a-zA-Z0-9.\\/&,\\\\@()]+(?:\\s[a-zA-Z0-9.\\/&,\\\\@()]+)*$/", $DATA['result'])) {
                $this->errors['result'] = 'Result: Required field and must contain only letters, numbers, and special characters (./&,\\@()).';
            }
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
