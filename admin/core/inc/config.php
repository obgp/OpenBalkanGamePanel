<?php

ini_set('display_errors', 1); // Kad bude Live zameni sa 1 => 0;
ini_set('display_startup_errors', 1); // Kad bude Live zameni sa 1 => 0;
ini_set('error_log', 'dev/logs/errors.log'); // Logging file path
error_reporting(E_ALL | E_STRICT | E_NOTICE);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ob_start();

date_default_timezone_set('Europe/Belgrade');

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // Database for localhost (Not-Live)
    function rootsec() {
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "obgp";
        return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    }
} else {
    //Database for Live
    function rootsec() {
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "obgp";
        return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    }
}

/**
* Include file 
*/

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/inc.php');


/**
* Admin activity
*/
echo admin_activity();
