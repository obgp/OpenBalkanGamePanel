<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');

error_reporting(E_ALL);

$Client_ID	= txt($_GET['id']);
if (is_valid_user($Client_ID) == false) {
	sMSG('Ovaj klijent nalog ne postoji!', 'error');
	redirect_to('clients.php');
	die();
}

?>
	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">

					<!-- KLIJENT INFO -->
					<div class="span12">
						<h1>
							<span class="icon-user"></span>
							Nalog Informacije
						</h1>
						<hr>
					</div>
					
					<!-- INFORMACIJE KLIjenta -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-user"></i>
								<h3>
									<a href="">
										#<?php echo $Client_ID; ?> 
										~
										<?php echo user_full_name($Client_ID); ?> 
									</a>
								</h3>
								
								<div class="adm_opcije_client">
									<li>
										<button class="btn btn-info" onclick="location = './add_server.php?user_id=<?php echo $Client_ID; ?>'">
											<span class="fa fa-plus"></span> DODAJ SERVER
										</button>
									</li>

									<li>
										<?php if (ban_user($Client_ID) == 0) { ?>
											<form action="/admin/process.php?a=banuj_nalog" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-warning">
													<span class="icon-lock"></span> BANUJ KLIJENTA
												</button>
											</form>
										<?php } else { ?>
											<form action="/admin/process.php?a=un_banuj_nalog" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-success">
													<span class="icon-unlock"></span> UN-BANUJ KLIJENTA
												</button>
											</form>
										<?php } ?>
									</li>
									<li>
										<?php if (ban_ftp($Client_ID) == 0) { ?>
											<form action="/admin/process.php?a=banuj_ftp" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-warning">
													<span class="icon-lock"></span> ZABRANI FTP
												</button>
											</form>
										<?php } else { ?>
											<form action="/admin/process.php?a=un_banuj_ftp" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-success">
													<span class="icon-unlock"></span> ODOBRI FTP
												</button>
											</form>
										<?php } ?>
									</li>
									<li>
										<?php if (ban_support($Client_ID) == 0) { ?>
											<form action="/admin/process.php?a=banuj_podrsku" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-warning">
													<span class="icon-lock"></span> ZABRANI PODRSKU
												</button>
											</form>
										<?php } else { ?>
											<form action="/admin/process.php?a=un_banuj_podrsku" method="POST">
												<input type="text" name="user_id" value="<?php echo $Client_ID; ?>" style="display:none;">
												<button class="btn btn-success">
													<span class="icon-unlock"></span> ODOBRI PODRSKU
												</button>
											</form>
										<?php } ?>
									</li>
									<li>
										<button class="btn btn-danger" href="#delete_client" role="button" class="btn" data-toggle="modal">
											<span class="icon-remove"></span> OBRISI NALOG
										</button>
									</li>
								</div>
							</div>

							<div class="widget-content">
								<form action="/admin/process.php?a=change_profile" method="POST" id="edit-profile" class="form-horizontal">
									<input type="text" name="client_id" hidden="" value="<?php echo $Client_ID; ?>" style="display:none;">
									<!-- PRVI RED -->
									<div class="span6" style="margin-left: 0;width: 553px;">
										<h3><span class="icon-exclamation-sign"></span> INFO</h3>

										<div class="control-group">											
											<label class="control-label" for="ime">Ime: </label>
											<div class="controls">
												<input type="text" name="ime" class="span6" id="ime" value="<?php echo user_ime($Client_ID); ?>">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="prezime">Prezime: </label>
											<div class="controls">
												<input type="text" name="prezime" class="span6" id="prezime" value="<?php echo user_prezime($Client_ID); ?>">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="email">Email: </label>
											<div class="controls">
												<input type="text" name="email" class="span4" id="email" value="<?php echo user_email($Client_ID); ?>">
											</div>
										</div>

										<div class="control-group">											
											<label class="control-label" for="drzava">Drzava: </label>
											<div class="controls">
												<input id="select_cnt" type="text" name="drzava_sel" value="<?php echo my_contry($Client_ID); ?>" style="display: none;">
												<select class="span4" id="drzava" name="drzava" required="">
													<option value="">Izaberi drzavu</option>
													<option value="RS" id="RS">Srbija</option>
													<option value="HR" id="HR">Hrvatska</option>
													<option value="BA" id="BA">Bosna i Hercegovina</option>
													<option value="MK" id="MK">Makedonija</option>
													<option value="ME" id="ME">Montenegro</option>
													<option value="other" id="other">No Balkan</option>
												</select>
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="password">Sifra: </label>
											<div class="controls">
												<input type="password" name="password" class="span4" id="password" placeholder="Ukoliko ne zelite da menjate ostavite prazno!">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="pin">Pin kod: </label>
											<div class="controls">
												<input type="text" name="pin_code" class="span4" id="pin" value="<?php echo user_pincode($Client_ID); ?>" maxlength="5">
											</div>		
										</div>
										
										<div class="control-group">											
											<label class="control-label" for="date_">Datum dodavanja: </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="date_" value="<?php echo user_register($Client_ID); ?>">
											</div>		
										</div>

										<!--<div class="control-group">											
											<label class="control-label" for="n_dodao">Nalog dodao: </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="n_dodao" value="Dodati funkicju.">
											</div>		
										</div>-->
									</div>

									<!-- DRUGI RED -->
									<div class="span6" style="margin-right: 0;width: 553px;">
										<h3><span class="icon-cogs"></span> AKCIJA</h3>

										<div class="control-group">											
											<label class="control-label" for="ban_nalog">Nalog banovan: </label>
											<div class="controls">
												<input disabled="" type="text" class="span6" id="ban_nalog" value="<?php echo ban_select(ban_user($Client_ID)); ?>">
											</div>				
										</div>

										<div class="control-group">											
											<label class="control-label" for="ban_ftp">FTP ban: </label>
											<div class="controls">
												<input disabled="" type="text" class="span6" id="ban_ftp" value="<?php echo ban_select(ban_ftp($Client_ID)); ?>">
											</div>		
										</div>

										<div class="control-group">											
											<label class="control-label" for="support_ban">Podrška ban: </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="support_ban" value="<?php echo ban_select(ban_support($Client_ID)); ?>">
											</div>		
										</div>

										<br/><br/>

										<div class="control-group">											
											<label class="control-label" for="balans"><h3><span class="icon-asterisk"></span> BALANS</h3> </label>
											<div class="controls">
												<input disabled="" type="text" class="span4" id="balans" value="<?php echo money_val(my_money($Client_ID), my_contry($Client_ID)); ?>">
											</div>		
										</div>

										<div class="control-group">
											<div class="controls">
												<div class="klijent_popravi_btn">
													<li>
														<a class="btn btn-warning"><span class="icon-credit-card"></span> DODAJ UPLATU</a>
													</li>
													<li style="float: right;margin-right: 33px;">
														<a class="btn btn-warning"><span class="icon-minus"></span> SKINI NOVAC</a>
													</li>
												</div>
											</div>		
										</div>
										
										<br/>

										<button class="btn btn-warning" style="float: right;margin-right: 33px;"><span class="icon-save"></span> SACUVAJ</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- LISTA SERVERA KLIJENTA -->
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-th-list"></i>
								<h3>Lista servera klijenta 
									<i>( <?php echo user_full_name($Client_ID).', '.user_email($Client_ID); ?> )</i>
								</h3>
							</div>

							<div class="widget-content">
								
								<table class="table table-striped table-bordered tabela-asd">
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
										</tr>
									</thead>

									<tbody>
										<?php  
											$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `user_id` = ? ORDER BY id DESC");
											$SQLSEC->Execute(array($Client_ID));

											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) {
												$Server_ID 		= txt($row['id']);

												include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/class/class.load_server.php');
											?>
											<tr>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
														#<?php echo $Server_ID ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
														<?php echo server_name($Server_ID); ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
														<?php echo server_full_ip($Server_ID); ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-client.php?id=<?php echo txt($Client_ID); ?>">
														<?php echo user_full_name($Client_ID); ?>
													</a>
												</td>
												<td><?php echo server_istice($Server_ID); ?></td>
												<td><?php echo gp_s_status($Server_ID); ?></td>
												<td><?php echo $Server_Players; ?></td>
												<td><?php echo $Server_Map; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
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
	<script type="text/javascript">
		var cnt_selected = $('#select_cnt').val();
		if(cnt_selected == 'RS') {
			$('#RS').attr("selected","selected");			
		} else if(cnt_selected == 'HR') {
			$('#HR').attr("selected","selected");
		} else if(cnt_selected == 'BA') {
			$('#BA').attr("selected","selected");
		} else if(cnt_selected == 'MK') {
			$('#MK').attr("selected","selected");
		} else if(cnt_selected == 'ME') {
			$('#ME').attr("selected","selected");
		} else {
			$('#other').attr("selected","selected");
		}
	</script>

	<div id="delete_client" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">Obrisi klijenta</h4>
		</div>

		<div class="modal-footer">
			<form action="/admin/process.php?a=delete_client" method="POST" id="forma_popup" class="left">
				<input type="text" name="client_id" value="<?php echo $Client_ID; ?>" style="display:none;">

				<div class="space clear"></div>

				<button class="left btn btn-danger">
					<i class="icon-ok"></i> Obrisi
				</button>
			</form>
		</div>
	</div>

</body>
</html>