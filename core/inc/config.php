<?php

//error_reporting(0);
error_reporting(E_ERROR | E_PARSE);

session_start();

ob_start();

date_default_timezone_set("Europe/Belgrade");


include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/db_connect.php');

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/inc.php');

$waf = new WAF();
$waf->start();

echo client_activity();

if (isset($_SESSION['user_login'])) {

	if (ban_user($_SESSION['user_login']) == 1) {

		include_once('user_ban.php');

		die();

	}

}

?>
