<?php
	    if (gp_game_id($Server_ID) == 11) {
		#SAMP
		$S_Command = game_command($Server_ID);
		if (empty($S_Command) || $S_Command == '') {
			$S_Command = './samp03svr';
		}

		//Instalation exec query command
		$S_Command 	= str_replace('{$ip}', server_ip($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$port}', server_port($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$slots}', server_slot($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$map}', server_i_map($Server_ID), $S_Command);

		//Instalation dir - gamefiles line
		$S_Install_Dir = server_mod_install_dir($Server_ID);
		if (empty($S_Install_Dir) || $S_Install_Dir == '') {
			$S_Install_Dir = '/home/gamefiles/fivem';
		}

		//GameID
		$S_Game_ID = gp_game_id($Server_ID);
		if (empty($S_Game_ID) || $S_Game_ID == '') {
			$S_Game_ID = 11;		
		}

		$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
		if(!$ftp_connect) {
			sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
			redirect_to('gp-webftp.php?id='.$Server_ID);
			die();
		}

		if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
			ftp_pasv($ftp_connect, true);

			$Load_File = LoadFile($Server_ID, '/server-data/server.cfg');
			$Load_File = file($Load_File, FILE_IGNORE_NEW_LINES);
			
		    $porttcp = false;
		    $portudp = false;
		    $maxplayers = false;
            $rconpass = false;
            
		    foreach ($Load_File as &$line) {
				$val = explode(' ', $line);
				
				if ($val[0] == 'endpoint_add_tcp') {
				    $val[1] = '"0.0.0.0:'.server_port($Server_ID).'"';
					$line = implode(' ', $val);
					$porttcp = true;
				}
				else if ($val[0] == 'endpoint_add_udp') {
				    $val[1] = '"0.0.0.0:'.server_port($Server_ID).'"';
					$line = implode(' ', $val);
					$portudp = true;
				} 
				else if ($val[0] == 'sv_maxclients') {
					$val[1] = server_slot($Server_ID);
					$line = implode(' ', $val);
					$maxplayers = true;
				}  
				else if ($val[0] == "rcon_password") {
    				$val[1] = server_password($Server_ID);
    				$line = implode(" ", $val);
    				$rconpass = true;
    			} 
			}
			unset($line);

			$folder = $_SERVER['DOCUMENT_ROOT'].'/assets/_cache/start_'.server_username($Server_ID).'_fivem_server.cfg';
		    if (!$fw = fopen(''.$folder.'', 'w+')) {
				sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
				redirect_to('gp-server.php?id='.$Server_ID);
				die();
			}

			foreach($Load_File as $line) {
				$fb = fwrite($fw, $line.PHP_EOL);
			}

			if (!$porttcp) {
			    fwrite($fw,'endpoint_add_tcp "0.0.0.0:'.server_port($Server_ID).'"'.PHP_EOL);
			}
			if (!$portudp) {
			    fwrite($fw,'endpoint_add_udp "0.0.0.0:'.server_port($Server_ID).'"'.PHP_EOL);
			}
			if (!$maxplayers) {
					fwrite($fw,"sv_maxclients $server_slot".PHP_EOL);
			}
			if (!$rconpass) {
					fwrite($fw,"rcon_password ".server_password($Server_ID).PHP_EOL);
			}
			//$fb = fwrite($fw, stripslashes($Load_File));
			$remote_file = '/server-data/server.cfg';

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