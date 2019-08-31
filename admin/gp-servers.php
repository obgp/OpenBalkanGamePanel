<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
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

if (isset($_GET['game_id'])) {
	$Game_ID = txt($_GET['game_id']);
} else {
	$Game_ID = '';
}

if (isset($_GET['status'])) {
	$Server_Status = txt($_GET['status']);
} else {
	$Server_Status = '1';
}

if ($Game_ID == 1) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 2) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 3) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 4) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 5) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 6) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 7) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 8) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
} else if ($Game_ID == 9) {
	$servers_query = mysql_query("SELECT * FROM `serveri` WHERE `igra` = '$Game_ID' AND `status` = '$Server_Status' ORDER BY id ASC");
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
					
					<!-- LISTA SERVERA -->
					<div class="span12">
						<h1>
							<span class="fa fa-gamepad"></span>
							Serveri
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Lista servera</h3>
							</div>

							<div class="widget-content">
								<div class="span5">
									<form action="gp-servers.php" method="GET" autocomplete="off" style="margin-top:10px;">
										<div class="add_server_by_client_box">
											<label>Izaberite igru: </label>
											<select name="game_id" onchange="this.form.submit()" class="selectpicker" data-live-search="true">
												<option value="0" disabled selected="selected">Izaberite igru</option>
												<option value="1">Counter-Strike 1.6</option>
												<option value="2">San Andreas Multiplayer</option>
												<option value="3">Minecraft</option>
												<option value="4">Call of Duty 2</option>
												<option value="5">Call of Duty 4</option>
												<option value="6">TeamSpeak 3</option>
												<option value="7">Counter-Strike GO</option>
												<option value="8">Multi Theft Auto</option>
												<option value="9">ARK</option>
											</select>
										</div>									
									</form>
								</div>

								<div class="span5">
									<form action="gp-servers.php" method="GET" autocomplete="off" style="margin-left:50px;margin-top:10px;">
										<div class="add_server_by_client_box">
											<input type="text" name="game_id" value="<?php echo txt($Game_ID); ?>" style="display:none;">
											<label>Izaberite status: </label>
											<select name="status" onchange="this.form.submit()" class="selectpicker" data-live-search="true">
												<option value="0" disabled selected="selected">Izaberite status</option>
												<option value="1">Aktivan</option>
												<option value="2">Suspendovan</option>
												<option value="3">Neaktivan</option>
											</select>
										</div>									
									</form>
								</div>

								<?php if (isset($_GET['game_id'])) { ?>
									<table class="table table-striped table-bordered tabela-asd" style="border-top: 2px solid #364856!important;border-top-left-radius: 0;border-top-right-radius: 0;">
										<thead>
											<tr>
												<th>ID</th>
												<th>Ime servera</th>
												<th>Ip:Port</th>
												<th>Klijent</th>
												<th>Istice</th>
												<th>Status</th>
												<th>Igraci</th>
												<th>Mapa</th>
												<th>Napomena</th>
											</tr>
										</thead>

										<tbody>
											<?php
												require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/lgsl_files/lgsl_class.php');

												while($row = mysql_fetch_array($servers_query)) { 
													$Client_ID 			= txt($row['user_id']);
													$Server_ID 			= txt($row['id']);
													$Box_ID 			= txt($row['box_id']);

													$Server_Name 		= server_name($Server_ID);
													if(strlen($Server_Name) > 25) { 
												        $Server_Name = substr($Server_Name,0,25); 
												        $Server_Name .= "..."; 
												    }

												    $Server_Slot 	= '32';
													$Server_Map 	= 'de_dust2';

													$Napomena = txt($row['napomena']);
													if ($Napomena == '') {
														$Napomena = '-//-';
													}

												?>
												<tr>
													<td>
														<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
															#<?php echo $Server_ID; ?>
														</a>
													</td>
													<td>
														<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
															<?php echo gp_game_icon($Server_ID).' '.$Server_Name; ?>
														</a>
													</td>
													<td>
														<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
															<?php echo server_full_ip($Server_ID); ?>
														</a> 
													</td>
													<td>
														<a href="/admin/gp-klijent.php?id=<?php echo $Client_ID; ?>" >
															<?php echo user_full_name($Client_ID); ?>
														</a>
													</td>
													<td><?php echo server_istice($Server_ID); ?></td>
													<td><?php echo gp_s_status($Server_ID); ?></td>
													<td><?php echo $Server_Slot; ?></td>
													<td><?php echo $Server_Map; ?></td>
													<td><?php echo $Napomena; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
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

	
</body>
</html>


