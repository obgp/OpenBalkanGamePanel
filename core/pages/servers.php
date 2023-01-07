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
					<h2><i class="fa fa-server"></i> Servers</h2>
					<div class="table-responsive">
						<table class="table">
    						<thead>
      							<tr>
        							<th>Ime servera</th>
        							<th>Vazi do</th>
        							<th>Cena</th>
        							<th>IP addresa</th>
        							<th>Slotovi</th>
        							<th>Status</th>
      							</tr>
    						</thead>
    						<tbody>
 					<?php  
											$rootsec = rootsec();

											$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `user_id` = ?");
											$SQLSEC->Execute(array($_SESSION["user_login"]));

	                                        while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
	                                            $srw_id = txt($row['id']);
	                                            $cena = txt($row['cena']);
	                                        ?>       
	                                        <tr>
	                                            <td>
	                                                <a href="/server?id=<?php echo $srw_id; ?>">
	                                                	<?php echo gp_game_icon($srw_id); ?>
	                                                	<?php echo server_name($srw_id); ?>
	                                                </a>
	                                            </td>
	                                            <td><?php echo server_istice($srw_id); ?></td>
	                                            <td><?php echo euro_for_slot($srw_id); ?></td>
	                                            <td class="ip">
	                                            	<a href="/server?id=<?php echo $srw_id; ?>">
	                                            		<?php echo server_full_ip($srw_id); ?>
	                                            	</a>
	                                            </td>
	                                            <td><?php echo server_slot($srw_id); ?></td>
	                                            <td><div class="aktivan"><?php echo gp_s_status($srw_id); ?></div></td>
	                                        </tr>
	                                    <?php } ?>                          						</tbody>
    				</table>
    				</div>
				</div>