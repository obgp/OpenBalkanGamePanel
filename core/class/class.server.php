<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

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

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
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

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ? AND `user_id` = ?");
	$SQLSEC->Execute(array($srv_id, $_SESSION["user_login"]));
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

	return txt($m_info['komanda']);
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

	return txt($m_info['putanja']);
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

function start_server($BOX_IP, $BOX_SSH, $BOX_User, $Box_Pass, $S_Command, $S_Install_Dir, $Server_ID) {
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}

	if(!($ssh_conn = ssh2_connect($BOX_IP, $BOX_SSH))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, $BOX_User, $Box_Pass)) {
	    	$return = false;
	    } else {
		$cmd1='su -lc "screen -L -AmdS gameserver '.$S_Command.'" '.server_username($Server_ID).PHP_EOL;
	    	$stream = ssh2_exec($ssh_conn, $cmd1);
		stream_set_blocking($stream, true);

				$data = "";
				while($line = fgets($stream)) {
					$data .= $line;
				}

				$return = true;

		return $return;
	}
}
}

function stop_server($BOX_IP, $BOX_SSH, $BOX_User, $Box_Pass, $S_Command, $S_Install_Dir, $Server_ID) {
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}

	if(!($ssh_conn = ssh2_connect($BOX_IP, $BOX_SSH))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, $BOX_User, $Box_Pass)) {
	    	$return = false;
	    } else {
		$cmd1='su -lc "screen -r gameserver -X quit" '.server_username($Server_ID).PHP_EOL;
	    	$stream = ssh2_exec($ssh_conn, $cmd1);
	    	stream_set_blocking($stream, true);

 
				$data = "";
				while($line = fgets($stream)) {
					$data .= $line;
				}

				$return = true;
	    }

		return $return;
	}
}

function reinstall_server($BOX_IP, $BOX_SSH, $BOX_User, $Box_Pass, $S_Command, $S_Install_Dir, $Server_ID) {
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}

	if(!($ssh_conn = ssh2_connect($BOX_IP, $BOX_SSH))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, $BOX_User, $Box_Pass)) {
	    	$return = false;
	    } else {
	    	$stream = ssh2_shell($ssh_conn, 'xterm');

/*            include_once($_SERVER['DOCUMENT_ROOT'].'/core/games/reinstall/cs16.php');
            include_once($_SERVER['DOCUMENT_ROOT'].'/core/games/reinstall/mc.php');
            include_once($_SERVER['DOCUMENT_ROOT'].'/core/games/reinstall/samp.php');
            
            if (gp_game_id($Server_ID) == 4) {
				$return = false;
			} else if (gp_game_id($Server_ID) == 5) {
				$return = false;
			} else if (gp_game_id($Server_ID) == 6) {
				$return = false;
			} else if (gp_game_id($Server_ID) == 7) {
				$return = false;
			} else if (gp_game_id($Server_ID) == 8) {
				$return = false;
			} else if (gp_game_id($Server_ID) == 9) {
				$return = false;
			} else {
	    		$return = false;
	    	}
	    }*/
	            $cmd1 = "screen -m -S ".server_username($Server_ID)."_reinstall && rm -Rf /home/".server_username($Server_ID)."/*";
	    	    $cmd2 = "cd /home/".server_username($Server_ID)."/ && wget -qO- ".$S_Install_Dir. " | tar -xvzf - && rm -rf *.tar.gz";
	    	    $cmd3 = "chown ".server_username($Server_ID)." -Rf /home/".server_username($Server_ID);
	    	    fwrite($stream, "$cmd1\n");
	    	    sleep(1);
	    	    fwrite($stream, "$cmd2\n");
	    	    sleep(5);
	    	    fwrite($stream, "$cmd3\n");
	    	    sleep(1);

				$data = "";
				
	    	    while($line = fgets($stream)) {
	    	    	$data .= $line;
	    	    }

				$return = true;

		return $return;
	}
}
}
function server_backup($Box_ID, $Server_ID, $Backup_Name) {
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}
	
	if(!($ssh_conn = ssh2_connect(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
	    	$stream = ssh2_shell($ssh_conn, 'xterm');
			
			$cmd1 = 'mkdir /home/BackUP';
			$cmd2 = 'mkdir /home/BackUP/Server';
			$cmd3 = 'cd /home/BackUP/Server';
			$cmd4 = 'screen -mSL '.server_username($Server_ID).'_backup\n';
			$cmd5 = 'tar -czvf '.$Backup_Name.'.tar.gz /home/'.server_username($Server_ID).'/* && exit';
			
			fwrite($stream, "$cmd1".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd2".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd3".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd4".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd5".PHP_EOL);
			sleep(20);
			
			$data = "";
			
    	    while($line = fgets($stream)) {
    	    	$data .= $line;
    	    }
			
			$return = true;
	    }
	}
	
	return $return;
}

function server_backup_restore($Box_ID, $Server_ID, $Backup_Name) {
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}
	
	if(!($ssh_conn = ssh2_connect(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
	    	$stream = ssh2_shell($ssh_conn, 'xterm');
			
			$cmd1 = 'cd /';
			$cmd2 = 'mv /home/BackUP/Server/'.$Backup_Name.'.tar.gz /';
			$cmd3 = 'rm -rf /home/'.server_username($Server_ID).'';
			$cmd4 = 'screen -mSL '.server_username($Server_ID).'_backup_restore';
			$cmd5 = 'tar xvzf '.$Backup_Name.'.tar.gz';
			$cmd6 = 'mv /'.$Backup_Name.'.tar.gz /home/BackUP/Server && exit';
			
			fwrite($stream, "$cmd1".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd2".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd3".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd4".PHP_EOL);
			sleep(1);
			fwrite($stream, "$cmd5".PHP_EOL);
			sleep(30);
			fwrite($stream, "$cmd6".PHP_EOL);
			sleep(1);
			
			$data = "";
			
    	    while($line = fgets($stream)) {
    	    	$data .= $line;
    	    }
			
			$return = true;
	    }
	}
	
	return $return;
}

function server_backup_delete($Box_ID, $Server_ID, $Backup_Name) {
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}
	
	if(!($ssh_conn = ssh2_connect(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
	    	$stream = ssh2_shell($ssh_conn, 'xterm');
			
			$cmd1 = 'rm -rf /home/BackUP/Server/'.$Backup_Name.'.tar.gz';
			
			fwrite($stream, "$cmd1".PHP_EOL);
			sleep(1);
			
			$data = "";
			
    	    while($line = fgets($stream)) {
    	    	$data .= $line;
    	    }
			
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
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}
	
	if(!($ssh_conn = ssh2_connect(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
			$SFTP = ssh2_sftp($ssh_conn);
			$StatInfo = ssh2_sftp_stat($SFTP, '/home/BackUP/Server/'.$Backup_Name.'.tar.gz');
			
			$return = ConvertBackUPSize($StatInfo['size']);
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
	if (!function_exists("ssh2_connect")) {
		$return = false;
	}

	if(!($ssh_conn = ssh2_connect(box_ip($Box_ID), box_ssh($Box_ID)))) {
	    $return = false;
	} else {
		if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
	    	$return = false;
	    } else {
	    	$stream = ssh2_shell($ssh_conn, 'xterm');

	    	//User add screen
			fwrite($stream, "screen -mSL ".server_username($Server_ID)."_change_mod\n");
			sleep(1);
			//CMD Final - Copy/Pase mod files and chown user
			$cmd_final = 'nice -n 19 rm -Rf /home/'.server_username($Server_ID).'/* && cp -Rf '.$S_Install_Dir.'/* /home/'.server_username($Server_ID).' && chown -Rf '.server_username($Server_ID).':'.server_username($Server_ID).' /home/'.server_username($Server_ID).' && exit'; 
			
			fwrite($stream, "$cmd_final\n");
			sleep(2);

			$data = "";
			while($line = fgets($stream)) {
				$data .= $line;
			}

			$return = true;
	    }
	}

	return $return;
}

?>