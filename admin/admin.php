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
			<!-- #1 -->
			<div class="container">
				<div class="row">
					<div class="adm_opcije_client right">
						<li>
							<form action="/admin/process.php?a=poke_admin" method="POST">
								<input type="text" name="admin_id" value="<?php echo $Admin_ID; ?>" style="display:none;">
								<button class="btn btn-info">
									<span class="fa fa-send"></span> POKE
								</button>
							</form>
						</li>
						<li>
							<?php if (ban_user($Admin_ID) == 0) { ?>
								<form action="/admin/process.php?a=banuj_admina" method="POST">
									<input type="text" name="admin_id" value="<?php echo $Admin_ID; ?>" style="display:none;">
									<button class="btn btn-warning">
										<span class="icon-lock"></span> BANUJ ADMINA
									</button>
								</form>
							<?php } else { ?>
								<form action="/admin/process.php?a=un_banuj_admina" method="POST">
									<input type="text" name="admin_id" value="<?php echo $Admin_ID; ?>" style="display:none;">
									<button class="btn btn-success">
										<span class="icon-unlock"></span> UN-BANUJ ADMINA
									</button>
								</form>
							<?php } ?>
						</li>
						<li>
							<button class="btn btn-danger" href="#jesi_siguran" role="button" class="btn" data-toggle="modal">
								<span class="icon-remove"></span> OBRISI ADMINA
							</button>
						</li>
					</div>
				</div>
			</div>

			<!-- #2 -->
			<div class="container">	
				<div class="row">
					<div class="span6">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="fa fa-user" style="margin-left:15px;"></i>
								<h3>Pregled admin profila</h3>
							</div> <!-- /widget-header -->

							<div class="widget-content">	
								<table id="pregledprofilat">
									<tbody>
										<tr>
											<th width="165px"></th>
											<th></th>
										</tr>
										<tr>
											<td>
												<div id="pavatar">
													<?php echo admin_rank_avatar_a($Admin_ID); ?>
												</div>	
											</td>
											<td>
												<p>Ime i prezime: 
													<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
														<?php echo my_name($Admin_ID); ?>
													</a>
												</p>

												<p>Username: 
													<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
														<?php echo admin_user_name($Admin_ID); ?>
													</a>
												</p>

												<p>E-mail: 
													<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
														<?php echo admin_email($Admin_ID); ?>
													</a>
												</p>

												<p>Rank: <?php echo admin_rank($Admin_ID); ?> </p>

												<p>Status: <?php echo get_status(admin_lastactivity($Admin_ID)); ?></p>
											</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->
					</div> <!-- /span12 -->     

					<div class="span6">
						<div class="widget stacked">
							<div class="widget-header">
								<i class="fa fa-pie-chart" style="margin-left:10px;"></i>
								<h3>Statistika</h3>
							</div> <!-- /widget-header -->

							<div class="widget-content" id="pregledprofil">	
								<p>Broj odgovora u tiketima:
									<?php echo admin_t_odogovori($Admin_ID); ?>
								</p>

								<p>Broj dignutih servera:
									<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
										<?php echo my_name($Admin_ID); ?>
									</a>
								</p>

								<p>Online: <?php echo get_status(admin_lastactivity($Admin_ID)); ?></p>

								<p>Rank: <?php echo admin_rank($Admin_ID); ?></p>

								<!--<button style="margin-top: 5px;" type="submit" class="btn btn-warning btn" data-toggle="modal" data-target="#admin_edit">
									<i class="icon-wrench" style="line-height: 19px;"></i> Podešavanje profila
								</button>-->
								<button style="margin-top: 5px;" type="submit" class="btn btn-warning btn" onclick="location = './admin_edit.php?id=<?php echo $Admin_ID; ?>'">
									<i class="icon-wrench" style="line-height: 19px;"></i> Podešavanje profila
								</button>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->					
					</div> <!-- /span6 -->   

					<div class="span12">
						<!--<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-check"></i>
								<h3>Komentari</h3>
							</div>

							<div class="widget-content">
								<div id="akomentari">
									<h5>
										<m>ODGOVOR: </m>
									</h5>

									<form action="/admin/process.php?a=add_komentar" method="POST" autocomplete="off">
										<input type="text" name="admin_id" value="<?php echo $Admin_ID; ?>" style="display:none;">
										<textarea name="add_comm" style="width:99%;height:80px;"></textarea>
										<button class="btn btn-primary right" style="margin:5px;">
											<i class="fa fa-send"></i> Pošalji
										</button>
									</form>		

									<div class="space clear"></div>

									<hr />

									<li style="padding: 20px;"><m>Trenutno nema komentara.</m></li>
								</div>
							</div>
						</div>-->

						<div class="widget stacked widget-table action-table">
							<div class="widget-header">
								<i class="icon-th-list"></i>
								<h3>Logovi</h3>
							</div> <!-- /widget-header -->

							<div class="widget-content">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="45px" class="tip header">ID</th>
											<th class="header">Poruka</th>
											<th class="header">Admin</th>
											<th class="header">IP</th>
											<th class="header">Vreme</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$SQLSEC = $rootsec->prepare("SELECT * FROM `logovi` WHERE `adminid` = ? ORDER by id DESC");
											$SQLSEC->Execute(array($Admin_ID));
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Log_ID 			= txt($row['id']);
												$Admin_Log 			= a_log_v(txt($row['message']));
											?>
												<tr>
													<td>#<?php echo $Log_ID; ?></td>
													<td><?php echo $Admin_Log; ?></td>
													<td>
														<a href="/admin/admin.php?id=<?php echo txt($row['adminid']); ?>">
															<?php echo my_name(txt($row['adminid'])); ?>		
														</a>
													</td>
													<td><?php echo txt($row['ip']); ?></td>
													<td><?php echo txt($row['vreme']); ?></td>
												</tr>
										<?php } ?>	
									</tbody>
								</table>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->	
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="extra">
		<div class="extra-inner">
			<div class="container">
				<div class="row">
					<div class="span12">
						<center>
							<img src="<?php echo logolink(); ?>" alt="<?php echo site_name(); ?>">
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<div class="row">
					<div class="span12"> &copy; <?php echo date('Y').' '.site_name(); ?>. Sva prava zadrzana. </div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>

	<!-- ovo je popup :D -->
	<div id="admin_edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">Admin edit</h4>
		</div>

		<div class="modal-footer">
			<p class="left">
				<strong>Izmenite informacije ovog radnika!</strong>
			</p>

			<br />

			<form action="/admin/process.php?a=edit_addmin" method="POST" id="forma_popup" class="left">
				<input type="hidden" name="admin_id" value="<?php echo txt($Admin_ID); ?>">
	            
				<div class="space clear"></div>

				<div class="control-group left">											
					<label class="control-label left" for="username" style="color:#fff;">Username: </label>
					<div class="controls">
						<input style="width:530px;" type="text" name="username" class="span6" id="username" value="<?php echo a_username($Admin_ID); ?>" required="">
					</div>				
				</div>

				<div class="control-group left">											
					<label class="control-label left" for="ime" style="color:#fff;">Ime i prezime: </label>
					<div class="controls">
						<input style="width:530px;" type="text" name="ime" class="span6" id="ime" value="<?php echo admin_full_name($Admin_ID); ?>" required="">
					</div>				
				</div>

				<div class="control-group left">											
					<label class="control-label left" for="email" style="color:#fff;">Email: </label>
					<div class="controls">
						<input style="width:530px;" type="email" name="email" class="span6" id="email" value="<?php echo admin_email($Admin_ID); ?>" required="">
					</div>				
				</div>

				<div class="control-group left">											
					<label class="control-label left" for="sifra" style="color:#fff;">Password: </label>
					<div class="controls">
						<input style="width:530px;" type="password" name="sifra" class="span6" id="sifra" placeholder="Ukoliko ne zelite menjati pw ostavite prazno!">
					</div>				
				</div>

	            <div class="space clear"></div>

				<button class="left btn btn-success">
					<i class="fa fa-save"></i> Sacuvaj
				</button>
			</form>
		</div>
	</div>

</body>
</html>
