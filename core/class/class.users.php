<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

/**
* User login;
* User INFO;
* UserName;
*/

function user_login($email, $password) {
	if ($email == ""||$password == "") {
		return false;
	} else {
		$rootsec = rootsec();
		$save_ip = host_ip();
		$save_host = host_name();

		$pass = md5($password);

		if (valid_email($email) == true) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `email` = ? AND `sifra` = ?");
			$SQLSEC->Execute(array($email, $pass));
			$proveri_usera = $SQLSEC->fetch(PDO::FETCH_ASSOC);
		} else {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `username` = ? AND `sifra` = ?");
			$SQLSEC->Execute(array($email, $pass));
			$proveri_usera = $SQLSEC->fetch(PDO::FETCH_ASSOC);
		}

		if (!$proveri_usera) {
			return false;
		}

		$last_loogin 	= date('d.m.Y, H:i');
		
		$_SESSION['user_login'] = $proveri_usera['klijentid'];
		
		// Set Cookie expiration for 7 days (7 dana)
		$cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  //for 7 days (7 dana)
		setcookie('user_login', $proveri_usera['klijentid'], $cookie_expiration_time, '/', null, null, TRUE);

		$save_sesion = md5( time() . $_SESSION['user_login'] . time() );

		if (!empty($_SESSION['user_login']) && is_numeric($_SESSION['user_login'])) {

			$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `lastip` = ? WHERE `klijentid` = ?");
			$SQLSEC->Execute(array($save_ip, $_SESSION["user_login"]));
			$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `lasthost` = ? WHERE `klijentid` = ?");
			$SQLSEC->Execute(array($save_host, $_SESSION["user_login"]));	
			$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `lastip` = ? WHERE `klijentid` = ?");
			$SQLSEC->Execute(array($last_loogin, $_SESSION["user_login"]));	

			return true;		
		}
	}
}

function is_user_info_free($email, $username) {
	$rootsec = rootsec();
	if ($email == "" || $username == "") {
		return false;
	} else {
		$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `email` = ?");
		$SQLSEC->Execute($email);

		$SQLSEC2 = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `username` = ?");
		$SQLSEC2->Execute($username);

		if($SQLSEC->rowCount() != 0) {
			return false;
		} else {
			if($SQLSEC2->rowCount() != 0) {
				return false;
			} else {
				return true;
			}
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

function is_login() {
	if(isset($_SESSION['user_login'])) {
		return true;
	} else {
		return false;
	}
}

function is_demo($u_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$is_demo = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if ($is_demo['username'] == "demo"||$is_demo['email'] == "demo@gb-hoster.me") {
		return true;
	} else {
		return false;
	}
}

function proveri_ime($name) {
	if(preg_match('/^[A-Z][a-zA-Z -]+$/', $name)) {
		return true;
	} else {
		return false;
	}
}

function is_user_pin() {
	if (isset($_SESSION['code'])) {
		return true;
	} else {
		return false;
	}
}

function user_name($u_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['username']);
}

function user_ime($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['ime']);
}

function user_prezime($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['prezime']);
}

function user_full_name($u_id) {
	return txt(user_ime($u_id).' '.user_prezime($u_id));
}

function user_email($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['email']);
}

function user_token($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['token']);
}

function my_money($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['novac']);
}

function my_contry($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['zemlja']);
}

function cl_avatar() {
	$Cl_Avatar = '<img alt="" src="/assets/img/icon/G_only_logo.png" class="media-object thumb-sm img-circle" style="width:45px;height:45px;">';
	return $Cl_Avatar;
}

function ban_user($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($u_info['banovan']);
}

function ban_ftp($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return $u_info['ftp_ban'];
}

function ban_support($u_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($u_id));
	$u_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

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

/* ADMIN */

function admin_user_name($a_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($a_id));
	$admin_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($admin_info['username']);
}

function admin_rank_id($a_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($a_id));
	$admin_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($admin_info['status']);
}

function admin_rank($a_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($a_id));
	$admin_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$Admin_Rank = txt($admin_info['status']);

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

function admin_rank_avatar($a_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($a_id));
	$admin_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$Admin_Rank = txt($admin_info['status']);

	if ($Admin_Rank == 1) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/supp.png" class="media-object thumb-sm img-circle" style="width:45px;height:45px;">';
	} else if ($Admin_Rank == 2) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/supp.png" class="media-object thumb-sm img-circle" style="width:45px;height:45px;">';
	} else if ($Admin_Rank == 3) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/admin.png" class="media-object thumb-sm img-circle" style="width:45px;height:45px;">';
	} else if ($Admin_Rank == 4) {
		$Admin_Rank_IMG = '<img alt="" src="/assets/img/rank/dev.png" class="media-object thumb-sm img-circle" style="width:45px;height:45px;">';
	}

	return $Admin_Rank_IMG;
}

function admin_full_name($a_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($a_id));
	$a_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($a_info['fname'].' '.$a_info['lname']);
}

function adm_r_name($a_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($a_id));
	$a_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

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

?>
