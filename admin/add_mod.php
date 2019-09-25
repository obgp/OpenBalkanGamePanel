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
							DODAJTE NOVI MOD
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>DODAJTE NOVI MOD</h3>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=add_mod" method="POST" id="edit-profile" class="form-horizontal" autocomplete="off">
									<!-- PRVI RED -->
									<div class="span6" style="margin-left: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="ime">Ime moda: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="opis">Opis moda: </label>
											<div class="controls">
												<textarea name="opis" id="opis" style="width:350px;height:50px;" placeholder="Opisite ovaj mod." required=""></textarea>
											</div>		
										</div>

										<br />

										<div class="control-group" style="position: absolute;">										
											<p>Cene su automatski podesene!</p>	
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
													<option value="3">Minecraft</option>
													<option value="4">Call of Duty 2</option>
													<option value="5">Call of Duty 4</option>
													<option value="6" disabled>TeamSpeak 3</option>
													<option value="7">Counter-Strike GO</option>
													<option value="11">FiveM</option>
												</select>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="link">Link: </label>
											<div class="controls">
												<input type="text" name="link" class="span4" id="link" value="" required="">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="def_mapa">Default mapa: </label>
											<div class="controls">
												<input type="text" name="def_mapa" class="span4" id="def_mapa" required="">
											</div>		
										</div>

										<br /><br /><br />

										<button class="btn btn-warning" style="float: right;margin-right: 33px;"><span class="icon-check"></span> DODAJ MOD</button>
									</div>
								</form>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php'); ?>

	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>

</body>
</html>
