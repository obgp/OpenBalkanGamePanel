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
                    <div id="top">
		                        <div id="left">
		                            <div style="margin-top:15px;color: #fff;">
		                                <strong>Autorestart</strong>
		                                <p>Ovde mozete podesiti vreme kada zelite da vam se server automatski restartuje svaki dan.
		                                <br/>Da vidite cemu sluzi ova funkcija posetite <a href=""><b>(Kako namestiti Autorestart)</b></a>.</p>
		                            </div>
		                        </div>
		                    </div>              
		                    <div id="formrr">
		                   		<form action="/process.php?a=autorestart" method="POST" autocomplete="off" style="margin: 20px 15px;">
		                            <input type="hidden" name="server_id" value="<?php echo $Server_ID; ?>" />
		                            <select class="form-control" style="width:250px;display:initial;" name="autorestart">
		                                <option value="-1">DISABLED</option>
					<?php
					for ($i = 0; $i < 24; $i++) {
						if (server_autorestart($Server_ID) == $i)
							$selected = "selected=\"selected\" $i";
						else
							$selected = "";
					?>
					<option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>:00</option>
					<?php
					}
					?>
				</select>
                <a href="#" onclick="$(this).closest('form').submit()" class="btn btn-primary"><i class="fa fa-ok"></i> SACUVAJ</a>
		                        </form>
		                    </div>
		                </div>
</div>

				</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>