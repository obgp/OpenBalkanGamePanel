<?php


error_reporting(E_ALL);

session_start();

ob_start();



/**

* Connect Database

* DB_HOST = 'db_host'

* DB_USER = 'db_user'

* DB_PASS = 'db_pass'

* DB_NAME = 'db_name'

*/

date_default_timezone_set("Europe/Belgrade");


function rootsec() {
$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";
return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
}

/**

* Include file 

*/

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/inc.php');



/**

* Admin activity

*/

echo admin_activity();



?>
