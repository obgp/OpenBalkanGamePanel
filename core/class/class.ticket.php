<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

/**
* Valid ticket;
*/

function is_valid_ticket($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if (!$t_info) {
		return false;
	} else {
		return true;
	}
}

function ticket_status_id($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($t_info['status']);	
}

function ticket_status($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$status = txt($t_info['status']);

	if($status == 1) {
        $status = "<span style='color: green;'> Otvoren </span>";
    } else if($status == 2) {
        $status = "<span style='color: orange;'> Pročitan </span>";
    } else if($status == 3) {
        $status = "<span style='color: green;'> Odgovoren </span>";
    } else if($status == 4) {
        $status = "<span style='color: red;'> Zaključan </span>";
    }

	return $status;
}

function ticket_name($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($t_info['naslov']);
}

function ticket_text($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return $t_info['text'];
}

function ticket_date($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($t_info['datum']);
}

function ticket_red($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($t_id, $_SESSION["user_login"]));
	$t_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC2 = $rootsec->prepare("SELECT * FROM `ticket_red` WHERE `status` = '1'");
	$SQLSEC2 = $SQLSEC2->Execute();
	
	$SQLSEC3 = $rootsec->prepare("SELECT * FROM `ticket_red` WHERE `ticket_id` = ? AND `status` = '1'");
	$SQLSEC3 = $SQLSEC3->Execute(array($t_id));
	$rf_info = $SQLSEC3->fetch(PDO::FETCH_ASSOC);

	return $rf_info['red'].'/'.$SQLSEC2->rowCount();
}

/* TICKET ODGOVOR */

function ticket_new_red() {
	$rootsec = rootsec();

	$SQLSEC2 = $rootsec->prepare("SELECT * FROM `ticket_red` WHERE `status` = '1'");
	$SQLSEC2 = $SQLSEC2->Execute();

	return $SQLSEC2->rowCount();
}

function ticket_poruke($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi_odgovori` WHERE `tiket_id` = ?");
	$SQLSEC->Execute(array($t_id));
	
	return $SQLSEC->rowCount();
}

function t_odg_text($t_odg_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi_odgovori` WHERE `id` = ?");
	$SQLSEC->Execute(array($t_odg_id));
	$t_odg_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return $t_odg_info['odgovor'];
}

function t_odg_time($t_odg_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi_odgovori` WHERE `id` = ?");
	$SQLSEC->Execute(array($t_odg_id));
	$t_odg_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($t_odg_info['vreme_odgovora']);
}

function last_odg_time($t_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi_odgovori` WHERE `id` = ?");
	$SQLSEC->Execute(array($t_odg_id));
	$t_odg_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
		
	return txt($t_odg_info['time']);
}

?>