<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');




if (isset($_GET['user_id'])) {
	$User_ID = txt($_GET['user_id']);

	if(isset($_GET['box_id'])) {
		$Box_ID = txt($_GET['box_id']);

		/* LGSL - INFO */
		require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/lgsl_files/lgsl_class.php');

		$v_username = 'srv_'.$User_ID.'_'.random_s_key(5).'';

		$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `username` = ?");
		$SQLSEC->Execute(array($v_username));

		if($SQLSEC->rowCount() != 0) {
			$v_username = 'srv_'.$User_ID.'_'.random_s_key(5).'';  
		}

		$Rand_PasS = random_s_key(8);

		$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
		$SQLSEC->Execute(array($Box_ID, $s_port));

		for($s_port = 27015; $s_port <= 29999; $s_port++) {
			if($SQLSEC->rowCount() == 0) {
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

		$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = '' AND `port` = ? LIMIT 1");
		$SQLSEC->Execute(array($Box_ID, $s_port));
	
			for($s_port = 7777; $s_port <= 9999; $s_port++) {
				if($SQLSEC->rowCount() == 0) {
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
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
				$vrati_inf = 'Da';
			} else {
			    	$port_for_cod2 = $s_port;
					break;
			}
		}
		for($s_port = 28960; $s_port <= 29960; $s_port++) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
								$vrati_inf = 'Da';
			} else {
			    	$port_for_cod4 = $s_port;
					break;
			}
		}
		for($s_port = 9987; $s_port <= 11000; $s_port++) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
								$vrati_inf = 'Da';
			} else {
			    	$port_for_ts = $s_port;
					break;
			}
		}
		for($s_port = 27015; $s_port <= 29999; $s_port++) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
								$vrati_inf = 'Da';
			} else {
			    	$port_for_csgo = $s_port;
					break;
			}
		}
		for($s_port = 22003; $s_port <= 24000; $s_port++) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
								$vrati_inf = 'Da';
			} else {
			    	$port_for_mta = $s_port;
					break;
			}
		}
		for($s_port = 27015; $s_port <= 29999; $s_port++) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
								$vrati_inf = 'Da';
			} else {
			    	$port_for_ark = $s_port;
					break;
			}
		}
		for($s_port = 30120; $s_port <= 33120; $s_port++) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `box_id` = ? AND `port` = ? LIMIT 1");
			$SQLSEC->Execute(array($Box_ID, $s_port));
			if($SQLSEC->rowCount() == 0) {
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
										
										<?php 
										$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` ORDER by klijentid ASC");
										$SQLSEC->Execute();
										while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
											<?php 
												if(txt($row['klijentid']) == $User_ID) {
													$get_u_link = 'selected="selected"';
												} else {
													$get_u_link = '';
												}
											?>
											<option <?php echo $get_u_link; ?> value="<?php echo txt($row['klijentid']); ?>">
												<?php echo user_full_name($row['klijentid']); ?>
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
											<?php 
										$SQLSEC = $rootsec->prepare("SELECT * FROM `box` ORDER by boxid ASC");
										$SQLSEC->Execute();
										while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<?php 
													if(txt($row['boxid']) == $Box_ID) {
														$get_b_link = 'selected="selected"';
													} else {
														$get_b_link = '';
													}
												?>
												<option <?php echo $get_b_link; ?> value="<?php echo txt($row['boxid']); ?>">
													<?php echo txt($row['name'].' - '.$row['ip']); ?>
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
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(1));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>
										</select>

										<select name="mod" id="samp_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(2));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>

										<select name="mod" id="mc_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(3));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										
										<select name="mod" id="cod2_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(4));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
                                        <select name="mod" id="cod4_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(5));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="csgo_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(7));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="mta_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(8));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>		
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="ark_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(9));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
										<select name="mod" id="fivem_mod" style="display: none;">
											<option value="0" disabled selected="selected">Izaberite mod</option>
											<?php 
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array(11));
											while($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
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

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/footer.php'); ?>

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
