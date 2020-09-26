<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');


if (view_admin(a_status($_SESSION['admin_login'])) == false) {
	sMSG('Samo Admin ima pristup!', 'error');
	redirect_to('home');
	die();
}

$Box_ID = txt($_GET['id']);

if (valid_box(box_ip($Box_ID)) == false) {
	sMSG('Ova masina ne postoji!', 'error');
	redirect_to('all_box.php');
	die();
}

$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
$SQLSEC->Execute(array($Box_ID));

$Box_Info 				= $SQLSEC->fetch(PDO::FETCH_ASSOC);
$Box_Cache 				= unserialize(gzuncompress($Box_Info['cache']));

?>
	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<h3>
									<i class="fa fa-server"></i> 
									<a href="/admin/box_info.php?id=<?php echo $Server_ID; ?>">
										<?php echo box_name($Box_ID); ?>
									</a>
								</h3>
							</div>

							<div class="widget-content">
								<!-- PRVI RED -->
								<div class="span5 left" style="margin-left:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-pushpin"></i>
											<h3>Box informacije</h3>
										</div>

										<div class="widget-content">
											<p> Ime servera: <strong><?php echo box_name($Box_ID); ?></strong></p>
											<p> IP adresa: <strong><?php echo box_ip($Box_ID); ?></strong></p>
											<p> SSH2 Port: <strong><?php echo box_ssh($Box_ID); ?></strong></p>
											<p> Status: <strong><?php echo format_status(box_status($Box_ID)); ?></strong></p>
											<p> 
												Serveri: 
												<strong><?php echo box_servers($Box_ID); ?></strong>
											</p>
										</div>
									</div>
								</div>

								<div class="span5 right" style="width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-cog"></i>
											<h3>Box Informacije #2</h3>
										</div>

										<div class="widget-content">
											<p> CPU Procesor: 
												<strong>
												<?php echo $Box_Cache["{$Box_ID}"]['cpu']['proc']; ?>,
												<?php echo $Box_Cache["{$Box_ID}"]['cpu']['cores']; ?> Core
												</strong>
											</p>
											<p> RAM Total: <strong><?php echo file_size($Box_Cache["{$Box_ID}"]['ram']['total']); ?></strong></p>
											<p> HDD Total: <strong><?php echo file_size($Box_Cache["{$Box_ID}"]['hdd']['total']); ?></strong></p>
											<p> Bandwidth: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage']; ?>&nbsp;%
												</span>
											</p>
											<p> 
												Uptime: 
												<strong>
													<span class="badge badge-success">
													<?php echo $Box_Cache["{$Box_ID}"]['uptime']['uptime']; ?>
													</span>
												</strong>
											</p>
										</div>
									</div>
								</div>

								<!-- DRUGI RED -->
								<div class="span5 right" style="margin-right:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-signal"></i>
											<h3>GRAFIK</h3>
										</div>

										<div class="widget-content">
											<img id="grafik_servera" src="/admin/assets/img/grafik_servera.png" style="width: 100%;">
										</div>
									</div>
								</div>
								<div class="span5 left" style="margin-left:0;width:550px;">
									<div class="widget stacked">
										<div class="widget-header">
											<i class="icon-exclamation-sign"></i>
											<h3>Online informacije</h3>
										</div>

										<div class="widget-content">
											<p> Online: 
												<span class="badge badge-<?php if(box_status($Box_ID) == 'Online') echo 'success'; else echo 'error'; ?>"> 
												<?php echo box_status($Box_ID); ?>
												</span>
											</p>
											<p> Hostname: 
												<strong> 
												<?php echo $Box_Cache["{$Box_ID}"]['hostname']['hostname']; ?>
												</strong>
											</p>
											<p> CPU Usage: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['cpu']['usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['cpu']['usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['cpu']['usage']; ?>&nbsp;%
												</span>
											</p>
											<p> RAM Usage: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['ram']['usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['ram']['usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['ram']['usage']; ?>&nbsp;%
												</span>
											</p>
											<p> HDD Usage: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['hdd']['usage'] < 65) { echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['hdd']['usage'] < 85) { echo 'warning';
												} else { echo 'error'; } ?>">
												<?php echo $Box_Cache["{$Box_ID}"]['hdd']['usage']; ?>&nbsp;%
												</span>
											</p>
											<p> 
												Load average: 
												<span class="badge badge-<?php
												if ($Box_Cache["{$Box_ID}"]['loadavg']['loadavg'] < 6.50) {
													echo 'info';
												} else if ($Box_Cache["{$Box_ID}"]['loadavg']['loadavg'] < 8.50) {
													echo 'warning';
												} else { echo 'error'; }
												$loadavg2 = str_replace("Unknown HZ value! (28) Assume 100.
												Warning: /boot/System.map-3.10.9-xxxx-grs-ipv6-64 has an incorrect kernel version.
												", "", $Box_Cache["{$Box_ID}"]['loadavg']['loadavg']);
												$loadavg2 = str_replace("Unknown HZ value! (776) Assume 100.
												Warning: /boot/System.map-3.10.9-xxxx-grs-ipv6-64 has an incorrect kernel version.", "", $Box_Cache["{$Box_ID}"]['loadavg']['loadavg']);
												$loadavg2 = str_replace("Unknown HZ value! (28) Assume 100.
												Warning: /boot/System.map-3.10.9-xxxx-grs-ipv6-64 has an incorrect kernel version.
												", "", $Box_Cache["{$Box_ID}"]['loadavg']['loadavg']);
												?>"><?php echo $loadavg2; ?>&nbsp;%
												</span>
											</p>
										</div>
									</div>
								</div>

								<!-- TRECI RED -->
								<div class="widget stacked">
									<div class="widget-header">
										<i class="icon-pushpin"></i>
										<h3>Support akcije</h3>
									</div>

									<div class="widget-content">
										<div class="admin_server_precice">
											<li>
												<a data-toggle="modal" href="#boxRestart">
			                      					<button class="btn btn-warning">
			                      						<i class="fa fa-refresh"></i> Restart
			                      					</button>
			                      				</a>
											</li>

											<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="boxRestart" class="modal fade" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Dali ste sigurni da, zelite restartovati masinu?</h4>
														</div>

														<div class="modal-body">
															<strong>Ukoliko pristanete restartovati masinu, morate znati da ce svi serveri na ovoj masini biti offline.</strong>

															<br /> <br />
															
															<form action="/admin/process.php?a=box_restart" method="POST">
																<input type="text" name="box_id" value="<?php echo $Box_ID; ?>" hidden="" style="display:none;">
																<button class="btn btn-info">Da znam, Restartuj masinu!</button>
															</form>
														</div>

														<div class="modal-footer" style="text-align:right;">
															<button data-dismiss="modal" class="btn btn-danger" type="button">
																Cancel
															</button>
														</div>

														<div class="clear"></div>
													</div>
												</div>
											</div>

											<li>
												<a data-toggle="modal" href="#boxBackup">
			                      					<button class="btn btn-info">
			                      						<i class="fa fa-folder"></i> Backup
			                      					</button>
			                      				</a>
											</li>

											<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="boxBackup" class="modal fade" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Dali ste sigurni da, zelite napraviti backup?</h4>
														</div>

														<div class="modal-body">
															<strong>Ukoliko pristanete napraviti backup masine, morate znati da ce se stari backup obrisati!</strong>

															<br /> <br />
															
															<form action="/admin/process.php?a=box_backup" method="POST">
																<input type="text" name="box_id" value="<?php echo $Box_ID; ?>" hidden="" style="display:none;">
																<button class="btn btn-info">Da znam, napravi trenutni backup!</button>
															</form>
														</div>

														<div class="modal-footer" style="text-align:right;">
															<button data-dismiss="modal" class="btn btn-danger" type="button">
																Cancel
															</button>
														</div>

														<div class="clear"></div>
													</div>
												</div>
											</div>

											<li>
												<a data-toggle="modal" href="#boxDelete">
			                      					<button class="btn btn-danger">
			                      						<i class="fa fa-trash"></i> Delete
			                      					</button>
			                      				</a>
											</li>

											<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="boxDelete" class="modal fade" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Dali ste sigurni da, zelite obrisati ovu masinu?</h4>
														</div>

														<div class="modal-body">
															<strong>Ukoliko pristanete obrisati ovu masinu, morate znati da ce svi serveri na ovoj masini biti obrisani zajedno sa njom!</strong>

															<br /> <br />
															
															<form action="/admin/process.php?a=box_delete" method="POST">
																<input type="text" name="box_id" value="<?php echo $Box_ID; ?>" hidden="" style="display:none;">
																<button class="btn btn-info">Da znam, obrisi ovu masinu!</button>
															</form>
														</div>

														<div class="modal-footer" style="text-align:right;">
															<button data-dismiss="modal" class="btn btn-danger" type="button">
																Cancel
															</button>
														</div>

														<div class="clear"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

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


