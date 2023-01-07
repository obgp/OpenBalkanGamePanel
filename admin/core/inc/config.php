<?php
error_log(E_ALL);
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	ob_start();
	date_default_timezone_set("Europe/Belgrade");
	if ($_SERVER["HTTP_HOST"] == "localhost") {
		// Database for localhost (Not-Live)
		function rootsec() {
			$servername = "localhost";
			$username   = "root";
			$password   = "1312";
			$dbname     = "obgp";
			return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
		}
	} else {
		//Database for Live
		function rootsec() {
			$servername = "localhost";
			$username   = "root";
			$password   = "1312";
			$dbname     = "obgp";
			return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
		}
	}
	/**
	* Include file 
	*/
	include_once($_SERVER["DOCUMENT_ROOT"]."/admin/core/inc/inc.php");

	echo admin_activity();
	?>