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
$cron_list	 			= mysql_query("SELECT * FROM `crons`");
//
$Svi_Tiketi 			= mysql_query("SELECT * FROM `tiketi`");
$Otv_Tiketi 			= mysql_query("SELECT * FROM `tiketi` WHERE `status` = '1'");
$Odg_Tiketi 			= mysql_query("SELECT * FROM `tiketi_odgovori`");
$Lck_Tiketi 			= mysql_query("SELECT * FROM `tiketi` WHERE `status` = '0'");
$Novi_Tiketi 			= mysql_query("SELECT * FROM `tiketi` ORDER BY `id` DESC LIMIT 4");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo site_name(); ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/head.php'); ?>

	<link rel="stylesheet" type="text/css" href="/admin/assets/js/gritter/css/jquery.gritter.css?<?php echo time(); ?>">
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
					<!-- Stats -->
					<div class="span12">
						<div class="widget widget-nopad">
							<div class="widget-header">
								<i class="icon-list-alt"></i>
								<h3> Statistika</h3>
								<div id="target-1"></div>
							</div>
							
							<div class="widget-content">
								<div class="widget big-stats-container">
									<div class="widget-content">
										<div id="big_stats" class="cf">
											<div class="stat">
												<i class="icon-signal"></i> 
												<span class="value" style="color:#fff;"><?php echo mysql_num_rows($stats_klijenti); ?></span>
												<br />
												<span>Korisnika</span> 
											</div>

											<div class="stat"> 
												<i class="icon-comments-alt"></i> 
												<span class="value" style="color:#fff;"><?php echo mysql_num_rows($stats_tiketi); ?></span> 
												<br />
												<span>Tiketa</span> 
											</div>
											
											<div class="stat"> 
												<i class="fa fa-gamepad"></i> 
												<span class="value" style="color:#fff;"><?php echo mysql_num_rows($stats_server); ?></span> 
												<br />
												<span>Servera</span> 
											</div>

											<div class="stat"> 
												<i class="fa fa-server"></i> 
												<span class="value" style="color:#fff;"><?php echo mysql_num_rows($stats_masine); ?></span> 
												<br />
												<span>Masina</span> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Chat -->
					<div class="span8">			
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-signal"></i>				
								<h3>Chat</h3>
								<div class="right" style="margin-right:10px;">
									<button class="btn btn-danger" onclick="del_all_msg()">
										<i class="fa fa-remove"></i> Delete all messages
									</button>
								</div>
							</div>

							<div class="widget-content" style="height: 250px;">				
								<div id="chat_main">
									<div id="chat_messages">
										<div id="chat_messages1">
											<div id="load_msg">
												<center>
													<img src="/admin/assets/img/icon/load/load1.gif" style="margin-top: 100px;border-radius: 50%;width: 120px;">
												</center>
											</div>
										</div>
									</div>		
								</div>

								<div class="down_inp_send_msg">
									<input type="text" id="send_msg" placeholder="Zabranjen spam i vredjanje..." onkeypress="return send_msg_event(event)">
									<button onclick="send_msg()"> <i class="fa fa-chevron-right"></i> </button>
								</div>
							</div>
						</div>
					</div>

					<!-- News ticket -->
					<div class="span4">
						<div class="widget widget-nopad">
							<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3> Novi tiketi </h3>
								<div id="target-3"></div>
							</div>

							<?php
								while($row = mysql_fetch_array($Novi_Tiketi)) { 
									$Tiket_ID	 			= txt($row['id']);
									$Tiket_Name 			= txt($row['naslov']);
									$Tiket_Text 			= txt($row['text']);
									$Tiket_Date 			= txt($row['datum']);
									
									$Exploded = multiexplode(array(".",", ",":"), $Tiket_Date);
									$timestamp = mktime($Exploded[3], $Exploded[4], 0, $Exploded[0], $Exploded[1], $Exploded[2]);
							?>

							<div class="widget-content">
								<ul class="news-items">
									<li style="width:100%;">
										<div class="news-item-date"> 
											<span class="news-item-day"><?php echo date('d', $timestamp); ?></span> 
											<span class="news-item-month"><?php echo date('M', $timestamp); ?></span>
										</div>

										<div class="news-item-detail">
											<a href="/admin/gp-tiket.php?id=<?php echo $Tiket_ID; ?>" class="news-item-title">
												<?php echo $Tiket_Name; ?>
											</a>
											<p class="news-item-preview" style="color:#bbb;">
												<?php echo $Tiket_Text; ?>
											</p>
										</div>
									</li>
								</ul>
							</div>
							<?php } ?>
						</div>
					</div>
					
					<!-- Cronovi -->
					<div class="span8">			
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-signal"></i>				
								<h3>Cronovi</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th>ID</th>
											<th>Cron Name</th>
											<th>Cron Last Update</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while($row = mysql_fetch_array($cron_list)) { 
												$Cron_ID 			= txt($row['id']);
												$Cron_Name 			= txt($row['cron_name']);
												$Cron_Update 		= txt($row['cron_value']);
											?>
											<tr>
												<td>
													#<?php echo $Cron_ID; ?>
												</td>
												<td>
													<?php echo $Cron_Name; ?>
												</td>
												<td>
													<?php echo $Cron_Update; ?>
												</td>
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
							<img src="/admin/assets/img/icon/logo.png" alt="<?php echo site_name(); ?>">
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
		function del_all_msg() {
			$.ajax({
		    	type: 	'GET',
		    	url: 	'/admin/process.php?a=del_all_msg',
		    	data: 	'all=' + true + '',
		    	success:function() {
		    		$('#send_msg').val('');
		    	}
			});
		}
		function send_msg_event(e) {
			if (e.which == 13 || e.keyCode == 13) {
		        send_msg();
		        var msg_send = $('#send_msg').val('');
		        return false;
		    }
		}
		function send_msg() {
			var msg_send = $('#send_msg').val();
			
			if (msg_send == '') {
				alert('Ne mozete poslati prazan input! :)');
			} else {
				$.ajax({
			    	type: 	'GET',
			    	url: 	'/admin/process.php?a=send_msg',
			    	data: 	'msg_text=' + msg_send + '',
			    	success:function() {
			    		$('#send_msg').val('');
			    	}
				});
			}
		}
		function load_msg() {
	    	$('#chat_messages1').load('/admin/process.php?a=chat_msg_num');      
		}
		setInterval('load_msg()', 1000);		
	</script>

	<!--script for this page-->
    <script type="text/javascript" src="/admin/assets/js/gritter/js/jquery.gritter.js"></script>
    <!--<script type="text/javascript" src="/admin/assets/js/gritter/js/gritter-conf.js"></script>-->

    <script type="text/javascript">
    	$(document).ready(function(){
	        $.gritter.add({
	            // (string | mandatory) the heading of the notification
	            title: 'Dobrodošao/la',
	            // (string | mandatory) the text inside the notification
	            text: '<?php echo my_name($_SESSION['admin_login']); ?>',
	            // (string | optional) the image to display on the left
	            image: '/assets/img/rank/dev.png',
	            // (bool | optional) if you want it to fade out on its own or just sit there
	            sticky: false,
	            // (int | optional) the time you want it to be alive for before fading out
	            time: ''
	        });

	        return false;
        });
    </script>
    
</body>
</html>