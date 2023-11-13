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

    private static function hasRole($role)
    {
        return isset($_SESSION['USER']->user_role) && $_SESSION['USER']->user_role === $role;
    }

    public static function isApprove($approve)
    {
        return isset($_SESSION['USER']->approve) && $_SESSION['USER']->approve === $approve;
    }

    public static function isSuperAdmin()
    {
        return self::hasRole('super_admin');
    }

    public static function isAdmin()
    {
        return self::hasRole('admin') || self::hasRole('super_admin');
    }

    public static function isParent()
    {
        return self::hasRole('parent');
    }

    public static function isDentist()
    {
        return self::hasRole('dentist');
    }

    public static function isCurrentUser($userId)
    {
        return self::user_id() === $userId;
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['USER']);
    }
}
