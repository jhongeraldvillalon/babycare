<?php

class Database
{
    private function connect()
    {
        $string = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME . ";";
        if (!$con = new PDO($string, DBUSER, DBPASS)) {
            // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            die("Can't connect to database");
        }

        return $con;
    }

    public function query($query, $data = [], $data_type = "object")
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);
        $result = false;
        if ($stmt) {
            $check = $stmt->execute($data);
            if ($check) {
                if ($data_type == "object") {
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }

        if (is_array($result)) {
            if (property_exists($this, "afterSelect")) {
                foreach ($this->afterSelect as $func) {
                    $result = $this->$func($result);
                }
            }
        }
        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return false;
    }
}
