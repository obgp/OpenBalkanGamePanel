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
		                                <strong>Plugini</strong>
		                                <p>Ovde mozete instalirati ili obrisati neki plugin sa vaseg servera</p>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="space" style="margin-top:20px;"></div>

		                    <div id="plugin_body">
		                    	<p style="color: red!important;">Info: <strong><i>Posle instalacije plugina, pozeljno je promeniti mapu ili restartovati vas server kako bi plugin radio.</i></strong></p>

								<?php
									$rootsec = rootsec();
		                        	$g_id = server_game_id($Server_ID);  									
									$SQLSEC = $rootsec->prepare("SELECT * FROM `plugins` WHERE `game_id` = ?");
									$SQLSEC->Execute(array($g_id));

		                            while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 

		                                $Plugin_ID 		= txt($row['id']);
		                                $Plugin_Name 	= txt($row['ime']);
		                                $Plugin_Desc 	= txt($row['deskripcija']);
		                                $Plugin_View 	= txt($row['prikaz']);
		                                $Plugin_Amxx 	= txt($row['text']);

		                                $Plugin_Install = 'ftp://'.server_username($Server_ID).':'.server_password($Server_ID).'@'.server_ip($Server_ID).':21/cstrike/addons/amxmodx/plugins/'.$Plugin_View;
		                                if (file_exists($Plugin_Install)) { ?>
		                                    <li class="plmdmp">
		                                    	<form action="/process.php?a=remove_plugin" method="POST">
		                                            <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                            <input hidden type="text" name="plugin_id" value="<?php echo $Plugin_ID; ?>">
		                                            <button class="pull-right btn btn-danger">DELETE <i class="fa fa-remove"></i></button>
		                                        </form>
		                                        
		                                        <p><strong>#<?php echo $Plugin_ID.' | '.$Plugin_Name; ?></strong></p>

		                                        <p><?php echo $Plugin_Desc; ?></p>                         
		                                    </li>
		                                <?php } else { ?>
		                                    <li class="plmdmp">
		                                    	<form action="/process.php?a=install_plugin" method="POST">
		                                            <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                            <input hidden type="text" name="plugin_id" value="<?php echo $Plugin_ID; ?>">
		                                            <button class="pull-right btn btn-success">INSTALL <i class="glyphicon glyphicon-ok"></i></button>
		                                        </form> 

		                                        <p><strong>#<?php echo $Plugin_ID.' | '.$Plugin_Name; ?></strong></p>

		                                        <p><?php echo $Plugin_Desc; ?></p>                         
		                                    </li>
		                                <?php } ?>
		                        <?php } ?>
		                    </div>
		                </div>

	                </div>
	            </div>