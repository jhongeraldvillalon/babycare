<?php

class Model extends Database
{
    protected $table = "users";
    public function __construct()
    {
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
