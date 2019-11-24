<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');

$Admin_ID	= txt($_GET['id']);
if (is_valid_admin($Admin_ID) == false) {
	sMSG('Ovaj admin ne postoji!', 'error');
	redirect_to('home');
	die();
}

if (!($_SESSION['admin_login'] == $Admin_ID)) {
	if (view_admin(a_status($_SESSION['admin_login'])) == false) {
		sMSG('Samo Admin ima pristup!', 'error');
		redirect_to('home');
		die();
	}
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
							Izmenite informacije radnika
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>Izmenite informacije radnika</h3>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=edit_admin" method="POST" id="edit-profile" class="form-horizontal" autocomplete="off">
									<!-- PRVI RED -->
									<input type="text" name="admin_id" value="<?php echo $Admin_ID; ?>" style="display:none;">

									<div class="span6" style="margin-left: 0;width: 553px;">
										<div class="control-group">											
											<label class="control-label" for="username">Username: </label>
											<div class="controls">
												<input type="text" name="username" class="span6" id="username" value="<?php echo a_username($Admin_ID); ?>" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="sifra">Password: </label>
											<div class="controls">
												<input type="password" name="sifra" class="span6" id="sifra" placeholder="Ukoliko ne zelite menjati pw ostavite prazno!">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="ime">Ime i prezime: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="<?php echo admin_full_name($Admin_ID); ?>" required="">
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
												<input type="email" name="email" class="span6" id="email" value="<?php echo admin_email($Admin_ID); ?>" required="">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="radnik">Radnik: </label>
											<div class="controls">
												<input id="select_rank" type="text" name="drzava_sel" value="<?php echo radnik_id_code($Admin_ID); ?>" style="display: none;">
												<select class="span4" id="radnik" name="radnik" required="">
													<option value="" id="other">Izaberi</option>
													<option value="1" id="helper">Helper</option>
													<option value="2" id="support">Support</option>
													<option value="3" id="admin">Administrator</option>
													<option value="4" id="developer">Developer</option>
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
											<i class="fa fa-save"></i> Sacuvaj
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
	<script type="text/javascript">
		var cnt_selected = $('#select_rank').val();
		if(cnt_selected == '1') {
			$('#helper').attr("selected","selected");			
		} else if(cnt_selected == '2') {
			$('#support').attr("selected","selected");
		} else if(cnt_selected == '3') {
			$('#admin').attr("selected","selected");
		} else if(cnt_selected == '4') {
			$('#developer').attr("selected","selected");
		} else {
			$('#other').attr("selected","selected");
		}
	</script>

</body>
</html>
