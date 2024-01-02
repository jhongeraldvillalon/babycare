<?php

class HealthAssessment extends Model
{

    protected $table = 'health_assessments';
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
        'make_health_assessment_id',
    ];

    public function validate($DATA)
    {
        $this->errors = [];

        if (empty($DATA['newborn_hearing_date'])) {
            $this->errors['newborn_hearing_date'] = 'Newborn hearing date is required.';
        }

        if (empty($DATA['newborn_screening_date'])) {
            $this->errors['newborn_screening_date'] = 'Newborn screening date is required.';
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_health_assessment_id($data)
    {

        $data['health_assessment_id'] = random_string(60);
        return $data;
    }

    public function insertAndGetId($data)
    {
        $data = $this->make_health_assessment_id($data);

        // Perform the insertion
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "insert into $this->table ($columns) values (:$values)";

        // Perform the insertion
        $this->query($query, $data);

        // Return the health_assessment_id after insertion
        return $data['health_assessment_id'];
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

    public function updateHealthAssessments($id, $health_assessment_id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['child_id'] = $id;
        $data['health_assessment_id'] = $health_assessment_id;
        $query = "update $this->table set $str where health_assessment_id = :health_assessment_id AND child_id = :child_id";
        // dd2($data, $query);
        return $this->query($query, $data);
    }
}
