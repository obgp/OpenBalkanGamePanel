<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

if (isset($_GET['naruci'])) {

} else {
	if (billing_num() == 0) {
		redirect_to('order.php?naruci');
		die();
	}
}

if(isset($_GET['game'])) {
	$Game_ID 	= txt($_GET['game']);
} else {
	$Game_ID 	= '';
}

$game_ = array(
	'1' => 'Counter-Strike 1.6',
	'2' => 'San Andreas Multiplayer',
	'3' => 'Minecraft',
	/*'4' => 'Call of Duty 2',*/
	/*'5' => 'Call of Duty 4',*/
	'6' => 'TeamSpeak 3',
	/*'7' => 'Counter-Strike GO',*/
	/*'8' => 'Multi Theft Auto',*/
	/*'9' => 'ARK',*/
);

if (isset($_GET['game'])) {
	if(!in_array($_GET['game'], array('1','2','3','6'))) {
		sMSG('Duboko se izvinjavamo, ovu igru trenutno nemamo u ponudi! Cim budemo dobili javicemo vam.', 'error');
		redirect_to('home');
		die();
	}
}

$location_ = array(
	'lite1' => 'Nemacka (Lite)',
	'lite2' => 'Francuska (Lite)',
	/*'premium1' => 'Srbija (Premium)',*/
	/*'premium2' => 'BiH (Premium)',*/
	/*'premium3' => 'Hrvatska (Premium)',*/
);

if (!isset($_GET['game'])) {
	$slot_ = array(
		'' => 'Odaberite prvo igru',
	);
} else if ($Game_ID == 1) {
	$slot_ = array(
		'12' => '12',
		'15' => '15',
		'18' => '18',
		'20' => '20',
		'22' => '22',
		'24' => '24',
		'26' => '26',
		'28' => '28',
		'30' => '30',
		'32' => '32',
	);
} else if ($Game_ID == 2) {
	$slot_ = array(
		'50' => '50',
		'100' => '100',
		'150' => '150',
		'200' => '200',
		'250' => '250',
		'300' => '300',
		'350' => '350',
		'400' => '400',
		'450' => '450',
		'500' => '500',
	);
} else if ($Game_ID == 3) {
	$slot_ = array(
		'30' => '30',
		'35' => '35',
		'40' => '40',
		'50' => '50',
		'60' => '60',
		'70' => '70',
		'75' => '75',
		'80' => '80',
		'85' => '85',
		'120' => '120',
		'160' => '160',
	);
} else if ($Game_ID == 4) {
	$slot_ = array(
		'0' => '0',
	);
} else if ($Game_ID == 5) {
	$slot_ = array(
		'0' => '0',
	);
} else if ($Game_ID == 6) {
	$slot_ = array(
		'50' => '50',
		'100' => '100',
		'150' => '150',
		'200' => '200',
		'250' => '250',
		'300' => '300',
		'350' => '350',
		'400' => '400',
		'450' => '450',
		'500' => '500',
	);
} else if ($Game_ID == 7) {
	$slot_ = array(
		'12' => '12',
		'14' => '14',
		'16' => '16',
		'18' => '18',
		'20' => '20',
		'22' => '22',
		'24' => '24',
		'26' => '26',
		'28' => '28',
		'30' => '30',
		'32' => '32',
		'34' => '34',
		'36' => '36',
		'38' => '38',
		'40' => '40',
		'42' => '42',
		'44' => '44',
		'46' => '46',
		'48' => '48',
		'50' => '50',
		'52' => '52',
		'54' => '54',
		'56' => '56',
		'58' => '58',
		'60' => '60',
		'62' => '62',
		'64' => '64',
	);
} else if ($Game_ID == 8) {
	$slot_ = array(
		'0' => '0',
	);
} else if ($Game_ID == 9) {
	$slot_ = array(
		'0' => '0',
	);
}

?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
		<div class="container">
			<div class="rows">
				<div class="contect">
					<div class="space1"></div>
					<div class="col-md-12">
	        <div style="color:white;" id="server_info_infor">    
	            <div id="server_info_infor">
	                <div id="server_info_infor2">
	                    <div class="space" style="margin-top: 20px;"></div>
	                    <div class="gp-home">
	                    	<?php if (isset($_GET['naruci'])) { ?>

                        	<h2>NARUCITE SERVER</h2>
                        	<h3 style="font-size: 12px;">
	                            Ovde možete naruciti vas server. 
	                            <br/>(<a href="" title="Zanima me">DETALJNIJE</a>)
	                        </h3>
                        	

	                        <div class="space" style="margin-top: 60px;"></div> 

	                       	<!-- NARUCI SERVER -->

	                       	<form action="order.php" method="GET" autocomplete="off" id="naruci">
	                       		<input type="hidden" name="naruci" value="naruci">
								<div class="add_server_by_client_box">
									<label>Izaberite igru: </label>
									<select class="form-control" name="game" id="game" onchange="this.form.submit()">
										<option value="0" disabled selected="selected">Izaberi</option>
										<?php foreach ($game_ as $game_key => $game_val) { ?>
											<?php 
											if(txt($Game_ID) == $game_key) {
												$get_s_game = 'selected="selected"';
											} else {
												$get_s_game = '';
											} ?>
											<option <?php echo $get_s_game; ?> value="<?php echo $game_key; ?>"><?php echo $game_val; ?></option>
										<?php } ?>
									</select>
								</div>									
							</form>

							<form action="/process.php?a=naruci_server" method="POST" autocomplete="off">
								<input type="hidden" name="naruci" value="naruci">
								<input type="hidden" name="game_id" value="<?php echo $Game_ID; ?>">

								<div class="add_server_by_client">
									<label for="klijent">Lokacija: </label>
									<select class="form-control" name="lokacija" id="lokacija" onchange="set_money()">
										<option value="" disabled selected="selected">Izaberi</option>
										<?php foreach ($location_ as $loc_key => $loc_val) { ?>
											<option value="<?php echo $loc_key; ?>"><?php echo $loc_val; ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="add_server_by_client">
									<label for="klijent">Slotovi: </label>
									<select class="form-control" name="slotovi" id="slot" onchange="set_money()">
										<option value="" disabled selected="selected">Izaberi</option>
										<?php foreach ($slot_ as $slot_key => $slot_val) { ?>
											<option value="<?php echo $slot_key; ?>"><?php echo $slot_val; ?></option>
										<?php } ?>
									</select>
								</div>								

								<div class="add_server_by_client">
									<label for="mesec">Meseci: </label>
									<select class="form-control" name="mesec" id="mesec">
										<option value="" disabled selected="selected">Izaberi</option>
										<option value="1">1 mesec</option>
									</select>
								</div>

								<div class="add_server_by_client">
									<label for="klijent">Ime servera: </label>
									<input class="form-control" name="name" type="text" placeholder="Ime servera" required="">
								</div>														
							
								<div class="add_server_by_client">
									<label for="klijent">Mod: </label>

									<?php if (!isset($_GET['game'])) { ?>
										<select class="form-control" name="mod" id="cs_def">
											<option value="" disabled selected="selected">Igra nije odabrana</option>
										</select>
									<?php } else if ($Game_ID == 1) { ?>
										<select class="form-control" name="mod" id="cs_mod">
											<option value="" disabled selected="selected">Izaberite mod</option>
											<?php
											$rootsec = rootsec();

											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array($Game_ID));

											while ($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_cs_mod['id']); ?>">
													<?php echo txt($row_cs_mod['ime']); ?>
												</option>
											<?php } ?>
										</select>
									<?php } else if ($Game_ID == 2) { ?>
										<select class="form-control" name="mod" id="samp_mod">
											<option value="" disabled selected="selected">Izaberite mod</option>
											<?php
											$rootsec = rootsec();

											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array($Game_ID));

											while ($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_samp_mod['id']); ?>">
													<?php echo txt($row_samp_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
									<?php } else if ($Game_ID == 3) { ?>
										<select class="form-control" name="mod" id="mc_mod">
											<option value="" disabled selected="selected">Izaberite mod</option>
											<?php
											$rootsec = rootsec();

											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
											$SQLSEC->Execute(array($Game_ID));

											while ($row_cs_mod = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
												<option value="<?php echo txt($row_mc_mod['id']); ?>">
													<?php echo txt($row_mc_mod['ime']); ?>
												</option>
											<?php } ?>	
										</select>
									<?php } else if ($Game_ID == 6) { ?>
										<select class="form-control" name="mod" id="ts_mod">
											<option value="0" disabled selected="selected">Default</option>
										</select>
									<?php } ?>
								</div>

								<div class="add_server_by_client">
									<label for="klijent">Cena: </label>
									<input type="hidden" name="cena" id="cena_input" value="">
									<span class="plava_color">
										<strong class="cena_pord" id="cena">0</strong> 
										<?php echo drzava_valuta(my_contry($_SESSION['user_login'])); ?>
									</span>
								</div>

								<div class="add_server_by_client" id="info_poruka" style="display:none;">
									<label for="klijent" style="color:red;">INFO: </label>
									<i style="color:#fff;">Trenutno je cena ispisana u <i style="color:red;">eure - &euro;</i>, U <a href="/gp-billing.php">billing</a> cena ce se ispisati u vasoj valuti.</i>
								</div>								
								
								<div class="space" style="margin-top:10px;"></div>

								<button class="pull-right btn btn-primary" type="submit"> 
									<i class="fa fa-cart-plus"></i> Naruci server
								</button>					
							</form>
	
							<?php } else if (isset($_GET['zahtev_za_dizanje'])) {
								redirect_to('gp-billing.php');
								die();
							} else { ?>
	                        	<h2>IZABERITE</h2>
	                        	<h3 style="font-size: 12px;">
		                            Već imate naručen server, ukoliko želite da platite i podignete taj server idite na Zahtev za dizanje.
		                            <br />
		                            Ukoliko želite da naručite još jedan server idite na Naruči server.
		                        </h3>
	                        	

		                        <div class="space" style="margin-top: 50px;"></div>

								<button onclick="location.href='order.php?naruci';" class="btn btn-info btn-large btn-block" style="width: 49%; display:inline;"><i class="fa fa-gamepad"></i> Naruči server</button>
								<button onclick="location.href='gp-billing.php';" class="btn btn-success btn-large btn-block" style="width: 48%; margin-left: 20px; margin-top: 0px; display:inline;"><i class="fa fa-credit-card"></i> Zahtev za dizanje</button>			
							</div>

							<?php } ?>

							<div class="space clear"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
<script>
		function set_money() {
			var slot 		= $('option:selected', '#slot').val();
			var Izdvajanje 	= $('#lokacija').val();
			var game_id_ 	= $('option:selected', '#game').val();
			
			if(Izdvajanje == 'lite1'||Izdvajanje == 'lite2'||Izdvajanje == 'lite3') {
				if (game_id_ == 1) {
					//cs 1.6
					cn_sl = '0.375'; //Lite
				} else if (game_id_ == 2) {
					//samp
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 3) {
					//mc
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 4) {
					//cod2
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 5) {
					//cod4
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 6) {
					//ts3
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 7) {
					//cs:go
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 8) {
					//mta
					cn_sl = '0.09'; //Lite
				} else if (game_id_ == 9) {
					//ark
					cn_sl = '0.09'; //Lite
				}

				var Izdvajanjep = cn_sl;
			} else if(Izdvajanje == 'premium1'||Izdvajanje == 'premium2'||Izdvajanje == 'premium3') {
				if (game_id_ == 1) {
					//cs 1.6
					cn_sl = '0.50'; //Premium
				} else if (game_id_ == 2) {
					//samp
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 3) {
					//mc
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 4) {
					//cod2
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 5) {
					//cod4
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 6) {
					//ts3
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 7) {
					//cs:go
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 8) {
					//mta
					cn_sl = '0.09'; //Premium
				} else if (game_id_ == 9) {
					//ark
					cn_sl = '0.09'; //Premium
				}

				var Izdvajanjep = cn_sl;
			} else {
				Izdvajanje = 0;
			}

			var CenaSlota = Izdvajanjep;
			var Cena = slot;
			Cena *= CenaSlota;
			Cena = Cena.toFixed(2);
			var cena_valuta_zemlja = Cena;

			if (Izdvajanje == '') {
				cena_valuta_zemlja = 'Izaberite lokaciju';
			} else {
				if(!(slot > 0)) {
					cena_valuta_zemlja = 'Izaberite broj slotova';
				} else {
					$('#info_poruka').show(300);
				}
			}

			$('#cena').html(cena_valuta_zemlja);
			$('#cena_input').val(cena_valuta_zemlja);	
		}
	</script>

	    <div class="space" style="margin-top: 40px;"></div>

	<!-- end containerr -->
	</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
    