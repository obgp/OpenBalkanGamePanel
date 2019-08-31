<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

/**
* User login;
* User INFO;
* UserName;
*/

function is_valid_user($u_id) {
	$u_info = mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'");
	if (mysql_num_rows($u_info) == 0) {
		$return = false;
	} else {
		$return = true;
	}

	return $return;
}

function ban_user($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['banovan']);
}

function ban_ftp($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['ftp_ban']);
}

function ban_support($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['support_ban']);
}

function ban_select($val) {
	if ($val == 1) {
		$val = 'Da';
	} else {
		$val = 'Ne';
	}

	return $val;
}

function user_name($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['username']);
}

function user_ime($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['ime']);
}

function user_prezime($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['prezime']);
}

function user_full_name($u_id) {
	return user_ime($u_id).' '.user_prezime($u_id);
}

function user_email($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['email']);
}

function user_pincode($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['sigkod']);
}

function user_token($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['token']);
}

function user_register($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['kreiran']);
}

function my_money($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['novac']);
}

function my_contry($u_id) {
	$u_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$u_id'"));

	return txt($u_info['zemlja']);
}

?>