<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/phpseclib/SSH2.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/phpseclib/SFTP.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/phpseclib/Crypt/AES.php');
/**
* Valid server;
* Server name;
*/

function is_valid_server($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if (!$s_info) {
		return false;
	} else {
		return true;
	}
}

function server_is_start($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['startovan']);
}

function server_name($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['name']);
}

function server_graph($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['graph']);
}

function server_istice($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['istice']);
}

function server_autorestart($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['autorestart']);
}

function server_istice_d($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$date = str_replace('.', '/', txt($s_info['istice']));

	return $date;
}

function server_slot($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['slotovi']);	
}

function server_igra($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return srv_game_name($m_info['igra']);
}

function server_game_id($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($m_info['igra']);
}

function srv_game_name($g_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `games` WHERE `id` = ?");
	$SQLSEC->Execute(array($g_id));
	$game = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return $game["gamename"];
}

function gp_game($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$g_id = txt($s_info['igra']);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `games` WHERE `id` = ?");
	$SQLSEC->Execute(array($g_id));
	$game = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return $game["icon"];
}

function gp_game_icon($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$g_id = txt($s_info['igra']);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `games` WHERE `id` = ?");
	$SQLSEC->Execute(array($g_id));
	$game = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return $game["icon"];
}

function gp_game_id($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['igra']);
}

function game_command($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	if(txt($m_info['komanda'])!="") {
		return txt($m_info['komanda']);
	} else {
		$SQLSEC = $rootsec->prepare("SELECT * FROM `games` WHERE `id` = ?");
		$SQLSEC->Execute(array($m_info["igra"]));
		$g_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

		return txt($m_info['defaultstartcmd']);
	}
}

function server_location($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return 'DE';
}

function server_full_ip($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return server_ip($srv_id).':'.txt($s_info['port']);
}

function server_ip($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($s_info["box_id"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($b_info['ip']);
}

function server_port($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['port']);
}

function gp_s_status($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$serverStatus = txt($s_info['status']);

    if ($serverStatus == 1) {
        $serverStatus = "<span style='color: #54ff00;'> Aktivan </span>";
    } else if($serverStatus == 2) {
        $serverStatus = "<span style='color: #ffd800;'> Suspendovan </span>";
    } else if($serverStatus == 3) {
        $serverStatus = "<span style='color: red;'> Neaktivan </span>";
    }
	return $serverStatus;
}

function server_cena($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['cena']);
}

function server_username($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['username']);
}

function server_password($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['password']);
}

function server_rank($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['rank']);
}

function server_mod($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['modovi']);
}

function s_mod_install($m_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($m_info['link']);
}

function server_mod_map($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($m_info['mapa']);
}

function server_i_map($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['map']);
}

function server_mod_install_dir($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return $m_info['link'];
}

function server_mod_name($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($m_info['ime']);
}

function LoadFile($srv_id, $f_name) {
	$f_link = 'ftp://'.server_username($srv_id).':'.server_password($srv_id).'@'.server_ip($srv_id).':21'.'/'.txt($f_name);

	return $f_link;
}

function getBOX($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($s_info['box_id']);
}

function get_mod_link($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	 
	return txt($m_info['link']);	
}	

function get_cpu_usage($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($s_info['box_id']));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if(!($ssh = new Net_SSH2($b_info["ip"], $b_info["sshport"]))) {
		die();
		return 0;
	} else {
	   	if($ssh->login(box_username($s_info['box_id']), box_password($s_info['box_id']))) {
			$cpu = intval(preg_replace("/\r\n|\r|\n/",'',$ssh->exec("top -b -n 1 -u ".$s_info['username']." | awk 'NR>7 { sum += $9; } END { print sum; }'")));
			if($cpu>100) {
				return 100;
	   		} else {
				return $cpu;
			}
	   	} else {
	   		return 0;
			die();
	   	}
	}
}

function get_ram_usage($srv_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($s_info['box_id']));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if(!($ssh = new Net_SSH2($b_info["ip"], $b_info["sshport"]))) {
		return 0;
		die();
	} else {
	   if($ssh->login(box_username($s_info['box_id']), box_password($s_info['box_id']))) {
		return intval(preg_replace("/\r\n|\r|\n/",'',$ssh->exec("top -b -n 1 -u ".$s_info['username']." | awk 'NR>7 { sum += $10; } END { print sum; }'")));
	   } else {
		return 0;
		die();
	   }
	}
}

function MTA_Max_Player($s_id, $f_name, $find) {
	$file = 'ftp://'.server_username($s_id).':'.server_password($s_id).'@'.server_ip($s_id).':21/'.$f_name;
				
	$contents = file_get_contents($file);
	
	$pattern = preg_quote($find, '/');

	$pattern = "/^.*$pattern.*\$/m";

	if(preg_match_all($pattern, $contents, $matches)) {
	   $text = implode("<maxplayers>", $matches[0]);
	   $g = explode('<maxplayers>', $text);

	   return $g[1];
	}
}

function MTA_ServerPort($s_id, $f_name, $find) {
	$file = 'ftp://'.server_username($s_id).':'.server_password($s_id).'@'.server_ip($s_id).':21/'.$f_name;
				
	$contents = file_get_contents($file);
	
	$pattern = preg_quote($find, '/');

	$pattern = "/^.*$pattern.*\$/m";

	if(preg_match_all($pattern, $contents, $matches)) {
	   $text = implode("<serverport>", $matches[0]);
	   $g = explode('<serverport>', $text);

	   return $g[1];
	}
}

function MTA_ServerHTTPPort($s_id, $f_name, $find) {
	$file = 'ftp://'.server_username($s_id).':'.server_password($s_id).'@'.server_ip($s_id).':21/'.$f_name;
				
	$contents = file_get_contents($file);
	
	$pattern = preg_quote($find, '/');

	$pattern = "/^.*$pattern.*\$/m";

	if(preg_match_all($pattern, $contents, $matches)) {
	   $text = implode("<httpport>", $matches[0]);
	   $g = explode('<httpport>', $text);

	   return $g[1];
	}
}

/* SERVER OPTION - FNC */

/*
* 1 = Start / Restart
* 2 = Stop
* 3 = Reinstall
* 4 = Backup
*
*/

function start_server($BOX_IP, $BOX_SSH, $BOX_User, $Box_Pass, $S_Command, $user) {
	if(!($ssh = new Net_SSH2($BOX_IP, $BOX_SSH))) {
	    $return = false;
	} else {
	   if(!$ssh->login($BOX_User, $Box_Pass)) {
	    	$return = false;
	    } else {
			$userha = explode(':', $ssh->exec('cat /etc/passwd | grep ' . $user . ':'));

			$ssh->exec('docker create --tty --rm --name=' . $user . ' --network=host --cpus=1 --memory=512M --memory-swap=-1 --volume="/home/' . $user . '/:/home/container/" --workdir=/home/container debian:stretch > /dev/null 2>&1');

			$ssh->exec('docker start ' . $user . ' > /dev/null 2>&1');

			$ssh->exec('docker exec ' . $user . ' groupadd -g ' . $userha[3] . ' gameservers > /dev/null 2>&1');

			$ssh->exec('docker exec ' . $user . ' useradd -u ' . $userha[2] . ' -g gameservers -p ' . crypt(mt_rand(111111111, 999999999), 'tlas') . ' -d /home/container/ ' . $user . ' > /dev/null 2>&1');

			$ssh->exec('docker exec ' . $user . ' su -lc "screen -L -AmdS gameserver '.$S_Command.'" '.$user. ' > /dev/null 2>&1');

			$return = true;
	    }
	}	
	return $return;
}

function stop_server($BOX_IP, $BOX_SSH, $BOX_User, $Box_Pass, $user) {
	if(!($ssh = new Net_SSH2($BOX_IP, $BOX_SSH))) {
	    $return = false;
	} else {
		if(!$ssh->login($BOX_User, $Box_Pass)) {
	    	$return = false;
	    } else {
			if($ssh->exec("docker stop ".$user))
			{
				$return = true;
			} else {
				$return = false;
			}
		}
}
	return $return;
}

function reinstall_server($BOX_IP, $BOX_SSH, $BOX_User, $Box_Pass, $S_Install_Dir, $user) {
	if(!($ssh = new Net_SSH2($BOX_IP, $BOX_SSH))) {
	    $return = false;
	} else {
		if(!$ssh->login($BOX_User, $Box_Pass)) {
	    	$return = false;
	    } else {
			$link = false;
			$arhiva = false;
			if (strpos($S_Install_Dir, 'https') !== false) {
			  $link = true;
			}
			else if (strpos($S_Install_Dir, 'http') !== false) {	
			  $link = true;
			} else {
			  $link = false;
			}
			if(strpos($S_Install_Dir, 'tar.gz') !== false) {
			  $arhiva = true;
			} else {
			  $arhiva = false;
			}
			if($link==true && $arhiva == true)
			{
			 $cmd_final = "nice -n 19 rm -Rf /home/".$user."/* && wget -q ".$S_Install_Dir." -O /home/".$user."/ && tar -xvzf *.tar.gz && rm -rf *.tar.gz";
			} else if ($link == false && $arhiva == true) {
			 $cmd_final = "nice -n 19 rm -Rf /home/".$user."/* && cp -r ".$S_Install_Dir. " /home/".$user."/ | tar -xvzf *.tar.gz && rm -rf *.tar.gz";
			} else if ($link == false && $arhiva == false) {
			 $cmd_final = "nice -n 19 rm -Rf /home/".$user."/* && cp -r ".$S_Install_Dir. "/* /home/".$user."/";
			}
			$cmd3 = "chown ".$user." -Rf /home/".$user;	
	    		$cmd4 = "chmod -R 700 /home/".$user;
			$ssh->write("$cmd_final\n");
			sleep(10);
			$ssh->write("$cmd3\n");
			sleep(2);
			$ssh->write("$cmd4\n");
			$return = true;
		}
}
		return $return;
}

function server_backup($Box_ID, $Server_ID, $Backup_Name) {
	if(!($ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$cmd = 'screen -mSL '.server_username($Server_ID).'_backup;mkdir /home/BackUP;mkdir /home/BackUP/Server;cd /home/BackUP/Server;tar -czvf '.$Backup_Name.'.tar.gz /home/'.server_username($Server_ID).'/* && exit';
			$ssh->exec($cmd);
			sleep(20);
			$return = true;
	    }
	}
	return $return;
}

function server_backup_restore($Box_ID, $Server_ID, $Backup_Name) {
	if(!($ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$cmd = 'screen -mSL '.server_username($Server_ID).'_backup_restore;cd /;mv /home/BackUP/Server/'.$Backup_Name.'.tar.gz /;rm -rf /home/'.server_username($Server_ID).';tar xvzf '.$Backup_Name.'.tar.gz;mv /'.$Backup_Name.'.tar.gz /home/BackUP/Server && exit;';
			$ssh->exec($cmd);
			sleep(20);
			$return = true;
	    }
	}
	return $return;
}

function server_backup_delete($Box_ID, $Server_ID, $Backup_Name) {
	if(!($ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$cmd = 'rm -rf /home/BackUP/Server/'.$Backup_Name.'.tar.gz';
			$ssh->exec($cmd);
			sleep(20);
			$return = true;
	    }
	}
	return $return;
}

function GetBackUPStatus($Box_ID, $Server_ID, $Backup_Name) {
	$ID = 0;
	$Scan1 = 0;
	$Scan2 = 0;
	
	while($ID < 2) {
		$ID++;
		if($ID == 1) {
			$Scan1 = GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
		} else if($ID == 2) {
			$Scan2 = GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
		}
	}
	
	if(($Scan2 == $Scan1) && $Scan1 != "Nepoznato") {
		$return = "Finished";
	} else if($Scan2 != $Scan1) {
		$return = "Copying";
	} else {
		$return = "Failed";
	}
	
	return $return;
}

function GetBackUPSize($Box_ID, $Server_ID, $Backup_Name) {
	if(!($ssh = new Net_SFTP(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$StatInfo = $ssh->size('/home/BackUP/Server/'.$Backup_Name.'.tar.gz');
			$return = $StatInfo['size'];
	    }
	}
	
	return $return;
}

function ConvertBackUPSize($Size) {
	if($Size < 0 - 1)
	{
		return "Nepoznato";
	}
    if($Size < 1024)
	{
		return round($Size, 2)." Byte";
	}
	if($Size < 1024 * 1024 )
	{
		return round($Size / 1024, 2)." Kb";
	}
	if($Size < 1024 * 1024 * 1024)
	{
		return round($Size / 1024 / 1024, 2)." Mb";
	}
	if($Size < 1024 * 1024 * 1024 * 1024)
	{
		return round($Size / 1024 / 1024 / 1024, 2)." Gb";
	}
	if($Size < 1024 * 1024 * 1024 * 1024 * 1024)
	{
		return round($Size / 1024 / 1024 / 1024 / 1024, 2)." Tb";
	}
}

function install_mod($Box_ID, $S_Install_Dir, $Server_ID) {
	if(!($ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$ssh->write("screen -mSL ".server_username($Server_ID)."_change_mod\n");
			sleep(1);
			$link = false;
			$arhiva = false;
			if (strpos($S_Install_Dir, 'https') !== false) {
			  $link = true;
			}
			else if (strpos($S_Install_Dir, 'http') !== false) {	
			  $link = true;
			} else {
			  $link = false;
			}
			if(strpos($S_Install_Dir, 'tar.gz') !== false) {
			  $arhiva = true;
			} else {
			  $arhiva = false;
			}
			if($link==true && $arhiva == true)
			{
			 $cmd_final = "nice -n 19 rm -Rf /home/".server_username($Server_ID)."/* && cd /home/".server_username($Server_ID)."/ && wget -qO- ".$S_Install_Dir. " | tar -xvzf - && rm -rf *.tar.gz";
			} else if ($link == false && $arhiva == true) {
			 $cmd_final = "nice -n 19 rm -Rf /home/".server_username($Server_ID)."/* && cd /home/".server_username($Server_ID)."/ && cp -r ".$S_Install_Dir. " . | tar -xvzf - && rm -rf *.tar.gz";
			} else if ($link == false && $arhiva == false) {
			 $cmd_final = "nice -n 19 rm -Rf /home/".server_username($Server_ID)."/* && cd /home/".server_username($Server_ID)."/ && cp -r ".$S_Install_Dir. "/* .";
			}
			$ssh->write($cmd_final."\n");
			sleep(2);
			$return = true;
	    }
	}
	return $return;
}

?>
