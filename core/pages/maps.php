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
		                                <strong>Map installer</strong>
		                                <p>Ovde mozete instalirati ili obrisati mapu sa vaseg servera.</p>
		                            </div>
		                        </div>
		                    </div>              
		                    <div id="plugin_body">
								<?php
									$rootsec = rootsec();
		                        	$g_id = server_game_id($Server_ID);  									
									$SQLSEC = $rootsec->prepare("SELECT * FROM `maps` WHERE `game_id` = ?");
									$SQLSEC->Execute(array($g_id));

		                            while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 

		                                $Map_ID 		= txt($row['id']);
		                                $Map_Name 		= txt($row['map_name']);
		                                $Map_Desc 		= txt($row['map_description']);
		                                $Map_Path 		= txt($row['map_file']);
		                                $Map_IMG 		= txt($row['map_img']);

		                            $Plugin_Install = 'ftp://'.server_username($Server_ID).':'.server_password($Server_ID).'@'.server_ip($Server_ID).':21/cstrike/maps/'.$Map_Path;
		                            if (file_exists($Plugin_Install)) { ?>
		                                <li class="plmdmp">
		                                	<form action="/process.php?a=remove_map" method="POST">
		                                        <input hidden type="text" name="map_id" value="<?php echo $Map_ID; ?>">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <button class="pull-right btn btn-danger">Obrisi <i class="fa fa-remove"></i></button>
		                                    </form>

		                                    <p><strong>#<?php echo $Map_ID.' | '.$Map_Name; ?></strong></p>

		                                    <p>
		                                    	<img src="/assets/img/maps/<?php echo $Map_IMG; ?>" style="width:100px;height:auto;">
		                                    	<strong style="margin-top:-5px;margin-left:10px;position:absolute;"><?php echo $Map_Desc; ?></strong>
		                                    </p>                           
		                                </li>
		                            <?php } else { ?>
		                                <li class="plmdmp">
		                                	<form action="/process.php?a=install_map" method="POST">
		                                        <input hidden type="text" name="map_id" value="<?php echo $Map_ID; ?>">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
		                                        <button class="pull-right btn btn-success">Install <i class="glyphicon glyphicon-ok"></i></button>
		                                    </form> 

		                                    <p><strong>#<?php echo $Map_ID.' | '.$Map_Name; ?></strong></p>

		                                    <p>
		                                    	<img src="/assets/img/maps/<?php echo $Map_IMG; ?>" style="width:100px;height:auto;">
		                                    	<strong style="margin-top:-5px;margin-left:10px;position:absolute;"><?php echo $Map_Desc; ?></strong>
		                                    </p>                       
		                                </li>
		                            <?php } ?>
		                        <?php } ?>
		                    </div>
		                </div>

	                </div>
	            </div>
