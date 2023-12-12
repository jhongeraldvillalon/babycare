<?php

class GrowthChart extends Model
{

    protected $table = 'growth_charts';

    protected $allowedColumns = [
        'length',
        'length_metrics',
        'weight',
        'weight_metrics',
        'body_mass_index',
        'notes_observation',
    ];
    protected $beforeInsert = [
        'make_growth_chart_id',
    ];

    public function validate($DATA)
    {
        $this->errors = [];

        $weight_metric = [
            'kilograms', 'pounds'
        ];


        if (empty($DATA['weight_metrics']) || !in_array($DATA['weight_metrics'], $weight_metric)) {
            $this->errors['weight_metrics'] = 'Weight Metric is not valid:';
        }

        if (!empty($DATA['weight']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['weight'])) {
            $this->errors['weight'] = 'Weight: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }

        $length_metric = [
            'cm', 'inches'
        ];

        if (empty($DATA['length_metrics']) || !in_array($DATA['length_metrics'], $length_metric)) {
            $this->errors['length_metric'] = 'Length Metric is not valid';
        }

        if (!empty($DATA['length']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['length'])) {
            $this->errors['length'] = 'Length: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }

        if (!empty($DATA['body_mass_index']) && !preg_match("/^[+-]?\d*\.?\d+$/", $DATA['body_mass_index'])) {
            $this->errors['body_mass_index'] = 'Body Mass Index: Only floating point or integer values are allowed in this field, no leading/trailing spaces or special characters';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }
    public function make_growth_chart_id($data)
    {

        $data['growth_chart_id'] = random_string(60);
        return $data;
    }

    public function insertAndGetId($data)
    {
        $data = $this->make_growth_chart_id($data);

        // Perform the insertion
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the growth_chart_id after insertion
        return $data['growth_chart_id'];
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

    public function updategrowth_chart($id, $growth_chart_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['growth_chart_id'] = $growth_chart_id;
        $query = "update $this->table set $str where growth_chart_id = :growth_chart_id AND child_id = :child_id";
        // dd2($data, $query);
        return $this->query($query, $data);
    }

}
