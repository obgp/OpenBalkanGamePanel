<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

error_reporting(E_ALL);

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}

$Client_ID	= txt($_GET['id']);
if (is_valid_user($Client_ID) == false) {
	sMSG('Ovaj klijent nalog ne postoji!', 'error');
	redirect_to('clients.php');
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

					<!-- KLIJENT INFO -->
					<div class="span12">
						<h1>
							<span class="icon-user"></span>
							Nalog Informacije
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>
									<a href="">
										#<?php echo $Client_ID; ?> 
										~
										<?php echo user_full_name($Client_ID); ?> 
									</a>
								</h3>
								
								<div class="adm_opcije_client">
									<li>
										<button class="btn btn-info" onclick="location = './add_server.php?user_id=<?php echo $Client_ID; ?>'">
											<span class="fa fa-plus"></span> DODAJ SERVER
										</button>
									</li>

									<li>
										<?php if (ban_user($Client_ID) == 0) { ?>
											<form action="/admin/process.php?a=banuj_nalog" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-warning">
													<span class="icon-lock"></span> BANUJ KLIJENTA
												</button>
											</form>
										<?php } else { ?>
											<form action="/admin/process.php?a=un_banuj_nalog" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-success">
													<span class="icon-unlock"></span> UN-BANUJ KLIJENTA
												</button>
											</form>
										<?php } ?>
									</li>
									<li>
										<?php if (ban_ftp($Client_ID) == 0) { ?>
											<form action="/admin/process.php?a=banuj_ftp" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-warning">
													<span class="icon-lock"></span> ZABRANI FTP
												</button>
											</form>
										<?php } else { ?>
											<form action="/admin/process.php?a=un_banuj_ftp" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-success">
													<span class="icon-unlock"></span> ODOBRI FTP
												</button>
											</form>
										<?php } ?>
									</li>
									<li>
										<?php if (ban_support($Client_ID) == 0) { ?>
											<form action="/admin/process.php?a=banuj_podrsku" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-warning">
													<span class="icon-lock"></span> ZABRANI PODRSKU
												</button>
											</form>
										<?php } else { ?>
											<form action="/admin/process.php?a=un_banuj_podrsku" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-success">
													<span class="icon-unlock"></span> ODOBRI PODRSKU
												</button>
											</form>
										<?php } ?>
									</li>
									<li>
										<button class="btn btn-danger" href="#delete_client" role="button" class="btn" data-toggle="modal">
											<span class="icon-remove"></span> OBRISI NALOG
										</button>
									</li>
								</div>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=change_profile" method="POST" id="edit-profile" class="form-horizontal">
									<input type="text" name="client_id" hidden="" value="<?php echo $Client_ID; ?>" style="display:none;">
									<!-- PRVI RED -->
									<div class="span6" style="margin-left: 0;width: 553px;">
										<h3><span class="icon-exclamation-sign"></span> INFO</h3>

										<div class="control-group">											
											<label class="control-label" for="ime">Ime: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="<?php echo user_ime($Client_ID); ?>">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="prezime">Prezime: </label>
											<div class="controls">
												<input type="text" name="prezime" class="span6" id="prezime" value="<?php echo user_prezime($Client_ID); ?>">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="email">Email: </label>
											<div class="controls">
												<input type="text" name="email" class="span4" id="email" value="<?php echo user_email($Client_ID); ?>">
											</div>
										</div>

										<div class="control-group">											
											<label class="control-label" for="drzava">Drzava: </label>
											<div class="controls">
												<input id="select_cnt" type="text" name="drzava_sel" value="<?php echo my_contry($Client_ID); ?>" style="display: none;">
												<select class="span4" id="drzava" name="drzava" required="">
													<option value="">Izaberi drzavu</option>
													<option value="RS" id="RS">Srbija</option>
													<option value="HR" id="HR">Hrvatska</option>
													<option value="BA" id="BA">Bosna i Hercegovina</option>
													<option value="MK" id="MK">Makedonija</option>
													<option value="ME" id="ME">Montenegro</option>
													<option value="other" id="other">No Balkan</option>
												</select>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="password">Sifra: </label>
											<div class="controls">
												<input type="password" name="password" class="span4" id="password" placeholder="Ukoliko ne zelite da menjate ostavite prazno!">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="pin">Pin kod: </label>
											<div class="controls">
												<input type="text" name="pin_code" class="span4" id="pin" value="<?php echo user_pincode($Client_ID); ?>" maxlength="5">
											</div>		
										</div>
										
										<div class="control-group">											
											<label class="control-label" for="date_">Datum dodavanja: </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="date_" value="<?php echo user_register($Client_ID); ?>">
											</div>		
										</div>

										<!--<div class="control-group">											
											<label class="control-label" for="n_dodao">Nalog dodao: </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="n_dodao" value="Dodati funkicju.">
											</div>		
										</div>-->
									</div>

									<!-- DRUGI RED -->
									<div class="span6" style="margin-right: 0;width: 553px;">
										<h3><span class="icon-cogs"></span> AKCIJA</h3>

										<div class="control-group">											
											<label class="control-label" for="ban_nalog">Nalog banovan: </label>
											<div class="controls">
												<input disabled="" type="text" class="span6" id="ban_nalog" value="<?php echo ban_select(ban_user($Client_ID)); ?>">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="ban_ftp">FTP ban: </label>
											<div class="controls">
												<input disabled="" type="text" class="span6" id="ban_ftp" value="<?php echo ban_select(ban_ftp($Client_ID)); ?>">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="support_ban">Podrška ban: </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="support_ban" value="<?php echo ban_select(ban_support($Client_ID)); ?>">
											</div>		
										</div>

										<br/><br/>

										<div class="control-group">											
											<label class="control-label" for="balans"><h3><span class="icon-asterisk"></span> BALANS</h3> </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="balans" value="<?php echo money_val(my_money($Client_ID), my_contry($Client_ID)); ?>">
											</div>		
										</div>

										<div class="control-group">
											<div class="controls">
												<div class="klijent_popravi_btn">
													<li>
														<a class="btn btn-warning"><span class="icon-credit-card"></span> DODAJ UPLATU</a>
													</li>
													<li style="float: right;margin-right: 33px;">
														<a class="btn btn-warning"><span class="icon-minus"></span> SKINI NOVAC</a>
													</li>
												</div>
											</div>		
										</div>
										
										<br/>

										<button class="btn btn-warning" style="float: right;margin-right: 33px;"><span class="icon-save"></span> SACUVAJ</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- LISTA SERVERA KLIJENTA -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-th-list"></i>
								<h3>Lista servera klijenta 
									<i>( <?php echo user_full_name($Client_ID).', '.user_email($Client_ID); ?> )</i>
								</h3>
							</div>

							<div class="widget-content">
								
								<table class="table table-striped table-bordered tabela-asd">
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
										</tr>
									</thead>

									<tbody>
										<?php  
											$data_query = mysql_query("SELECT * FROM `serveri` WHERE `user_id` = '$Client_ID' ORDER BY id DESC");

											while($row = mysql_fetch_array($data_query)) {
												$Server_ID 		= txt($row['id']);

												include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/class/class.load_server.php');
											?>
											<tr>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
														#<?php echo $Server_ID ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
														<?php echo server_name($Server_ID); ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
														<?php echo server_full_ip($Server_ID); ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-client.php?id=<?php echo txt($Client_ID); ?>">
														<?php echo user_full_name($Client_ID); ?>
													</a>
												</td>
												<td><?php echo server_istice($Server_ID); ?></td>
												<td><?php echo gp_s_status($Server_ID); ?></td>
												<td><?php echo $Server_Players; ?></td>
												<td><?php echo $Server_Map; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
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
	<script type="text/javascript">
		var cnt_selected = $('#select_cnt').val();
		if(cnt_selected == 'RS') {
			$('#RS').attr("selected","selected");			
		} else if(cnt_selected == 'HR') {
			$('#HR').attr("selected","selected");
		} else if(cnt_selected == 'BA') {
			$('#BA').attr("selected","selected");
		} else if(cnt_selected == 'MK') {
			$('#MK').attr("selected","selected");
		} else if(cnt_selected == 'ME') {
			$('#ME').attr("selected","selected");
		} else {
			$('#other').attr("selected","selected");
		}
	</script>

	<div id="delete_client" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">Obrisi klijenta</h4>
		</div>

		<div class="modal-footer">
			<form action="/admin/process.php?a=delete_client" method="POST" id="forma_popup" class="left">
				<input type="text" name="client_id" value="<?php echo $Client_ID; ?>" style="display:none;">

				<div class="space clear"></div>

				<button class="left btn btn-danger">
					<i class="icon-ok"></i> Obrisi
				</button>
			</form>
		</div>
	</div>

</body>
</html>