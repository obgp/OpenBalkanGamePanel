<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('gp-servers.php');
	die();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo site_name(); ?> - GamePanel</title>

	<link rel="stylesheet" type="text/css" href="/assets/css/main.css?<?php echo time(); ?>">

	<!-- CSS Povezivanje -->
    <link href="/assets/css/mobile.css?<?php echo time(); ?>" rel="stylesheet" media="all">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    
</head>
<body>

	 <script src="https://use.fontawesome.com/4ae75e425f.js"></script>

	<!-- Error script -->
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>

    <script type="text/javascript">
    	setTimeout(function() {
    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";
    	}, 5000);
    </script>

	<!-- header -->
	<header>
		<div id="top_bar">
			<div class="top_bar_vesti">
				<li><a href="">INFO</a></li>
			</div>
			
			<div class="top_bar_info">
				<p>Dobrodosli na novi Sajt sa integrisanim panelom, ovo je Beta verzija sajta i panela! Sve korisnike ukoliko imaju problema savjetujem da nas kontaktirate. <a href="/contact">KLIK</a></p>
			</div>

			<div class="top_bar_flag right">
				<li><a href="?lang=rs"><img src="/assets/img/icon/flag/RS.png" alt=""></a></li>
				<li><a href="?lang=de"><img src="/assets/img/icon/flag/DE.png" alt=""></a></li>
				<li><a href="?lang=en"><img src="/assets/img/icon/flag/US.png" alt=""></a></li>
			</div>
		</div>
	</header>

	<div class="containerr">

		<!-- section -->
		<section>
			<li>
				<a href="/index.php"><img src="/assets/img/icon/gb_logo.png" alt="LOGO"></a>
			</li>

			<?php if (is_login() == false) { ?>
				<li class="right">
					<div class="login_form">
						<ul style="width:100%;">
							<form action="/process.php?a=login" method="POST" autocomplete="off">
								<li class="inline" style="float:right;display:block;">
									<ul class="inline">
										<li style="display:block;">
											<span class="inline" id="span_for_name">
												<div class="none">
													<img src="/assets/img/icon/katanac-overlay.png" style="width:33px;position:absolute;margin:3px -18px;">
													<img src="/assets/img/icon/user-icon-username.png" style="width:11px;margin:9px -9px;position:absolute;">
												</div>
											</span>
											<input type="text" name="email" placeholder="email" required autocomplete="email">
										</li>
										<li style="display:block;">
											<span class="inline" id="span_for_pass">
												<div class="none">
													<img src="/assets/img/icon/katanac-overlay.png" style="width:33px;position:absolute;margin:3px -18px;">
													<img src="/assets/img/icon/katanac-pw.png" style="width:9px;margin:9px -9px;position:absolute;">
												</div>
											</span>
											<input type="password" name="password" placeholder="password" required>
										</li>
										
										<div id="loginBox">
											<li><a href="/demo_login.php">DEMO</a></li>
											<li><button>LOGIN <img src="/assets/img/icon/KATANAC-submit.png" style="width: 7px;"></button></li>
										</div>

									</ul>
								</li>
							</form>
						</ul>
					</div>
				</li>
			<?php } else { ?>
				<li class="right">
					<div class="login_form">
						<ul style="width:100%;">
							<li class="inline prof_inf_hdr">
								<div class="av left">
									<img src="/assets/img/icon/G-logo.png" style="width:90px;height:90px;">
								</div>

								<ul class="inline right" style="margin-right:30px;">
									<li style="display:block;">
										<span class="fa fa-user" style="color:#bbb;"></span> 
										<span style="color: #fff;"><?php echo user_full_name($_SESSION['user_login']); ?></span>
									</li>
									<li style="display:block;">
										<span class="fa fa-send" style="color:#bbb;"></span> 
										<span style="color: #fff;"><?php echo user_email($_SESSION['user_login']); ?></span>
									</li>
									<li style="display:block;">
										<span class="fa fa-mail-forward" style="color:#bbb;"></span> 
										<span style="color: #fff;"><?php echo host_ip(); ?></span>
									</li>
									<li style="display:block;">
										<span class="fa fa-money" style="color:#bbb;"></span> 
										<span style="color: #fff;"><?php echo money_val(my_money($_SESSION['user_login']), my_contry($_SESSION['user_login'])); ?></span>
									</li>
									<br>
									<div id="loginBox" style="margin-left:-100px;">
										<li><a href="/gp-settings.php">EDIT</a></li>
										<li><a href="/gp-billing.php">BILLING</a></li>
										<li><a href="/logout.php">LOGOUT</a></li>
									</div>
								</ul>
							</li>
						</ul>
					</div>
				</li>
			<?php } ?>
		</section>

		<div class="space clear" style="margin-top: 20px;"></div>

		<!-- NAVIGACIJA - MENI -->
		<nav>
			<ul style="margin-left: 20px;">
				<li><a href="/home">Početna</a></li>
				<li class="selected"><a href="/gp-home.php">Game Panel</a></li>
				<li><a href="">Forum</a></li>
				<li><a href="/naruci.php">Naruci</a></li>
				<li><a href="">O nama</a></li>
				<li><a href="">Kontakt</a></li>
			</ul>

			<?php if (is_login() == false) { ?>
				<div id="reg">
					<a href="#">REGISTRUJ SE</a>
				</div>
			<?php } else { ?>
				<div id="reg">
					<a href="#">MOJ PROFIL</a>
				</div>
			<?php } ?>
		</nav>

		<!-- GP HOME -->
		<div id="ServerBox">
	        <div id="server_info_menu">
	            <div class="sNav">
	                <li><a href="/gp-home.php">Vesti</a></li>
	                <li class="nav_s_active"><a href="/gp-servers.php">Serveri</a></li>
	                <li><a href="/gp-billing.php">Billing</a></li>
	                <li><a href="/gp-support.php">Podrška</a></li>
	                <li><a href="/gp-settings.php">Podešavanja</a></li>
	                <li><a href="/gp-iplog.php">IP Log</a></li>
	                <li><a href="/logout.php">Logout</a></li> 
	            </div>
	        </div>

	        <div id="server_info_infor">    
	            <div id="server_info_infor">
	                <div id="server_info_infor2">
	                    <div id="ftp_header">
		                    <div id="left_header">
		                        <div style="margin-top:15px;color: #fff;">
		                            <strong><?php echo server_name($Server_ID); ?></strong>
		                        </div>
		                    </div>
		                    <div id="right_header">
		                        <div class="info_buttn">
		                        	<?php if (server_is_start($Server_ID) == false) { ?>
		                        		<li>
		                                    <form action="/process.php?s=server_start" method="POST">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <button href="" class="start_btn" style="background:none;border:none;">
		                                            <i class="fa fa-caret-right" style="font-size: 20px;"></i> Start
		                                        </button>
		                                    </form>
		                                </li>

		                                <?php if (is_user_pin() == false) { ?>
		                                	<li>
			                                    <button class="restart_btn" style="background:none;border:none;" data-toggle="modal" data-target="#pin-auth">
		                                            <i class="fa fa-refresh" style="font-size: 15px;"></i> Reinstall
		                                        </button>
			                                </li>
		                                <?php } else { ?>
		                                	<li>
			                                    <form action="/process.php?s=server_reinstall" method="POST">
			                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
			                                        <button class="restart_btn" style="background:none;border:none;">
		                                                <i class="fa fa-refresh" style="font-size: 15px;"></i> Reinstall
		                                            </button>
			                                    </form>
			                                </li>
		                                <?php } ?>
		                        	<?php } else { ?>
		                        		<li>
		                                    <form action="/process.php?s=server_restart" method="POST">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <button class="restart_btn" style="background:none;border:none;">
		                                            <i class="fa fa-refresh" style="font-size: 15px;"></i> Restart
		                                        </button>
		                                    </form>
		                                </li>
		                                <li>
		                                    <form action="/process.php?s=server_stop" method="POST">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <button href="" class="stop_btn" style="background:none;border:none;">
		                                            <i class="fa fa-power-off" style="font-size: 15px;"></i> Stop
		                                        </button>
		                                    </form>
		                                </li> 
		                        	<?php } ?>
		                        </div>
		                    </div>
		                </div>

		                <div class="space" style="margin-top: 20px;"></div>

		                <li><a href="gp-server.php?id=<?php echo $Server_ID; ?>">Server</a></li>
		                <!--<li><a href="gp-config.php?id=<?php echo $Server_ID; ?>">Podesavanje</a></li>-->
		                <?php if (gp_game_id($Server_ID) == 1) { ?>
		                    <li class="nav_s_active"><a href="gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
		                    <li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="gp-maps.php?id=<?php echo $Server_ID; ?>">Map installer</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 2) { ?>
		                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 3) { ?>
		                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 4) { ?>
		                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                	<li class="nav_s_active"><a href="gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 5) { ?>
		                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                	<li><a href="gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 6) { ?>
		                	<li><a href="ts-perm.php?id=<?php echo $Server_ID; ?>">Permission</a></li>
		                	<li><a href="ts-bans.php?id=<?php echo $Server_ID; ?>">Banovani</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 7) { ?>	
		                	<li><a href="gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
		                    <li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li class="nav_s_active"><a href="gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 8) { ?>
		                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 9) { ?>
		                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } ?>

	                    <div id="ftp_container">
	                    	<div class="space" style="margin-top: 20px;"></div>
		                    <div id="ftp_header">
		                        <div id="left_header">
		                            <div>
		                                <img src="/assets/img/icon/gp/gp-admin.png">
		                            </div> 
		                            <div style="margin-top:15px;color: #fff;">
		                                <strong>Server BackUP</strong>
		                                <p>Ovde mozete napraviti rezervnu kopiju vaseg servera.
		                                <br/></p>
		                            </div>
		                        </div>
		                    </div>
							<div class="supportAkcija right">
								<center><form action="/process.php?s=server_backup" method="POST">
									<input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
									<button class="btn btn-success">
										<i class="fa fa-folder" style="font-size: 15px;"></i> Create Backup
									</button>
								</form></center>
		                    </div> 

		                    <div class="space" style="margin-top:60px;"></div>
						
		                    <div id="plugin_body">
								<?php if (server_is_start($Server_ID) == true) { ?>
									<p style="color: red!important;">Info: <strong><i>Da biste napravili Backup, pozeljno je stopirati vas server.</i></strong></p>
								<?php } ?>
		                    	
                        <div id="serveri">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Backup ID</th>
                                        <th>Backup Name</th>
										<th>Backup Size</th>
										<th>Backup Status</th>
										<th>Backup Action</th>
                                    </tr>
                                </thead>
								<tbody>
										<?php  
											$backups		=	mysql_query("SELECT * FROM `server_backup` WHERE `srvid` = '$Server_ID'");
											$BID = 1;
											while($row = mysql_fetch_array($backups)) {
												
												$Backup_ID		=	txt($row['id']);
												$Backup_Name	=	txt($row['name']);
												$Backup_Size	=	txt($row['size']);
												$Backup_Status	=	txt($row['status']);
												$Box_ID 		=	getBOX($Server_ID); 
												?>
												<tr>
													<td>
														#<?php echo $Backup_ID; ?>
													</td>
													<td>
														<?php echo $Backup_Name; ?>
													</td>
													<td>
														<?php
														if($Backup_Size == "0" && $Backup_Status == "0") {
															echo GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
														} else {
															echo $Backup_Size;
														}
														?>
													</td>
													<td>
														<?php
														if($Backup_Size == "0" && $Backup_Status == "0") {
															$Backup_Status = GetBackUPStatus($Box_ID, $Server_ID, $Backup_Name);
															if($Backup_Status == "Failed") {
																echo "<font color=\"#FE0300\">Failed!</font>";
															} else if($Backup_Status == "Finished") {
																echo "<font color=\"#00FF00\">Finished</font>";
															} else if($Backup_Status == "Copying") {
																echo "<font color=\"#E08010\">Copying files...</font>";
															}
														} else {
															if($Backup_Status == "Failed") {
																echo "<font color=\"#FE0300\">Failed!</font>";
															} else if($Backup_Status == "Finished") {
																echo "<font color=\"#00FF00\">Finished</font>";
															} else if($Backup_Status == "Copying") {
																echo "<font color=\"#E08010\">Copying files...</font>";
															}
														}
														?>
													</td>
													<td>
														<form action="/process.php?s=server_backup_restore" method="POST">
															<input hidden type="text" name="backup_id" value="<?php echo $Backup_ID; ?>" style="display:none;">
				                                        	<input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        	<button class="btn btn-warning">
																<i class="fa fa-folder" style="font-size: 15px;"></i> Restore
			                                            	</button>
				                                    	</form>
														<form action="/process.php?s=server_backup_delete" method="POST">
															<input hidden type="text" name="backup_id" value="<?php echo $Backup_ID; ?>" style="display:none;">
				                                        	<input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        	<button class="btn btn-danger">
																<i class="fa fa-folder" style="font-size: 15px;"></i> Delete
			                                            	</button>
				                                    	</form>
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

	    <div class="space" style="margin-top: 40px;"></div>

	<!-- end containerr -->
	</div>

	<!-- FOOTER -->
	<div class="copyright">
		<div class="container">
			<div class="col-md-6">
				<p>&copy; Copyright 2017-<?php echo date('Y').' '.site_name(); ?>. Sva prava zadrzana.</p>
			</div>
			
			<div class="col-md-6">
				<ul class="bottom_ul">
					<li><a href="/home">Početna</a></li>
					<li><a href="/gp-home.php">Game Panel</a></li>
					<li><a href="">Forum</a></li>
					<li><a href=""><?php echo GT_Site_Name(); ?></a></li>
				</ul>
			</div>
		</div>
	</div>

	<script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>