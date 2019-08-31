<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

/**
* Admin login;
* Admin INFO;
*/

/* tiime */
$times = array(
	'online'	=> 0,
	'idle'		=> 300,
	'offline'	=> 700,
);


function admin_login($email, $password) {
	if ($email == ""||$password == "") {
		return false;
	} else {
		$save_ip = host_ip();
		$save_host = host_name();

		$pass = md5($password);

		if (valid_email($email) == true) {
			$proveri_usera = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$pass'"));
		} else {
			$proveri_usera = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `username` = '$email' AND `password` = '$pass'"));
		}

		if (!$proveri_usera) {
			return false;
		}

		$last_loogin 	= date('d.m.Y, H:i');
		
		$_SESSION['admin_login'] = $proveri_usera['id'];
		
		setcookie('admin_login', $proveri_usera['id'], time() + 60*60*24*7); // 7 days (604800)
		
		$_SESSION['admin_rank'] = $proveri_usera['status'];
		
		setcookie('admin_rank', $proveri_usera['status'], time() + 60*60*24*7); // 7 days (604800)
		
		$save_sesion = md5( time() . $_SESSION['admin_login'] . time() );

		if (!empty($_SESSION['admin_login']) && is_numeric($_SESSION['admin_login'])) {
			mysql_query("UPDATE `admin` SET `lastip` = '$save_ip' WHERE `id` = '$_SESSION[admin_login]'");	
			mysql_query("UPDATE `admin` SET `lasthost` = '$save_host' WHERE `id` = '$_SESSION[admin_login]'");	
			mysql_query("UPDATE `admin` SET `last_login` = '$last_loogin' WHERE `id` = '$_SESSION[admin_login]'");

			return true;		
		} else {
			return false;
		}
	}
}

function host_ip() {
	$ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

function host_name() {
	$hostname = host_ip();

	if (strstr($hostname, ', ')) {
	    $ips = explode(', ', $hostname);
	    $ip = $ips[0];

	    return gethostbyaddr($ip);
	}

	return gethostbyaddr($hostname);
}

////////////////////////////////////////////////

function is_valid_admin($a_id) {
	$a_info = mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'");
	if (mysql_num_rows($a_info) == 0) {
		$return = false;
	} else {
		$return = true;
	}

	return $return;
}

function is_login() {
	if(isset($_SESSION['admin_login'])) {
		return true;
	} else {
		return false;
	}
}

function admin_rank($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	$Admin_Rank = txt($a_info['status']);

	if ($Admin_Rank == 1) {
		$Admin_Rank_Name = '<i style="color:#bbb;">Helper</i>';
	} else if ($Admin_Rank == 2) {
		$Admin_Rank_Name = '<i style="color:yellow;">Support</i>';
	} else if ($Admin_Rank == 3) {
		$Admin_Rank_Name = '<i style="color:red;">Administrator</i>';
	} else if ($Admin_Rank == 4) {
		$Admin_Rank_Name = '<i style="color:#0ba3fd;">Developer</i>';
	}

	return $Admin_Rank_Name;
}

function a_username($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['username']);
}

function a_status($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['status']);
}

function my_name($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	$Admin_Rank = txt($a_info['status']);

	if ($Admin_Rank == 1) {
		$My_Name = '<span style="color:#bbb;">'.admin_full_name($a_id).'</span>';
	} else if ($Admin_Rank == 2) {
		$My_Name = '<span style="color:yellow;">'.admin_full_name($a_id).'</span>';
	} else if ($Admin_Rank == 3) {
		$My_Name = '<span style="color:red;">'.admin_full_name($a_id).'</span>';
	} else if ($Admin_Rank == 4) {
		$My_Name = '<span style="color:#0ba3fd;">'.admin_full_name($a_id).'</span>';
	}

	return $My_Name;
}

function admin_full_name($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['fname'].' '.$a_info['lname']);
}

function admin_email($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['email']);
}

function admin_user_name($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['username']);
}

function get_status($last) {
	global $times;

	$status = '<i style="color:#54ff00;">Online</i>';
	if ($last < (time() - $times['idle'])) {
		$status = '<i style="color:yellow;">Zauzet</i>';
	} else if ($last < (time() - $times['offline'])) {
		$status = '<i style="color:red;">Offline</i>';
	}

	return $status;
}

function admin_signature($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['signature']);
}

function admin_lastactivity($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['lastactivity']);
}

function admin_t_odogovori($a_id) {
	$t_a_info = mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `admin_id` = '$a_id'");

	if (mysql_num_rows($t_a_info) == 0) {
		$a_t_return = '<span style="color:red;">'.mysql_num_rows($t_a_info).'</span>';
	} else if (mysql_num_rows($t_a_info) < 20) {
		$a_t_return = '<span style="color:yellow;">'.mysql_num_rows($t_a_info).'</span>';
	} else {
		$a_t_return = '<span style="color:#0ba3fd;">'.mysql_num_rows($t_a_info).'</span>';
	}

	return $a_t_return;
}

function admin_rank_avatar($a_id, $a_w) {
	$admin_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	$Admin_Rank = txt($admin_info['status']);

	if ($Admin_Rank == 1) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/supp.png" class="media-object thumb-sm img-circle" style="width:'.$a_w.'px;height:auto;">';
	} else if ($Admin_Rank == 2) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/supp.png" class="media-object thumb-sm img-circle" style="width:'.$a_w.'px;height:auto;">';
	} else if ($Admin_Rank == 3) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/admin.png" class="media-object thumb-sm img-circle" style="width:'.$a_w.'px;height:auto;">';
	} else if ($Admin_Rank == 4) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/dev.png" class="media-object thumb-sm img-circle" style="width:'.$a_w.'px;height:auto;">';
	}

	return $Admin_Rank_IMG;
}

function admin_rank_avatar_a($a_id) {
	$admin_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	$Admin_Rank = txt($admin_info['status']);

	if ($Admin_Rank == 1) {
		$Admin_Rank_IMG = '<img 1alt="" src="/assets/img/rank/supp.png" id="pimg">';
	} else if ($Admin_Rank == 2) {
		$Admin_Rank_IMG = '<img 1alt="" src="/assets/img/rank/supp.png" id="pimg">';
	} else if ($Admin_Rank == 3) {
		$Admin_Rank_IMG = '<img 1alt="" src="/assets/img/rank/admin.png" id="pimg">';
	} else if ($Admin_Rank == 4) {
		$Admin_Rank_IMG = '<img 1alt="" src="/assets/img/rank/dev.png" id="pimg">';
	}

	return $Admin_Rank_IMG;
}

function admin_code_to_rank($admin_rank) {
	$Admin_Rank = txt($admin_rank);

	if ($Admin_Rank == 1) {
		$Admin_Rank_Name = 'Helper';
	} else if ($Admin_Rank == 2) {
		$Admin_Rank_Name = 'Support';
	} else if ($Admin_Rank == 3) {
		$Admin_Rank_Name = 'Administrator';
	} else if ($Admin_Rank == 4) {
		$Admin_Rank_Name = 'Developer';
	}

	return $Admin_Rank_Name;
}

function radnik_id_code($a_id) {
	$a_info = mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$a_id'"));

	return txt($a_info['status']);
}

?>