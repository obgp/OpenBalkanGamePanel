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

?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
		<div class="container">
			<div class="rows">
				<div class="contect">
				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/nav.php'); ?>
					<div class="col-md-9"><span class="server-name"><?php echo server_name($Server_ID); ?></span></div>
					<?php include_once($_SERVER['DOCUMENT_ROOT'].'/komande.php'); ?>
					<div class="space1"></div>
					<div class="col-md-12">
                    <div id="ftp_header">
		                        <div id="left_header">
		                            <div>
		                                <img src="/assets/img/icon/gp/gp-admin.png">
		                            </div> 
		                            <div style="margin-top:15px;color: #fff;">
		                                <strong>Admini i slotovi</strong>
		                                <p>Ovde mozete dodavati, brisati ili menjati trenutne admine i slotove na serveru.
		                                <br/></p>
		                            </div>
		                        </div>
		                    </div>

		                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#new-admin"><i class="fa fa-lock"></i> DODAJ ADMINA</a>


		                    <div class="space" style="margin-top:60px;"></div>

		                    <div id="plugin_body">
		                    	<p style="color: red!important;">Info: <strong><i>Posle dodavanja,promene admina, pozeljno je promeniti mapu ili jednostavno u konzolu ukucati 'amx_reloadadmins'.</i></strong></p>

		                    	<?php  

                            $filename = LoadFile($Server_ID, 'cstrike/addons/amxmodx/configs/users.ini');
                            $contents = file_get_contents($filename);   

                            $fajla = explode("\n;", $contents);

                        ?>
<div class="table-responsive">
						<table class="table">
                                <tbody>
                                    <tr>
                                        <th>Nick/SteamID/IP</th>
                                        <th>Sifra (ako ima)</th>
                                        <th>Privilegije</th>
                                        <th>Vrsta</th>
                                        <th>Komentar</th>
                                        <th>Akcija</th>
                                    </tr>
                                    <?php 
                                        foreach($fajla as $sekcija) {
                                            $linije = explode("\n", $sekcija);
                                            array_shift($linije);
                                            
                                            foreach($linije as $linija) {
                                                $admin = explode('"',$linija);
                                                if(!empty($admin[1]) && !empty($admin[5])) { ?>
                                                    <tr>
                                                        <td><?php echo txt($admin[1]); ?></td>
                                                        <td><?php echo txt($admin[3]); ?></td>
                                                        <td><?php echo txt($admin[5]); ?></td>
                                                        <td><?php echo txt($admin[7]); ?></td>
                                                        <td><?php echo str_replace('//', '', txt($admin[8])); ?></td>
                                                        <td>
                                                        	<div class="akcija_addmin">
                                                                <a href="/gp-webftp.php?id=<?php echo $Server_ID; ?>&path=/cstrike/addons/amxmodx/configs/&fajl=users.ini">
                                                                	<button class="btn btn-primary"> <span class="fa fa-edit"></span> </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }
                                        }
                                    ?>                            
                                </tbody>
                            </table>
                        </div>
		                        
		                    </div>
		                </div>    
                    </div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>