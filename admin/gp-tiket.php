<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}


$Ticket_ID = txt($_GET['id']);

if (is_valid_ticket($Ticket_ID) == false) {
	sMSG('Ovaj tiket ne postoji!', 'error');
	redirect_to('gp-tiketi.php');
	die();
}

if (cp_perm_tiket_view($Ticket_ID) == false) {
	sMSG('Niste support za ovu igru!', 'info');
	redirect_to('gp-tiketi.php');
	die();
}

$Tiket_Info 			= mysql_fetch_array(mysql_query("SELECT * FROM `tiketi` WHERE `id` = '$Ticket_ID'"));
$Tiket_Info_odg 		= mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `tiket_id` = '$Ticket_ID'");

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
					
					<!-- TICKET -->
		<div class="span12">
			<h1>
				<span class="icon-comment"></span>
				Podrska
			</h1>

			<br />

			<h3><?php echo ticket_name($Ticket_ID); ?></h3>

			<hr>
		</div>

		<div class="span8">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-list"></i>
					<h3>
						<a href="">
							<?php echo user_full_name(ticket_owner($Ticket_ID)); ?>
						</a>
					</h3>
					<span style="float: right;margin-right: 10px;font-weight: bold;">
						<?php echo ticket_date($Ticket_ID); ?>
					</span>
				</div>

				<div class="widget-content">
					<?php echo smile(ticket_text($Ticket_ID)); ?>
				</div>
			</div>

			<?php  

				$t_odg_query = mysql_query("SELECT * FROM `tiketi_odgovori` WHERE `tiket_id` = '$Ticket_ID' ORDER by id ASC");  

				if (mysql_num_rows($t_odg_query) == true) {
					while($row = mysql_fetch_array($t_odg_query)) {
						$Odg_Ticket_ID 		= txt($row['id']);

						$Odg_User_ID 		= txt($row['user_id']);
						$Odg_Admin_id 		= txt($row['admin_id']);
			?>
			<!-- -->
			<?php if (!$Odg_Admin_id == "") { ?>
				
				<div class="widget stacked">
					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>
							<a href="/admin/admin.php?id=<?php echo $Odg_User_ID; ?>">
								<?php echo my_name($Odg_Admin_id); ?>
							</a>
						</h3>
						<span style="float: right;margin-right: 10px;font-weight: bold;">
							<?php echo t_odg_time($Odg_Ticket_ID); ?>
						</span>
					</div>

					<div class="widget-content">
						<?php echo smile(t_odg_text($Odg_Ticket_ID)); ?>
						
						<hr>
						
						<div class="potpis_tiket_odg" style="float:left;color:#9c9696;">
							<?php echo admin_signature($Odg_Admin_id); ?>
						</div>

						<div class="obrisi_tiket_odg" style="float:right;">
							<form action="/admin/process.php?a=delete_odg" method="POST">
								<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
								<input type="text" name="odg_id" value="<?php echo $Odg_Ticket_ID; ?>" style="display: none;">
								<button class="btn btn-danger">Obrisi</button>
							</form>
						</div>
					</div>
				</div>
			
			<?php } else { ?>
				
				<div class="widget stacked">
					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>
							<a href="/admin/gp-klijent.php?id=<?php echo $Odg_User_ID; ?>">
								<?php echo user_full_name($Odg_User_ID); ?>
							</a>
						</h3>
						<span style="float: right;margin-right: 10px;font-weight: bold;">
							<?php echo t_odg_time($Odg_Ticket_ID); ?>
						</span>
					</div>

					<div class="widget-content">
						<?php echo smile(t_odg_text($Odg_Ticket_ID)); ?>
						
						<hr>

						<div class="obrisi_tiket_odg" style="float: right;">
							<form action="/admin/process.php?a=delete_odg" method="POST">
								<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
								<input type="text" name="odg_id" value="<?php echo $Odg_Ticket_ID; ?>" style="display: none;">
								<button class="btn btn-danger">Obrisi</button>
							</form>
						</div>
					</div>
				</div>

			<?php } ?>
			<!-- -->
			<?php }} ?>

			<hr>
			<!-- Posalji poruku -->
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-pushpin"></i>
					<h3>Posalji poruku</h3>
				</div>

				<div class="widget-content">
					<form action="/admin/process.php?a=supp_odg" method="POST">
						<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
						<textarea name="supp_odg" placeholder="Posaljite poruku..." style="width: 100%;height: 150px;margin: 0 0 0 -7px;background: #29384D!important;border: 2px solid #364856!important;color: #fff; padding: 5px;"></textarea>
						<div class="button_suup_odg_ticket" style="float: right;margin: 10px -5px -5px -5px;">
							<button class="btn btn-warning">
								<i class="fa fa-send"></i> POSALJITE
							</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	
		<div class="span4">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-list"></i>
					<h3>Tiket #<?php echo $Ticket_ID; ?></h3>
				</div>

				<div class="widget-content">
					<div class="admin_tiket_precice">
						<?php if (ticket_status_id($Ticket_ID) == 4) { ?>
							<li>
								<form action="/admin/process.php?a=unlock_tiket" method="POST">
									<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
									<button class="btn btn-success"> <i class="icon-unlock"></i> OTKLJUCAJ</button>
								</form>
							</li>
						<?php } else { ?>
							<li>
								<form action="/admin/process.php?a=lock_tiket" method="POST">
									<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
									<button class="btn btn-danger"> <i class="icon-lock"></i> ZATVORI</button>
								</form>
							</li>
						<?php } ?>
						
						<li>
							<form action="/admin/gp-server.php?id=<?php echo ticket_server($Ticket_ID); ?>" method="POST">
								<button class="btn btn-info"> <i class="icon-screenshot"></i> SERVER</button>
							</form>
						</li>

						<li>
							<form action="/admin/gp-klijent.php?id=<?php echo ticket_owner($Ticket_ID); ?>" method="POST">
								<button class="btn btn-warning"> <i class="icon-user"></i> PROFIL</button>
							</form>
						</li>
						
						<hr>

						<p>IP adresa: <strong> <?php echo server_full_ip(ticket_server($Ticket_ID)); ?> </strong></p>
						<p>Status: <strong> <?php echo ticket_status($Ticket_ID); ?> </strong></p>
						<p>Prioritet: <strong> <?php echo ticket_s_pro($Ticket_ID); ?> </strong></p>
						
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

	
</body>
</html>