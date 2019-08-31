<?php

/* LGSL - INFO */
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/lgsl_files/lgsl_class.php');  

if (gp_game_id($Server_ID) == 1) {
	$game_name = 'halflife';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$server_info['s']['name'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map 		= @$server_info['s']['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}

} else if (gp_game_id($Server_ID) == 2) {
	$game_name = 'samp';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$server_info['s']['name'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map 		= @$server_info['s']['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}

} else if (gp_game_id($Server_ID) == 3) {
	#Include GameQ-3
	require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/gameq/src/GameQ/Autoloader.php');

	$game_name = 'minecraft';

	$GameQ = new \GameQ\GameQ();
	$GameQ->addServer([
	    'type' => $game_name,
	    'host' => server_ip($Server_ID).':'.server_port($Server_ID),
	]);
	$GameQ->setOption('timeout', 3); // seconds
	$results = $GameQ->process();
	//print_r($results);

	if(@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['numplayers'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['maxplayers'];

	$Server_Map 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}
} else if (gp_game_id($Server_ID) == 4) {
	$game_name = 'callofduty2';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$server_info['s']['name'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map 		= @$server_info['s']['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}

} else if (gp_game_id($Server_ID) == 5) {
	$game_name = 'callofduty4mw';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$server_info['s']['name'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map 		= @$server_info['s']['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}

} else if (gp_game_id($Server_ID) == 6) {
	#Include ts3admin.class.php
	require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/ts/lib/ts3admin.class.php');
	#build a new ts3admin object
	$tsAdmin = new ts3admin(server_ip($Server_ID), 10011);

	if($tsAdmin->getElement('success', $tsAdmin->connect())) {
		#login as serveradmin
		$tsAdmin->login(server_username($Server_ID), server_password($Server_ID));
		
		#select teamspeakserver
		$tsAdmin->selectServer(server_port($Server_ID));

		//print_r($clients);
	} else {
		//Error.
		sMSG('Doslo je do greske.', 'error');
	}

	#get serverInfo
	$ts_s_info 		= $tsAdmin->serverInfo();

	#poke client
	if (isset($_POST['c_id']) && isset($_POST['poke_msg']) && isset($_POST['poke_true'])) {
		$Client_ID 	= txt($_POST['c_id']);
		$Poke_MSG 	= txt($_POST['poke_msg']);

		$poke_msg_ok = $tsAdmin->clientPoke($Client_ID, $Poke_MSG);
		if (!$poke_msg_ok) {
			sMSG('Doslo je do greske.', 'error');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		} else {
			sMSG('Uspesno ste izvrsili komandu.', 'success');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		}
	}

	#kick client
	if (isset($_POST['c_id']) && isset($_POST['kick_msg']) && isset($_POST['kick_true'])) {
		$Client_ID 	= txt($_POST['c_id']);
		$Kick_MSG 	= txt($_POST['kick_msg']);

		$kick_msg_ok = $tsAdmin->clientKick($Client_ID, 'server', $Kick_MSG);
		if (!$kick_msg_ok) {
			sMSG('Doslo je do greske.', 'error');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		} else {
			sMSG('Uspesno ste izvrsili komandu.', 'success');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		}
	}

	$Server_Online  = txt($ts_s_info['data']['virtualserver_status']);

	if($Server_Online == 'online') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 	= txt($ts_s_info['data']['virtualserver_name']);

	$Server_Players = txt($ts_s_info['data']['virtualserver_clientsonline'].'/'.$ts_s_info['data']['virtualserver_maxclients']);

	$ts_s_platform 	= txt($ts_s_info['data']['virtualserver_platform']);
	$ts_s_version 	= txt($ts_s_info['data']['virtualserver_version']);
	$ts_s_pass 		= txt($ts_s_info['data']['virtualserver_password']);
	if ($ts_s_pass == '') {
		$ts_s_pass = "<span style='color:red;'>No</span>";
	} else {
		$ts_s_pass = "<span style='color:#54ff00;'>Yes</span>";
	}

	$ts_s_autostart = txt($ts_s_info['data']['virtualserver_autostart']);

	if ($ts_s_autostart == 1) {
		$ts_s_autostart = "<span style='color:#54ff00;'>Yes</span>";
	} else {
		$ts_s_autostart = "<span style='color:red;'>No</span>";
	}

	$Server_Map 		= @$server_info['s']['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}

	if(isset($ts_s_info['data']['virtualserver_uptime'])) {
		$ts_s_uptime = $tsAdmin->convertSecondsToStrTime(($ts_s_info['data']['virtualserver_uptime']));
	} else {
		$ts_s_uptime = '-';
	}
} else if (gp_game_id($Server_ID) == 7) {
	$game_name = 'source';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$server_info['s']['name'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map 		= @$server_info['s']['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}
} else if (gp_game_id($Server_ID) == 8) {
	#Include GameQ-3
	require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/gameq/src/GameQ/Autoloader.php');

	$game_name = 'mta';

	$GameQ = new \GameQ\GameQ();
	$GameQ->addServer([
	    'type' => $game_name,
	    'host' => server_ip($Server_ID).':'.server_port($Server_ID),
	]);
	$GameQ->setOption('timeout', 3); // seconds
	$results = $GameQ->process();
	//print_r($results);

	if(@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['max_players'];

	$Server_Map 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}
} else if (gp_game_id($Server_ID) == 9) {
	#Include GameQ-3
	require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/gameq/src/GameQ/Autoloader.php');

	$game_name = 'arkse';

	$GameQ = new \GameQ\GameQ();
	$GameQ->addServer([
	    'type' => $game_name,
	    'host' => server_ip($Server_ID).':'.server_port($Server_ID),
	]);
	$GameQ->setOption('timeout', 3); // seconds
	$results = $GameQ->process();
	//print_r($results);

	if(@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1') {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];
	if ($Server_Name == "") {
	    $Server_Name = "n/a";
	}

	$Server_Players 	= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['max_players'];

	$Server_Map 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];
	if ($Server_Map == "") {
	    $Server_Map = "n/a";
	}
}

?>