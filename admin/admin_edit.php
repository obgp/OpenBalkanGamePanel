<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}

$Admin_ID	= txt($_GET['id']);
if (is_valid_admin($Admin_ID) == false) {
	sMSG('Ovaj admin ne postoji!', 'error');
	redirect_to('home');
	die();
}

if (!($_SESSION['admin_login'] == $Admin_ID)) {
	if (view_developer(a_status($_SESSION['admin_login'])) == false) {
		sMSG('Samo Developer ima pristup!', 'error');
		redirect_to('home');
		die();
	}
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
					
					<!-- Add Client -->
					<div class="span12">
						<h1>
							<span class="icon-user"></span>
							Izmenite informacije radnika
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>Izmenite informacije radnika</h3>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=edit_admin" method="POST" id="edit-profile" class="form-horizontal" autocomplete="off">
									<!-- PRVI RED -->
									<input type="text" name="admin_id" value="<?php echo $Admin_ID; ?>" style="display:none;">

									<div class="span6" style="margin-left: 0;width: 553px;">
										<div class="control-group">											
											<label class="control-label" for="username">Username: </label>
											<div class="controls">
												<input type="text" name="username" class="span6" id="username" value="<?php echo a_username($Admin_ID); ?>" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="sifra">Password: </label>
											<div class="controls">
												<input type="password" name="sifra" class="span6" id="sifra" placeholder="Ukoliko ne zelite menjati pw ostavite prazno!">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="ime">Ime i prezime: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="<?php echo admin_full_name($Admin_ID); ?>" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="cvarovi">Permisije: </label>
											
											<div class="perm_adm">
												<li style="display:inline-block;padding:0 20px;">
													<input id="flag_a" name="admin_perm[]" type="checkbox" value="1"> Modovi
												</li>

												<li style="display:inline-block;padding:0 20px;">
													<input id="flag_a" name="admin_perm[]" type="checkbox" value="2"> Plugini
												</li>

												<li style="display:inline-block;padding:0 20px;">
													<input id="flag_a" name="admin_perm[]" type="checkbox" value="3"> Masine
												</li>
											</div> 
										</div>

									</div>

									<!-- DRUGI RED -->
									<div class="span6" style="margin-right: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="email">Email: </label>
											<div class="controls">
												<input type="email" name="email" class="span6" id="email" value="<?php echo admin_email($Admin_ID); ?>" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="radnik">Radnik: </label>
											<div class="controls">
												<input id="select_rank" type="text" name="drzava_sel" value="<?php echo radnik_id_code($Admin_ID); ?>" style="display: none;">
												<select class="span4" id="radnik" name="radnik" required="">
													<option value="" id="other">Izaberi</option>
													<option value="1" id="helper">Helper</option>
													<option value="2" id="support">Support</option>
													<option value="3" id="admin">Administrator</option>
													<option value="4" id="developer">Developer</option>
												</select>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="cvarovi">Support za: </label>
											
											<div class="perm_adm" style="margin-left:160px;position:absolute;">
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="1"> - Counter-Strike 1.6
												<br />
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="2"> - San Andreas Multiplayer
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="3"> - Minecraft
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="4"> - Call of Duty 2
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="5"> - Call of Duty 4
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="6"> - TeamSpeak 3
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="7"> - Counter-Strike GO
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="8"> - Multi Theft Auto
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="9"> - ARK
												<br />
											</div> 
										</div>

										<br /><br /><br />
										<br /><br /><br />
										<br /><br /><br />

										<button class="btn btn-warning" style="float: right;margin-right: 33px;">
											<i class="fa fa-save"></i> Sacuvaj
										</button>
									</div>
								</form>
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
		var cnt_selected = $('#select_rank').val();
		if(cnt_selected == '1') {
			$('#helper').attr("selected","selected");			
		} else if(cnt_selected == '2') {
			$('#support').attr("selected","selected");
		} else if(cnt_selected == '3') {
			$('#admin').attr("selected","selected");
		} else if(cnt_selected == '4') {
			$('#developer').attr("selected","selected");
		} else {
			$('#other').attr("selected","selected");
		}
	</script>

</body>
</html>