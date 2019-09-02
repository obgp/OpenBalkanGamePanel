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
		                            <div>
		                                <img src="/assets/img/icon/gp/gp-sett.png">
		                            </div> 
		                            <div style="margin-top:15px;color: #fff;">
		                                <strong>BOOST</strong>
		                                <p>Ovde mozete boostovati vas server.
		                                <br/>Da vidite cemu sluzi ova funkcija posetite <a href=""><b>(Sta je to boost)</b></a>.</p>
		                            </div>
		                        </div>
		                    </div>              
		                    <div id="formrr">
		                   		<form action="/process.php?a=boost" method="POST" autocomplete="off" style="margin: 20px 15px;">
		                            <input type="hidden" name="server_id" value="<?php echo $Server_ID; ?>" />
                <a href="#" onclick="$(this).closest('form').submit()" class="btn btn-primary"><i class="fa fa-ok"></i> BOOST</a>
		                        </form>
		                    </div>
		                </div>
</div>

				</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
