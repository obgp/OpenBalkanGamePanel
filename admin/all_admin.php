<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');
?>


	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- LISTA SERVERA -->
					<div class="span12">
						<h1>
							<span class="fa fa-users"></span>
							Radnici
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Lista Admina</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th style="width: 20px"> ID </th>
											<th style="width: 130px"> Ime i prezime </th>
											<th style="width: 130px"> Email </th>
											<th style="width: 130px"> Rank </th>
											<th style="width: 50px"> Status </th>
										</tr>
									</thead>

									<tbody>
										<?php
											$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` ORDER by id ASC");
											$SQLSEC->Execute();
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Admin_ID 			= txt($row['id']);
											?>
											<tr>
												<td>
													<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
														#<?php echo $Admin_ID; ?>
													</a>
												</td>

												<td>
													<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
														<?php echo my_name($Admin_ID); ?>	
													</a>
												</td>

												<td>
													<a href="/admin/admin.php?id=<?php echo $Admin_ID; ?>">
														<?php echo admin_email($Admin_ID); ?>
													</a>
												</td>

												<td><?php echo admin_rank($Admin_ID); ?></td>
												<td><?php echo get_status(admin_lastactivity($Admin_ID)); ?></td>
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
