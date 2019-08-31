<?php

/**
* Message;
* Print message;
* Unset message;
*/

function sMSG($msg_txt, $msg_mode) {
	if ($msg_mode == 'success') {
		$_SESSION['a_msg_success'] = $msg_txt;
	} else if ($msg_mode == 'error') {
		$_SESSION['a_msg_error'] = $msg_txt;
	} else if ($msg_mode == 'info') {
		$_SESSION['a_msg_info'] = $msg_txt;
	} else if ($msg_mode == 'warning') {
		$_SESSION['a_msg_warning'] = $msg_txt;
	} else {
		echo "Error.";
	}

	if (is_login() == true) {
		$get_ip = host_ip();
		$get_d_t = date('d.m.Y, H:i');

		mysql_query("INSERT INTO `logovi` (`id`, `clientid`, `message`, `name`, `ip`, `vreme`, `adminid`) VALUES (NULL, NULL, '$msg_txt', '$msg_mode', '$get_ip', '$get_d_t', '$_SESSION[admin_login]')");
	}
}

function eMSG() {
	//empty.
	$eAlert = '';

	if (isset($_SESSION['a_msg_success'])) {
		$eMSG = $_SESSION['a_msg_success'];

		$eAlert = "<div id='msg_bar_ok'><p>".$eMSG."</p></div>";
	} else if (isset($_SESSION['a_msg_error'])) {
		$eMSG = $_SESSION['a_msg_error'];

		$eAlert = "<div id='msg_bar_error'><p>".$eMSG."</p></div>";
	} else if (isset($_SESSION['a_msg_info'])) {
		$eMSG = $_SESSION['a_msg_info'];

		$eAlert = "<div id='msg_bar_info'><p>".$eMSG."</p></div>";
	} else if (isset($_SESSION['a_msg_warning'])) {
		$eMSG = $_SESSION['a_msg_warning'];

		$eAlert = "<div id='msg_bar_info'><p>".$eMSG."</p></div>";
	} else {
		$eMSG = "";
	}

	return $eAlert;
}

function unset_msg() {
	if (isset($_SESSION['a_msg_success'])) {
		unset($_SESSION['a_msg_success']);
	} else if (isset($_SESSION['a_msg_error'])) {
		unset($_SESSION['a_msg_error']);
	} else if (isset($_SESSION['a_msg_info'])) {
		unset($_SESSION['a_msg_info']);
	} else if (isset($_SESSION['a_msg_warning'])) {
		unset($_SESSION['a_msg_warning']);
	} else {
		
	}
}


?>