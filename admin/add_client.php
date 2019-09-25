<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');



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
							KREIRAJTE NOVI NALOG
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>KREIRAJTE NOVI NALOG</h3>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=add_client" method="POST" id="edit-profile" class="form-horizontal" autocomplete="off">
									<!-- PRVI RED -->
									<div class="span6" style="margin-left: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="username">Username: </label>
											<div class="controls">
												<input type="text" name="username" class="span6" id="username" value="" required="">
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
											<label class="control-label" for="email">Email: </label>
											<div class="controls">
												<input type="text" name="email" class="span4" id="email" value="" required="">
											</div>		
										</div>
									</div>

									<!-- DRUGI RED -->
									<div class="span6" style="margin-right: 0;width: 553px;">
										
										<div class="control-group">											
											<label class="control-label" for="drzava">Drzava: </label>
											<div class="controls">
												<select class="span4" id="drzava" name="drzava" required="">
													<option value="RS">Srbija</option>
													<option value="HR">Hrvatska</option>
													<option value="BA">Bosna i Hercegovina</option>
													<option value="MK">Makedonija</option>
													<option value="ME">Montenegro</option>
													<option value="other">No Balkan</option>
												</select>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="password">Sifra: </label>
											<div class="controls">
												<input type="text" name="sifra" class="span4" id="password" value="<?php echo random_s_key(8); ?>" required="">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="pin">Pin kod: </label>
											<div class="controls">
												<input type="text" name="pin_code" class="span4" id="pin" value="<?php echo random_n_key(5); ?>" maxlength="5" required="">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="token">TOKEN: </label>
											<div class="controls">
												<input type="text" name="token" class="span4" id="token" value="<?php echo md5('token_'.time()); ?>" maxlength="5" required="">
											</div>		
										</div>

										<br /><br />

										<button class="btn btn-warning" style="float: right;margin-right: 33px;"><span class="icon-save"></span> NAPRAVI NALOG</button>
									</div>
								</form>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>

<?php	include_once($_SERVER['DOCUMENT_ROOT'].'/admin/footer.php'); ?>


	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>

</body>
</html>
