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
							<span class="fa fa-gamepad"></span>
							Plugin
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Plugin lista</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th style="width: 20px"> ID </th>
											<th style="width: 130px"> Ime plugina </th>
											<th style="width: 130px"> Igra </th>
											<th style="width: 130px"> Opis </th>
										</tr>
									</thead>

									<tbody>
										<?php
											$SQLSEC = $rootsec->prepare("SELECT * FROM `plugins` ORDER by id DESC");
											$SQLSEC->Execute();
										
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Plugin_ID 			= txt($row['id']);
											?>
											<tr>
												<td>
													<a href="/admin/gp-plugin.php?id=<?php echo $Plugin_ID; ?>">
														#<?php echo $Plugin_ID; ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-plugin.php?id=<?php echo $Plugin_ID; ?>">
														<?php echo plugin_name($Plugin_ID); ?>
													</a>
												</td>
												<td><?php echo plugin_game($Plugin_ID); ?></td>
												<td><?php echo plugin_opis($Plugin_ID); ?></td>
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