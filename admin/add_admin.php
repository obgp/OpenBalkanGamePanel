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
							DODAJTE NOVOG RADNIKA
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>DODAJTE NOVOG RADNIKA</h3>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=add_admin" method="POST" id="edit-profile" class="form-horizontal" autocomplete="off">
									<!-- PRVI RED -->
									<div class="span6" style="margin-left: 0;width: 553px;">
										<div class="control-group">											
											<label class="control-label" for="username">Username: </label>
											<div class="controls">
												<input type="text" name="username" class="span6" id="username" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="sifra">Password: </label>
											<div class="controls">
												<input type="password" name="sifra" class="span6" id="sifra" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="ime">Ime: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="prezime">Prezime: </label>
											<div class="controls">
												<input type="text" name="prezime" class="span6" id="prezime" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="komentar">Komentar: </label>
											<div class="controls">
												<textarea name="komentar" id="komentar" style="width:350px;height:50px;" placeholder="Ostavite neki komentar. (Ukoliko necete ostavite prazno).."></textarea>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="cvarovi">Permisije: </label>
											
											<div class="perm_adm">
												<li style="display:inline-block;padding:0 20px;">
													<input id="flag_a" name="admin_perm[]" type="checkbox" value="1"> Modovi
												</li>

												<li style="display:inline-block;padding:0 20px;">
													<input id="flag_a" name="admin_perm[]" type="checkbox" value="2"> Plugini
												</li>

												<li style="display:inline-block;padding:0 20px;">
													<input id="flag_a" name="admin_perm[]" type="checkbox" value="3"> Masine
												</li>
											</div> 
										</div>

									</div>

									<!-- DRUGI RED -->
									<div class="span6" style="margin-right: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="email">Email: </label>
											<div class="controls">
												<input type="email" name="email" class="span6" id="email" value="" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="radnik">Radnik: </label>
											<div class="controls">
												<select class="span4" id="radnik" name="radnik" required="">
													<option value="">Izaberi</option>
													<option value="1">Helper</option>
													<option value="2">Support</option>
													<option value="3">Administrator</option>
												</select>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="cvarovi">Support za: </label>
											
											<div class="perm_adm" style="margin-left:160px;position:absolute;">
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="1"> - Counter-Strike 1.6
												<br />
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="2"> - San Andreas Multiplayer
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="3"> - Minecraft
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="4"> - Call of Duty 2
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="5"> - Call of Duty 4
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="6"> - TeamSpeak 3
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="7"> - Counter-Strike GO
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="8"> - Multi Theft Auto
												<br /> 
												<input id="flag_a" name="supp_perm[]" type="checkbox" value="9"> - ARK
												<br />
											</div> 
										</div>

										<br /><br /><br />
										<br /><br /><br />
										<br /><br /><br />

										<button class="btn btn-warning" style="float: right;margin-right: 33px;">
											<span class="icon-check"></span> DODAJ ADMINA
										</button>
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
