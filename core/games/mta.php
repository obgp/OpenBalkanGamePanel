<?php
	    if (gp_game_id($Server_ID) == 8) {
		    
		$S_Command = game_command($Server_ID);
		$S_Install_Dir = server_mod_install_dir($Server_ID);
		$S_Game_ID = gp_game_id($Server_ID);
		if (empty($S_Game_ID) || $S_Game_ID == '') {
			$S_Game_ID = 8;		
		}

		$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
		if(!$ftp_connect) {
			sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
			redirect_to('gp-webftp.php?id='.$Server_ID);
			die();
		}

		if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
			ftp_pasv($ftp_connect, true);

			$Load_File = LoadFile($Server_ID, '/mods/deathmatch/mtaserver.conf');
			$Load_File = file($Load_File, FILE_IGNORE_NEW_LINES);
			
		    $porttcp = false;
		    $portudp = false;
		    $maxplayers = false;
            	    $httpport = false;
            	    $bandwidth = false;
		    $fpslimit = false;
			
		    foreach ($Load_File as &$line) {
				$val = explode(' ', $line);
				
				if ($val[0] == '<serverip>') {
				    $val[1] = server_ip($Server_ID)."</serverip>";
					$line = implode('', $val);
					$porttcp = true;
				}
				else if ($val[0] == '<serverport>') {
				    $val[1] = server_port($Server_ID)."</serverport>";
					$line = implode(' ', $val);
					$portudp = true;
				} 
				else if ($val[0] == '<maxplayers>') {
					$val[1] = server_slot($Server_ID)."</maxplayers>";
					$line = implode(' ', $val);
					$maxplayers = true;
				}  
				else if ($val[0] == "<httpport>") {
    					$val[1] = server_port($Server_ID)+2."</httpport>";
    					$line = implode(" ", $val);
    					$httpport = true;
    				} 
			    	else if ($val[0] == "<bandwidth_reduction>") {
    					$val[1] = "medium</bandwidth_reduction>";
    					$line = implode(" ", $val);
    					$bandwidth = true;
    				} 
			    	else if ($val[0] == "<fpslimit>") {
    					$val[1] = "36</fpslimit>";
    					$line = implode(" ", $val);
    					$fpslimit = true;
    				} 
			}
			unset($line);

			$folder = $_SERVER['DOCUMENT_ROOT'].'/assets/_cache/start_'.server_username($Server_ID).'_mta_server.cfg';
		    if (!$fw = fopen(''.$folder.'', 'w+')) {
				sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
				redirect_to('gp-server.php?id='.$Server_ID);
				die();
			}

			foreach($Load_File as $line) {
				$fb = fwrite($fw, $line.PHP_EOL);
			}

			if (!$porttcp) {
			    fwrite($fw,'<serverip>auto</serverip>'.PHP_EOL);
			}
			if (!$portudp) {
			    fwrite($fw,'<serverport>'.server_port($Server_ID).'</serverport>'.PHP_EOL);
			}
			if (!$maxplayers) {
					fwrite($fw,"<maxplayers>$server_slot</maxplayers>".PHP_EOL);
			}
			if (!$httpport) {
					fwrite($fw,"<httpport>".server_port($Server_ID)+2."</httpport>".PHP_EOL);
			}
			if (!$bandwidth) {
					fwrite($fw,"<bandwidth_reduction>auto</bandwidth_reduction>".PHP_EOL);
			}
			if (!$fpslimit) {
					fwrite($fw,"<fpslimit>36</fpslimit>".PHP_EOL);
			}
			//$fb = fwrite($fw, stripslashes($Load_File));
			$remote_file = '/mods/deathmatch/mtaserver.conf';

			if (!ftp_put($ftp_connect, $remote_file, $folder, FTP_BINARY)) {
				sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
				redirect_to('gp-server.php?id='.$Server_ID);
				die();
			}
			fclose($fw);
			unlink($folder);
		} else {
			sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		}
		ftp_close($ftp_connect);
		
	}
	?>
