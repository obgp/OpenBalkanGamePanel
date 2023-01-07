<?php

/**
* 
*/

function is_money() {
	$my_money = money_val_code(my_money($_SESSION['user_login']), my_contry($_SESSION['user_login']));;
	if (cena_slota_code(12) > $my_money) {
		return false;
	} else {
		return true;
	}
}

function drzava_valuta($d) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC->Execute(array($d));
	$drzava = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	if($drzava) {
	return $drzava["currencysign"];
	} else {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `id` = ?");
	$SQLSEC->Execute(array(0));
	$drzava = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $drzava["currencysign"];
	}
}

function drzava($d) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC->Execute(array($d));
	$drzava = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return $drzava["country"];
}

function euro_for_slot($s_id) {
	$rootsec = rootsec();
	$g_id = gp_game_id($s_id);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_id));
	$ss_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC2 = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC2->Execute(array($ss_info["user_id"]));
	$uu_info = $SQLSEC2->fetch(PDO::FETCH_ASSOC);

	$SQLSEC3 = $rootsec->prepare("SELECT * FROM `gp_cene` WHERE `game_id` = ?");
	$SQLSEC3->Execute(array($g_id));
	$slot_cena = $SQLSEC3->fetch(PDO::FETCH_ASSOC);

	$cena_slota = explode('|', $slot_cena['cena_slota']);

	$SQLSEC4 = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC4->Execute(array($uu_info['zemlja']));
	$drzava = $SQLSEC4->fetch(PDO::FETCH_ASSOC);

	$cena = $cena_slota[$drzava["id"]];

	$cenaslota = round($cena * server_slot($s_id), 2);
	$cenaslota = number_format($cenaslota, 2);
	
	$cenaslota = $cenaslota.' '.drzava_valuta($uu_info['zemlja']); 
	
	return $cenaslota;
}

function cena_slota($slot_12) {
	//cs 1.6 - public mod
	$rootsec = rootsec();
	$g_id = 1;

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_id));
	$ss_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC2 = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC2->Execute(array($ss_info["user_id"]));
	$uu_info = $SQLSEC2->fetch(PDO::FETCH_ASSOC);

	$SQLSEC3 = $rootsec->prepare("SELECT * FROM `gp_cene` WHERE `game_id` = ?");
	$SQLSEC3->Execute(array($g_id));
	$slot_cena = $SQLSEC3->fetch(PDO::FETCH_ASSOC);

	$SQLSEC4 = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC4->Execute(array($uu_info['zemlja']));
	$drzava = $SQLSEC4->fetch(PDO::FETCH_ASSOC);

	$cena_slota = explode('|', $slot_cena['cena_slota']);
	$cena = $cena_slota[$drzava["id"]];

	$cenaslota = round($cena * $slot_12, 2);
	$cenaslota = number_format($cenaslota, 2);
	
	$cenaslota = $cenaslota.' '.drzava_valuta($uu_info['zemlja']); 
	
	return $cenaslota;
}

function money_num($novac, $drzava) {
	$rootsec = rootsec();

	$SQLSEC4 = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC4->Execute(array($drzava));
	$drzavares = $SQLSEC4->fetch(PDO::FETCH_ASSOC);
	if($drzavares){
		$novac = $novac*$drzavares["multiply"];	
		$novacc = number_format(floatval($novac), 2).''.drzava_valuta($drzava);
		return $novacc;	
	} else {
		$novacc = $novac;
		return $novacc;	
	}
	return false;
}
function money_num_clean($novac, $drzava) {
	$rootsec = rootsec();

	$SQLSEC4 = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC4->Execute(array($drzava));
	$drzavares = $SQLSEC4->fetch(PDO::FETCH_ASSOC);
	if($drzavares){
		$novac = $novac*$drzavares["multiply"];	
		$novacc = floatval($novac);
		return $novacc;	
	} else {
		$novacc = $novac;
		return $novacc;	
	}
	return false;
}
function money_val($novac, $drzava) {
	$rootsec = rootsec();

	$SQLSEC4 = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC4->Execute(array($drzava));
	$drzavares = $SQLSEC4->fetch(PDO::FETCH_ASSOC);
	if($drzavares){
		$novac = $novac*$drzava["multiply"];	
		$novacc = number_format(floatval($novac), 2).' '.drzava_valuta($drzava);
		return $novacc;	
	} else {
		$novacc = $novac;
		return $novacc;	
	}
	return false;
}


//CREATE A NEW GAME SERVER - CLIENT MODE
function cena_slota_code($slot, $game_id, $loc) {
	$rootsec = rootsec();

	$SQLSEC2 = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC2->Execute(array($ss_info["user_id"]));
	$uu_info = $SQLSEC2->fetch(PDO::FETCH_ASSOC);

	if ($loc == 'premium1'||$loc == 'premium2'||$loc == 'premium3') {

		if ($game_id == 1) {
			//cs 1.6
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 2) {
			//samp
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.03eur');
		} else if ($game_id == 3) {
			//mc
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 4) {
			//cod2
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 5) {
			//cod4
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 6) {
			//ts3
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 7) {
			//csgo
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 8) {
			//mta
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 9) {
			//ark
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		}

	} else if ($loc == 'lite1'||$loc == 'lite2'||$loc == 'lite3') {
		$SQLSEC = $rootsec->prepare("SELECT `cena` FROM `modovi` WHERE `igra` = ?");
		$SQLSEC->Execute(array($game_id));
		$slot_cena = $SQLSEC->fetch(PDO::FETCH_ASSOC);

		$cena_slota = explode('|', $slot_cena['cena']);
	}

	if (my_contry($_SESSION['user_login']) == "RS") {
		$cena = $cena_slota[0];
	} else if (my_contry($_SESSION['user_login']) == "HR") {
		$cena = $cena_slota[1];
	} else if (my_contry($_SESSION['user_login']) == "BA") {
		$cena = $cena_slota[2];
	} else if (my_contry($_SESSION['user_login']) == "MK") {
		$cena = $cena_slota[3];
	} else if (my_contry($_SESSION['user_login']) == "ME") {
		$cena = $cena_slota[4];
	} else if (my_contry($_SESSION['user_login']) == "other") {
		$cena = $cena_slota[0];
	}

	$cenaslota = round($cena * $slot, 2);
	$cenaslota = number_format($cenaslota, 2);
	
	$cenaslota = $cenaslota; 
	
	return $cenaslota;
}

//CREATE A NEW GAME SERVER - CLIENT MODE
function cena_slota_code_v($slot, $game_id, $loc = 'lite1') {
	$rootsec = rootsec();

	$SQLSEC2 = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC2->Execute(array($ss_info["user_id"]));
	$uu_info = $SQLSEC2->fetch(PDO::FETCH_ASSOC);

	if ($loc == 'premium1'||$loc == 'premium2'||$loc == 'premium3') {

		if ($game_id == 1) {
			//cs 1.6
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 2) {
			//samp
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.03eur');
		} else if ($game_id == 3) {
			//mc
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 4) {
			//cod2
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 5) {
			//cod4
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 6) {
			//ts3
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 7) {
			//csgo
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 8) {
			//mta
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		} else if ($game_id == 9) {
			//ark
			$cena_slota = explode('|', '61din|3.7kn|0.9km|30mkd|0.50eur');
		}

	} else if ($loc == 'lite1'||$loc == 'lite2'||$loc == 'lite3') {
		$SQLSEC = $rootsec->prepare("SELECT `cena` FROM `modovi` WHERE `igra` = ?");
		$SQLSEC->Execute(array($game_id));
		$slot_cena = $SQLSEC->fetch(PDO::FETCH_ASSOC);
		
		$cena_slota = explode('|', $slot_cena['cena']);
	}

	if (my_contry($_SESSION['user_login']) == "RS") {
		$cena = $cena_slota[0];
	} else if (my_contry($_SESSION['user_login']) == "HR") {
		$cena = $cena_slota[1];
	} else if (my_contry($_SESSION['user_login']) == "BA") {
		$cena = $cena_slota[2];
	} else if (my_contry($_SESSION['user_login']) == "MK") {
		$cena = $cena_slota[3];
	} else if (my_contry($_SESSION['user_login']) == "ME") {
		$cena = $cena_slota[4];
	} else if (my_contry($_SESSION['user_login']) == "other") {
		$cena = $cena_slota[0];
	}
	
	return $cena;
}

function money_val_code($novac, $drzava) {
	$rootsec = rootsec();

	$SQLSEC4 = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
	$SQLSEC4->Execute(array($drzava));
	$drzavares = $SQLSEC4->fetch(PDO::FETCH_ASSOC);
	if($drzavares){
		$novac = $novac*$drzava["multiply"];	
		$novacc = number_format(floatval($novac), 2).' '.drzava_valuta($drzava);
		return $novacc;	
	} else {
		$novacc = $novac;
		return $novacc;	
	}
	return false;
}

function money_smb($mn_smb) {

	$s_zamene = array (
        'EUR'     	=> '&euro;',
    );
        
    $mn_smb = str_replace(array_keys($s_zamene), array_values($s_zamene), $mn_smb);

	return $mn_smb;
}

?>