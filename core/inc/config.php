<?php



error_reporting(0);

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


include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/db_connect.php');


/**

* Include file 

*/

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/inc.php');



/**

* Client activity

*/

echo client_activity();



if (isset($_SESSION['user_login'])) {

	if (ban_user($_SESSION['user_login']) == 1) {

		include_once('user_ban.php');

		die();

	}

}



?>
