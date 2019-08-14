<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/lgsl_files/lgsl_class.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$hour = date('H');
$list_server = mysql_query("SELECT * FROM `serveri` WHERE `autorestart` = '{$hour}' AND `startovan` = '1'");

echo "Auto Restart!<br>";
echo "Restartovanje svih servera zakazanih za {$hour}:00 !<br>";
echo '<br>';

while($row = mysql_fetch_array($list_server)) {
    $Server_ID 	= txt($row['id']);
    $Box_ID 	= txt($row['box_id']);
	
    cron_stop_server(box_ip($Box_ID), box_ssh($Box_ID), server_username($Server_ID), server_password($Server_ID), $Server_ID, 'admin', true);
	cron_start_server(box_ip($Box_ID), box_ssh($Box_ID), server_username($Server_ID), server_password($Server_ID), $Server_ID, 'admin', true);
	
    echo '<br>';
}

function cron_stop_server($ip, $port, $username, $password, $serverid, $klijentid, $restart) {
	$server = mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `id` = '".$serverid."'"));
	
	if($restart == false) {
		if($server['startovan'] == "0") {
			echo "Server mora biti startovan!";
		}
	}
	
	if (!function_exists("ssh2_connect")) {
		echo "SSH2 PHP extenzija nije instalirana";
	}
	
	if(!($con = ssh2_connect($ip, $port))) {
		echo "Ne mogu se spojiti na server";
	} else {
		if(!ssh2_auth_password($con, $username, $password)) {
			echo "Netačni podatci za prijavu";
		} else {
			$stream = ssh2_shell($con, 'vt102', null, 80, 24, SSH2_TERM_UNIT_CHARS);
			fwrite( $stream, 'kill -9 `screen -list | grep "'.$username.'" | awk {\'print $1\'} | cut -d . -f1`'.PHP_EOL);
			sleep(1);
			fwrite( $stream, 'screen -wipe'.PHP_EOL);
			sleep(1);
			
			$data = "";
			
			while($line = fgets($stream)) {
				$data .= $line;
			}
			
			mysql_query("UPDATE `serveri` SET `startovan` = '0' WHERE `id` = '".$serverid."'");
			echo 'Server '.server_name($serverid).' je uspesno stopiran!';
		}
	}
	echo '<br>';
}

function cron_start_server($ip, $port, $username, $password, $serverid, $klijentid, $restart) {
	$server = mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `id` = '".$serverid."'"));
	
	if($restart == false) {
		if($server['startovan'] == 1) {
			echo 'Server mora biti stopiran.';
		}
	}
	
	if (!function_exists("ssh2_connect")) {
		echo "SSH2 extenzija nije instalirana!";
	}
	
	if(!($con = ssh2_connect($ip, $port))) {
		echo "Ne mogu se spojiti sa serverom!";
	} else {
		if(!ssh2_auth_password($con, $username, $password)) {
			echo "Podaci za prijavu nisu tacni!";
		} else {
			if($server['igra'] == 1) {
				$komanda = $server["komanda"];
				$komanda = str_replace('{$ip}', $ip, $komanda);
				$komanda = str_replace('{$port}', $server['port'], $komanda);
				$komanda = str_replace('{$slots}', $server['slotovi'], $komanda);
				$komanda = str_replace('{$map}', $server['map'], $komanda);
				$komanda = str_replace('{$fps}', $server['fps'], $komanda);
			} else if($server['igra'] == 3) {
				$komanda = $server["komanda"];
				
				// Max Ram ( SLOT * 51.2)
				$mr = ($server['slotovi'] * 51.2);
				
				// Min Ram
				$minr = "512";
				
				$komanda = str_replace('{$maxram}', $mr, $komanda);
				$komanda = str_replace('{$minram}', $minr, $komanda);
			} else {
				$komanda = $server["komanda"];
			}
			
			$stream = ssh2_shell($con, 'vt102', null, 80, 24, SSH2_TERM_UNIT_CHARS);
			fwrite($stream, "screen -A -m -L -S ".$username."".PHP_EOL);
			sleep(1);
			fwrite( $stream, "$komanda".PHP_EOL);
			sleep(1);
			fwrite( $stream, "rm log.log".PHP_EOL);
			sleep(1);
			
			$data = "";
			
			while($line = fgets($stream)) {
				$data .= $line;
			}
			
			mysql_query("UPDATE `serveri` SET `startovan` = '1' WHERE `id` = '".$serverid."'");
			echo 'Server '.server_name($serverid).' je uspesno startovan!';
		}
	}
	echo '<br>';
}

?>