<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('gp-servers.php');
	die();
}

if (cp_perm_srv_view($Server_ID) == false) {
	sMSG('Niste support za ovu igru!', 'info');
	redirect_to('gp-servers.php');
	die();
}

//
$stats_klijenti			= mysql_query("SELECT * FROM `klijenti`");
$stats_tiketi 			= mysql_query("SELECT * FROM `tiketi`");
$stats_server 			= mysql_query("SELECT * FROM `serveri`");
$stats_masine 			= mysql_query("SELECT * FROM `box`");
//
$Svi_Tiketi 			= mysql_query("SELECT * FROM `tiketi`");
$Otv_Tiketi 			= mysql_query("SELECT * FROM `tiketi` WHERE `status` = '1'");
$Odg_Tiketi 			= mysql_query("SELECT * FROM `tiketi_odgovori`");
$Lck_Tiketi 			= mysql_query("SELECT * FROM `tiketi` WHERE `status` = '0'");

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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo site_name().' | '.server_name($Server_ID); ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/head.php'); ?>
</head>
<body>
	<!-- Error script -->
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>

    <script type="text/javascript">
    	setTimeout(function() {
    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";
    	}, 5000);
    </script>

	<!-- header -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="index.php">
					<img src="/admin/assets/img/logo.png" alt="GB-Hoster.Me LOGO!"> 
				</a>
				
				<div class="nav-collapse">
					<ul class="nav pull-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i> <?php echo my_name($_SESSION['admin_login']); ?> <b class="caret"></b>
							</a>

							<ul class="dropdown-menu">
								<li><a href="/admin/profile.php">Profile</a></li>
								<li><a href="/admin/logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div> 
			</div>
		</div>
	</div>

	<!-- nav menu -->
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
				<ul class="mainnav">
					<li class="active">
						<a href="/admin/index.php">
							<i class="icon-dashboard"></i>
							<span>POCETNA</span> 
						</a> 
					</li>
					
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-th"></i>
							<span>KLIJENTI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_client.php">DODAJ NALOG</a></li>
							<li><a href="/admin/clients.php">LISTA KLIJENATA</a></li>
							<li><a href="/admin/banovani.php">BANOVANI KLIJENTI</a></li>
						</ul>
					</li>
				
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-gamepad"></i>
							<span>SERVERI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_server.php">DODAJ SERVER</a></li>
							<li><a href="/admin/gp-servers.php">LISTA SVIH SERVERA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-comments"></i>
							<span>TIKETI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/gp-tiketi.php">SVI TIKETI (<span style="color: green;"><?php echo mysql_num_rows($Svi_Tiketi); ?></span>)</a></li>
							<li><a href="/admin/gp-tiketi-open.php">OTVORENI TIKETI (<span style="color: green;"><?php echo mysql_num_rows($Otv_Tiketi); ?></span>)</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-code"></i>
							<span>MODOVI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_mod.php">DODAJ NOVI MOD</a></li>
							<li><a href="/admin/list_mods.php">LISTA MODOVA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-code"></i>
							<span>PLUGINI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_plugin.php">DODAJ NOVI PLUGIN</a></li>
							<li><a href="/admin/list_plugins.php">LISTA PLUGINA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-hdd-o"></i>
							<span>MASINE</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_box.php">DODAJ NOVU MASINU</a></li>
							<li><a href="/admin/all_box.php">PREGLED MASINA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users"></i>
							<span>ADMINI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_admin.php">DODAJ NOVOG ADMINA</a></li>
							<li><a href="/admin/all_admin.php">PREGLED ADMINA</a></li>
						</ul>
					</li>

					<li>
						<a href="">
							<i class="icon-bar-chart"></i>
							<span>Charts</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-long-arrow-down"></i>
							<span>Drops</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="icons.html">Icons</a></li>
							<li><a href="faq.html">FAQ</a></li>
							<li><a href="pricing.html">Pricing Plans</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="signup.html">Signup</a></li>
							<li><a href="error.html">404</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- SERVER INFO -->
					<div class="span12">
						<div class="navbar">
							<div class="navbar-inner">
								<ul class="nav">
									<li class="nav_s_active"><a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">Server</a></li>
					                <!--<li><a href="gp-config.php?id=<?php echo $Server_ID; ?>">Podesavanje</a></li>-->
					                <?php if (gp_game_id($Server_ID) == 1) { ?>
					                    <li><a href="/admin/gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
					                    <li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-maps.php?id=<?php echo $Server_ID; ?>">Map installer</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 2) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 3) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 4) { ?>
					                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                	<li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 5) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                	<li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 6) { ?>
					                	<li><a href="/admin/ts-perm.php?id=<?php echo $Server_ID; ?>">Permission</a></li>
					                	<li><a href="/admin/ts-bans.php?id=<?php echo $Server_ID; ?>">Banovani</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 7) { ?>	
					                	<li><a href="/admin/gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
					                    <li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 8) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 9) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } ?>
					                <li><a href="" data-toggle="modal" data-target="#jesi_siguran"><i class="icon-share-alt"></i> Prebaci server</a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<h3>
									<i class="fa fa-gamepad"></i>
									<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>"><?php echo server_name($Server_ID); ?></a> 
									| 
									<i class="fa fa-user"></i> <a href="/admin/gp-client.php?id=<?php echo Srw_Owenr($Server_ID); ?>"><?php echo user_full_name(Srw_Owenr($Server_ID)); ?></a>
								</h3>
							</div>

							<div class="widget-content">
								<!-- PRVI RED -->
								<div class="span5 left" style="margin-left:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-pushpin"></i>
											<h3>Server informacije</h3>
										</div>

										<div class="widget-content">
											<p> Ime servera: <strong><?php echo server_name($Server_ID); ?></strong></p>
											<p> IP adresa: <strong><?php echo server_full_ip($Server_ID); ?></strong></p>
											<p> Igra: <strong><?php echo gp_game($Server_ID); ?></strong></p>
											<p> Status: <strong><?php echo gp_s_status($Server_ID); ?></strong> (istice <?php echo server_istice($Server_ID); ?> ~ 30dana)</p>
										</div>
									</div>
								</div>

								<div class="span5 right" style="width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-cog"></i>
											<h3>FTP Informacije</h3>
										</div>

										<div class="widget-content">
											<p> 
												Hostname: 
												<strong><?php echo server_ip($Server_ID); ?></strong>
											</p>
											<p> 
												Port: 
												<strong>21</strong>
											</p>
											<p> 
												Username: 
												<strong><?php echo server_username($Server_ID); ?></strong>
											</p>
											<p> 
												Password: 
												<strong><?php echo server_password($Server_ID); ?></strong>
												| <a href=""> <i class="icon-repeat"></i> Promeni FTP password</a>
											</p>
										</div>
									</div>
								</div>

								<!-- DRUGI RED -->
								<div class="span5 right" style="margin-right:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-signal"></i>
											<h3>GRAFIK</h3>
										</div>

										<div class="widget-content">
											<img id="grafik_servera" src="/admin/assets/img/grafik_servera.png" style="width: 100%;">
										</div>
									</div>
								</div>

								<div class="span5 left" style="margin-left:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-exclamation-sign"></i>
											<h3>Online informacije</h3>
										</div>

										<div class="widget-content">
											<p> Ime servera: <strong> <?php echo $Server_Name; ?></strong></p>
											<p> Online: <strong> <?php echo $Server_Online; ?></strong></p>
											<p> Mapa: <strong> <?php echo $Server_Map; ?></strong></p>
											<p> Igraci: <strong> <?php echo $Server_Players; ?></strong></p>
										</div>
									</div>
									
									<div class="bottom-nav">
										<ul class="ftp-nav">
											<?php if (gp_game_id($Server_ID) == 1) { ?>
												<li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/">
					                                	<i class="fa fa-folder-open folder-color"></i> Configs
					                            	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/">
					                                	<i class="fa fa-folder-open folder-color"></i> Cstrike
					                            	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/plugins/">
					                                	<i class="fa fa-folder-open folder-color"></i> Plugins
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/&fajl=server.cfg">
					                                	<i class="fa fa-file file-color"></i> server.cfg
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=users.ini">
					                                	<i class="fa fa-file file-color"></i> users.ini
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=plugins.ini">
					                                	<i class="fa fa-file file-color"></i> plugins.ini
					                                </a>
					                            </li>
											<?php } else if (gp_game_id($Server_ID) == 2) { ?>
												<li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/scriptfiles">
					                                	<i class="fa fa-folder-open folder-color"></i> SCRIPTFILES
					                               	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/gamemodes">
					                                	<i class="fa fa-folder-open folder-color"></i> GAMEMODES
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/&fajl=server.cfg">
					                                	<i class="fa fa-file file-color"></i> SERVER.CFG
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/&fajl=server_log.txt">
					                                	<i class="fa fa-file file-color"></i> SERVER_LOG.TXT
					                                </a>
					                            </li>
											<?php } else if (gp_game_id($Server_ID) == 3) { ?>
												<li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">
					                                	<i class="fa fa-folder-open folder-color"></i> PLUGINS
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">
					                                	<i class="fa fa-folder-open folder-color"></i> LOGS
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">
					                                	<i class="fa fa-file file-color"></i> SERVER.PROPERTIES
					                                </a>
					                            </li>
											<?php } else if (gp_game_id($Server_ID) == 4) { ?>
												<li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/">
					                                	<i class="fa fa-folder-open folder-color"></i> Configs
					                            	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/">
					                                	<i class="fa fa-folder-open folder-color"></i> Cstrike
					                            	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/plugins/">
					                                	<i class="fa fa-folder-open folder-color"></i> Plugins
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/&fajl=server.cfg">
					                                	<i class="fa fa-file file-color"></i> server.cfg
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=users.ini">
					                                	<i class="fa fa-file file-color"></i> users.ini
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=plugins.ini">
					                                	<i class="fa fa-file file-color"></i> plugins.ini
					                                </a>
					                            </li>
											<?php } else if (gp_game_id($Server_ID) == 5) { ?>
												<li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/">
					                                	<i class="fa fa-folder-open folder-color"></i> Configs
					                            	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/">
					                                	<i class="fa fa-folder-open folder-color"></i> Cstrike
					                            	</a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/plugins/">
					                                	<i class="fa fa-folder-open folder-color"></i> Plugins
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/&fajl=server.cfg">
					                                	<i class="fa fa-file file-color"></i> server.cfg
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=users.ini">
					                                	<i class="fa fa-file file-color"></i> users.ini
					                                </a>
					                            </li>
					                            <li>
					                                <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=plugins.ini">
					                                	<i class="fa fa-file file-color"></i> plugins.ini
					                                </a>
					                            </li>
											<?php } else if (gp_game_id($Server_ID) == 6) { ?>

											<?php } else if (gp_game_id($Server_ID) == 7) { ?>
												
											<?php } else if (gp_game_id($Server_ID) == 8) { ?>
												
											<?php } else if (gp_game_id($Server_ID) == 9) { ?>
												
											<?php } ?>
										</ul>
									</div>
								</div>

								<!-- TRECI RED -->
								<div class="widget stacked">
									<div class="widget-header">
										<i class="icon-pushpin"></i>
										<h3>Support akcije</h3>
									</div>

									<div class="widget-content">
										<div class="admin_server_precice">
											<li>
												<form action="/admin/gp-client.php?id=<?php echo Srw_Owenr($Server_ID); ?>" method="POST">
													<button class="btn btn-info"> 
														<i class="icon-user"></i> Profil
													</button>
												</form>
											</li>

											<?php if (server_is_start($Server_ID) == false) { ?>
				                        		<li>
				                                    <form action="/admin/process.php?s=server_start" method="POST">
				                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        <button href="" class="btn btn-success">
				                                            <i class="fa fa-caret-right" style="font-size: 20px;"></i> Start
				                                        </button>
				                                    </form>
				                                </li>

				                                <li>
				                                    <form action="/admin/process.php?s=server_reinstall" method="POST">
				                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        <button class="btn btn-danger">
			                                                <i class="fa fa-refresh" style="font-size: 15px;"></i> Reinstall
			                                            </button>
				                                    </form>
				                                </li>
				                        	<?php } else { ?>
				                        		<li>
				                                    <form action="/admin/process.php?s=server_restart" method="POST">
				                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        <button class="btn btn-warning">
				                                            <i class="fa fa-refresh" style="font-size: 15px;"></i> Restart
				                                        </button>
				                                    </form>
				                                </li>
				                                <li>
				                                    <form action="/admin/process.php?s=server_stop" method="POST">
				                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        <button href="" class="btn btn-danger">
				                                            <i class="fa fa-power-off" style="font-size: 15px;"></i> Stop
				                                        </button>
				                                    </form>
				                                </li> 
				                        	<?php } ?>

				                        	<?php if (gp_code_status($Server_ID) == 1 || gp_code_status($Server_ID) == 3) { ?>
												<li>
													<form action="/admin/process.php?s=suspend_server" method="POST">
														<input type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display: none;">
														<button class="btn btn-warning"> 
															<i class="icon-bolt"></i> Suspenduj server
														</button>
													</form>
												</li>
											<?php } else { ?>
												<li>
													<form action="/admin/process.php?s=un_suspend_server" method="POST">
														<input type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display: none;">
														<button class="btn btn-warning"> 
															<i class="icon-bolt"></i> Un-Suspenduj server
														</button>
													</form>
												</li>
											<?php } ?>

											<li>
												<form action="/admin/process.php?s=delete_server" method="POST">
													<input type="text" name="user_id" value="<?php echo Srw_Owenr($Server_ID); ?>" style="display: none;">
													<input type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display: none;">
													<button class="btn btn-danger"> 
														<i class="fa fa-trash"></i> Obrisi server
													</button>
												</form>
											</li>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="extra">
		<div class="extra-inner">
			<div class="container">
				<div class="row">
					<div class="span12">
						<center>
							<img src="/admin/assets/img/icon/gh_logo.png" alt="Gold Hosting LOGO!">
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<div class="row">
					<div class="span12"> &copy; 2017 - <?php echo date('Y').' '.real_site_name(); ?>. Sva prava zadrzana. </div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>

	<div id="jesi_siguran" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">Prebaci server</h4>
		</div>

		<div class="modal-footer">
			<form action="/admin/process.php?s=change_owner" method="POST" id="forma_popup" class="left">
				<input type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">

				<select name="client_id" class="selectpicker" data-live-search="true">
					<option value="0" disabled selected="selected">Izaberite klijenta</option>
					<?php $get_clients = mysql_query("SELECT * FROM `klijenti` ORDER by klijentid ASC");
					while ($row_client = mysql_fetch_array($get_clients)) { ?>
						<option value="<?php echo txt($row_client['klijentid']); ?>" style="color:#333;">
							<?php echo user_full_name($row_client['klijentid']).' - '.user_email($row_client['klijentid']); ?>
						</option>
					<?php } ?>
				</select>

				<div class="space clear"></div>

				<button class="left btn btn-success">
					<i class="icon-ok"></i> Prebaci
				</button>
			</form>
		</div>
	</div>

</body>
</html>