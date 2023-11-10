<?php

class Auth

{
    public static function authenticate($row)
    {
        $_SESSION['USER'] = $row;
    }

    public static function logout()
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
    }

    public static function logged_in()
    {
        if (isset($_SESSION['USER'])) {
            return true;
        }
        return false;
    }


    public static function user()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->first_name;
        }
        return false;
    }

    public static function __callStatic($method, $params)
    {
        $prop = strtolower(str_replace('get', '', $method));
        if (isset($_SESSION['USER']->$prop)) {
            return $_SESSION['USER']->$prop;
        }
        return "Unknown";
    }
    public static function switch_hospital($id)
    {
        if (isset($_SESSION['USER']) && $_SESSION['USER']->user_role == 'super_admin') {
            $user = new User();
            $hospital = new Hospital();
            if ($row = $hospital->where('id', $id)) {
                $row = $row[0];
                $arr['hospital_id'] = $row->hospital_id;
                if ($user->update($_SESSION['USER']->id, $arr)) {
                    $_SESSION['USER']->hospital_name =  $row->hospital;
                }
            }
            return true;
        }
        return false;
    }
}
