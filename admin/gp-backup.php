<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');


$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('gp-servers.php');
	die();
}

if (cp_perm_srv_view($Server_ID) == false) {
	sMSG('Niste support za ovu igru!', 'info');
	redirect_to('gp-servers.php');
	die();
}


?>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- SERVER INFO -->
					<div class="span12">
						<div class="navbar">
							<div class="navbar-inner">
								<ul class="nav">
									<li class="nav_s_active"><a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">Server</a></li>
					                <!--<li><a href="gp-config.php?id=<?php echo $Server_ID; ?>">Podesavanje</a></li>-->
					                <?php if (gp_game_id($Server_ID) == 1) { ?>
					                    <li><a href="/admin/gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
					                    <li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-maps.php?id=<?php echo $Server_ID; ?>">Map installer</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 2) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 3) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 4) { ?>
					                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                	<li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 5) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                	<li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 6) { ?>
					                	<li><a href="/admin/ts-perm.php?id=<?php echo $Server_ID; ?>">Permission</a></li>
					                	<li><a href="/admin/ts-bans.php?id=<?php echo $Server_ID; ?>">Banovani</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 7) { ?>	
					                	<li><a href="/admin/gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
					                    <li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 8) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 9) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } ?>
					                <li><a href="" data-toggle="modal" data-target="#jesi_siguran"><i class="icon-share-alt"></i> Prebaci server</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<h3>
									<i class="fa fa-gamepad"></i>
									<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
										<?php echo server_name($Server_ID); ?>
									</a> 
									
									|

									<i class="fa fa-user"></i> 
									<a href="/admin/gp-klijent.php?id=<?php echo Srw_Owenr($Server_ID); ?>">
										<?php echo user_full_name(Srw_Owenr($Server_ID)); ?>
									</a>
								</h3>
							</div>
						</div>
					</div>
					
					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Server BackUP</h3>
							</div>
							<div class="widget-content">
								<?php if (server_is_start($Server_ID) == true) { ?>
			                    	<p style="color: red!important;">Info: <strong><i>Da biste napravili Backup, pozeljno je stopirati vas server.</i></strong></p>
			                    <?php } ?>
				                <center><form action="/admin/process.php?s=server_backup" method="POST">
				                    <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                    <button class="btn btn-success">
			                            <i class="fa fa-folder" style="font-size: 15px;"></i> Create Backup
			                        </button>
				                </form></center>
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th>Backup ID</th>
											<th>Backup Name</th>
											<th>Backup Size</th>
											<th>Backup Status</th>
											<th>Backup Action</th>
										</tr>
									</thead>

									<tbody>
										<?php  
											$BID = 1;
											$SQLSEC = $rootsec->prepare("SELECT * FROM `server_backup` WHERE `srvid` = ?");
											$SQLSEC->Execute(array($Server_ID));

											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												
												$Backup_ID		=	txt($row['id']);
												$Backup_Name	=	txt($row['name']);
												$Backup_Size	=	txt($row['size']);
												$Backup_Status	=	txt($row['status']);
												$Box_ID 		=	getBOX($Server_ID); 
												?>
												<tr>
													<td>
														#<?php echo $Backup_ID; ?>
													</td>
													<td>
														<?php echo $Backup_Name; ?>
													</td>
													<td>
														<?php
														if($Backup_Size == "0" && $Backup_Status == "0") {
															echo GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
														} else {
															echo $Backup_Size;
														}
														?>
													</td>
													<td>
														<?php
														if($Backup_Size == "0" && $Backup_Status == "0") {
															$Backup_Status = GetBackUPStatus($Box_ID, $Server_ID, $Backup_Name);
															if($Backup_Status == "Failed") {
																echo "<font color=\"#FE0300\">Failed!</font>";
															} else if($Backup_Status == "Finished") {
																echo "<font color=\"#00FF00\">Finished</font>";
															} else if($Backup_Status == "Copying") {
																echo "<font color=\"#E08010\">Copying files...</font>";
															}
														} else {
															if($Backup_Status == "Failed") {
																echo "<font color=\"#FE0300\">Failed!</font>";
															} else if($Backup_Status == "Finished") {
																echo "<font color=\"#00FF00\">Finished</font>";
															} else if($Backup_Status == "Copying") {
																echo "<font color=\"#E08010\">Copying files...</font>";
															}
														}
														?>
													</td>
													<td>
														<form action="/admin/process.php?s=server_backup_restore" method="POST">
															<input hidden type="text" name="backup_id" value="<?php echo $Backup_ID; ?>" style="display:none;">
				                                        	<input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        	<button class="btn btn-warning">
																<i class="fa fa-folder" style="font-size: 15px;"></i> Restore
			                                            	</button>
				                                    	</form>
														<form action="/admin/process.php?s=server_backup_delete" method="POST">
															<input hidden type="text" name="backup_id" value="<?php echo $Backup_ID; ?>" style="display:none;">
				                                        	<input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">
				                                        	<button class="btn btn-danger">
																<i class="fa fa-folder" style="font-size: 15px;"></i> Delete
			                                            	</button>
				                                    	</form>
													</td>
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

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/footer.php'); ?>


	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>
</body>
</html>