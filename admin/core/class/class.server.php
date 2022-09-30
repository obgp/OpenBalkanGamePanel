<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/phpseclib/SSH2.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/phpseclib/SFTP.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/phpseclib/Crypt/AES.php');

/**
* Valid server;
* Server name;
*/
function is_valid_server($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	if (!$s_info) {
		return false;
	} else {
		return true;
	}
}
function Srw_Owenr($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['user_id']);
}
function gp_code_status($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['status']);
}
function server_is_start($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['startovan']);
}
function server_name($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['name']);
}
function server_graph($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['graph']);
}
function server_istice($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['istice']);
}
function server_autorestart($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['autorestart']);
}
function server_istice_d($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$date = str_replace('.', '/', txt($s_info['istice']));
	return $date;
}
function server_slot($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['slotovi']);	
}
function server_igra($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return srv_game_name($m_info['igra']);
}
function server_game_id($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($m_info['igra']);
}
function srv_game_name($g_id) {
	if ($g_id == 1) {
		$game_name = 'Counter-Strike 1.6';
	} else if ($g_id == 2) {
		$game_name = 'San Andreas Multiplayer';
	} else if ($g_id == 3) {
		$game_name = 'Minecraft';
	} else if ($g_id == 4) {
		$game_name = 'Call of Duty 2';
	} else if ($g_id == 5) {
		$game_name = 'Call of Duty 4';
	} else if ($g_id == 6) {
		$game_name = 'TeamSpeak 3';
	} else if ($g_id == 7) {
		$game_name = 'Counter-Strike GO';
	} else if ($g_id == 8) {
		$game_name = 'Multi Theft Auto';
	} else if ($g_id == 9) {
		$game_name = 'ARK';
	} else if ($g_id == 10) {
		$game_name = 'FDL';
	} else if ($g_id == 11) {
		$game_name = 'FiveM';
	}
	return $game_name;
}
function gp_game($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$g_id = txt($s_info['igra']);
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
	} else if ($g_id == 10) {
		$gp_game = '<img src="/assets/img/icon/gp/game/fdl.png" class="gp_game_icon"> FDL';
	} else if ($g_id == 11) {
		$gp_game = '<img src="/assets/img/icon/gp/game/fivem.png" class="gp_game_icon"> FiveM';
	}
	return $gp_game;
}
function gp_game_icon($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$g_id = txt($s_info['igra']);
	if ($g_id == 1) {
		$gp_game = '<img src="/assets/img/icon/gp/game/cs.ico" class="gp_game_icon">';
	} else if ($g_id == 2) {
		$gp_game = '<img src="/assets/img/icon/gp/game/samp.jpg" class="gp_game_icon">';
	} else if ($g_id == 3) {
		$gp_game = '<img src="/assets/img/icon/gp/game/mc.png" class="gp_game_icon">';
	} else if ($g_id == 4) {
		$gp_game = '<img src="/assets/img/icon/gp/game/cod2.png" class="gp_game_icon">';
	} else if ($g_id == 5) {
		$gp_game = '<img src="/assets/img/icon/gp/game/cod4.png" class="gp_game_icon">';
	} else if ($g_id == 6) {
		$gp_game = '<img src="/assets/img/icon/gp/game/ts3.png" class="gp_game_icon">';
	} else if ($g_id == 7) {
		$gp_game = '<img src="/assets/img/icon/gp/game/csgo.jpg" class="gp_game_icon">';
	} else if ($g_id == 8) {
		$gp_game = '<img src="/assets/img/icon/gp/game/mta.png" class="gp_game_icon">';
	} else if ($g_id == 9) {
		$gp_game = '<img src="/assets/img/icon/gp/game/ark.png" class="gp_game_icon">';
	} else if ($g_id == 10) {
		$gp_game = '<img src="/assets/img/icon/gp/game/fdl.png" class="gp_game_icon">';
	} else if ($g_id == 11) {
		$gp_game = '<img src="/assets/img/icon/gp/game/fivem.png" class="gp_game_icon">';
	}
	return $gp_game;
}
function gp_game_id($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['igra']);
}
function game_command($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($m_info['komanda']);
}
function server_location($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return 'DE';
}
function server_full_ip($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return server_ip($srv_id).':'.txt($s_info['port']);
}
function server_ip($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($s_info["box_id"]));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($b_info['ip']);
}
function server_port($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['port']);
}
function gp_s_status($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
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
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['cena']);
}
function server_username($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['username']);
}
function server_password($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['password']);
}
function server_rank($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['rank']);
}
function server_mod($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? ");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['modovi']);
}
function s_mod_install($m_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($m_info['putanja']);
}
function server_mod_map($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($m_info['mapa']);
}
function server_i_map($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['map']);
}
function server_mod_install_dir($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($s_info["modovi"]));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $m_info['link'];
}
function server_mod_name($srv_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
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
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($srv_id));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($s_info['box_id']);
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
			$cmd1='su -lc "screen -L -AmdS gameserver '.$S_Command.'" '.$user;
			$ssh->exec($cmd1);
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
			$cmd1='su -lc "screen -r gameserver -X quit" '.$user;
			$ssh->exec($cmd1);
			$return = true;
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
			sleep(10);
			$return = true;
	    }
	}
	return $return;
}

/* Mod Info */	
 function get_mod_name($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	 
 	return txt($m_info['ime']);	
}	
 function get_mod_map($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	 
	return txt($m_info['mapa']);	
}	
 function get_mod_komanda($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	 
	return txt($m_info['komanda']);	
}	
 function get_mod_opis($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	 
	return txt($m_info['opis']);	
}	
 function get_mod_link($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	 
	return txt($m_info['link']);	
}	
 function get_mod_link_masina($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return $m_info['link'];	
}	
 function get_mod_game($m_id) {	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `id` = ?");
	$SQLSEC->Execute(array($m_id));
	$m_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$g_id = txt($m_info['igra']);	
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
	} else if ($g_id == 10) {	
		$gp_game = '<img src="/assets/img/icon/gp/game/fdl.png" class="gp_game_icon"> FDL';	
	} else if ($g_id == 11) {	
		$gp_game = '<img src="/assets/img/icon/gp/game/fivem.png" class="gp_game_icon"> FiveM';	
	}	
 	return $gp_game;	
}	
 /* ADD SERVER */	
 function srv_install($Box_ID, $Srv_Username, $Srv_Password, $S_Install_Dir) {	
	if(!($ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$ssh->write("useradd -m -g gameservers -p $Srv_Password $Srv_Username\n");	
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
			 $cmd2 = "cd /home/".$Srv_Username."/ && wget -qO- ".$S_Install_Dir. " | tar -xvzf - && rm -rf *.tar.gz";
			} else if ($link == false && $arhiva == true) {
			 $cmd2 = "cd /home/".$Srv_Username."/ && cp -r ".$S_Install_Dir. " . | tar -xvzf - && rm -rf *.tar.gz";
			} else if ($link == false && $arhiva == false) {
			 $cmd2 = "cp -r ".$S_Install_Dir. "/* /home/".$Srv_Username."/";
			}
			$cmd1 = "screen -m -S ".$Srv_Username."_install";	
	    	$cmd3 = "chown ".$Srv_Username." -Rf /home/".$Srv_Username;	
	    	$cmd4 = "chmod -R 700 /home/".$Srv_Username;	
			$ssh->write("$cmd1\n");	
			sleep(1);	
			$ssh->write("$cmd2\n");	
			sleep(10);	
			$ssh->write("$cmd3\n");	
			sleep(1);	
			$ssh->write("$cmd4\n");	
			sleep(1);	
 			$ssh->write("passwd $Srv_Username\n");	
			sleep(1);	
			$ssh->write("$Srv_Password\n");	
			sleep(1);	
			$ssh->write("$Srv_Password\n");	
			sleep(1);	
 			$return = true;	
	    }	
	}	
 	return $return;	
}	
 /* REMOVE SERVER */	

 function srv_delete($Box_ID, $Srv_Username) {	
	if(!($ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!$ssh->login(box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$cmd='userdel -rf '.$Srv_Username;
			$ssh->exec($cmd);
 			$return = true;	
	    }	
	}	
 	return $return;	
}
?>
