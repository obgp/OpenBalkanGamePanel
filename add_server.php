<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

if (c_add_server() == false) {
	sMSG('Ova opcija je trenutno uklonjena, moguci razlog je bag ili popravljanje istog.', 'error');
	redirect_to('gp-billing.php');
	die();
}

if (is_money() == false) {
	sMSG('Nemate dovoljno novca da izvrsite ovu funkciju, minimalno je potrebno: '.cena_slota(12).' Trenutno stanje vaseg racuna iznosi: '.money_val(my_money($_SESSION['user_login']), my_contry($_SESSION['user_login'])), 'info');
	redirect_to('gp-billing.php');
	die();
}

/* LGSL - INFO */
require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/lgsl_files/lgsl_class.php');


$p_username = mysql_num_rows(mysql_query("SELECT `id` FROM `serveri` WHERE `user_id` = '$_SESSION[user_login]'"));  
$br_servera = $p_username+1;

$v_username = 'srv_'.$_SESSION['user_login'].'_'.$br_servera.'';

if(mysql_num_rows(mysql_query("SELECT * FROM `serveri` WHERE `username` = '{$v_username}'")) != 0) {
	$v_username = 'srv_'.$_SESSION['user_login'].'_'.($br_servera + 1).'';  
}

$Rand_PasS = random_s_key(8);

if(isset($_GET['box_id'])) {
	$Box_ID 	= txt($_GET['box_id']);

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

	for($s_port = 25565; $s_port <= 25999; $s_port++) {
		if(mysql_fetch_array(mysql_query("SELECT * FROM `serveri` WHERE `box_id` = '$Box_ID' AND `port` = '$s_port' LIMIT 1")) == 0) {
			$get_free_port = lgsl_query_live('minecraft', box_ip($Box_ID), NULL, $s_port, NULL, 's');
			
			if(@$get_free_port['b']['status'] == '1') {
				$vrati_inf = 'Da';
			} else {
				$vrati_inf = 'Ne';
			}

			if ($vrati_inf == 'Ne') {
				$port_for_mc = $s_port;
				break;
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo site_name(); ?> | Install server</title>

	<link rel="stylesheet" type="text/css" href="/assets/css/main.css?<?php echo time(); ?>">

	<!-- CSS Povezivanje -->
    <link href="/assets/css/mobile.css?<?php echo time(); ?>" rel="stylesheet" media="all">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="/assets/css/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" media="all">
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

		<!-- GP SUPPORT -->
		<div id="ServerBox">
	        <div id="server_info_menu">
	            <div class="sNav">
	                <li><a href="/gp-home.php">Vesti</a></li>
	                <li><a href="/gp-servers.php">Serveri</a></li>
	                <li class="nav_s_active"><a href="/gp-billing.php">Billing</a></li>
	                <li><a href="/gp-support.php">Podrška</a></li>
	                <li><a href="/gp-settings.php">Podešavanja</a></li>
	                <li><a href="/gp-iplog.php">IP Log</a></li>
	                <li><a href="/logout.php">Logout</a></li> 
	            </div>
	        </div>

	        <div id="server_info_infor">    
	            <div id="server_info_infor">
	                <div id="server_info_infor2">
	                    <div class="space" style="margin-top: 20px;"></div>
	                    <div class="gp-home">
	                        <img src="/assets/img/icon/gp/gp-server.png" alt="" style="position:absolute;margin-left:20px;">
                        	<h2>NOVI SERVER</h2>
                        	<h3 style="font-size: 12px;">
	                            Ovde možete instalirati vas naruceni server. 
	                            <br/>(<a href="" title="Zanima me">DETALJNIJE</a>)
	                        </h3>
                        	
                        	<div class="supportAkcija right">
	                            <li>
	                            	<a href="/add_server.php" class="lock-btn btn"><i class="fa fa-plus"></i> Podigni novi server</a>
	                            </li>
	                        </div>

	                        <div class="space" style="margin-top: 60px;"></div> 

	                       	<!-- NEW SERVER -->

	                       	<form action="add_server.php" method="GET" autocomplete="off">
								<div class="add_server_by_client_box">
									<label>Izaberite masinu: </label>
									<select name="box_id" onchange="this.form.submit()">
										<option value="0" disabled selected="selected">Izaberite masinu</option>
										<?php $get_box = mysql_query("SELECT * FROM `box`");
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

							<form action="" method="POST">
								<input type="hidden" name="box_id" value="<?php echo $Box_ID; ?>">
								<input type="hidden" name="game_id" value="<?php echo $Game_ID; ?>">

								<div class="add_server_by_client">
									<label for="klijent">Igra: </label>
									<select name="game_id" id="serveraddigra">
										<option value="0" disabled selected="selected">Izaberi</option>
										<option value="1">Counter-Strike 1.6</option>
										<option value="2">San Andreas Multiplayer</option>
										<option value="3" disabled>Minecraft</option>
										<option value="4" disabled>Call of Duty 2</option>
										<option value="5" disabled>Call of Duty 4</option>
										<option value="6" disabled>TeamSpeak 3</option>
										<option value="7" disabled>Counter-Strike GO</option>
									</select>
								</div>

								<div class="add_server_by_client">
									<label for="klijent">Slotovi: </label>
									<input type="text" name="slotovi" placeholder="12 - (minimalno)">
								</div>								

								<div class="add_server_by_client">
									<label for="klijent">Ime servera: </label>
									<input name="ime" type="text" placeholder="Ime servera">
								</div>								

								<div class="add_server_by_client">
									<label for="klijent">Port: </label>
									<input name="port" type="text" placeholder="Port (Automatski)" id="defad" disabled="">
									<input name="port_cs" type="text" value="<?php echo $port_for_cs; ?>" id="csad" style="display: none">
									<input name="port_samp" type="text" value="<?php echo $port_for_samp; ?>" id="sampad" style="display: none">
									<input name="port_mc" type="text" value="<?php echo $port_for_mc; ?>" id="mcad" style="display: none">
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

								<div class="add_server_by_client">
									<label for="klijent">Mod: </label>
									<select name="mod" id="cs_def">
										<option value="0" disabled selected="selected">Izaberite mod</option>
										<?php $get_cs_mod = mysql_query("SELECT * FROM `modovi` WHERE `igra` = '1'");
										while ($row_cs_mod = mysql_fetch_array($get_cs_mod)) { ?>
											<option value="<?php echo txt($row_cs_mod['id']); ?>">
												<?php echo txt($row_cs_mod['ime']); ?>
											</option>
										<?php } ?>	
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
									
								</div>								
							
								<button class="right add_server_by_client_btn" type="submit"> 
									<i class="glyphicon glyphicon-ok"></i> Napravi server
								</button>					
							</form>

							<div class="space clear"></div>
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
    <script src="/assets/js/jquery-ui.js"></script>

    <script type="text/javascript">
    	$("#serveraddigra").change(function() {
			var val = $(this).val();

			if(val == "1") {
				$("#csad").show();
				$("#sampad").hide();
				$("#mcad").hide();
				$("#defad").hide();
				$("#cs_mod").show();
				$("#samp_mod").hide();
				$("#mc_mod").hide();
				$("#cs_def").hide();		
			} else if(val == "2") {
				$("#csad").hide();
				$("#mcad").hide();
				$("#sampad").show();
				$("#defad").hide();
				$("#cs_mod").hide();
				$("#samp_mod").show();
				$("#cs_def").hide();
				$("#mc_mod").hide();
			} else if(val == "3") {
				$("#csad").hide();
				$("#sampad").hide();
				$("#mcad").show();
				$("#defad").hide();
				$("#cs_mod").hide();
				$("#mc_mod").show();
				$("#samp_mod").hide();
				$("#cs_def").hide();
			}
		});

		$("#datum").datepicker(); 
    </script>

</body>
</html>