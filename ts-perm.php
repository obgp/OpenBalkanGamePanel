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

#poke client
if (isset($_POST['sgid']) && isset($_POST['perm_name']) && isset($_POST['edit_true'])) {
	$Perm_ID 	= txt($_POST['sgid']);
	$Perm_Name 	= txt($_POST['perm_name']);

	$poke_msg_ok = $tsAdmin->serverGroupRename($Perm_ID, $Perm_Name);
	if (!$poke_msg_ok) {
		sMSG('Doslo je do greske.', 'error');
		redirect_to('ts-perm.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste izvrsili komandu.', 'success');
		redirect_to('ts-perm.php?id='.$Server_ID);
		die();
	}
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
				<a href="/index.php"><img src="/assets/img/icon/logo/logo.png" alt="LOGO"></a>
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
									<img src="/assets/img/icon/G_only_logo.png" style="width:90px;height:90px;">
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
		                    <li><a href="gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
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
		                	<li><a href="gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
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
		                	<li class="nav_s_active"><a href="ts-perm.php?id=<?php echo $Server_ID; ?>">Permission</a></li>
		                	<li><a href="ts-bans.php?id=<?php echo $Server_ID; ?>">Banovani</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 7) { ?>	
		                	<li><a href="gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
		                    <li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
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
		                    <div id="ftp_header">
		                        <div id="left_header">
		                            <div>
		                                <img src="/assets/img/icon/gp/gp-plugins.png">
		                            </div> 
		                            <div style="margin-top:15px;color: #fff;">
		                                <strong>TS3 Permisije</strong>
		                                <p>Ovde mozete dodavati, brisati, editovati i gledati permisije.</p>
		                            </div>
		                        </div>
		                    </div>              
		                    <div id="plugin_body">

		                    	<div id="webftp">
	                                <table>
	                                    <tbody>
	                                        <tr>
	                                            <th>Name</th>
	                                            <th>Action</th>
	                                        </tr>
		                    	
						                    	<?php
												#get serverGroupList
												$get_group_list = $tsAdmin->serverGroupList();
												
												//print_r($get_group_list);

												#print perm to you
												foreach($get_group_list['data'] as $perm_) {
													$Perm_ID 		= txt($perm_['sgid']);
													$Perm_Name 		= txt($perm_['name']);
													$Perm_Icon 		= $tsAdmin->serverGroupGetIconBySGID($Perm_ID);

													//print_r($Perm_Icon);
												?>
												<tr>
													<td>
														<img src="data:image/png;base64,<?php echo $Perm_Icon['data']; ?>" /> 
														<?php echo $Perm_Name; ?>
													</td>
													<td style="width:100px;">
														<li class="left" style="padding:0px 5px;">
															<i class="fa fa-edit"></i>
															<a href="#" data-toggle="modal" data-target="#izmeni-auth_id_<?php echo $Perm_ID; ?>">Izmeni</a>
														</li>
													</td>
												</tr>

													<!-- POKE POPUP -->
<div id="izmeni-auth_id_<?php echo $Perm_ID; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div id="popUP"> 
	        <div class="popUP">
	            <form action="/ts-perm.php?id=<?php echo $Server_ID; ?>" method="POST" autocomplete="off" id="modal-izmeni-auth">
	                <fieldset>
	                    <h2 style="font-size:15px;">Izmeni <?php echo $Perm_Name; ?> permisiju</h2>
	                    <ul>
	                        <li>
	                            <label>Name:</label>
	                            <input type="hidden" name="sgid" value="<?php echo $Perm_ID; ?>">
	                            <input type="hidden" name="edit_true" value="true">
	                            <input type="text" name="perm_name" value="<?php echo $Perm_Name; ?>" class="short">
	                        </li>
	                        <div class="space clear"></div>
	                        <li style="text-align:center;border:none;">
	                        	<button style="color:#333!important;"> <span class="fa fa-check-square-o"></span> Save</button>
	                        </li>
	                    </ul>
	                </fieldset>
	            </form>
	        </div>        
	    </div>  
	</div>
</div>
<!-- KRAJ - POKE (POPUP) -->
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