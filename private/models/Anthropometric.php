<?php

class Anthropometric extends Model
{

    protected $table = 'anthropometrics';
    public $feedback = [];
    protected $allowedColumns = [
        'weight',
        'length',
        'head',
        'chest',
        'abdomen',
        'weight_metric',
        'length_metric',
        'head_metric',
        'chest_metric',
        'abdomen_metric',
    ];
    protected $beforeInsert = [
        'make_anthropometric_id',
    ];


    public function validate($DATA)
    {


        $this->errors = [];
        $this->feedback = [];

        $weight_metric = [
            'kilograms', 'pounds'
        ];


        if (empty($DATA['weight_metric']) || !in_array($DATA['weight_metric'], $weight_metric)) {
            $this->errors['weight_metric'] = 'Weight Metric is not valid:';
        }

        if (!empty($DATA['weight']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['weight'])) {
            $this->errors['weight'] = 'Weight: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }

        $length_metric = [
            'cm', 'inches'
        ];

        if (empty($DATA['length_metric']) || !in_array($DATA['length_metric'], $length_metric)) {
            $this->errors['length_metric'] = 'Length Metric is not valid';
        }

        if (!empty($DATA['length']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['length'])) {
            $this->errors['length'] = 'Length: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }

        $head_metric = [
            'cm', 'inches'
        ];

        if (empty($DATA['head_metric']) || !in_array($DATA['head_metric'], $head_metric)) {
            $this->errors['head_metric'] = 'Head Metric is not valid';
        }

        if (!empty($DATA['head']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['head'])) {
            $this->errors['head'] = 'Head: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }


        $chest_metric = [
            'cm', 'inches'
        ];



        if (empty($DATA['chest_metric']) || !in_array($DATA['chest_metric'], $chest_metric)) {
            $this->errors['chest_metric'] = 'Chest Metric is not valid';
        }

        if (!empty($DATA['chest']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['chest'])) {
            $this->errors['chest'] = 'Chest: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }


        $abdomen_metric = [
            'cm', 'inches'
        ];

        if (empty($DATA['abdomen_metric']) && !in_array($DATA['abdomen_metric'], $abdomen_metric)) {
            $this->errors['abdomen_metric'] = 'Abdomen Metric is not valid';
        }

        if (!empty($DATA['abdomen']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['abdomen'])) {
            $this->errors['abdomen'] = 'Abdomen: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        if (count($this->feedback) == 0) {
            $this->feedback['feedback'] = "Task executed successfully";
            return true;
        }

        return false;
    }


    public function make_anthropometric_id($data)
    {

        $data['anthropometric_id'] = random_string(60);
        return $data;
    }


    public function insertAndGetId($data)
    {
        $data = $this->make_anthropometric_id($data);

        // Perform the insertion
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the anthropometric_id after insertion
        return $data['anthropometric_id'];
    }

    public function updateAnthropometric($id, $anthropometric_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['anthropometric_id'] = $anthropometric_id;
        $query = "update $this->table set $str where anthropometric_id = :anthropometric_id AND child_id = :child_id";
        // dd2($data, $query);
        return $this->query($query, $data);
    }
}
