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
							Otvoreni tiketi
						</h1>
						<hr>
					</div>

					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Lista otvorenih tiketa</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th style="width: 20px"> ID </th>
											<th style="width: 130px"> Naslov tiketa </th>
											<th style="width: 130px"> Klijent </th>
											<th style="width: 130px"> Server </th>
											<th style="width: 50px"> Broj poruka </th>
											<th style="width: 130px"> Prioritet </th>
											<th style="width: 130px"> Status </th>
										</tr>
									</thead>

									<tbody>
										<?php
											$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `status` = '1' OR `status` = '2' OR `status` = '3' ORDER by id DESC");
											$SQLSEC->Execute();
										
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Ticket_ID 			= txt($row['id']);
												$Client_ID 			= txt($row['user_id']);
												$Server_ID 			= txt($row['server_id']);
												
												$Ticket_Name 		= ticket_name($Ticket_ID);
												if(strlen($Ticket_Name) > 25) { 
											        $Ticket_Name = substr($Ticket_Name,0,25); 
											        $Ticket_Name .= "..."; 
											    }

											  	
											?>
											<tr>
												<td>
													<a href="/admin/gp-tiket.php?id=<?php echo $Ticket_ID; ?>">
														#<?php echo $Ticket_ID; ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-tiket.php?id=<?php echo $Ticket_ID; ?>">
														<?php echo $Ticket_Name; ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-klijent.php?id=<?php echo ticket_owner($Ticket_ID); ?>">
														<?php echo user_full_name(ticket_owner($Ticket_ID)); ?>
													</a>
												</td>
												<td>
													<a href="/admin/gp-server.php?id=<?php echo ticket_server($Ticket_ID); ?>">
														<?php echo server_full_ip(ticket_server($Ticket_ID)); ?>
													</a>
												</td>
												<td><?php echo ticket_poruke($Ticket_ID); ?></td>
												<td><?php echo ticket_s_pro($Ticket_ID); ?></td>
												<td><?php echo ticket_status($Ticket_ID); ?></td>
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