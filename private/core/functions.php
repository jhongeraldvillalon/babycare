<?php

function get_var($key, $default = "")
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

function get_select($key, $value)
{
    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return "selected";
        }
    }
    return "";
}

function esc($var)
{
    return htmlspecialchars($var);
}

function random_string($length)
{
    $array = array(
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
    );

    $text = '';

    for ($i = 0; $i < $length; $i++) {
        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}

function  get_date($date)
{
    return date("M j, Y", strtotime($date));
}


function show($data)
{
    echo "<pre>" . var_dump($data) . "</pre>";
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function dd2($data, $data2)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    echo "<pre>";
    var_dump($data2);
    echo "</pre>";
    die();
}

function get_image($image, $gender = '')
{
    if ($image && is_string($image) && file_exists($image)) {
        return ROOT . "/" . $image;
    } else {
        if ($gender == "male" || $gender == "female") {
            return ASSETS . "/parent.png";
        } else {
            return ASSETS . "/parent.png";
        }
    }
}

function views_path($view)
{
    if (file_exists("../private/views/" . $view . ".inc.php")) {
        return ("../private/views/" . $view . ".inc.php");
    } else {
        return ("../private/views/404.view.php");
    }
}

function getCurrentURL()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    $currentURL = $protocol . "://" . $host . $uri;

    return $currentURL;
}


function child_id_URL()
{
    // Check if there's a record in the database for the current child ID
    // Get the current URL path
    $current_url = $_SERVER['REQUEST_URI'];

    // Split the URL path by '/'
    $url_parts = explode('/', $current_url);

    // The child_id will be the last part of the URL
    return end($url_parts);
}

function calculateBabyAgeInMonths($birthday)
{
    $birthdayTimestamp = strtotime($birthday);
    $currentTimestamp = time();
    $diff = $currentTimestamp - $birthdayTimestamp;
    $ageInMonths = floor($diff / (30 * 24 * 60 * 60));
    return $ageInMonths;
}

function sanitize_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}