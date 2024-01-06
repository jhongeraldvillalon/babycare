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

function child_id_URL_milestone()
{
    // Get the current URL path
    $current_url = $_SERVER['REQUEST_URI'];

    // Split the URL into path and query string
    $url_components = explode('?', $current_url);

    // The first component is the URL path
    $url_path = $url_components[0];

    // Split the URL path by '/'
    $url_parts = explode('/', $url_path);

    // The child_id will be the last part of the URL path
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

function checkOverdueImmunizations($child_id)
{
    $immunization = new Immunization();

    // Define the immunization schedule with specific doses
    $immunizationSchedule = [
        'BCG' => [
            '1' => 0  // BCG is usually given at birth (0 months)
        ],
        'Hepatitis B' => [
            '1' => 0,  // First dose at birth
            '2' => 1,  // Second dose at 1 month
            '3' => 6   // Third dose at 6 months
        ],
        'Ditheria, Tetanus, Pertussis (DTP)' => [
            '1' => 2,  // First dose at 2 months
            '2' => 4,  // Second dose at 4 months
            '3' => 6   // Third dose at 6 months
        ],
        'Haemophius Influenzae Type B (Hib)' => [
            '1' => 2,  // First dose at 2 months
            '2' => 4,  // Second dose at 4 months
            '3' => 6,  // Third dose at 6 months
            'Booster' => 12  // Booster dose at 12 months
        ],
        'Polio (IPV/OPV)' => [
            '1' => 2,  // First dose at 2 months
            '2' => 4,  // Second dose at 4 months
            '3' => 6,  // Third dose at 6 months
            'Booster' => 15  // Booster dose at 15-18 months
        ],
        'Measles' => [
            '1' => 12  // First dose at 12 months
        ],
        'Measles, Mumps, Rubella (MMR)' => [
            '1' => 12,  // First dose at 12 months
            '2' => 48   // Second dose at 4 years (48 months)
        ],
        'Varicella' => [
            '1' => 12,  // First dose at 12 months
            '2' => 48   // Second dose at 4 years (48 months)
        ],
        'Hepatitis A' => [
            '1' => 12,  // First dose at 12 months
            '2' => 18   // Second dose at 18 months
        ],
        'Pneumococcal (PCV/PPV)' => [
            '1' => 2,   // First dose at 2 months
            '2' => 4,   // Second dose at 4 months
            '3' => 6,   // Third dose at 6 months
            'Booster' => 12  // Booster dose at 12 months
        ],
        'Meningocal A+C' => [
            '1' => 9  // First dose at 9 months
        ],
        'Rotavirus' => [
            '1' => 2,  // First dose at 2 months
            '2' => 4,  // Second dose at 4 months
            '3' => 6   // Third dose at 6 months
        ],
        'Typhoid Fever' => [
            '1' => 24  // First dose at 2 years (24 months)
        ],
        'Human Papillomavirus (HPV)' => [
            '1' => 132,  // First dose starting from 11 years (132 months)
            '2' => 144   // Second dose 6-12 months after the first dose (e.g., at 12 years or 144 months)
        ],
        'Influenza' => [
            // Annual vaccination, starting from 6 months old
            // The specific doses will depend on the child's age and previous vaccination history
        ],
        // 'Other' vaccine schedules can be added based on specific requirements
    ];

    // Calculate the child's age in months
    $child = new Child();
    $child_row = $child->first('child_id', $child_id);
    $birthDate = new DateTime($child_row->birth_date);
    $currentDate = new DateTime();
    $interval = $birthDate->diff($currentDate);
    $ageInMonths = $interval->y * 12 + $interval->m;

    $overdueImmunizations = [];
    foreach ($immunizationSchedule as $vaccine => $doses) {
        // Iterate through each dose for the vaccine
        foreach ($doses as $dose => $dueMonth) {
            // Check if the dose is overdue and not administered
            if ($ageInMonths >= $dueMonth && !$immunization->isVaccineAdministered($child_id, $vaccine, $dose)) {
                // Add the overdue dose to the notification list
                $overdueImmunizations[] = $vaccine . " - " . $dose . " (Dose due at " . $dueMonth . " months)";
            }
        }
    }

    return $overdueImmunizations;
}
