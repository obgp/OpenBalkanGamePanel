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
					
					<!-- LISTA MASINA -->
					<div class="span12">
						<h1>
							<span class="icon-hdd"></span>
							Masine
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Lista masina</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th>ID</th>
											<th>Ime masine</th>
											<th>Ip</th>
											<th>Serveri</th>
											<th>Net status</th>
											<th>Ram memorija</th>
											<th>CPU usage</th>
											<th>HDD</th>
											<th>Status</th>
										</tr>
									</thead>

									<tbody>
										<?php  
											$SQLSEC = $rootsec->prepare("SELECT * FROM `box` ORDER BY `boxid` DESC");
											$SQLSEC->Execute();

											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Box_ID 		= txt($row['boxid']);
												$Box_Cache 		= unserialize(gzuncompress($row['cache']));
											?>
											<tr>
												<td>
													<a href="/admin/box_info.php?id=<?php echo $Box_ID; ?>">
														#<?php echo $Box_ID; ?>
													</a>
												</td>
												<td>
													<a href="/admin/box_info.php?id=<?php echo $Box_ID; ?>">
														<?php echo box_name($Box_ID); ?>
													</a>
												</td>
												<td>
													<a href="/admin/box_info.php?id=<?php echo $Box_ID; ?>">
														<?php echo box_ip($Box_ID); ?>
													</a>
												</td>
												<td>
													<a href="">
														<?php echo box_servers($Box_ID); ?>
													</a>
												</td>
												<td>
													<span class="badge badge-<?php
													if ($Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage'] < 65) { echo 'info';
													} else if ($Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage'] < 85) { echo 'warning';
													} else { echo 'error'; } ?>">
													<?php echo $Box_Cache["{$Box_ID}"]['bandwidth']['rx_usage']; ?>&nbsp;%
													</span>
												</td>
												<td>
													<span class="badge badge-<?php
													if ($Box_Cache["{$Box_ID}"]['ram']['usage'] < 65) { echo 'info';
													} else if ($Box_Cache["{$Box_ID}"]['ram']['usage'] < 85) { echo 'warning';
													} else { echo 'error'; } ?>">
													<?php echo $Box_Cache["{$Box_ID}"]['ram']['usage']; ?>&nbsp;%
													</span>
												</td>
												<td>
													<span class="badge badge-<?php
													if ($Box_Cache["{$Box_ID}"]['cpu']['usage'] < 65) { echo 'info';
													} else if ($Box_Cache["{$Box_ID}"]['cpu']['usage'] < 85) { echo 'warning';
													} else { echo 'error'; } ?>">
													<?php echo $Box_Cache["{$Box_ID}"]['cpu']['usage']; ?>&nbsp;%
													</span>
												</td>
												<td>
													<span class="badge badge-<?php
													if ($Box_Cache["{$Box_ID}"]['hdd']['usage'] < 65) { echo 'info';
													} else if ($Box_Cache["{$Box_ID}"]['hdd']['usage'] < 85) { echo 'warning';
													} else { echo 'error'; } ?>">
													<?php echo $Box_Cache["{$Box_ID}"]['hdd']['usage']; ?>&nbsp;%
													</span>
												</td>
												<td>
													<span class="badge badge-<?php if(box_status($Box_ID) == 'Online') echo 'success'; else echo 'error'; ?>"> 
													<?php echo box_status($Box_ID); ?>
													</span>
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
