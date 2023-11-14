<?php

require "config.php";
require "functions.php";
require "database.php";
require "controller.php";
require "model.php";
require "app.php";
require "../private/libraries/PHPMailer/src/PHPMailer.php";
require "../private/libraries/PHPMailer/src/SMTP.php";
require "../private/libraries/PHPMailer/src/Exception.php";

spl_autoload_register(function ($class_name) {
    require "../private/models/" .  ucfirst($class_name) . ".php";
});
