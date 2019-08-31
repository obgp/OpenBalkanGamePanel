<?php

/**
* Site Name;
* Site Version;
* Site Developer;
* Site Link;
* Site Lang;
* Site Backup;
* Site Cron;
* Site Active;
*/

function site_name() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_name']).' | Admin Panel';
}

function real_site_name() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_name']);
}

function site_version() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_version']);
}

function site_developer() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_developer']);
}

function site_link() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_link']);
}

function site_lang() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_lang']);
}

function site_backup() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_backup']);
}

function site_cron() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_cron']);
}

function c_add_server() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['client_add_srw']);
}

function site_active() {
	$get_site_info = mysql_fetch_array(mysql_query("SELECT * FROM `site_settings`"));

	return txt($get_site_info['site_active']);
}

?>