<?php
 if (gp_game_id($Server_ID) == 5) {
		#COD4
		$S_Command = game_command($Server_ID);
		if (empty($S_Command) || $S_Command == '') {
			$S_Command = '';
		}

		//Instalation exec query command
		$S_Command 	= str_replace('{$ip}', server_ip($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$port}', server_port($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$slots}', server_slot($Server_ID), $S_Command);
		$S_Command 	= str_replace('{$map}', server_i_map($Server_ID), $S_Command);

		//Instalation dir - gamefiles line
		$S_Install_Dir = server_mod_install_dir($Server_ID);
		if (empty($S_Install_Dir) || $S_Install_Dir == '') {
			$S_Install_Dir = '/home/gamefiles/cod4/default';
		}

		//GameID
		$S_Game_ID = gp_game_id($Server_ID);
		if (empty($S_Game_ID) || $S_Game_ID == '') {
			$S_Game_ID = 5;		
		}
	}
?>