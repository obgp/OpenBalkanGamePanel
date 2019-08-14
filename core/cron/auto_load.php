<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

if (is_login() == false) {
	die('Morate se ulogovati.');
}
if(isset($_GET['id']))
	$Server_ID = txt($_GET['id']);
else 
	die('Ovaj server ne postoji ili za njega nemate pristup.');
if (is_valid_server($Server_ID) == false) {
	die('Ovaj server ne postoji ili za njega nemate pristup.');
}

/* LGSL - INFO */
require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/lgsl_files/lgsl_class.php');

if (gp_game_id($Server_ID) == 1) {
	$game_name = 'halflife';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$server_info['s']['name'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map_a 		= @$server_info['s']['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}

} else if (gp_game_id($Server_ID) == 2) {
	$game_name = 'samp';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$server_info['s']['name'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map_a 		= @$server_info['s']['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}

} else if (gp_game_id($Server_ID) == 3) {
	#Include GameQ-3
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/gameq/src/GameQ/Autoloader.php');

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
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['numplayers'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['maxplayers'];

	$Server_Map_a 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}
} else if (gp_game_id($Server_ID) == 4) {
	$game_name = 'callofduty2';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$server_info['s']['name'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map_a 		= @$server_info['s']['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}

} else if (gp_game_id($Server_ID) == 5) {
	$game_name = 'callofduty4mw';
	$server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');

	if(@$server_info['b']['status'] == '1') {
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$server_info['s']['name'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map_a 		= @$server_info['s']['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}

} else if (gp_game_id($Server_ID) == 6) {
	#Include ts3admin.class.php
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/ts/lib/ts3admin.class.php');
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

	$Server_Online_a  = txt($ts_s_info['data']['virtualserver_status']);

	if($Server_Online_a == 'online') {
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 	= txt($ts_s_info['data']['virtualserver_name_a']);

	$Server_Players_a = txt($ts_s_info['data']['virtualserver_clientsonline'].'/'.$ts_s_info['data']['virtualserver_maxclients']);

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

	$Server_Map_a 		= @$server_info['s']['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
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
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$server_info['s']['name'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];

	$Server_Map_a 		= @$server_info['s']['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}
} else if (gp_game_id($Server_ID) == 8) {
	#Include GameQ-3
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/gameq/src/GameQ/Autoloader.php');

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
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['max_players'];

	$Server_Map_a 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}
} else if (gp_game_id($Server_ID) == 9) {
	#Include GameQ-3
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/gameq/src/GameQ/Autoloader.php');

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
	    $Server_Online_a = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online_a = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online_a = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name_a 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];
	if ($Server_Name_a == "") {
	    $Server_Name_a = "n/a";
	}

	$Server_Players_a 	= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['max_players'];

	$Server_Map_a 		= @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];
	if ($Server_Map_a == "") {
	    $Server_Map_a = "n/a";
	}
}
?>

<script type="text/javascript">
	$('#s_inf_status').html("<?php echo $Server_Online_a; ?>");
	$('#s_inf_name').html("<?php echo $Server_Name_a; ?>");
	$('#s_inf_pl').html("<?php echo $Server_Players_a; ?>");
	$('#s_inf_map').html("<?php echo $Server_Map_a; ?>");
	$('#load_srv_onl').fadeOut(300);
</script>