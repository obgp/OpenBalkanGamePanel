<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}

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

//
$stats_klijenti			= mysql_query("SELECT * FROM `klijenti`");
$stats_tiketi 			= mysql_query("SELECT * FROM `tiketi`");
$stats_server 			= mysql_query("SELECT * FROM `serveri`");
$stats_masine 			= mysql_query("SELECT * FROM `box`");
//
$Svi_Tiketi 			= mysql_query("SELECT * FROM `tiketi`");
$Otv_Tiketi 			= mysql_query("SELECT * FROM `tiketi` WHERE `status` = '1'");
$Odg_Tiketi 			= mysql_query("SELECT * FROM `tiketi_odgovori`");
$Lck_Tiketi 			= mysql_query("SELECT * FROM `tiketi` WHERE `status` = '0'");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo site_name().' | '.server_name($Server_ID); ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/head.php'); ?>
</head>
<body>
	<!-- Error script -->
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>

    <script type="text/javascript">
    	setTimeout(function() {
    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";
    	}, 5000);
    </script>

	<!-- header -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="index.php">
					<img src="/admin/assets/img/logo.png" alt="GB-Hoster.Me LOGO!"> 
				</a>
				
				<div class="nav-collapse">
					<ul class="nav pull-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i> <?php echo my_name($_SESSION['admin_login']); ?> <b class="caret"></b>
							</a>

							<ul class="dropdown-menu">
								<li><a href="/admin/profile.php">Profile</a></li>
								<li><a href="/admin/logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div> 
			</div>
		</div>
	</div>

	<!-- nav menu -->
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
				<ul class="mainnav">
					<li class="active">
						<a href="/admin/index.php">
							<i class="icon-dashboard"></i>
							<span>POCETNA</span> 
						</a> 
					</li>
					
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-th"></i>
							<span>KLIJENTI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_client.php">DODAJ NALOG</a></li>
							<li><a href="/admin/clients.php">LISTA KLIJENATA</a></li>
							<li><a href="/admin/banovani.php">BANOVANI KLIJENTI</a></li>
						</ul>
					</li>
				
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-gamepad"></i>
							<span>SERVERI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_server.php">DODAJ SERVER</a></li>
							<li><a href="/admin/gp-servers.php">LISTA SVIH SERVERA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-comments"></i>
							<span>TIKETI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/gp-tiketi.php">SVI TIKETI (<span style="color: green;"><?php echo mysql_num_rows($Svi_Tiketi); ?></span>)</a></li>
							<li><a href="/admin/gp-tiketi-open.php">OTVORENI TIKETI (<span style="color: green;"><?php echo mysql_num_rows($Otv_Tiketi); ?></span>)</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-code"></i>
							<span>MODOVI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_mod.php">DODAJ NOVI MOD</a></li>
							<li><a href="/admin/list_mods.php">LISTA MODOVA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-code"></i>
							<span>PLUGINI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_plugin.php">DODAJ NOVI PLUGIN</a></li>
							<li><a href="/admin/list_plugins.php">LISTA PLUGINA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-hdd-o"></i>
							<span>MASINE</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_box.php">DODAJ NOVU MASINU</a></li>
							<li><a href="/admin/all_box.php">PREGLED MASINA</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users"></i>
							<span>ADMINI</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/admin/add_admin.php">DODAJ NOVOG ADMINA</a></li>
							<li><a href="/admin/all_admin.php">PREGLED ADMINA</a></li>
						</ul>
					</li>

					<li>
						<a href="">
							<i class="icon-bar-chart"></i>
							<span>Charts</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-long-arrow-down"></i>
							<span>Drops</span> 
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="icons.html">Icons</a></li>
							<li><a href="faq.html">FAQ</a></li>
							<li><a href="pricing.html">Pricing Plans</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="signup.html">Signup</a></li>
							<li><a href="error.html">404</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>

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

	<!-- footer -->
	<div class="extra">
		<div class="extra-inner">
			<div class="container">
				<div class="row">
					<div class="span12">
						<center>
							<img src="/admin/assets/img/icon/gh_logo.png" alt="Gold Hosting LOGO!">
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<div class="row">
					<div class="span12"> &copy; 2017 - <?php echo date('Y').' '.real_site_name(); ?>. Sva prava zadrzana. </div>
				</div>
			</div>
		</div>
	</div>

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