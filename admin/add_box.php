<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');


if (view_admin(a_status($_SESSION['admin_login'])) == false) {
	sMSG('Samo Admin ima pristup!', 'error');
	redirect_to('home');
	die();
}

$location_ = array(
	'lite1' => 'Nemacka (Lite)',
	'lite2' => 'Francuska (Lite)',
	'premium1' => 'Srbija (Premium)',
	'premium2' => 'BiH (Premium)',
	'premium3' => 'Hrvatska (Premium)',
);
?>


	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<div class="span12">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-hdd"></i>
					<h3>DODAJTE NOVU MASINU</h3>
				</div>

				<div class="widget-content">
					<h4><span class="icon-exclamation-sign"></span> Popunite sva polja</h4>
					<form action="/admin/process.php?a=add_box" method="POST" id="edit-profile" class="form-horizontal">
						<!-- PRVI RED -->
						<div class="span6" style="margin-left: 0;width: 553px;">
							
							<div class="control-group">											
								<label class="control-label" for="ip_adr">Ip masine: </label>
								<div class="controls">
									<input type="text" name="box_ip" class="span6" id="ip_adr" placeholder="192.168.1.1">
								</div>				
							</div>

							<div class="control-group">											
								<label class="control-label" for="lokacija">Lokacija: </label>
								<div class="controls">
									<select class="span5 valid" name="box_location">
										<?php foreach ($location_ as $loc_key => $loc_val) { ?>
											<option value="<?php echo $loc_key; ?>"><?php echo $loc_val; ?></option>
										<?php } ?>
									</select>
								</div>		
							</div>

							<div class="control-group">											
								<label class="control-label" for="ime_masine">Ime masine: </label>
								<div class="controls">
									<input type="text" name="box_name" class="span4" id="ime_masine" placeholder="<?php echo site_name(); ?> #1">
								</div>		
							</div>
						</div>

						<!-- DRUGI RED -->
						<div class="span6" style="margin-right: 0;width: 553px;">
							
							<div class="control-group">											
								<label class="control-label" for="ssh_port">SSH port: </label>
								<div class="controls">
									<input type="number" name="box_ssh" class="span4" id="ssh_port" value="22" placeholder="22">
								</div>		
							</div>

							<div class="control-group">											
								<label class="control-label" for="ftp_port">Root login: </label>
								<div class="controls">
									<input type="text" name="box_user" class="span4" id="ftp_port" value="root" placeholder="root">
								</div>		
							</div>

							<div class="control-group">											
								<label class="control-label" for="password">Root password: </label>
								<div class="controls">
									<input type="password" name="box_pass" class="span4" id="password" placeholder="password">
								</div>		
							</div>

							<br /><br />

							<button class="btn btn-warning" style="float: right;margin-right: 33px;">
								<span class="icon-save"></span> DODAJ MASINU
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

<?php	include_once($_SERVER['DOCUMENT_ROOT'].'/admin/footer.php'); ?>


	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>

</body>
</html>
