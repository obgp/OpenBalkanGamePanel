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
							Modovi
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Lista modova</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th style="width: 20px"> ID </th>
											<th style="width: 130px"> Ime moda </th>
											<th style="width: 130px"> Igra </th>
											<th style="width: 130px"> Opis </th>
											<th style="width: 50px"> Mapa </th>
											<th style="width: 50px"> Script Link </th>
										</tr>
									</thead>

									<tbody>
										<?php
											$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` ORDER by id DESC");
											$SQLSEC->Execute();
										
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Mod_ID 			= txt($row['id']);
											?>
											<tr>
												<td>
													<a href="/admin/gp-mod.php?id=<?php echo $Mod_ID; ?>">
														#<?php echo $Mod_ID; ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-mod.php?id=<?php echo $Mod_ID; ?>">
														<?php echo get_mod_name($Mod_ID); ?>
													</a>
												</td>
												<td><?php echo get_mod_game($Mod_ID); ?></td>
												<td><?php echo get_mod_opis($Mod_ID); ?></td>
												<td><?php echo get_mod_map($Mod_ID); ?></td>
												<td><?php echo get_mod_link($Mod_ID); ?></td>
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