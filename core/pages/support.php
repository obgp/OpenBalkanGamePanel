<?php 
if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

if (ban_support($_SESSION['user_login']) == 1) {
	sMSG('Vas nalog, je na nasoj ban listi za ovu stranicu. Ukoliko mislite da je ovo neka greska obratite se nasem support timu!', 'info');
	redirect_to('home');
	die();
}

?>


		<div class="container">
			<div class="rows">
				<div class="contect">
					<div class="col-md-12">
						<div class="col-md-10">
							<h2><i class="fa fa-support"></i> Support</h2>
						</div>
						<div class="col-md-2" style="margin-top: 20px;">
							<a href="" class="btn btn-primary"  data-toggle="modal" data-target="#new-ticket">New</a>
							<a href="" class="btn btn-primary">Arhive</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
    						<thead>
							<tr>
	                                        <th>ID Tiketa</th>
	                                        <th>Ime tiketa</th>
	                                        <th>Datum</th>
	                                        <th>Server</th>
	                                        <th>Broj poruka</th>
	                                        <th>Status</th>
	                        </tr>
    						</thead>
    						<tbody>
							<?php
											$rootsec = rootsec();

											$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `user_id` = ?");
											$SQLSEC->Execute(array($_SESSION["user_login"]));

	                                        while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 

	                                            $Ticket_ID 	= txt($row['id']);
	                                            $Server_ID 	= txt($row['server_id']);

	                        ?>   
	                                        <tr>
	                                            <td><a href="/ticket?id=<?php echo $Ticket_ID; ?>">#<?php echo $Ticket_ID; ?></a></td>
	                                            <td><a href="/ticket?id=<?php echo $Ticket_ID; ?>"><?php echo ticket_name($Ticket_ID); ?></a></td>
	                                            <td><?php echo ticket_date($Ticket_ID); ?></td>
	                                            <?php if ($Server_ID == 0) { ?>
		                                            <td class="ip"> Za sve servere </td>
		                                        <?php } else { ?>
		                                        	<td class="ip">
		                                                <a href="/server?id=<?php echo $Server_ID; ?>">
		                                                	<?php echo gp_game_icon($Server_ID).' '.server_full_ip($Server_ID); ?>
		                                                </a>
		                                            </td>
		                                        <?php } ?>
	                                            <td><?php echo ticket_poruke($Ticket_ID); ?></td>
	                                            <td><?php echo ticket_status($Ticket_ID); ?></td>
	                                        </tr>
	                                    <?php } ?>   
    						</tbody>
    					</table>
					</div>
				</div>
