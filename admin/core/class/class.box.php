<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/phpseclib/SSH2.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/phpseclib/Crypt/AES.php');
/**
* 
*/
function box_status($Box_ID) {
	if($socket = @fsockopen(box_ip($Box_ID), box_ssh($Box_ID), $errno, $errstr, 1)) {
		fclose($socket);
		return 'Online';
	} else {
		return 'Offline';
	}
}
function is_valid_box($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	if ($SQLSEC->rowCount() == 0) {
		$return = false;
	} else {
		$return = true;
	}
	return $return;
}
function valid_box($b_ip) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `ip` = ?");
	$SQLSEC->Execute(array($b_ip));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	if (!$b_info) {
		$return = false;
	} else {
		$return = true;
	}
	return $return;
}
function box_name($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($b_info['name']);
}
function box_location($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($b_info['location']);
}
function box_id($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `ip` = ?");
	$SQLSEC->Execute(array($b_ip));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($b_info['boxid']);
}
function box_ip($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($b_info['ip']);
}
function box_ssh($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return txt($b_info['sshport']);
}
function box_servers($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ?");
	$SQLSEC->Execute(array($b_id));
	return $SQLSEC->rowCount();
}
function box_username($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($b_info['login']);
}
function box_pass_in_base($pass) {
	$aes = new Crypt_AES();
	$aes->setKey('rootsecbebo');
	return $aes->encrypt($pass);
}
function box_password($b_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($b_id));
	$b_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$aes = new Crypt_AES();
	$aes->setKey('rootsecbebo');
	return $aes->decrypt($b_info['password']);
}
function box_action($Box_ID, $Box_Action_ID) {
	/* fnc box_action() -- $Box_Action_ID
		1. Restart
		2. Backup
	*/
	if ($Box_Action_ID == 1) {
		$ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID));
		if ($ssh->login(box_username($Box_ID), box_password($Box_ID))) {
			$ssh->exec('reboot');
			$return = true;
		} else {
			$return = false;
		}
	} else if ($Box_Action_ID == 2) {
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
	    		//Backup box
				
				$cmd1 = 'mkdir /home/backup';
				$cmd2 = 'mkdir /home/backup/box';
				$cmd3 = 'cd /home/backup/box';
				$cmd4 = 'screen nice -n 19 tar -czvf box_backup_'.date('d_m_Y').'_'.box_username($Box_ID).'.tar.gz /home/*';
	    		
				fwrite($stream, "$cmd1".PHP_EOL);
				sleep(2);
				fwrite($stream, "$cmd2".PHP_EOL);
				sleep(2);
				fwrite($stream, "$cmd3".PHP_EOL);
				sleep(2);
				fwrite($stream, "$cmd4".PHP_EOL);
				sleep(2);
				
				$data = "";
					
	    	    while($line = fgets($stream)) {
	    	    	$data .= $line;
	    	    }
				$return = true;
			}
		}
	} else {
		$return = false;
	}
	return $return;
}
//firewall setup
function csfirewallinstall($Box_ID) {
$cmd1 = "ipset create valve_allowed hash:ip hashsize 2097152 maxelem 40000000 timeout 259200";
$cmd2 = "iptables -N OBGP_VALVE -t raw";
$cmd3 = "iptables -A PREROUTING -t raw -j OBGP_VALVE";
$cmd4 = "iptables -A OBGP_VALVE -d obgp -t raw -m set ! --match-set valve_allowed src -j VALVE";
$cmd5 = "iptables -A VALVE -t raw -p tcp -m multiport --dports 21,".box_ssh($Box_ID).",80,443,27015:27800 -j RETURN";
$cmd6 = "iptables -A VALVE -t raw -p udp --sport 53 -m length --length 750:65535 -j DROP";
$cmd7 = 'iptables -A VALVE -t raw -p udp ! --sport 53 -m hashlimit --hashlimit-upto 7/sec --hashlimit-burst 10 --hashlimit-mode dstip --hashlimit-name obgp_valve --hashlimit-htable-max 2000000 -m string --string "TSource" --algo kmp -j SET --add-set valve_allowed src';
$cmd8 = "iptables -A VALVE -t raw -m set ! --match-set valve_allowed src -j DROP";
$cmd9 = "iptables-save > /etc/sysconfig/iptable";
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
				
			fwrite($stream, "$cmd1\n");	
			sleep(1);	
			fwrite($stream, "$cmd2\n");	
			sleep(1);	
			fwrite($stream, "$cmd3\n");	
			sleep(1);		
			fwrite($stream, "$cmd4\n");	
			sleep(1);		
			fwrite($stream, "$cmd5\n");	
			sleep(1);
			fwrite($stream, "$cmd6\n");	
			sleep(1);
			fwrite($stream, "$cmd7\n");	
			sleep(1);
			fwrite($stream, "$cmd8\n");	
			sleep(1);
			fwrite($stream, "$cmd9\n");	
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
// Box Cache
function box_cache($Box_ID) {
	if (empty($Box_ID)) {
		$return = false;
	} else {
		if (!valid_box(box_ip($Box_ID))) {
			$return = false;
		}
		$ssh = new Net_SSH2(box_ip($Box_ID), box_ssh($Box_ID));
		if (!$ssh) {
			$return = false;
		}
		if ($ssh->login(box_username($Box_ID), box_password($Box_ID))) {
			//Retrieves information from box
			// NETWORK INTERFACE
			
			$iface = trim($ssh->exec("netstat -r | grep default | awk '{print $8}'"));
			if (!preg_match("#^eth[0-9]#", $iface)) {
				$iface = 'eth0'; //Default value
			}
			
			$iface = 'eth0'; //Default value
			// BANDWIDTH
			$bandwidth_rx_total = intval(trim($ssh->exec('cat /sys/class/net/'.$iface.'/statistics/rx_bytes')));
			$bandwidth_tx_total = intval(trim($ssh->exec('cat /sys/class/net/'.$iface.'/statistics/tx_bytes')));
			// BANDWIDTH USAGE CALCULATION
			$rootsec = rootsec();
			$SQLSEC = $rootsec->prepare("SELECT `cache` FROM `box` WHERE `boxid` = ?");
			$SQLSEC->Execute(array($Box_ID));
			$previousBoxCache = $SQLSEC->rowCount();
			if (!empty($previousBoxCache['cache'])) {
				$oldCache = unserialize(gzuncompress($previousBoxCache['cache']));
				$bandwidth_rx_usage = round(( $bandwidth_rx_total - $oldCache["{$Box_ID}"]['bandwidth']['rx_total'] ) / ( CRONDELAY ), 2);
				$bandwidth_tx_usage = round(( $bandwidth_tx_total - $oldCache["{$Box_ID}"]['bandwidth']['tx_total'] ) / ( CRONDELAY ), 2);
				// Hot fix in case of the following actions:
				// "stats have been reset"
				// "the box has been rebooted"
				if (($bandwidth_rx_usage < 0) || ($bandwidth_tx_usage < 0)) {
					$bandwidth_rx_usage = 0;
					$bandwidth_tx_usage = 0;
				}
			}
			// No data
			if (!isset($bandwidth_rx_usage) || !isset($bandwidth_tx_usage)) {
				$bandwidth_rx_usage = 0;
				$bandwidth_tx_usage = 0;
			}
			//---------------------------------------------------------+
			// CPU INFO
			$cpu_proc = trim($ssh->exec("cat /proc/cpuinfo | grep 'model name' | awk -F \":\" '{print $2}' | head -n 1"));
			$cpu_cores = intval(trim($ssh->exec("nproc")));
			// CPU USAGE
			$cpu_usage = intval(trim($ssh->exec("ps -A -u ".box_username($Box_ID)." -o pcpu | tail -n +2 | awk '{ usage += $1 } END { print usage }'")));
			$cpu_usage = round(($cpu_usage / $cpu_cores), 2);
			//---------------------------------------------------------+
			// MEMORY INFO
			$ram_used = intval(trim($ssh->exec("free -b | grep 'buffers/cache' | awk -F \":\" '{print $2}' | awk '{print $1}'")));
			$ram_free = intval(trim($ssh->exec("free -b | grep 'buffers/cache' | awk -F \":\" '{print $2}' | awk '{print $2}'")));
			$ram_total = $ram_used + $ram_free;
			$ram_usage = round((($ram_used / $ram_total) * 100), 2);
			//---------------------------------------------------------+
			// LOAD AVERAGE
			$loadavg = trim($ssh->exec("top -b -n 1 | grep 'load average' | awk -F \",\" '{print $5}'"));
			//---------------------------------------------------------+
			// MISC INFO
			$Box_Hostname 	= trim($ssh->exec('hostname'));
			$Box_OS 		= trim($ssh->exec('uname -o'));
			$Box_Date 		= trim($ssh->exec('date'));
			$Box_Kernel		= trim($ssh->exec('uname -r'));
			$Box_Arch 		= trim($ssh->exec('uname -m'));
			//---------------------------------------------------------+
		
			// UPTIME
			$Box_UpTime = intval(trim($ssh->exec("cat /proc/uptime | awk '{print $1}'")));
			$Box_UpTimeM = $Box_UpTime / 60;
			if ($Box_UpTimeM > 59) {
				$Box_UpTimeH = $Box_UpTimeM / 60;
				if ($Box_UpTimeH > 23) {
					$Box_UpTimeD = $Box_UpTimeH / 24;
				} else {
					$Box_UpTimeD = 0;
				}
			} else {
				$Box_UpTimeH = 0;
				$Box_UpTimeD = 0;
			}
			$Box_UpTime = floor($Box_UpTimeD).' days '.($Box_UpTimeH % 24).' hours '.($Box_UpTimeM % 60).' minutes ';
			//---------------------------------------------------------+
			// SWAP INFO
			$swap_used = intval(trim($ssh->exec("free -b | grep 'Swap' | awk -F \":\" '{print $2}' | awk '{print $2}'")));
			$swap_free = intval(trim($ssh->exec("free -b | grep 'Swap' | awk -F \":\" '{print $2}' | awk '{print $3}'")));
			$swap_total = $swap_used + $swap_free;
			$swap_usage = round((($swap_used / $swap_total) * 100), 2);
			//---------------------------------------------------------+
			
			// HARD DISK DRIVE INFO
			$hdd_total 	= (intval(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $2}'"))) * 1024);
			$hdd_used 	= (intval(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $3}'"))) * 1024);
			$hdd_free 	= (intval(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $4}'"))) * 1024);
			$hdd_usage 	= intval(substr(trim($ssh->exec("df -P / | tail -n +2 | head -n 1 | awk '{print $5}'")), 0, -1));
			//---------------------------------------------------------+
			//Retrieves num players of the box
			$p = 0;
			/*$Get_Server = mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `status` = '1' AND `startovan` = '1' ORDER by DESC LIMIT 1"));
			$Server_ID = txt($Get_Server['id']);
			#LGSL
			require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/lgsl_files/lgsl_class.php');
			#GameQ
			require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/gameq/src/GameQ/Autoloader.php');
			#TS3
			require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/ts/lib/ts3admin.class.php');
			if (gp_game_id($Server_ID) == 1) {
				//CS 1.6
				$game_name = 'halflife';
				$s_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');
				$cs_p = @$s_info['s']['players'];
			} else if (gp_game_id($Server_ID) == 2) {
				//SAMP
				$game_name = 'samp';
				$s_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');
				$samp_p = @$s_info['s']['players'];
			} else if (gp_game_id($Server_ID) == 3) {
				//Minecraft
				$game_name = 'minecraft';
				$GameQ = new \GameQ\GameQ();
				$GameQ->addServer([
				    'type' => $game_name,
				    'host' => server_ip($Server_ID).':'.server_port($Server_ID),
				]);
				$GameQ->setOption('timeout', 3); // seconds
				$s_info = $GameQ->process();
				$mc_p = @$s_info[server_ip($Server_ID).':'.server_port($Server_ID)]['numplayers'];
			} else if (gp_game_id($Server_ID) == 4) {
				//COD2
				$game_name = 'callofduty2';
				$s_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');
				$cod2_p = @$s_info['s']['players'];
			} else if (gp_game_id($Server_ID) == 5) {
				//COD4
				$game_name = 'callofduty4mw';
				$s_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');
				$cod4_p = @$s_info['s']['players'];
			} else if (gp_game_id($Server_ID) == 6) {
				//TS3
				$tsAdmin = new ts3admin(server_ip($Server_ID), 10011);
				if($tsAdmin->getElement('success', $tsAdmin->connect())) {
					#login as serveradmin
					$tsAdmin->login(server_username($Server_ID), server_password($Server_ID));
					
					#select teamspeakserver
					$tsAdmin->selectServer(server_port($Server_ID));
					#get serverInfo
					$ts_s_info 		= $tsAdmin->serverInfo();
					$ts3_p 	= txt($ts_s_info['data']['virtualserver_clientsonline']);
				} else {
					$ts3_p 	= 0;
				}
			} else if (gp_game_id($Server_ID) == 7) {
				//CS:GO
				$game_name = 'source';
				$s_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');
				$csgo_p = @$s_info['s']['players'];
			} else if (gp_game_id($Server_ID) == 8) {
				//MTA
				$game_name = 'mta';
				$GameQ = new \GameQ\GameQ();
				$GameQ->addServer([
				    'type' => $game_name,
				    'host' => server_ip($Server_ID).':'.server_port($Server_ID),
				]);
				$GameQ->setOption('timeout', 3); // seconds
				$s_info = $GameQ->process();
				$mta_p = @$s_info[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'];
			} else if (gp_game_id($Server_ID) == 9) {
				//ARK
				$game_name = 'arkse';
				$GameQ = new \GameQ\GameQ();
				$GameQ->addServer([
				    'type' => $game_name,
				    'host' => server_ip($Server_ID).':'.server_port($Server_ID),
				]);
				$GameQ->setOption('timeout', 3); // seconds
				$s_info = $GameQ->process();
				$ark_p = @$s_info[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'];
			}
			$p = $p + $cs_p + $samp_p + $mc_p + $cod2_p + $cod4_p + $ts3_p + $csgo_p + $mta_p + $ark_p;*/
			//---------------------------------------------------------+
			//Data
			$Box_Cache = array(
				$Box_ID => array(
					'players'	=> array('players' => $p),
					'bandwidth'	=> array('rx_usage' => $bandwidth_rx_usage,
										 'tx_usage' => $bandwidth_tx_usage,
										 'rx_total' => $bandwidth_rx_total,
										 'tx_total' => $bandwidth_tx_total),
					'cpu'		=> array('proc' => $cpu_proc,
										 'cores' => $cpu_cores,
										 'usage' => $cpu_usage),
					'ram'		=> array('total' => $ram_total,
										 'used' => $ram_used,
										 'free' => $ram_free,
										 'usage' => $ram_usage),
					'loadavg'	=> array('loadavg' => $loadavg),
					'hostname'	=> array('hostname' => $Box_Hostname),
					'os'		=> array('os' => $Box_OS),
					'date'		=> array('date' => $Box_Date),
					'kernel'	=> array('kernel' => $Box_Kernel),
					'arch'		=> array('arch' => $Box_Arch),
					'uptime'	=> array('uptime' => $Box_UpTime),
					'swap'		=> array('total' => $swap_total,
										 'used' => $swap_used,
										 'free' => $swap_free,
										 'usage' => $swap_usage),
					'hdd'		=> array('total' => $hdd_total,
										 'used' => $hdd_used,
										 'free' => $hdd_free,
										 'usage' => $hdd_usage)
				)
			);
			//---------------------------------------------------------+
			//Update DB for the current 
			$cachesec = gzcompress(serialize($Box_Cache), 2);
			$SQLSEC2 = $rootsec->prepare("UPDATE `box` SET `cache` = ? WHERE `boxid` = ?");
			$SQLSEC2->Execute(array($cachesec, $Box_ID));
			$return = true;
		} else {
			$Box_Cache = array(
				$Box_ID => array(
					'players'	=> array('players' => 0),
					'bandwidth'	=> array('rx_usage' => 0,
										 'tx_usage' => 0,
										 'rx_total' => 0,
										 'tx_total' => 0),
					'cpu'		=> array('proc' => '',
										 'cores' => 0,
										 'usage' => 0),
					'ram'		=> array('total' => 0,
										 'used' => 0,
										 'free' => 0,
										 'usage' => 0),
					'loadavg'	=> array('loadavg' => '0.00'),
					'hostname'	=> array('hostname' => ''),
					'os'		=> array('os' => ''),
					'date'		=> array('date' => ''),
					'kernel'	=> array('kernel' => ''),
					'arch'		=> array('arch' => ''),
					'uptime'	=> array('uptime' => ''),
					'swap'		=> array('total' => 0,
										 'used' => 0,
										 'free' => 0,
										 'usage' => 0),
					'hdd'		=> array('total' => 0,
										 'used' => 0,
										 'free' => 0,
										 'usage' => 0)
				)
			);
			$cachesec = gzcompress(serialize($Box_Cache), 2);
			$SQLSEC2 = $rootsec->prepare("UPDATE `box` SET `cache` = ? WHERE `boxid` = ?");
			$SQLSEC2->Execute(array($cachesec, $Box_ID));
			$return = true;
		}
		return $return;
	}
}
?>
