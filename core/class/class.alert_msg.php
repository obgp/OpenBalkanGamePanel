<?php

/**
* Message;
* Print message;
* Unset message;
*/

function sMSG($msg_txt, $msg_mode) {
	if ($msg_mode == 'success') {
		$_SESSION['msg_success'] = $msg_txt;
	} else if ($msg_mode == 'error') {
		$_SESSION['msg_error'] = $msg_txt;
	} else if ($msg_mode == 'info') {
		$_SESSION['msg_info'] = $msg_txt;
	} else if ($msg_mode == 'warning') {
		$_SESSION['msg_warning'] = $msg_txt;
	} else {
		echo "Error.";
	}

}

function eMSG() {
	//empty.
	$eAlert = '';

	if (isset($_SESSION['msg_success'])) {
		$eMSG = $_SESSION['msg_success'];

		$eAlert = "<div id='msg_bar_ok'><p>".$eMSG."</p></div>";
	} else if (isset($_SESSION['msg_error'])) {
		$eMSG = $_SESSION['msg_error'];

		$eAlert = "<div id='msg_bar_error'><p>".$eMSG."</p></div>";
	} else if (isset($_SESSION['msg_info'])) {
		$eMSG = $_SESSION['msg_info'];

		$eAlert = "<div id='msg_bar_info'><p>".$eMSG."</p></div>";
	} else if (isset($_SESSION['msg_warning'])) {
		$eMSG = $_SESSION['msg_warning'];

		$eAlert = "<div id='msg_bar_info'><p>".$eMSG."</p></div>";
	} else {
		$eMSG = "";
	}

	return $eAlert;
}

function unset_msg() {
	if (isset($_SESSION['msg_success'])) {
		unset($_SESSION['msg_success']);
	} else if (isset($_SESSION['msg_error'])) {
		unset($_SESSION['msg_error']);
	} else if (isset($_SESSION['msg_info'])) {
		unset($_SESSION['msg_info']);
	} else if (isset($_SESSION['msg_warning'])) {
		unset($_SESSION['msg_warning']);
	} else {
		
	}
}


?>