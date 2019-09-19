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
								<h3>Konzola</h3>
							</div>

							<div class="widget-content">
								
								<div id="konzolaajax" server_id="<?php echo $Server_ID; ?>">
<pre id="down_animate" style="width: 98%;height: 550px;background: none;color: #fff;overflow-x: hidden;">
<?php
    if(!($con = ssh2_connect(server_ip($Server_ID), box_ssh(getBOX($Server_ID))))) { 
        return "error";
    } else {
        if(!ssh2_auth_password($con, box_username(getBOX($Server_ID)), box_password(getBOX($Server_ID)))) {
            return "error";
        } else {
            $stream = ssh2_exec($con, "cat /home/".server_username($Server_ID)."/screenlog.0"); 
            stream_set_blocking($stream, true );

            $resp = '';
            $text = '';

            while ($line=fgets($stream)){ 
                if (!preg_match("/rm log.log/", $line) || !preg_match("/Creating bot.../", $line)){
                    $resp .= $line; 
                }
            } 

            if(empty($resp)){ 
                $result_info = "Could not load console log";
            } else { 
                $result_info = $resp;
            }
        }
    }

    $result_info = str_replace("/home", "", $result_info);
    $result_info = str_replace("/home", "", $result_info);  
    $result_info = str_replace(">", "", $result_info);

    if(gp_game_id($Server_ID) == 2) {
		$filename = LoadFile($Server_ID, 'server_log.txt');
		$text .= file_get_contents($filename);
		echo $text;
    } else {
		$text .= htmlspecialchars($result_info);
		echo $text;
    }
?>
</pre>
									<?php if (server_game_id($Server_ID) == 1) {
		                                $rcon_provera = cs_cfg('rcon_password', $Server_ID);
		                                if($rcon_provera == "") { ?>
		                                    <form action="" method="POST" style="margin:10px;">
		                                        <input style="display:none;" type="text" name="server_id" value="<?php echo $Server_ID; ?>" required="">
		                                        <input type="text" name="komanda" placeholder="amx_map <mapname>" required="" style="background: none;border: 1px solid #ccc;padding: 5px 10px;border-radius: 2px;color: #fff;width: 250px;">
		                                        <button style="margin-top: -10px;background: none;padding: 5px 10px;border: 1px solid #ccc;border-radius: 2px;color: #fff;">></button>
		                                    </form>
		                                    <p style="color:#ccc;"><span style="color:red;">(napomena)</span> koristite input bez zagrada i html znakova jer u suprotnom skripta nece raditi kako treba!</p>
		                                <?php }
		                            } ?>
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

	<script type="text/javascript">
		var server_id = $("#konzolaajax").attr('server_id');
		function konzola_refresh(server_id) {
			$('#down_animate').load('gp-console-log.php?id='+server_id+'');
		}
		setInterval('ROnly5sec()', 5000);
		function ROnly5sec() {
			konzola_refresh(server_id);
		}
		function console_down() {
			$("#down_animate").animate({ scrollTop: $("#down_animate")[0].scrollHeight}, 500);
		}
		console_down();
	</script>

</body>
</html>