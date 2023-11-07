<?php

class Database
{
    private function connect()
    {
        $string = "mysql:host=localhost;dbname=babycare;";
        if (!$con = new PDO($string, "root", "")) {
            // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            die("Can't connect to database");
        }

        return $con;
    }

    private function run($query, $data = [], $data_type = "object")
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);

        if ($stmt) {
            $check = $stmt->execute($data);
            if ($check) {
                if ($data_type == "object") {
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                if (is_array($data) && count($data) > 0) {
                    return $data;
                }
            }
        }

        return false;
    }

    public function query()
    {
    }
}
