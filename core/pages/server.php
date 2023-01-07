<?php 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('servers');
	die();
}

/* LGSL - INFO */
require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/lgsl_files/lgsl_class.php');

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
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/ts/lib/ts3admin.class.php');
	#build a new ts3admin object
	$tsAdmin = new ts3admin(server_ip($Server_ID), 10101);

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
			redirect_to('server?id='.$Server_ID);
			die();
		} else {
			sMSG('Uspesno ste izvrsili komandu.', 'success');
			redirect_to('server?id='.$Server_ID);
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
			redirect_to('server?id='.$Server_ID);
			die();
		} else {
			sMSG('Uspesno ste izvrsili komandu.', 'success');
			redirect_to('server?id='.$Server_ID);
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
} else if (gp_game_id($Server_ID) == 11) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/fivem.php');

	if(fivemstatus(server_ip($Server_ID), server_port($Server_ID))==true) {
	    $Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
	} else {
	    if (server_is_start($Server_ID) == true) {
	        $Server_Online = "<span style='color:red;'>Server je offline.</span>";
	    } else {
	        $Server_Online = "<span style='color:red;'>Server je stopiran u panelu.</span>";
	    }
	}

	$Server_Name = server_name($Server_ID);

	$Server_Players = fivemplayers(server_ip($Server_ID), server_port($Server_ID))."/".server_slot($Server_ID);

	$Server_Map = "n/a";
} else if (gp_game_id($Server_ID) == 10) {
	$Server_Online = "<span style='color:#54ff00;'>Online</span>"; 
}

?>

		<div class="container">
			<div class="rows">
				<div class="contect">
				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/nav.php'); ?>
					<div class="col-md-9"><span class="server-name"><?php echo server_name($Server_ID); ?></span></div>
					<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/komande.php'); ?>
					<div class="space1"></div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="font-size: 16px;font-weight: 600;"><i class="fa fa-map-pin"></i> Server Information</div>
							<div class="panel-body">
								<p>Name: <b class="white"><?php echo server_name($Server_ID); ?> 
								<?php if (is_user_pin() == false) { ?>
								<a href="#" data-toggle="modal" data-target="#pin"><i class="fa fa-pencil" style="margin-left: 5px;"></i></a></b></p>
				                                <?php } else { ?>
								<a href="#" data-toggle="modal" data-target="#serverime"><i class="fa fa-pencil" style="margin-left: 5px;"></i></a></b></p>
								<?php } ?>
								<?php if (gp_game_id($Server_ID) != 10) { ?>
								<p>Game: <b class="white"><?php echo gp_game($Server_ID); ?></b></p>
								<p>IP Adress: <b class="white"><?php echo server_full_ip($Server_ID); ?></b></p>
			                        		<?php if (is_user_pin() == false){$provera_df_m = "#pin";} else {$provera_df_m = "#edit_map";} ?>
								<p>Default mapa: <b class="white"><?php echo server_i_map($Server_ID); ?> <a href="<?php echo $provera_df_m;?>" data-toggle="modal" data-target="<?php echo $provera_df_m;?>"><i class="fa fa-pencil" style="margin-left: 5px;"></i></a></b></p>
								<?php } else {?>
								<p>FDL Link: <b class="white"><?php echo fdllink(); ?>/<?php echo server_username($Server_ID); ?>/</b></p>
								<?php } ?>
								<p>Datum isteka: <b class="white">
			                                	<form action="/process.php?a=produzi_srv" method="POST" autocomplete="off" style="display:inline-block;">
			                                	<input type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;" hidden="">
			                                	<input onchange="this.form.submit()" class="d_none" name="datum_prd" id="datum" value="<?php echo server_istice_d($Server_ID); ?>">
			                                	</form>
								</b></p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<?php if (gp_game_id($Server_ID) == 6) { ?>
							<div class="panel-heading" style="font-size: 16px;font-weight: 600;"><i class="fa fa-file-o"></i> TS3 Infomration</div>
							<div class="panel-body">
								<p>Server Platform: <b class="white"><?php echo $ts_s_platform; ?></b></p>
								<p>Version: <b class="white"><?php echo $ts_s_version; ?></b></p>
								<p>UpTime: <b class="white"><?php echo $ts_s_uptime; ?></b></p>
								<p>Password: <b class="white"><?php echo $ts_s_pass; ?></b></p>
								<p>Autorestart: <b class="white"><?php echo $ts_s_autostart; ?></b></p>
							<?php } else { ?>
							<div class="panel-heading" style="font-size: 16px;font-weight: 600;"><i class="fa fa-file-o"></i> FTP Infomration</div>
							<div class="panel-body">
								<p>Host: <b class="white"><?php echo server_ip($Server_ID); ?></b></p>
								<p>Port: <b class="white">21</b></p>
								<p>Uername: <b class="white"><?php echo server_username($Server_ID); ?></b></p>
								<p>Password: 
								<?php if (is_user_pin() == false) { ?>
								<a href="#" data-toggle="modal" data-target="#pin"><span class="label label-danger">Show</span></a>
				                                <?php } else { ?>
				                                <b class="white"><?php echo server_password($Server_ID); ?></b>
				                                	<a href="#"> <i class="fa fa-refresh"></i> </a>
				                                <?php } ?>    
								</p>
												<?php } ?>
							</div>
						</div>
					</div>
					  <div class="clearfix"></div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="font-size: 16px;font-weight: 600;"><i class="fa fa-file-o"></i> Status</div>
							<div class="panel-body">
								<p>Server status: <b class="white"><?php echo $Server_Online; ?></b></p>
								<?php if (gp_game_id($Server_ID) != 10) { ?>
								<p>Ime servera: <b class="white"><?php echo txt($Server_Name); ?></b></p>
								<p>Igraci: <b class="white"><?php echo txt($Server_Players); ?></b></p>
								<?php if (gp_game_id($Server_ID) != 6) { ?>
								<p>Mapa: <b class="white"><?php echo txt($Server_Map); ?></b></p>
								<p>Mod: <b class="white"><?php echo server_mod_name($Server_ID); ?></b></p>
								<?php } }?>
							</p>
							</div>
						</div>
					</div>
					<?php if (gp_game_id($Server_ID) != 11 || gp_game_id($Server_ID) != 10) { ?>
					<div class="col-md-6 pull-right">
					<div class="panel panel-default">
					<div class="panel-heading" style="font-size: 16px;font-weight: 600;"><h5 class="pc-icon">Banner by <?php echo site_name(); ?> <a class="right" href="#" data-toggle="modal" data-target="#baneri"><i class="fa fa-plus"></i></a></h5></div>
					<center>
					<div class="ServerInfoFTP" style="border:none;padding:0;">
			                    	<img width="100%" src="/banner.php?id=<?php echo $Server_ID; ?>" alt="BANNER" class="grafik_img">
			        	</div>
					</center>
					</div>
					<?php } ?>
				</div>
					<div class="col-md-12">
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
						<div id="cpu"></div>
					</div>
					<div class="col-md-3">
						<div id="ram"></div>
					</div>		
					<div class="col-md-3">
					</div>
					</div>
				</div>
				
<script defer>
window.onload = function(){
CPU();
RAM();
update();

function update()
{
    $.getJSON('/process.php?a=server_usage&id=<?php echo $Server_ID; ?>').done(function(data) {
  	            cpu.updateSeries([data.cpu]);
                    ram.updateSeries([data.ram]);
		    setTimeout(update, 5000); 
    });
}
function CPU(){
                var options = {
                    chart: {
                    height: 200,
                    type: 'radialBar',
                    responsive:'true',
                    offsetX: 0,
                    offsetY: 10,
                },
                plotOptions: {
                    radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    size: 120,
                    imageWidth: 50,
                    imageHeight: 50,
                    track: {	
                        strokeWidth: "80%",	
                    },
                    dropShadow: {
                        enabled: false,
                        top: 0,
                        left: 0,
                        bottom: 0,
                        blur: 3,
                        opacity: 0.5
                    },
                    dataLabels: {
                      name: {
                        fontSize: '16px',
                        color: undefined,
                        offsetY: 30,
                      },
                      hollow: {	
                         size: "60%"	
                        },
                      value: {
                        offsetY: -10,
                        fontSize: '22px',
                        color: "#ffffff",
                        formatter: function (val) {
                          return val + "%";
                        }
                      }
                    }
                  }
                },
                colors: ['#ff5d9e'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "gradient",
                        type: "horizontal",
                        shadeIntensity: .5,
                        gradientToColors: ["#05c3fb"],
                        inverseColors: !0,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                stroke: {
                    dashArray: 4
                },
                series: [],	
                    labels: ["CPU"]
                };
                document.querySelector("#cpu").innerHTML = "";
                cpu = new ApexCharts(document.querySelector("#cpu"), options);
                cpu.render();
             }
function RAM(){
                var options = {
                    chart: {
                    height: 200,
                    type: 'radialBar',
                    responsive:'true',
                    offsetX: 0,
                    offsetY: 10,
                },
                plotOptions: {
                    radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    size: 120,
                    imageWidth: 50,
                    imageHeight: 50,
                    track: {	
                        strokeWidth: "80%",	
                    },
                    dropShadow: {
                        enabled: false,
                        top: 0,
                        left: 0,
                        bottom: 0,
                        blur: 3,
                        opacity: 0.5
                    },
                    dataLabels: {
                      name: {
                        fontSize: '16px',
                        color: undefined,
                        offsetY: 30,
                      },
                      hollow: {	
                         size: "60%"	
                        },
                      value: {
                        offsetY: -10,
                        fontSize: '22px',
                        color: "#ffffff",
                        formatter: function (val) {
                          return val + "%";
                        }
                      }
                    }
                  }
                },
                colors: ['#ff5d9e'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "gradient",
                        type: "horizontal",
                        shadeIntensity: .5,
                        gradientToColors: ["#05c3fb"],
                        inverseColors: !0,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                stroke: {
                    dashArray: 4
                },
                series: [],	
                    labels: ["RAM"]
                };
                
                document.querySelector("#ram").innerHTML = "";
                ram = new ApexCharts(document.querySelector("#ram"), options);
                ram.render();
}
};
</script>