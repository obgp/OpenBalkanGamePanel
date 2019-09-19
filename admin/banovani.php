<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');
?>
	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- Klijenti -->
					<div class="span12">
						<h1>
							<span class="icon-user"></span> Banovani klijenti
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Banovani klijenti</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th>ID</th>
											<th>Ime i prezime</th>
											<th>Email</th>
											<th>Drzava</th>
											<th>Broj servera</th>
											<th>Registrovan</th>
										</tr>
									</thead>

									<tbody>
										<?php  
										
											$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` ORDER by klijentid ASC");
											$SQLSEC->Execute();
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Client_ID 			= txt($row['klijentid']);
												if (ban_user($Client_ID) == 1) {
												$Drzava 			= txt($row['zemlja']);
												$Register 			= txt($row['kreiran']);

											    $broj_servera = mysql_query("SELECT * FROM `serveri` WHERE `user_id` = '$Client_ID'");
											?>
											<tr>
												<td>
													<a href="/admin/gp-client.php?id=<?php echo $Client_ID; ?>">
														#<?php echo $Client_ID; ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-client.php?id=<?php echo $Client_ID; ?>">
														<?php echo user_full_name($Client_ID); ?>
													</a> 
												</td>
												<td>
													<a href="/admin/gp-client.php?id=<?php echo $Client_ID; ?>">
														<?php echo user_email($Client_ID); ?>
													</a>
												</td>
												<td style="width:40px;text-align:center;">
													<img src="/admin/assets/img/icon/country/<?php echo my_contry($Client_ID); ?>.png" title="">
												</td>
												<td> 
													<?php echo mysql_num_rows($broj_servera); ?> 
												</td>
												<td> 
													<?php echo $Register; ?> 
												</td>
											</tr>
										<?php } ?>
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