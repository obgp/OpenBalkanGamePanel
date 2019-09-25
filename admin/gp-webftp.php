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

$allowed_ext = array(
	"txt",  
	"sma", 
	"SMA",
	"cfg", 
	"CFG", 
	"inf", 
	"log", 
	"rc", 
	"ini", 
	"yml", 
	"json", 
	"properties",
	"conf"
);

error_reporting(0);

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
								<h3>WebFTP</h3>
							</div>

							<div class="widget-content">
								<?php 
		                            if(isset($_GET['path'])) {
		                                $path = txt($_GET['path']);
		                                $back_link = dirname($path);

		                                $ftp_path = substr($path, 1);
		                                $breadcrumbs = preg_split('/[\/]+/', $ftp_path, 9); 
		                                $breadcrumbs = str_replace("/", "", $breadcrumbs);

		                                $ftp_pth = '';
		                                if(($bsize = sizeof($breadcrumbs)) > 0) {
		                                    $sofar = '';
		                                    for($bi=0;$bi<$bsize;$bi++) {
		                                        if($breadcrumbs[$bi]) {
		                                            $sofar = $sofar . $breadcrumbs[$bi] . '/';

		                                            $ftp_pth .= '<i class="fa fa-chevron-right"></i>
		                                                        <a style="color: #FFF;" href="/admin/gp-webftp.php?id='.$Server_ID.'&path=/'.$sofar.'">
		                                                        <i class="fa fa-folder-open"></i> '.$breadcrumbs[$bi].'</a>';
		                                        }
		                                    }
		                                }
		                            } else {
		                                redirect_to('gp-webftp.php?id='.$Server_ID.'&path=/');
		                                die();
		                            }

		                            $ftp = ftp_connect(server_ip($Server_ID), 21);
		                            if(!$ftp) {
		                                sMSG('Ne mogu se spojiti sa FTP serverom, molimo prijavite nasoj podrsci ovaj problem.', 'error');
		                                redirect_to('gp-server.php?id='.$Server_ID);
		                                die();
		                            }
		                            
		                            if (@ftp_login($ftp, server_username($Server_ID), server_password($Server_ID))) {
		                                ftp_pasv($ftp, true);
		                                if (!isset($_GET['fajl'])) {
		                                    ftp_chdir($ftp, $path);
		                                    $ftp_contents = ftp_rawlist($ftp, $path);
		                                    $i = "0";

		                                    foreach ($ftp_contents as $folder) {
		                                        $broj = $i++;   
		                                        $current = preg_split("/[\s]+/",$folder,9);

		                                        $isdir = ftp_size($ftp, $current[8]);
		                                        if (substr($current[0][0], 0 - 1) == "l"){
		                                            $ext = explode(".", $current[8]);
		                                            print_r($ext);
		                                            $xa = explode("->", $current[8]);
		                                            
		                                            $current[8] = $xa[0];
		                                            
		                                            $current[0] = "link";
		                                            
		                                            $current[4] = "link fajla";
		                                            
		                                            $ftp_fajl[]=$current;
		                                        } else {
		                                            if ( substr( $current[0][0], 0 - 1 ) == "d" ) $ftp_dir[]=$current;
		                                            else {
		                                                $ext = explode(".", $current[8]);
		                                                if(!empty($ext[1])) if (in_array( $ext[1], $allowed_ext )) $current[9] = $ext[1];
		                                                
		                                                $ftp_fajl[]=$current;
		                                            }
		                                        }   
		                                    } 

		                                } else {
		                                    $filename = 'ftp://'.server_username($Server_ID).':'.server_password($Server_ID).'@'.server_ip($Server_ID).':21/'.txt($_GET['path'].'/'.$_GET['fajl']);
		                                    $contents = file_get_contents($filename);
		                                }
		                                if(isset($_GET['path'])) {
		                                    $old_path = ''.txt($_GET['path']).'/';
		                                    $old_path = str_replace('//', '/', $old_path);
		                                }
		                            } else {
		                                sMSG('Ne mogu se spojiti sa FTP serverom, molimo prijavite nasoj podrsci ovaj problem.', 'error');
		                                redirect_to('gp-server.php?id='.$Server_ID);
		                                die();
		                            }

		                            ftp_close($ftp);
		                        ?>

		                        <?php if(isset($_GET["path"])) { ?>
		                            <div id="file_info">
		                                <a style="color: #FFF;" href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">
		                                    <i class="fa fa-home"></i> root
		                                </a>
		                                <?php echo $ftp_pth; if(isset($_GET['fajl'])) { ?>
		                                    <i class="fa fa-caret-right"></i>
		                                    <i class="fa fa-file"></i> 
		                                <?php echo htmlspecialchars($_GET['fajl']); } ?>
		                            </div>
		                        <?php } else { ?>
		                            <div id="file_info">
		                                <a style="color: #FFF;" href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>">
		                                    <i class="fa fa-home"></i> root
		                                </a>
		                                <?php if(isset($_GET['fajl'])) { ?>  
		                                    <i class="fa fa-caret-right"></i>
		                                    <i class="fa fa-file"></i> 
		                                <?php echo htmlspecialchars($_GET['fajl']); } ?>
		                            </div>
		                        <?php } ?>

		                        <?php if(!isset($_GET['fajl'])) { ?>

									<table class="table table-striped table-bordered tabela-asd">
										<thead>
											<tr>
	                                            <th>Ime fajla/foldera</th>
	                                            <th>Veličina</th>
	                                            <th>User</th>
	                                            <th>Grupa</th>
	                                            <th>Permisije</th>
	                                            <th>Modifikovan</th>
	                                            <th style="width:50px;">Akcija</th>
	                                        </tr>
										</thead>

										<tbody>
											<?php
	                                            $back_link = str_replace("\\", '/', $back_link);
	                                            if($path != "/") {
	                                        ?>
	                                            <tr>
	                                                <td colspan="7" style="cursor: pointer;" onClick="window.location='?id=<?php echo $Server_ID; ?><?php if ($back_link != "/") { ?>&path=<?php echo $back_link; } ?>'">
	                                                <z><i class="fa fa-arrow-left"></i></z>  ...
	                                                </td>
	                                            </tr>
	                                        <?php } foreach($ftp_dir as $x) { ?>
	                                            <tr>
	                                                <td>
	                                                    <a style="color: #FFF;" href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=<?php echo $old_path."".$x[8]; ?>">
	                                                        <i class='fa fa-folder-open' style="color: yellow;"></i>
	                                                        <?php echo $x[8]; ?>
	                                                    </a>
	                                                </td>   

	                                                <td>-</td>

	                                                <td>
	                                                    <?php echo $x[2]; ?>
	                                                </td>

	                                                <td>
	                                                    <?php echo $x[3]; ?>
	                                                </td>

	                                                <td>
	                                                    <?php echo $x[0]; ?>
	                                                </td>

	                                                <td>
	                                                    <?php echo $x[5].' '.$x[6].' '.$x[7]; ?>
	                                                </td>

	                                                <td>
	                                                    <form method="POST" action="" id="izbrisi-folder" class="right" style="margin:5px;">
		                                                    <a href="#" data-toggle="modal" data-target="#folder_dell-auth_<?php echo $x[8]; ?>">
		                                                        <button class="btn btn-danger">
		                                                        	<i class="fa fa-remove"></i>
		                                                        </button>
		                                                    </a>
	                                                    </form>
	                                                    <!--<form method="POST" action="" id="izbrisi-fajl" class="left" style="margin:5px;">
		                                                    <a href="#" data-toggle="modal" data-target="#folder_edit-auth_<?php echo $x[8]; ?>">
		                                                        <button class="btn btn-warning">
		                                                        	<i class="fa fa-edit"></i>
		                                                        </button>
		                                                    </a>
	                                                    </form>-->        
	                                                </td>
	                                            </tr>
<!-- ovo je popup :D -->
<div id="folder_dell-auth_<?php echo txt($x[8]); ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">Delete folder</h4>
	</div>

	<div class="modal-footer">
		<p class="left">
			<strong> Dali ste sigurni da zelite obrisati (<?php echo txt($x[8]); ?>) folder?</strong>
		</p>

		<br />

		<form action="/admin/process.php?a=delete_folder" method="POST" id="forma_popup" class="left">
			<input type="hidden" name="server_id" value="<?php echo txt($Server_ID); ?>">
            <input type="hidden" name="f_name" value="<?php echo txt($x[8]); ?>">
            <input type="hidden" name="path" value="<?php echo txt($_GET['path']); ?>">

			<div class="space clear"></div>

			<button class="left btn btn-success">
				<i class="icon-ok"></i> Delete folder
			</button>
		</form>
	</div>
</div>

	                                        <?php } ?>

	                                       	<?php if(!empty($ftp_fajl)) {
	                                            foreach($ftp_fajl as $x) { ?>
		                                            <tr>
		                                                <td>
		                                                    <?php if(isset($x[9])) { ?>
		                                                        <a href="/admin/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=<?php echo $old_path; ?>&fajl=<?php echo txt($x[8]); ?>" style="color:#bfd5ff;">
		                                                            <i class='fa fa-file-text'></i>
		                                                            <?php echo $x[8]; ?>
		                                                        </a>
		                                                    <?php } else { ?>
		                                                        <i class='fa fa-file'></i>
		                                                        <?php echo $x[8]; ?>
		                                                    <?php } ?>
		                                                </td>

		                                                <td>
		                                                    <?php

		                                                        if($x[4] == "link fajla") echo $x[4];
		                                                        else {          
		                                                            if($x[4] < 1024) echo $x[4]." byte";
		                                                            else if($x[4] < 1048576) echo round(($x[4]/1024), 0)." KB";
		                                                            else echo round(($x[4]/1024/1024), 0)." MB";
		                                                        }
		                                                    ?>
		                                                </td>

		                                                <td>
		                                                    <?php echo $x[2]; ?>
		                                                </td>

		                                                <td>
		                                                    <?php echo $x[3]; ?>
		                                                </td>

		                                                <td>
		                                                    <?php echo $x[0]; ?>
		                                                </td>

		                                                <td>
		                                                    <?php echo $x[5].' '.$x[6].' '.$x[7]; ?>
		                                                </td>

		                                                <?php
		                                                	$exp_f_name 	= explode('.', $x[8]);
		                                                	$File_auth_m 	= $exp_f_name[0];
		                                                ?>

		                                                <td>
		                                                    <form method="POST" action="" id="izbrisi-folder" class="right" style="margin:5px;">
			                                                    <a href="#" data-toggle="modal" data-target="#file_dell_<?php echo txt($File_auth_m); ?>">
			                                                        <button class="btn btn-danger">
			                                                        	<i class="fa fa-remove"></i>
			                                                        </button>
			                                                    </a>
		                                                    </form>
		                                                    <!--<form method="POST" action="" id="izbrisi-fajl" class="left" style="margin:5px;">
			                                                    <a href="#" data-toggle="modal" data-target="#folder_edit-auth_<?php echo txt($File_auth_m); ?>">
			                                                        <button class="btn btn-warning">
			                                                        	<i class="fa fa-edit"></i>
			                                                        </button>
			                                                    </a>
		                                                    </form>-->          
		                                                </td>
		                                            </tr>
<!-- ovo je popup :D -->
<div id="file_dell_<?php echo txt($File_auth_m); ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dali_ste_sigurni" aria-hidden="true" style="display:none;outline:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">Delete file</h4>
	</div>

	<div class="modal-footer">
		<p class="left">
			<strong> Dali ste sigurni da zelite obrisati (<?php echo txt($x[8]); ?>) file?</strong>
		</p>

		<br />

		<form action="/admin/process.php?a=delete_file" method="POST" id="forma_popup" class="left">
			<input type="hidden" name="server_id" value="<?php echo txt($Server_ID); ?>">
            <input type="hidden" name="f_name" value="<?php echo txt($x[8]); ?>">
            <input type="hidden" name="path" value="<?php echo txt($_GET['path']); ?>">

			<div class="space clear"></div>

			<button class="left btn btn-success">
				<i class="icon-ok"></i> Delete file
			</button>
		</form>
	</div>
</div>	                                           
		                                        <?php } } ?>

		                                    </tbody>
		                                </table>
		                            </div>
		                        <?php } else { ?>
		                            <div id="ftp_sacuvajFile">
		                                <div style="margin-top: 20px;"></div>
		                                <form action="/admin/process.php?a=save_ftp_file" method="POST">
		                                    <input type="hidden" name="f_name" value="<?php echo txt($_GET['fajl']); ?>" />
		                                    <input type="hidden" name="path" value="<?php echo $path; ?>" />
		                                    <input type="hidden" name="server_id" value="<?php echo $Server_ID; ?>" />
		                                    <textarea id="file_edit" name="file_text_edit" height="auto"><?php echo htmlspecialchars($contents); ?></textarea>
		                                    <div class="tiket_info">
		                                    	<button class="right btn btn-success" style="margin: 10px 10px -3px 0px;">  
		                                    		<i class="fa fa-save"></i> Sačuvaj 
		                                    	</button>
		                                    	<div class="clear"></div>
		                                    </div>
		                                </form>     
		                            </div>
		                        <?php } ?>
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