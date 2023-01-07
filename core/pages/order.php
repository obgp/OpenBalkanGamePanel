<?php 

$rootsec = rootsec();

$game_ = array();
$location_ = array();
$slot_ = array();
$ram_ = array();
$cpu_ = array();

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

if (isset($_GET['naruci'])) {

} else {
	if (billing_num() == 0) {
		redirect_to('order?naruci');
		die();
	}
}

if(isset($_GET['game'])) {
	$Game_ID 	= txt($_GET['game']);
} else {
	$Game_ID 	= '';
}


$SQLSEC = $rootsec->prepare("SELECT * FROM `games`");
$SQLSEC->Execute();

while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
$game_[$row["id"]] = $row["gamename"];
}

$SQLSEC = $rootsec->prepare("SELECT * FROM `locations`");
$SQLSEC->Execute();

while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
$location_[$row["id"]] = array($row["country"], $row["premium"], money_num($row["premium"], $row["countryshort"]));
}

$SQLSEC = $rootsec->prepare("SELECT * FROM `games` WHERE `id` = ? ");
$SQLSEC->Execute(array($Game_ID));
$gameinfo = $SQLSEC->fetch(PDO::FETCH_ASSOC);

if($gameinfo["maxslots"]!=0) {
	if($gameinfo["maxslots"]>100)
	{
		$i=1;
		while($i<=($gameinfo["maxslots"]/25))
		{
			$slot_[$i*25] = $i*25; 
			$i++;
		}

	} else {
		$i=2;
		while($i<=($gameinfo["maxslots"]/2))
		{
			$slot_[$i*2] = $i*2; 
			$i++;
		}
	}
}

if($gameinfo["maxramgb"]!=0) {

}

if($gameinfo["maxcore"]!=0) {
}

if (!isset($_GET['game'])) {

}

?>
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

	                       	<form action="order" method="GET" autocomplete="off" id="naruci">
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
											<option value="<?php echo $loc_key; ?>"><?php echo $loc_val[0]; ?> <?php  if($loc_val[1]==1) { ?> (Premium) <?php } ?></option>
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
								
								<div class="space" style="margin-top:10px;"></div>

								<button class="pull-right btn btn-primary" type="submit"> 
									<i class="fa fa-cart-plus"></i> Naruci server
								</button>					
							</form>
	
							<?php } else if (isset($_GET['zahtev_za_dizanje'])) {
								redirect_to('billing');
								die();
							} else { ?>
	                        	<h2>IZABERITE</h2>
	                        	<h3 style="font-size: 12px;">
		                            Već imate naručen server, ukoliko želite da platite i podignete taj server idite na Zahtev za dizanje.
		                            <br />
		                            Ukoliko želite da naručite još jedan server idite na Naruči server.
		                        </h3>
	                        	

		                        <div class="space" style="margin-top: 50px;"></div>

								<button onclick="location.href='order?naruci';" class="btn btn-info btn-large btn-block" style="width: 49%; display:inline;"><i class="fa fa-gamepad"></i> Naruči server</button>
								<button onclick="location.href='billing';" class="btn btn-success btn-large btn-block" style="width: 48%; margin-left: 20px; margin-top: 0px; display:inline;"><i class="fa fa-credit-card"></i> Zahtev za dizanje</button>			
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
			var pricing = [
			<?php
			$SQLSEC = $rootsec->prepare("SELECT * FROM `games`");
			$SQLSEC->Execute();
			while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
			{
				"id": "<?php echo $row["id"];?>",
				"name": "<?php echo $row["gamename"];?>",
				"slot": <?php echo $row["priceperslot"];?>,
				"ram": <?php echo $row["priceperram"];?>,
				"cpu": <?php echo $row["pricepercore"];?>
			},
			<?php } ?> 
			];
			var locationpricing = [
			<?php
			$SQLSEC = $rootsec->prepare("SELECT * FROM `locations`");
			$SQLSEC->Execute();
			while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
			?>
			{
				"id": "<?php echo $row["id"];?>",
				"country": "<?php echo $row["country"];?>",
				"premium": "<?php echo $row["premium"];?>",
				"price": <?php echo $row["premiumprice"];?>
			},
			<?php } ?>
			];

			<?php
			$SQLSEC = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
			$SQLSEC->Execute(array(my_contry($_SESSION['user_login'])));
			$konv = $SQLSEC->fetch(PDO::FETCH_ASSOC);
			if(!$konv) {
			$SQLSEC = $rootsec->prepare("SELECT * FROM `billing_currency` WHERE `countryshort` = ?");
			$SQLSEC->Execute(array("other"));
			$konv = $SQLSEC->fetch(PDO::FETCH_ASSOC);
			}
			?>
			var conversion = [{
			"multiply": <?php echo $konv["multiply"];?>,
			"sign": "<?php echo $konv["currencysign"];?>"	
			}];

			var slot 	= $('option:selected', '#slot').val();
			var Izdvajanje 	= $('#lokacija').val();
			var game = pricing.find(obj => obj.id === $('option:selected', '#game').val());
			var cena_valuta_zemlja = 0;

			if(game.slot!=0) {
			var CenaSlota = game.slot;
			var Cena = slot;
			Cena *= CenaSlota;
			Cena = Cena.toFixed(2);
			cena_valuta_zemlja = cena_valuta_zemlja + Cena;
			}
			if(game.ram!=0) {
			var CenaSlota = game.ram;
			var Cena = slot;
			Cena *= CenaSlota;
			Cena = Cena.toFixed(2);
			cena_valuta_zemlja = cena_valuta_zemlja + Cena;
			}
			if(game.cpu!=0) {
			var CenaSlota = game.cpu;
			var Cena = slot;
			Cena *= CenaSlota;
			Cena = Cena.toFixed(2);
			cena_valuta_zemlja = cena_valuta_zemlja + Cena;
			}

			if (Izdvajanje == '') {
				cena_valuta_zemlja = 'Izaberite lokaciju';
			} else {
				var lokacija = locationpricing.find(obj => obj.id === Izdvajanje);
				if(lokacija.premium==1) {
					cena_valuta_zemlja = cena_valuta_zemlja + lokacija.price;
				}
				if(!(slot > 0)) {
					cena_valuta_zemlja = 'Izaberite broj slotova';
				} else {
					$('#info_poruka').show(300);
				}
			}
			cena_valuta_zemlja = cena_valuta_zemlja*conversion[0].multiply;
			$('#cena').html(cena_valuta_zemlja);
			$('#cena_input').val(cena_valuta_zemlja);	
		}
	</script>

	    <div class="space" style="margin-top: 40px;"></div>

	<!-- end containerr -->
	</div>
    