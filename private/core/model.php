<?php

class Model extends Database
{
    public function __construct()
    {
        if (!property_exists($this, "table")) {

            $this->table = strtolower($this::class) . "s";
        }
    }

    public function where($column, $value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        return $this->query($query, [
            'value' => $value
        ]);
    }

    public function findAll()
    {
        $query = "select * from $this->table";
        return $this->query($query);
    }
}
