<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');


if (view_admin(a_status($_SESSION['admin_login'])) == false) {
	sMSG('Samo Admin ima pristup!', 'error');
	redirect_to('home');
	die();
}

?>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- Add Client -->
					<div class="span12">
						<h1>
							<span class="icon-user"></span>
							DODAJTE NOVI PLUGIN
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>DODAJTE NOVI PLUGIN</h3>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=add_plugin" method="POST" id="edit-profile" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
									<!-- PRVI RED -->
									<div class="span6" style="margin-left: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="ime">Ime plugina: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="upload">Upload AMXX file: </label>
											<div class="controls">
												<input type="file" name="fileToUpload" id="fileToUpload" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="opis">Opis plugina: </label>
											<div class="controls">
												<textarea name="opis" id="opis" style="width:350px;height:50px;" placeholder="Opisite ovaj plugin." required=""></textarea>
											</div>		
										</div>

									</div>

									<!-- DRUGI RED -->
									<div class="span6" style="margin-right: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="game_">Igra: </label>
											<div class="controls">
												<select name="game_" id="game_" required="">
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
										</div>

										<div class="control-group">											
											<label class="control-label" for="cvarovi">Unesite CVAR: </label>
											<div class="controls">
												<textarea name="cvarovi" id="cvarovi" style="width:350px;height:88px;" placeholder="Upisite cvarove ukoliko ih ima! (Ukoliko ih nema ostavite prazno).."></textarea>
											</div>		
										</div>

										<br /><br /><br />

										<button class="btn btn-warning" style="float: right;margin-right: 33px;"><span class="icon-check"></span> DODAJ PLUGIN</button>
									</div>
								</form>
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
