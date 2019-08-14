<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

/**
* Valid billing view;
*/

function is_valid_billing($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if (!$b_info) {
		return false;
	} else {
		return true;
	}
}

function billing_name($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['name']);
}

function billing_location($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$location = txt($b_info['location']);

	if ($location == 'lite1') {
		$return = 'DE';
	} else if ($location == 'lite2') {
		$return = 'FR';
	} else if ($location == 'lite3') {
		$return = 'IT';
	} else if ($location == 'premium1') {
		$return = 'RS';
	} else if ($location == 'premium2') {
		$return = 'BA';
	} else if ($location == 'premium3') {
		$return = 'HR';
	}
	
	return $return;
}

function billing_game_id($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['game_id']);
}

function game_billing_icon($g_id) {
	if ($g_id == 1) {
		$gp_game = '<img src="/assets/img/icon/gp/game/cs.ico" class="gp_game_icon"> Counter-Strike 1.6';
	} else if ($g_id == 2) {
		$gp_game = '<img src="/assets/img/icon/gp/game/samp.jpg" class="gp_game_icon"> San Andreas Multiplayer';
	} else if ($g_id == 3) {
		$gp_game = '<img src="/assets/img/icon/gp/game/mc.png" class="gp_game_icon"> Minecraft';
	} else if ($g_id == 4) {
		$gp_game = '<img src="/assets/img/icon/gp/game/cod2.png" class="gp_game_icon"> Call of Duty 2';
	} else if ($g_id == 5) {
		$gp_game = '<img src="/assets/img/icon/gp/game/cod4.png" class="gp_game_icon"> Call of Duty 4';
	} else if ($g_id == 6) {
		$gp_game = '<img src="/assets/img/icon/gp/game/ts3.png" class="gp_game_icon"> TeamSpeak 3';
	} else if ($g_id == 7) {
		$gp_game = '<img src="/assets/img/icon/gp/game/csgo.jpg" class="gp_game_icon"> Counter-Strike GO';
	} else if ($g_id == 8) {
		$gp_game = '<img src="/assets/img/icon/gp/game/mta.png" class="gp_game_icon"> Multi Theft Auto';
	} else if ($g_id == 9) {
		$gp_game = '<img src="/assets/img/icon/gp/game/ark.png" class="gp_game_icon"> ARK';
	}

	return $gp_game;
}

function billing_mod_name($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($b_info["mod_id"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return txt($m_info['ime']);
}

function billing_slot($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['slotovi']);
}

function billing_cena($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['cena']);
}

function billing_date($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['date']);
}

function billing_status($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$billing_status = txt($b_info['status']);

	if ($billing_status == 'success') {
		$return = "<span style='color: #54ff00;'>Success</span>";
	} else if ($billing_status == 'pending') {
		$return = "<span style='color: #ffd800;'>Na čekanju</span>";
	} else if ($billing_status == 'close') {
		$return = "<span style='color: red;'>Otkazano</span>";
	} else {
		$return = "<span style='color: red;'>Otkazano</span>";
	}

	return $return;
}

function billing_status_txt($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['status']);
}

function billing_install_srv($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['srv_install']);
}


function billing_z_install_srv($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['srv_z_install']);
}

function billing_dokaz($bid) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($bid, $_SESSION["user_login"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return txt($b_info['dokaz']);
}

function billing_num() {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `user_id` = ?");
	$SQLSEC->Execute(array($_SESSION["user_login"]));

	return $SQLSEC->rowCount();
}

?>