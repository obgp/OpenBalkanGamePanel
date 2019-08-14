<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('gp-servers.php');
	die();
}

if (ban_ftp($_SESSION['user_login']) == 1) {
	sMSG('Vas nalog, je na nasoj ban listi za ovu stranicu. Ukoliko mislite da je ovo neka greska obratite se nasem support timu!', 'info');
	redirect_to('gp-home.php');
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

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
		<div class="container">
			<div class="rows">
				<div class="contect">
				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/nav.php'); ?>

					<h2><i class="fa fa-folder-open"></i> WebFTP</h2>
					<div class="pull-right" style="margin-top: -40px;">
						<a href="" class="btn btn-primary">New File</a>
						<a href="" class="btn btn-primary">Upload</a>
					</div>
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
	                                                        <a style="color: #FFF;" href="/gp-webftp.php?id='.$Server_ID.'&path=/'.$sofar.'#server_info_infor2">
	                                                        <i class="fa fa-folder-open"></i> '.$breadcrumbs[$bi].'</a>';
	                                        }
	                                    }
	                                }
	                            } else {
	                                redirect_to('gp-webftp.php?id='.$Server_ID.'&path=/#server_info_infor2');
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
	                                            $xa = explode("->", $current[8]);
	                                            
	                                            $current[8] = $xa[0];
	                                            
	                                            $current[0] = "Linkovano";
	                                            
	                                            $current[4] = "Linkovano";
	                                            
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
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table">
    							<thead>
      								<tr>
									  <th>Ime fajla/foldera</th>
	                                            <th>Veličina</th>
	                                            <th>User</th>
	                                            <th>Grupa</th>
	                                            <th>Permisije</th>
	                                            <th>Modifikovan</th>
	                                            <th>Akcija</th>
      								</tr>
    							</thead>
    							<tbody>
								<?php
	                                            $back_link = str_replace("\\", '/', $back_link);
	                                            if($path != "/") {
	                                        ?>
	                                            <tr>
	                                                <td colspan="7" style="cursor: pointer;" onClick="window.location='?id=<?php echo $Server_ID; ?><?php if ($back_link != "/") { ?>&path=<?php echo $back_link; } ?>'#server_info_infor2">
	                                                <z><i class="fa fa-arrow-left"></i></z>  ...
	                                                </td>
	                                            </tr>
	                                        <?php } foreach($ftp_dir as $x) { ?>
	                                            <tr>
	                                                <td>
	                                                    <a style="color: #FFF;" href="/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=<?php echo $old_path."".$x[8]; ?>#server_info_infor2">
	                                                        <i class='fa fa-folder-open' style="color: #337ab7;"></i>
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

	                                                <td style="width:60px;">
	                                                    <form method="POST" action="" id="izbrisi-folder" class="right">
		                                                    <a href="#" data-toggle="modal" data-target="#folder_dell-auth_<?php echo $x[8]; ?>">
		                                                        <button class="btn btn-primary" id="iconweb"><i class="fa fa-remove"></i></button>
		                                                    </a>
	                                                    </form>
	                                                    <form method="POST" action="" id="izbrisi-fajl" class="left">
		                                                    <a href="#" data-toggle="modal" data-target="#folder_edit-auth_<?php echo $x[8]; ?>">
		                                                        <button class="btn btn-primary" id="iconweb"><i class="fa fa-edit"></i></button>
		                                                    </a>
	                                                    </form>         
	                                                </td>
	                                            </tr>

<!-- EDIT FOLDER POPUP -->
<div id="folder_dell-auth_<?php echo txt($x[8]); ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div id="popUP"> 
	        <div class="popUP">
	            <form action="/process.php?a=delete_folder" method="POST" autocomplete="off" id="modal-delete-auth">
	                <fieldset>
	                	<h2>Delete folder</h2>
	                    <h2 style="font-size:15px;">Dali ste sigurni da zelite obrisati (<?php echo txt($x[8]); ?>) folder?</h2>
	                    <ul>
                            <input type="hidden" name="server_id" value="<?php echo txt($Server_ID); ?>">
                            <input type="hidden" name="f_name" value="<?php echo txt($x[8]); ?>">
                            <input type="hidden" name="path" value="<?php echo txt($_GET['path']); ?>">
	                        <div class="space clear"></div>
	                        <li style="text-align:center;background:none;border:none;">
	                        	<button> <span class="fa fa-check-square-o"></span> Delete folder</button>
	                        </li>
	                    </ul>
	                </fieldset>
	            </form>
	        </div>        
	    </div>  
	</div>
</div>
<!-- KRAJ - EDIT FOLDER (POPUP) -->

<!-- EDIT FOLDER POPUP
<div id="folder_edit-auth_<?php echo txt($x[8]); ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div id="popUP"> 
	        <div class="popUP">
	            <form action="/process.php?a=edit_folder" method="POST" autocomplete="off" id="modal-edit-auth">
	                <fieldset>
	                	<h2>ReName file</h2>
	                    <h2 style="font-size:15px;">Trenutno ime fajla: (<?php echo txt($x[8]); ?>)</h2>
	                    <ul>
	                        <li>
	                            <label>Novo ime:</label>
	                            <input type="hidden" name="server_id" value="<?php echo txt($Server_ID); ?>">
	                            <input type="hidden" name="f_name" value="<?php echo txt($x[8]); ?>">
	                            <input type="hidden" name="path" value="<?php echo txt($_GET['path']); ?>">
	                            <input type="text" name="new_file_name" value="<?php echo txt($x[8]); ?>" class="short">
	                        </li>
	                        <div class="space clear"></div>
	                        <li style="text-align:center;background:none;border:none;">
	                        	<button> <span class="fa fa-check-square-o"></span> Save</button>
	                        </li>
	                    </ul>
	                </fieldset>
	            </form>
	        </div>        
	    </div>  
	</div>
</div>
KRAJ - EDIT FOLDER (POPUP) -->
	                                        <?php } ?>
	                                        
	                                        <?php if(!empty($ftp_fajl)) {
	                                            foreach($ftp_fajl as $x) { ?>
	                                            <tr>
	                                                <td>
	                                                    <?php if(isset($x[9])) { ?>
	                                                        <a href="/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=<?php echo $old_path; ?>&fajl=<?php echo txt($x[8]); ?>#server_info_infor2" style="color:#bfd5ff;">
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

	                                                        if($x[4] == "Linkovano") echo $x[4];
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

	                                                <td style="width:60px;">
	                                                    <form method="POST" action="" id="izbrisi-folder" class="right">
		                                                    <a href="#" data-toggle="modal" data-target="#file_dell_<?php echo txt($File_auth_m); ?>">
		                                                        <button class="btn btn-primary" id="iconweb"><i class="fa fa-remove"></i></button>
		                                                    </a>
	                                                    </form>
	                                                    <form method="POST" action="" id="izbrisi-fajl" class="left">
		                                                    <a href="#" data-toggle="modal" data-target="#folder_edit-auth_<?php echo txt($File_auth_m); ?>">
		                                                        <button class="btn btn-primary" id="iconweb"><i class="fa fa-edit"></i></button>
		                                                    </a>
	                                                    </form>          
	                                                </td>
	                                            </tr>

<!-- DELETE FILE POPUP -->
<div id="file_dell_<?php echo txt($File_auth_m); ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div id="popUP"> 
	        <div class="popUP">
	            <form action="/process.php?a=delete_file" method="POST" autocomplete="off" id="modal-delete-auth">
	                <fieldset>
	                	<h2>Delete file</h2>
	                    <h2 style="font-size:15px;">Dali ste sigurni da zelite obrisati (<?php echo txt($x[8]); ?>) file?</h2>
	                    <ul>
                            <input type="hidden" name="server_id" value="<?php echo txt($Server_ID); ?>">
                            <input type="hidden" name="f_name" value="<?php echo txt($x[8]); ?>">
                            <input type="hidden" name="path" value="<?php echo txt($_GET['path']); ?>">
	                        <div class="space clear"></div>
	                        <li style="text-align:center;background:none;border:none;">
	                        	<button> <span class="fa fa-check-square-o"></span> Delete file</button>
	                        </li>
	                    </ul>
	                </fieldset>
	            </form>
	        </div>        
	    </div>  
	</div>
</div>
<!-- KRAJ - DELETE FILE (POPUP) -->
	                                        <?php } } ?>
    							</tbody>
    					</table>
    				</div>
				</div>
			</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>