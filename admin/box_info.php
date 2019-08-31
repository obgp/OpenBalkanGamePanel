<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}

if (view_developer(a_status($_SESSION['admin_login'])) == false) {
	sMSG('Samo Developer ima pristup!', 'error');
	redirect_to('home');
	die();
}

$Box_ID = txt($_GET['id']);

if (valid_box(box_ip($Box_ID)) == false) {
	sMSG('Ova masina ne postoji!', 'error');
	redirect_to('all_box.php');
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

$Box_Info 				= mysql_fetch_array(mysql_query("SELECT * FROM `box` WHERE `boxid` = '$Box_ID'"));
$Box_Cache 				= unserialize(gzuncompress($Box_Info['cache']));

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo site_name().' | '.box_name($Box_ID); ?></title>

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
					
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<h3>
									<i class="fa fa-server"></i> 
									<a href="/admin/box_info.php?id=<?php echo $Server_ID; ?>">
										<?php echo box_name($Box_ID); ?>
									</a>
								</h3>
							</div>

							<div class="widget-content">
								<!-- PRVI RED -->
								<div class="span5 left" style="margin-left:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-pushpin"></i>
											<h3>Box informacije</h3>
										</div>

										<div class="widget-content">
											<p> Ime servera: <strong><?php echo box_name($Box_ID); ?></strong></p>
											<p> IP adresa: <strong><?php echo box_ip($Box_ID); ?></strong></p>
											<p> SSH2 Port: <strong><?php echo box_ssh($Box_ID); ?></strong></p>
											<p> Status: <strong><?php echo format_status(box_status($Box_ID)); ?></strong></p>
											<p> 
												Serveri: 
												<strong><?php echo box_servers($Box_ID); ?></strong>
											</p>
										</div>
									</div>
								</div>

								<div class="span5 right" style="width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-cog"></i>
											<h3>Box Informacije #2</h3>
										</div>

										<div class="widget-content">
											<p> CPU Procesor: 
												<strong>
												<?php echo $Box_Cache["{$Box_ID}"]['cpu']['proc']; ?>,
												<?php echo $Box_Cache["{$Box_ID}"]['cpu']['cores']; ?> Core
												</strong>
											</p>
											<p> RAM Total: <strong><?php echo file_size($Box_Cache["{$Box_ID}"]['ram']['total']); ?></strong></p>
											<p> HDD Total: <strong><?php echo file_size($Box_Cache["{$Box_ID}"]['hdd']['total']); ?></strong></p>
											<p> Bandwidth: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage']; ?>&nbsp;%
												</span>
											</p>
											<p> 
												Uptime: 
												<strong>
													<span class="badge badge-success">
													<?php echo $Box_Cache["{$Box_ID}"]['uptime']['uptime']; ?>
													</span>
												</strong>
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
											<p> Online: 
												<span class="badge badge-<?php if(box_status($Box_ID) == 'Online') echo 'success'; else echo 'error'; ?>"> 
												<?php echo box_status($Box_ID); ?>
												</span>
											</p>
											<p> Hostname: 
												<strong> 
												<?php echo $Box_Cache["{$Box_ID}"]['hostname']['hostname']; ?>
												</strong>
											</p>
											<p> CPU Usage: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['cpu']['usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['cpu']['usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['cpu']['usage']; ?>&nbsp;%
												</span>
											</p>
											<p> RAM Usage: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['ram']['usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['ram']['usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['ram']['usage']; ?>&nbsp;%
												</span>
											</p>
											<p> HDD Usage: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['hdd']['usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['hdd']['usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['hdd']['usage']; ?>&nbsp;%
												</span>
											</p>
											<p> 
												Load average: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['loadavg']['loadavg'] < 6.50) {
													echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['loadavg']['loadavg'] < 8.50) {
													echo 'warning';
												} else { echo 'error'; }
												$loadavg2 = str_replace("Unknown HZ value! (28) Assume 100.
												Warning: /boot/System.map-3.10.9-xxxx-grs-ipv6-64 has an incorrect kernel version.
												", "", $Box_Cache["{$Box_ID}"]['loadavg']['loadavg']);
												$loadavg2 = str_replace("Unknown HZ value! (776) Assume 100.
												Warning: /boot/System.map-3.10.9-xxxx-grs-ipv6-64 has an incorrect kernel version.", "", $Box_Cache["{$Box_ID}"]['loadavg']['loadavg']);
												$loadavg2 = str_replace("Unknown HZ value! (28) Assume 100.
												Warning: /boot/System.map-3.10.9-xxxx-grs-ipv6-64 has an incorrect kernel version.
												", "", $Box_Cache["{$Box_ID}"]['loadavg']['loadavg']);
												?>"><?php echo $loadavg2; ?>&nbsp;%
												</span>
											</p>
										</div>
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
												<a data-toggle="modal" href="#boxRestart">
			                      					<button class="btn btn-warning">
			                      						<i class="fa fa-refresh"></i> Restart
			                      					</button>
			                      				</a>
											</li>

											<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="boxRestart" class="modal fade" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Dali ste sigurni da, zelite restartovati masinu?</h4>
														</div>

														<div class="modal-body">
															<strong>Ukoliko pristanete restartovati masinu, morate znati da ce svi serveri na ovoj masini biti offline.</strong>

															<br /> <br />
															
															<form action="/admin/process.php?a=box_restart" method="POST">
																<input type="text" name="box_id" value="<?php echo $Box_ID; ?>" hidden="" style="display:none;">
																<button class="btn btn-info">Da znam, Restartuj masinu!</button>
															</form>
														</div>

														<div class="modal-footer" style="text-align:right;">
															<button data-dismiss="modal" class="btn btn-danger" type="button">
																Cancel
															</button>
														</div>

														<div class="clear"></div>
													</div>
												</div>
											</div>

											<li>
												<a data-toggle="modal" href="#boxBackup">
			                      					<button class="btn btn-info">
			                      						<i class="fa fa-folder"></i> Backup
			                      					</button>
			                      				</a>
											</li>

											<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="boxBackup" class="modal fade" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Dali ste sigurni da, zelite napraviti backup?</h4>
														</div>

														<div class="modal-body">
															<strong>Ukoliko pristanete napraviti backup masine, morate znati da ce se stari backup obrisati!</strong>

															<br /> <br />
															
															<form action="/admin/process.php?a=box_backup" method="POST">
																<input type="text" name="box_id" value="<?php echo $Box_ID; ?>" hidden="" style="display:none;">
																<button class="btn btn-info">Da znam, napravi trenutni backup!</button>
															</form>
														</div>

														<div class="modal-footer" style="text-align:right;">
															<button data-dismiss="modal" class="btn btn-danger" type="button">
																Cancel
															</button>
														</div>

														<div class="clear"></div>
													</div>
												</div>
											</div>

											<li>
												<a data-toggle="modal" href="#boxDelete">
			                      					<button class="btn btn-danger">
			                      						<i class="fa fa-trash"></i> Delete
			                      					</button>
			                      				</a>
											</li>

											<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="boxDelete" class="modal fade" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Dali ste sigurni da, zelite obrisati ovu masinu?</h4>
														</div>

														<div class="modal-body">
															<strong>Ukoliko pristanete obrisati ovu masinu, morate znati da ce svi serveri na ovoj masini biti obrisani zajedno sa njom!</strong>

															<br /> <br />
															
															<form action="/admin/process.php?a=box_delete" method="POST">
																<input type="text" name="box_id" value="<?php echo $Box_ID; ?>" hidden="" style="display:none;">
																<button class="btn btn-info">Da znam, obrisi ovu masinu!</button>
															</form>
														</div>

														<div class="modal-footer" style="text-align:right;">
															<button data-dismiss="modal" class="btn btn-danger" type="button">
																Cancel
															</button>
														</div>

														<div class="clear"></div>
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
			<form action="/admin/process.php?a=change_owner" method="POST" id="forma_popup" class="left">
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


