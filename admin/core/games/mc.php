<?php
if (gp_game_id($Server_ID) == 3) {
		#Minecraft
		$S_Command = game_command($Server_ID);
		if (empty($S_Command) || $S_Command == '') {
			$S_Command = 'java -Xms512M -Xmx1024M -XX:MaxPermSize=128M -XX:+DisableExplicitGC -XX:+AggressiveOpts -Dfile.encoding=UTF-8 -jar Server.jar';
		}

		//Instalation exec query command
		$S_Command 	= str_replace('{$ip}', server_ip($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$port}', server_port($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$slots}', server_slot($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$map}', server_i_map($Server_ID), $S_Command);

		//Instalation dir - gamefiles line
		$S_Install_Dir = server_mod_install_dir($Server_ID);
		if (empty($S_Install_Dir) || $S_Install_Dir == '') {
			$S_Install_Dir = '/home/gamefiles/mc/default';
		}

		//GameID
		$S_Game_ID = gp_game_id($Server_ID);
		if (empty($S_Game_ID) || $S_Game_ID == '') {
			$S_Game_ID = 3;		
		}

		$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
		if(!$ftp_connect) {
			sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
			redirect_to('gp-webftp.php?id='.$Server_ID);
			die();
		}

		if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
			ftp_pasv($ftp_connect, true);

			$Load_File = LoadFile($Server_ID, 'server.properties');
			$Load_File = file($Load_File, FILE_IGNORE_NEW_LINES);

			foreach ($Load_File as &$line) {
				$val = explode('=', $line);
				
				if ($val[0] == 'server-port') {
					$val[1] = server_port($Server_ID);
					$line = implode('=', $val);
				} else if ($val[0] == 'query.port') {
					$val[1] = server_port($Server_ID);
					$line = implode('=', $val);
				} else if ($val[0] == 'max-players') {
					$val[1] = server_slot($Server_ID);
					$line = implode('=', $val);
				} else if ($val[0] == 'server-ip') {
					$val[1] = server_ip($Server_ID);
					$line = implode('=', $val);
				}
			}
			unset($line);

			$folder = $_SERVER['DOCUMENT_ROOT'].'/assets/_cache/start_'.server_username($Server_ID).'_minecraft_server.cfg';

			$fw = fopen(''.$folder.'', 'w+');
			foreach($Load_File as $line) {
				$fb = fwrite($fw, $line.PHP_EOL);
			}

		    if (!$fw = fopen(''.$folder.'', 'w+')) {
				sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
				redirect_to('gp-server.php?id='.$Server_ID);
				die();
			}
			
			//$fb = fwrite($fw, stripslashes($Load_File));
			$remote_file = '/server.properties';

			if (!ftp_put($ftp_connect, $remote_file, $folder, FTP_BINARY)) {
				sMSG('Doslo je do greske prilikom spajanja na FTP server. (Server nije startovan)', 'error');
				redirect_to('gp-server.php?id='.$Server_ID);
				die();
			}
			fclose($fw);
			unlink($folder);
		}
		ftp_close($ftp_connect);
	} 
?>