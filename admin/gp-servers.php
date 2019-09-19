<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');

if (isset($_GET['game_id'])) {
	$Game_ID = txt($_GET['game_id']);
} else {
	$Game_ID = '';
}

if (isset($_GET['status'])) {
	$Server_Status = txt($_GET['status']);
} else {
	$Server_Status = '1';
}

if ($Game_ID == 1) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 2) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 3) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 4) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 5) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 6) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 7) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 8) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
} else if ($Game_ID == 9) {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `igra` = ? AND `status` = ? ORDER BY id ASC");
	$SQLSEC->Execute(array($Game_ID,$Server_Status));
}


?>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- LISTA SERVERA -->
					<div class="span12">
						<h1>
							<span class="fa fa-gamepad"></span>
							Serveri
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Lista servera</h3>
							</div>

							<div class="widget-content">
								<div class="span5">
									<form action="gp-servers.php" method="GET" autocomplete="off" style="margin-top:10px;">
										<div class="add_server_by_client_box">
											<label>Izaberite igru: </label>
											<select name="game_id" onchange="this.form.submit()" class="selectpicker" data-live-search="true">
												<option value="0" disabled selected="selected">Izaberite igru</option>
												<option value="1">Counter-Strike 1.6</option>
												<option value="2">San Andreas Multiplayer</option>
												<option value="3">Minecraft</option>
												<option value="4">Call of Duty 2</option>
												<option value="5">Call of Duty 4</option>
												<option value="6">TeamSpeak 3</option>
												<option value="7">Counter-Strike GO</option>
												<option value="8">Multi Theft Auto</option>
												<option value="9">ARK</option>
											</select>
										</div>									
									</form>
								</div>

								<div class="span5">
									<form action="gp-servers.php" method="GET" autocomplete="off" style="margin-left:50px;margin-top:10px;">
										<div class="add_server_by_client_box">
											<input type="text" name="game_id" value="<?php echo txt($Game_ID); ?>" style="display:none;">
											<label>Izaberite status: </label>
											<select name="status" onchange="this.form.submit()" class="selectpicker" data-live-search="true">
												<option value="0" disabled selected="selected">Izaberite status</option>
												<option value="1">Aktivan</option>
												<option value="2">Suspendovan</option>
												<option value="3">Neaktivan</option>
											</select>
										</div>									
									</form>
								</div>

								<?php if (isset($_GET['game_id'])) { ?>
									<table class="table table-striped table-bordered tabela-asd" style="border-top: 2px solid #364856!important;border-top-left-radius: 0;border-top-right-radius: 0;">
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
												<th>Napomena</th>
											</tr>
										</thead>

										<tbody>
											<?php
												require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/libs/lgsl_files/lgsl_class.php');

												while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
													$Client_ID 			= txt($row['user_id']);
													$Server_ID 			= txt($row['id']);
													$Box_ID 			= txt($row['box_id']);

													$Server_Name 		= server_name($Server_ID);
													if(strlen($Server_Name) > 25) { 
												        $Server_Name = substr($Server_Name,0,25); 
												        $Server_Name .= "..."; 
												    }

												    $Server_Slot 	= '32';
													$Server_Map 	= 'de_dust2';

													$Napomena = txt($row['napomena']);
													if ($Napomena == '') {
														$Napomena = '-//-';
													}

												?>
												<tr>
													<td>
														<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
															#<?php echo $Server_ID; ?>
														</a>
													</td>
													<td>
														<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
															<?php echo gp_game_icon($Server_ID).' '.$Server_Name; ?>
														</a>
													</td>
													<td>
														<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
															<?php echo server_full_ip($Server_ID); ?>
														</a> 
													</td>
													<td>
														<a href="/admin/gp-klijent.php?id=<?php echo $Client_ID; ?>" >
															<?php echo user_full_name($Client_ID); ?>
														</a>
													</td>
													<td><?php echo server_istice($Server_ID); ?></td>
													<td><?php echo gp_s_status($Server_ID); ?></td>
													<td><?php echo $Server_Slot; ?></td>
													<td><?php echo $Server_Map; ?></td>
													<td><?php echo $Napomena; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
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

	
</body>
</html>


