<?php 
if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}
?>
		<div class="container">
			<div class="rows">
				<div class="contect">
	            <div id="server_info_infor">
	                <div id="server_info_infor2">
	                    <div class="space" style="margin-top: 20px;"></div>
	                    <div class="gp-home">
	                        <h2>Billing</h2>
	                        <h3 style="color:white;font-size: 12px;">
	                            Dobrodosli u <?php echo site_name(); ?> billing panel
	                            <br/>Ovde možete pogledati vase narudzbe i ukoliko su odobrene, mozete ih aktivirati!
	                        </h3>

	                        <div class="pull-right">
	                            <ul class="list-inline">
	                            <li class="list-inline-item">
	                                <a href="/order" class="btn btn-primary">Nova narudzbina</a>
	                            </li>
	                            </ul>
	                        </div>

	                        <div class="space" style="margin-top: 60px;"></div> 

					<div class="table-responsive">
						<table class="table">
	                                <tbody>
	                                    <tr>
	                                        <th>ID</th>
	                                        <th>Ime narudzbine</th>
	                                        <th>Game</th>
	                                        <th>Lokacija</th>
	                                        <th>Slotovi</th>
	                                        <th>Cena</th>
	                                        <th>Date</th>
	                                        <th>Status</th>
	                                    </tr>

	                                    <?php
											$rootsec = rootsec();

											$SQLSEC = $rootsec->prepare("SELECT * FROM `billing` WHERE `user_id` = ?");
											$SQLSEC->Execute(array($_SESSION["user_login"]));

	                                        while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
	                                            $Billing_ID 	= txt($row['id']);
	                                            
	                                        ?>       
	                                        <tr>
	                                            <td>
	                                            	<a href="/gp-view-billing.php?id=<?php echo $Billing_ID; ?>">
	                                            		#<?php echo $Billing_ID; ?>
	                                            	</a>
	                                           	</td>
	                                           	<td>
	                                           		<a href="/gp-view-billing.php?id=<?php echo $Billing_ID; ?>">
	                                            		<?php echo billing_name($Billing_ID); ?>
	                                            	</a>
	                                           	</td>
	                                           	<td>
	                                           		<?php echo game_billing_icon(billing_game_id($Billing_ID)); ?>
	                                           	</td>
	                                            <td style="width:40px;text-align:center;">
													<img src="/assets/img/icon/country/<?php echo billing_location($Billing_ID); ?>.png" title="">
												</td>
	                                            <td><?php echo billing_slot($Billing_ID); ?></td>
	                                            <td><?php echo money_val(billing_cena($Billing_ID), my_contry($_SESSION['user_login'])); ?></td>
	                                            <td><?php echo billing_date($Billing_ID); ?></td>
	                                            <td><?php echo billing_status($Billing_ID); ?></td>
	                                        </tr>
	                                    <?php } ?>

	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            </div>
