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


    public static function access($user_role)
    {
        if (!isset($_SESSION['USER'])) {
            return false;
        }

        $logged_in_role = $_SESSION['USER']->user_role;
        $USER_ROLE['super_admin'] = ['super_admin', 'admin', 'dentist', 'pediatrician', 'obgyne', 'parent'];
        $USER_ROLE['admin'] = ['admin', 'dentist', 'pediatrician', 'obgyne', 'parent'];
        $USER_ROLE['dentist'] = ['dentist'];
        $USER_ROLE['pediatrician'] = ['pediatrician'];
        $USER_ROLE['obgyne'] = ['obgyne'];
        $USER_ROLE['parent'] = ['parent'];

        if (!isset($USER_ROLE[$logged_in_role])) {
            return false;
        }

        if (in_array($user_role, $USER_ROLE[$logged_in_role])) {
            return true;
        }

        return false;
    }

    public static function i_own_content($row)
    {
        if (!isset($_SESSION['USER'])) {
            return false;
        }
        if (isset($row->user_id)) {
            if ($_SESSION['USER']->user_id == $row->user_id) {
                return true;
            }
        }

        $allowed[] = 'super_admin';
        $allowed[] = 'admin';

        if (in_array($_SESSION['USER']->user_role, $allowed)) {
            return true;
        }

        return false;
    }

    public static function isUserInChildTable($user_id, $table_name)
    {
        $child_table = new ChildParent(); // Initialize ChildParent or ChildStaff model
        // Check if the user exists in the specified table
        $result = $child_table->first('user_id', $user_id, 'AND', 'child_id', $table_name);
        return ($result !== false);
    }
}
