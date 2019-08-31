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

define('DB_HOST', 'localhost');

define('DB_USER', 'dev_gb');

define('DB_PASS', 'kolkijeprihod1337');

define('DB_NAME', 'dev_gb');



if (!$db_connect = @mysql_connect(DB_HOST, DB_USER, DB_PASS)) {

	die("<li> Sorry, site is not connecting to database. </li>");

}



if (!mysql_select_db(DB_NAME, $db_connect)) {

	die("<li> Sorry, cannot search to database. </li>");

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