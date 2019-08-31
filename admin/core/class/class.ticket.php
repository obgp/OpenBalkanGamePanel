<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

/**
* Valid ticket;
*/

function is_valid_ticket($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	if (!$t_info) {
		return false;
	} else {
		return true;
	}
}

function ticket_status_id($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	return txt($t_info['status']);	
}

function ticket_s_pro($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	$status = txt($t_info['prioritet']);

	if($status == 1) {
        $status = "<span style='color: #54ff00;'> Normalno </span>";
    } else if($status == 2) {
        $status = "<span style='color: orange;'> Srednje </span>";
    } else if($status == 3) {
        $status = "<span style='color: red;'> Hitno </span>";
    }

	return $status;
}

function ticket_status($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	$status = txt($t_info['status']);

	if($status == 1) {
        $status = "<span style='color: #54ff00;'> Otvoren </span>";
    } else if($status == 2) {
        $status = "<span style='color: orange;'> Pročitan </span>";
    } else if($status == 3) {
        $status = "<span style='color: #54ff00;'> Odgovoren </span>";
    } else if($status == 4) {
        $status = "<span style='color: red;'> Zaključan </span>";
    }

	return $status;
}

function ticket_name($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	return txt($t_info['naslov']);
}

function ticket_text($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	return $t_info['text'];
}

function ticket_date($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	return txt($t_info['datum']);
}

function ticket_owner($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	return txt($t_info['user_id']);
}

function ticket_server($t_id) {
	$t_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	
	return txt($t_info['server_id']);
}

function ticket_red($t_id) {
	$t_info 	= mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$t_id'"));
	$all_info 	= mysql_query("SELECT * FROM `ticket_red` WHERE `status` = '1'");
	$r_info 	= mysql_query("SELECT * FROM `ticket_red` WHERE `ticket_id` = '$t_id' AND `status` = '1'");
	$rf_info 	= mysql_fetch_array($r_info);

	return $rf_info['red'].'/'.mysql_num_rows($all_info);
}

/* TICKET ODGOVOR */

function ticket_new_red() {
	$all_info 	= mysql_query("SELECT * FROM `ticket_red` WHERE `status` = '1'");
	
	return mysql_num_rows($all_info);
}

function ticket_poruke($t_id) {
	$t_info = mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `tiket_id` = '$t_id'");
	
	return mysql_num_rows($t_info);
}

function t_odg_text($t_odg_id) {
	$t_odg_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `id` = '$t_odg_id'"));
	
	return $t_odg_info['odgovor'];
}

function t_odg_time($t_odg_id) {
	$t_odg_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `id` = '$t_odg_id'"));
	
	return txt($t_odg_info['vreme_odgovora']);
}

function t_adm_id($t_odg_id) {
	$t_odg_info = mysql_fetch_array(mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `id` = '$t_odg_id'"));
	
	return txt($t_odg_info['admin_id']);
}

?>