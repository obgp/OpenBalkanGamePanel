<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}



if (isset($_GET['user_id'])) {
	$User_ID = txt($_GET['user_id']);

	if(isset($_GET['box_id'])) {
		$Box_ID = txt($_GET['box_id']);

		/* LGSL - INFO */
		require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/lgsl_files/lgsl_class.php');

		$v_username = 'srv_'.$User_ID.'_'.random_s_key(5).'';

		if(mysql_num_rows(mysql_query("SELECT * FROM `serveri` WHERE `username` = '{$v_username}'")) != 0) {
			$v_username = 'srv_'.$User_ID.'_'.random_s_key(5).'';  
		}

		$Rand_PasS = random_s_key(8);

		for($s_port = 27015; $s_port <= 29999; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$get_free_port = lgsl_query_live('halflife', box_ip($Box_ID), NULL, $s_port, NULL, 's');
				
				if(@$get_free_port['b']['status'] == '1') {
					$vrati_inf = 'Da';
				} else {
					$vrati_inf = 'Ne';
				}

				if ($vrati_inf == 'Ne') {
					$port_for_cs = $s_port;
					break;
				}
			}
		}

		for($s_port = 7777; $s_port <= 9999; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$get_free_port = lgsl_query_live('samp', box_ip($Box_ID), NULL, $s_port, NULL, 's');
				
				if(@$get_free_port['b']['status'] == '1') {
					$vrati_inf = 'Da';
				} else {
					$vrati_inf = 'Ne';
				}

				if ($vrati_inf == 'Ne') {
					$port_for_samp = $s_port;
					break;
				}
			}
		}
		
				for($s_port = 7777; $s_port <= 9999; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$get_free_port = lgsl_query_live('samp', box_ip($Box_ID), NULL, $s_port, NULL, 's');
				
				if(@$get_free_port['b']['status'] == '1') {
					$vrati_inf = 'Da';
				} else {
					$vrati_inf = 'Ne';
				}

				if ($vrati_inf == 'Ne') {
					$port_for_samp = $s_port;
					break;
				}
			}
		}
		for($s_port = 28960; $s_port <= 29960; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_cod2 = $s_port;
					break;
			}
		}
		for($s_port = 28960; $s_port <= 29960; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_cod4 = $s_port;
					break;
			}
		}
		for($s_port = 9987; $s_port <= 11000; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_ts = $s_port;
					break;
			}
		}
		for($s_port = 27015; $s_port <= 29999; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_csgo = $s_port;
					break;
			}
		}
		for($s_port = 22003; $s_port <= 24000; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_mta = $s_port;
					break;
			}
		}
		for($s_port = 27015; $s_port <= 29999; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_ark = $s_port;
					break;
			}
		}
		for($s_port = 30120; $s_port <= 33120; $s_port++) {
			if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_fivem = $s_port;
					break;
			}
		}

	} else {
		$Box_ID 		= '';
		$port_for_cs 	= '';
		$port_for_samp 	= '';
		$port_for_mc 	= '';
		$port_for_ark 	= '';
		$port_for_csgo 	= '';
		$port_for_cod2 	= '';
		$port_for_cod4 	= '';
		$port_for_fivem 	= '';
		$port_for_mta 	= '';
		$port_for_ts 	= '';

		$v_username 	= '';
		$Rand_PasS 		= '';
	}

} else {
	$User_ID = '';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo site_name(); ?></title>

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
					<img src="<?php echo logolink(); ?>" alt="LOGO!"> 
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
					
					<!-- Add Server -->
					<div class="span12">
						<h1>
							<span class="icon-user"></span>
							DODAJTE NOVI SERVER
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>KREIRAJTE NOVI SERVER</h3>
							</div>

							<div class="widget-content">
							
							<form action="add_server.php" method="GET" autocomplete="off">
								<div class="add_server_by_client_box">
									<label>Izaberite klijenta: </label>
									<select name="user_id" onchange="this.form.submit()" class="selectpicker" data-live-search="true">
										<option value="0" disabled selected="selected">Izaberite klijenta</option>
										<?php $get_user = mysql_query("SELECT * FROM `klijenti` ORDER by klijentid ASC");
										while ($row_user = mysql_fetch_array($get_user)) { ?>
											<?php 
												if(txt($row_user['klijentid']) == $User_ID) {
													$get_u_link = 'selected="selected"';
												} else {
													$get_u_link = '';
												}
											?>
											<option <?php echo $get_u_link; ?> value="<?php echo txt($row_user['klijentid']); ?>">
												<?php echo user_full_name($row_user['klijentid']); ?>
											</option>
										<?php } ?>
									</select>
								</div>									
							</form>

							<?php if (isset($_GET['user_id'])) { ?>

								<form action="add_server.php" method="GET" autocomplete="off">
									<input type="hidden" name="user_id" value="<?php echo txt($User_ID); ?>">

									<div class="add_server_by_client_box">
										<label>Izaberite masinu: </label>
										<select name="box_id" onchange="this.form.submit()" class="selectpicker" data-live-search="true">
											<option value="0" disabled selected="selected">Izaberite masinu</option>
											<?php $get_box = mysql_query("SELECT * FROM `box` ORDER by boxid ASC");
											while ($row_box = mysql_fetch_array($get_box)) { ?>
												<?php 
													if(txt($row_box['boxid']) == $Box_ID) {
														$get_b_link = 'selected="selected"';
													} else {
														$get_b_link = '';
													}
												?>
												<option <?php echo $get_b_link; ?> value="<?php echo txt($row_box['boxid']); ?>">
													<?php echo txt($row_box['name'].' - '.$row_box['ip']); ?>
												</option>
											<?php } ?>
										</select>
									</div>									
								</form>

								<form action="/admin/process.php?a=add_server" method="POST" autocomplete="off">
									<input type="hidden" name="user_id" value="<?php echo txt($User_ID); ?>">
									<input type="hidden" name="box_id" value="<?php echo txt($Box_ID); ?>">
									
									<div class="add_server_by_client_box">
										<label for="serveraddigra">Igra: </label>
										<select name="game_id" id="serveraddigra" class="selectpicker" data-live-search="true">
											<option value="0" disabled selected="selected">Izaberi</option>
											<option value="1">Counter-Strike 1.6</option>
											<option value="2">San Andreas Multiplayer</option>
											<option value="3">Minecraft</option>
											<option value="4">Call of Duty 2</option>
											<option value="5">Call of Duty 4</option>
											<option value="6">TeamSpeak 3</option>
											<option value="7">Counter-Strike GO</option>
											<option value="8">MTA</option>
											<option value="9">ARK</option>
											<option value="10">FDL</option>
											<option value="11">FiveM</option>

										</select>
									</div>

									<br />

									<div class="add_server_by_client_box">
										<label for="klijent">Mod: </label>
										<select name="mod" id="cs_def">
											<option value="0" disabled selected="selected">Izaberite prvo igru</option>
										</select>

										<select name="mod" id="cs_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '1'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>
										</select>

										<select name="mod" id="samp_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '2'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>

										<select name="mod" id="mc_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '3'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										
										<select name="mod" id="cod2_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '4'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
                                        <select name="mod" id="cod4_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '5'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="csgo_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '7'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="mta_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '8'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="ark_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '9'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="fivem_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '11'");
											while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
									</div>

									<br />

									<div class="add_server_by_client">
										<label for="klijent">Ime servera: </label>
										<input name="ime" type="text" placeholder="Ime servera">
									</div>	

									<div class="add_server_by_client">
										<label for="klijent">Slotovi: </label>
										<input type="text" name="slotovi" placeholder="12 - (minimalno)">
									</div>								

									<div class="add_server_by_client">
										<label for="klijent">Port: </label>
										<input name="port" type="text" placeholder="Port (Ukoliko nije automatski javite developeru!)" id="def_port_null" disabled="">
										<input name="port_cs" type="text" value="<?php echo $port_for_cs; ?>" id="cs_port" style="display: none">
										<input name="port_samp" type="text" value="<?php echo $port_for_samp; ?>" id="samp_port" style="display: none">
										<input name="port_mc" type="text" value="<?php echo $port_for_mc; ?>" id="mc_port" style="display: none">
										<input name="port_cod2" type="text" value="<?php echo $port_for_cod2; ?>" id="cod2_port" style="display: none">
										<input name="port_cod4" type="text" value="<?php echo $port_for_cod4; ?>" id="cod4_port" style="display: none">
										<input name="port_ts" type="text" value="<?php echo $port_for_ts; ?>" id="ts_port" style="display: none">
										<input name="port_mta" type="text" value="<?php echo $port_for_mta; ?>" id="mta_port" style="display: none">
										<input name="port_ark" type="text" value="<?php echo $port_for_ark; ?>" id="ark_port" style="display: none">
										<input name="port_fivem" type="text" value="<?php echo $port_for_fivem; ?>" id="fivem_port" style="display: none">
									</div>								
								
									<div class="add_server_by_client">
										<label for="klijent">Username: </label>
										<input name="username" type="text" readonly="readonly" value="<?php echo $v_username; ?>">
									</div>								
						
									<div class="add_server_by_client">
										<label for="klijent">Password: </label>
										<input name="password" type="text" readonly="readonly" value="<?php echo $Rand_PasS; ?>">
									</div>								
								
									<div class="add_server_by_client">
										<label for="klijent">Istice: </label>
										<input name="istice" type="text" id="datum" value="<?php echo date("m/d/Y", time()); ?>">
									</div>

									<button class="right btn btn-warning" style="margin-top: 20px;">
										<span class="icon-save"></span> NAPRAVI SERVER
									</button>					
								</form>

							<?php } ?>
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
							<img src="<?php echo logolink(); ?>" alt="LOGO!">
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
					<div class="span12"> &copy; <?php echo date('Y').' '.real_site_name(); ?>. Sva prava zadrzana. </div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>
	<script src="/assets/js/jquery-ui.js"></script>

    <script type="text/javascript">
    	$("#serveraddigra").change(function() {
			var val = $(this).val();

			if(val == "1") {
				$("#cs_port").show();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").show();
				$("#samp_mod").hide();
				$("#mc_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if(val == "2") {
				$("#cs_port").hide();
				$("#mc_port").hide();
				$("#samp_port").show();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#samp_mod").show();
				$("#cs_def").hide();
				$("#mc_mod").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if(val == "3") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").show();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").show();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if (val == "4") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").show();
				$("#cod2_port").show();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if (val == "5") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").show();
				$("#cod4_port").show();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if (val == "6") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").show();
			} else if (val == "7") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").show();
				$("#csgo_port").show();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if (val == "8") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").show();
				$("#mta_port").show();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if (val == "9") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").show();
				$("#ark_port").show();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			} else if (val == "10") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").hide();
				$("#fivem_port").hide();
				$("#ts_port").hide();
			}
			else if (val == "11") {
				$("#cs_port").hide();
				$("#samp_port").hide();
				$("#mc_port").hide();
				$("#def_port_null").hide();
				$("#cs_mod").hide();
				$("#mc_mod").hide();
				$("#samp_mod").hide();
				$("#cs_def").hide();
				$("#ark_mod").hide();
				$("#ark_port").hide();
				$("#cod2_mod").hide();
				$("#cod2_port").hide();
				$("#cod4_mod").hide();
				$("#cod4_port").hide();
				$("#csgo_mod").hide();
				$("#csgo_port").hide();
				$("#mta_mod").hide();
				$("#mta_port").hide();
				$("#fivem_mod").show();
				$("#fivem_port").show();
				$("#ts_mod").hide();
				$("#ts_port").hide();
			}
		});

		$("#datum").datepicker(); 
    </script>

</body>
</html>
