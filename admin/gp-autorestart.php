<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');


$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('gp-servers.php');
	die();
}

if (cp_perm_srv_view($Server_ID) == false) {
	sMSG('Niste support za ovu igru!', 'info');
	redirect_to('gp-servers.php');
	die();
}

?>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- SERVER INFO -->
					<div class="span12">
						<div class="navbar">
							<div class="navbar-inner">
								<ul class="nav">
									<li class="nav_s_active"><a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">Server</a></li>
					                <!--<li><a href="gp-config.php?id=<?php echo $Server_ID; ?>">Podesavanje</a></li>-->
					                <?php if (gp_game_id($Server_ID) == 1) { ?>
					                    <li><a href="/admin/gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
					                    <li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-maps.php?id=<?php echo $Server_ID; ?>">Map installer</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 2) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 3) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 4) { ?>
					                	<li><a href="gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                	<li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 5) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                	<li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 6) { ?>
					                	<li><a href="/admin/ts-perm.php?id=<?php echo $Server_ID; ?>">Permission</a></li>
					                	<li><a href="/admin/ts-bans.php?id=<?php echo $Server_ID; ?>">Banovani</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 7) { ?>	
					                	<li><a href="/admin/gp-admins.php?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
					                    <li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-plugins.php?id=<?php echo $Server_ID; ?>">Plugini</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-boost.php?id=<?php echo $Server_ID; ?>">Boost</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 8) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } else if (gp_game_id($Server_ID) == 9) { ?>
					                	<li><a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
					                    <li><a href="/admin/gp-mods.php?id=<?php echo $Server_ID; ?>">Modovi</a></li>
					                    <li><a href="/admin/gp-console.php?id=<?php echo $Server_ID; ?>">Konzola</a></li>
					                    <li><a href="/admin/gp-autorestart.php?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
					                    <li><a href="/admin/gp-backup.php?id=<?php echo $Server_ID; ?>">Backup</a></li>
					                <?php } ?>
					                <li><a href="" data-toggle="modal" data-target="#jesi_siguran"><i class="icon-share-alt"></i> Prebaci server</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="span12">
						<div class="widget stacked">
							<div class="widget-header">
								<h3>
									<i class="fa fa-gamepad"></i>
									<a href="/admin/gp-server.php?id=<?php echo $Server_ID; ?>">
										<?php echo server_name($Server_ID); ?>
									</a> 
									
									|

									<i class="fa fa-user"></i> 
									<a href="/admin/gp-klijent.php?id=<?php echo Srw_Owenr($Server_ID); ?>">
										<?php echo user_full_name(Srw_Owenr($Server_ID)); ?>
									</a>
								</h3>
							</div>
						</div>
					</div>
					
					<div class="span12">
						<div class="widget widget-table action-table">
							<div class="widget-header"> <i class="icon-th-list"></i>
								<h3>Auto restart</h3>
							</div>

							<div class="widget-content">
								
								<div class="add_server_by_client">
			                   		<form action="/admin/process.php?a=autorestart" method="POST" autocomplete="off" style="margin: 20px 15px;">
			                            <input type="hidden" name="server_id" value="<?php echo $Server_ID; ?>" />
			                            <select name="autorestart">
			                                <option value="-1">DISABLED</option>
			                                <option value="0">00:00</option>
			                                <option value="1">01:00</option>
			                                <option value="2">02:00</option>
			                                <option value="3">03:00</option>
			                                <option value="4">04:00</option>
			                                <option value="5">05:00</option>
			                                <option value="6">06:00</option>
			                                <option value="7">07:00</option>
			                                <option value="8">08:00</option>
			                                <option value="9">09:00</option>
			                                <option value="10">10:00</option>
			                                <option value="11">11:00</option>
			                                <option value="12">12:00</option>
			                                <option value="13">13:00</option>
			                                <option value="14">14:00</option>
			                                <option value="15">15:00</option>
			                                <option value="16">16:00</option>
			                                <option value="17">17:00</option>
			                                <option value="18">18:00</option>
			                                <option value="19">19:00</option>
			                                <option value="20">20:00</option>
			                                <option value="21">21:00</option>
			                                <option value="22">22:00</option>
			                                <option value="23">23:00</option>
			                            </select>

			                            <button class="btn btn-info" style="margin-top:-10px;">
			                                <i class="glyphicon glyphicon-ok"></i> SACUVAJ
			                            </button>
			                        </form>
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

	<div id="jesi_siguran" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">Prebaci server</h4>
		</div>

		<div class="modal-footer">
			<form action="/admin/process.php?a=change_owner" method="POST" id="forma_popup" class="left">
				<input type="text" name="server_id" value="<?php echo $Server_ID; ?>" style="display:none;">

				<select name="client_id" class="selectpicker" data-live-search="true">
					<option value="0" disabled selected="selected">Izaberite klijenta</option>
					<?php $get_clients = mysql_query("SELECT * FROM `klijenti` ORDER by klijentid ASC");
					while ($row_client = mysql_fetch_array($get_clients)) { ?>
						<option value="<?php echo txt($row_client['klijentid']); ?>" style="color:#333;">
							<?php echo user_full_name($row_client['klijentid']).' - '.user_email($row_client['klijentid']); ?>
						</option>
					<?php } ?>
				</select>

				<div class="space clear"></div>

				<button class="left btn btn-success">
					<i class="icon-ok"></i> Prebaci
				</button>
			</form>
		</div>
	</div>

</body>
</html>