<?php

/**
* 
*/

function is_money($u_id) {
	$my_money = money_val_code(my_money($u_id), my_contry($u_id));;
	if (cena_slota_code(12) > $my_money) {
		return false;
	} else {
		return true;
	}
}

function drzava_valuta($d) {
	if($d == "RS") {
		$drzava = "din";
	} else if($d == "HR") {
		$drzava = "kn";
	} else if($d == "BA") {
		$drzava = "km";
	} else if($d == "MK") { 
		$drzava = "den";
	} else if($d == "ME") { 
		$drzava = "&euro;";
	} else if($d == "other") { 
		$drzava = "&euro;";
	}

	return $drzava;
}

function drzava($d) {
	if($d == "RS") {
		$drzava = "Srbija";
	} else if($d == "HR") {
		$drzava = "Hrvatska";
	} else if($d == "BA") {
		$drzava = "Bosna i Hercegovina";
	} else if($d == "MK") { 
		$drzava = "Makedonija";
	} else if($d == "ME") { 
		$drzava = "Montenegro";
	} else if($d == "other") { 
		$drzava = "No Balkan";
	}

	return $drzava;
}

function euro_for_slot($s_id) {
	$g_id = gp_game_id($s_id);

	$ss_info = mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `id` = '$s_id'"));
	$uu_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$ss_info[user_id]'"));

	$slot_cena = mysql_fetch_array(mysql_query("SELECT * FROM `gp_cene` WHERE `game_id` = '$g_id'"));
	$cena_slota = explode('|', $slot_cena['cena_slota']);

	if ($uu_info['zemlja'] == "RS") {
		$cena = $cena_slota[0];
	} else if ($uu_info['zemlja'] == "HR") {
		$cena = $cena_slota[1];
	} else if ($uu_info['zemlja'] == "BA") {
		$cena = $cena_slota[2];
	} else if ($uu_info['zemlja'] == "MK") {
		$cena = $cena_slota[3];
	} else if ($uu_info['zemlja'] == "ME") {
		$cena = $cena_slota[4];
	} else if ($uu_info['zemlja'] == "other") {
		$cena = $cena_slota[0];
	} else {
		$cena = '';
	}

	$cenaslota = round($cena * server_slot($s_id), 2);
	$cenaslota = number_format($cenaslota, 2);
	
	$cenaslota = $cenaslota.' '.drzava_valuta($uu_info['zemlja']); 
	
	return $cenaslota;
}

function cena_slota($slot, $user_id, $game_id) {
	$uu_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$user_id'"));

	$slot_cena = mysql_fetch_array(mysql_query("SELECT * FROM `gp_cene` WHERE `game_id` = '$game_id'"));
	$cena_slota = explode('|', $slot_cena['cena_slota']);

	if ($uu_info['zemlja'] == "RS") {
		$cena = $cena_slota[0];
	} else if ($uu_info['zemlja'] == "HR") {
		$cena = $cena_slota[1];
	} else if ($uu_info['zemlja'] == "BA") {
		$cena = $cena_slota[2];
	} else if ($uu_info['zemlja'] == "MK") {
		$cena = $cena_slota[3];
	} else if ($uu_info['zemlja'] == "ME") {
		$cena = $cena_slota[4];
	} else if ($uu_info['zemlja'] == "other") {
		$cena = $cena_slota[0];
	}

	$cenaslota = round($cena * $slot, 2);
	$cenaslota = number_format($cenaslota, 2);
	
	$cenaslota = $cenaslota.' '.drzava_valuta($uu_info['zemlja']); 
	
	return $cenaslota;
}

function mod_cena_for_slot($slot, $game_id, $drzava) {
	$slot_cena = mysql_fetch_array(mysql_query("SELECT * FROM `gp_cene` WHERE `game_id` = '$game_id'"));
	$cena_slota = explode('|', $slot_cena['cena_slota']);

	if ($drzava == "RS") {
		$cena = $cena_slota[0];
	} else if ($drzava == "HR") {
		$cena = $cena_slota[1];
	} else if ($drzava == "BA") {
		$cena = $cena_slota[2];
	} else if ($drzava == "MK") {
		$cena = $cena_slota[3];
	} else if ($drzava == "ME") {
		$cena = $cena_slota[4];
	} else if ($drzava == "other") {
		$cena = $cena_slota[0];
	}

	$cenaslota = round($cena * $slot, 2);
	$cenaslota = number_format($cenaslota, 2);
	
	return $cenaslota;
}

function money_num($novac, $drzava) {
	if($drzava == "RS"){
		$novac = $novac*125;
		$novacc = $novac;
		return $novacc;	
	} else if($drzava == "HR"){
		$novac = $novac*6.5;	
		$novacc = $novac;
		return $novacc;		
	} else if($drzava == "BA"){
		$novac = $novac*1.7;		
		$novacc = $novac;
		return $novacc;		
	} else if($drzava == "MK"){
		$novac = $novac*5.36;	
		$novacc = $novac;
		return $novacc;		
	} else if($drzava == "ME" || $drzava == "other"){
		$novacc = $novac;
		return $novacc;		
	}

	return false;
}

function money_val($novac, $drzava) {
	if($drzava == "RS"){
		$novac = $novac*120;	
		$novacc = number_format(floatval($novac), 2).''.drzava_valuta($drzava);
		return $novacc;	
	} else if($drzava == "HR"){
		$novac = $novac*6.5;	
		$novacc = number_format(floatval($novac), 2).''.drzava_valuta($drzava);
		return $novacc;		
	} else if($drzava == "BA"){
		$novac = $novac*1.7;		
		$novacc = number_format(floatval($novac), 2).''.drzava_valuta($drzava);
		return $novacc;		
	} else if($drzava == "MK"){
		$novac = $novac*5.36;	
		$novacc = number_format(floatval($novac), 2).''.drzava_valuta($drzava);
		return $novacc;		
	} else if($drzava == "ME" || $drzava == "other"){	
		$novacc = number_format(floatval($novac), 2).' '.drzava_valuta($drzava);
		return $novacc;		
	}

	return false;
}


//CREATE A NEW GAME SERVER - CLIENT MODE
function cena_slota_code($cl_id, $slot, $game_id, $loc) {
	$uu_info = mysql_fetch_array(mysql_query("SELECT * FROM `klijenti` WHERE `klijentid` = '$cl_id'"));

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
		$slot_cena = mysql_fetch_array(mysql_query("SELECT * FROM `gp_cene` WHERE `game_id` = '$game_id'"));
		$cena_slota = explode('|', $slot_cena['cena_slota']);
	}

	if (my_contry($cl_id) == "RS") {
		$cena = $cena_slota[0];
	} else if (my_contry($cl_id) == "HR") {
		$cena = $cena_slota[1];
	} else if (my_contry($cl_id) == "BA") {
		$cena = $cena_slota[2];
	} else if (my_contry($cl_id) == "MK") {
		$cena = $cena_slota[3];
	} else if (my_contry($cl_id) == "ME") {
		$cena = $cena_slota[4];
	} else if (my_contry($cl_id) == "other") {
		$cena = $cena_slota[0];
	}

	$cenaslota = round($cena * $slot, 2);
	$cenaslota = number_format($cenaslota, 2);
	
	$cenaslota = $cenaslota; 
	
	return $cenaslota;
}

function money_val_code($novac, $drzava) {
	if($drzava == "RS"){
		$novac = $novac*120;	
		$novacc = number_format(floatval($novac), 2);
		return $novacc;	
	} else if($drzava == "HR"){
		$novac = $novac*6.5;	
		$novacc = number_format(floatval($novac), 2);
		return $novacc;		
	} else if($drzava == "BA"){
		$novac = $novac*1.7;		
		$novacc = number_format(floatval($novac), 2);
		return $novacc;		
	} else if($drzava == "MK"){
		$novac = $novac*5.36;	
		$novacc = number_format(floatval($novac), 2);
		return $novacc;		
	} else if($drzava == "ME" || $drzava == "other"){	
		$novacc = number_format(floatval($novac), 2);
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