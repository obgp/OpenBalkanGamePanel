<?php 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('servers');
	die();
}

?>
		<div class="container">
			<div class="rows">
				<div class="contect">
				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/nav.php'); ?>
					<div class="col-md-9"><span class="server-name"><?php echo server_name($Server_ID); ?></span></div>
					<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/komande.php'); ?>
					<div class="space1"></div>
					<div class="col-md-12">
	                    <div id="ftp_container">
		                    <div id="ftp_header">
		                        <div id="left_header">
		                            <div>
		                                <img src="/assets/img/icon/gp/gp-plugins.png">
		                            </div> 
		                            <div style="margin-top:15px;color: #fff;">
		                                <strong>Modovi</strong>
		                                <p>Ovde mozete instalirati ili obrisati modove sa vaseg servera.
		                                <br />Svaki server moze imati najvise jedan mod instaliran!</p>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="space" style="margin-top:20px;"></div>

		                    <div id="plugin_body">
		                    	<?php if (server_is_start($Server_ID) == true) { ?>
		                    		<p style="color: red!important;">Info: <strong><i>Da biste promenili mod, pozeljno je stopirati vas server.</i></strong></p>
		                    	<?php } ?>

								<?php
									$rootsec = rootsec();
		                        	$g_id 		= server_game_id($Server_ID);  
									$mm_id 		= server_mod($Server_ID);  
									
									$SQLSEC = $rootsec->prepare("SELECT * FROM `modovi` WHERE `igra` = ?");
									$SQLSEC->Execute(array($g_id));
		                            $MID = 1;
		                            while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 

		                                $Mod_ID 		= txt($row['id']);
		                                $Mod_Name 		= txt($row['ime']);
		                                $Mod_Desc 		= txt($row['opis']);
		                                $Mod_Path 		= txt($row['putanja']);

		                            if ($mm_id == $Mod_ID) { ?>
		                                <li class="plmdmp">
		                                	<form action="" method="POST" autocomplete="off">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <input hidden type="text" name="mod_id" value="<?php echo $Mod_ID; ?>">
		                                        <button disabled="" class="pull-right btn btn-success">INSTALIRAN <i class="fa fa-remove"></i></button>
		                                    </form>

		                                    <p><strong>#<?php echo $MID++.' | '.$Mod_Name; ?></strong></p>

		                                    <p><?php echo $Mod_Desc; ?></p>                           
		                                </li>
		                            <?php } else { ?>
		                                <li class="plmdmp">
		                                	<form action="/process.php?a=change_mod" method="POST" autocomplete="off">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <input hidden type="text" name="mod_id" value="<?php echo $Mod_ID; ?>">
		                                        <button class="pull-right btn btn-primary">INSTALL <i class="glyphicon glyphicon-ok"></i></button>
		                                    </form> 

		                                    <p><strong>#<?php echo $MID++.' | '.$Mod_Name; ?></strong></p>

		                                    <p><?php echo $Mod_Desc; ?></p>                          
		                                </li>
		                            <?php } ?>
		                        <?php } ?>
		                    </div>
		                </div>

	                </div>
	            </div>								