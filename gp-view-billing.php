<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

if (!isset($_GET['id'])) {
	sMSG('Greska.', 'error');
	redirect_to('home');
	die();
}

$Billing_ID = txt($_GET['id']);

if (is_valid_billing($Billing_ID) == false) {
	sMSG('Ova narudzba ne postoji ili nemate pristup za istu!', 'error');
	redirect_to('gp-billing.php');
	die();
}
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
		<div class="container">
			<div class="rows">
				<div class="contect">
	        <div id="server_info_infor">    
	            <div id="server_info_infor">
	                <div id="server_info_infor2">
	                    <div class="space" style="margin-top: 20px;"></div>
	                    <div class="gp-home">
	                        <h2>Billing</h2>
	                        <h3 style="color:white;font-size: 12px;">
	                            Dobrodosli u <?php echo site_name(); ?> billing panel
	                            <br/>Ovde možete pogledati vase narudzbe i ukoliko su odobrene, mozete ih aktivirati!
	                        </h3>

	                        <div class="supportAkcija pull-right">
	                            <ul class="list-inline">
	                            <li class="list-inline-item">
	                                <a href="/order.php" class="btn btn-primary">Nova narudzbina</a>
	                            </li>
	                            <li class="list-inline-item">
	                                <a href="/gp-billing.php" class="btn btn-primary">Arhiva</a>
	                            </li>
	                            </ul>
	                        </div>

	                        <div class="space" style="margin-top: 60px;"></div> 

	                        <div id="serveri">


	                            <div class="row">
		                       		<div class="col-md-12">
				                        	<div class="ticket-odg">
												
												<div class="media-body">
													<div style="padding: 10px 5px 0 5px;">
														<div class="row">
															<div class="col-md-4">
															  <div class="panel panel-default">
															      <div class="panel-heading" style="font-size: 16px;font-weight: 600;"><i class="fa fa-map-pin"></i> Narudzbina:</div>

                                                                    <div class="panel-body" style="color:white;">
											                        <label>Igra: </label>
											                        <span>
												                        <strong>
												                        	<?php echo game_billing_icon(billing_game_id($Billing_ID)); ?>
												                        </strong>
											                        </span> <br />

											                        <label>Mod: </label>
											                        <span>
												                        <strong>
												                        	<?php echo billing_mod_name($Billing_ID); ?>
												                        </strong>
											                        </span> <br />

											                        <label>Lokacija: </label>
											                        <span>
												                        <strong>
												                        	<img src="/assets/img/icon/country/<?php echo billing_location($Billing_ID); ?>.png" title="">
												                        </strong>
											                        </span> <br />

											                        <label>Slotovi: </label>
											                        <span>
												                        <strong>
												                        	<?php echo billing_slot($Billing_ID); ?>
												                        </strong>
											                        </span> <br />

											                        <label>Cena: </label>
											                        <span>
												                        <strong>
												                        	<?php echo money_val(billing_cena($Billing_ID), my_contry($_SESSION['user_login'])); ?>
												                        </strong>
											                        </span> <br />
											                        <label>Status: </label>
											                        <span>
												                        <strong>
												                        	<?php echo billing_status($Billing_ID); ?>
												                        </strong>
											                        </span> <br />

											                    </div>
															</div>
															</div>

															<div class="col-md-8">
															    <div class="panel panel-default">
														      <div class="panel-heading" style="font-size: 16px;font-weight: 600;"><i class="fa fa-map-pin"></i> Dokaz:</div>

                                                                <div class="panel-body">
											                        <?php if (billing_dokaz($Billing_ID) == '') { ?>
											                        	<img src="/assets/img/buy/no_dokaz.png" style="width:100%;height:100%;opacity: 0.5;">
									                    <div class="space clear" style="margin-top:10px;"></div>

											                        		<a class="pull-right btn btn-primary" href="">Dodaj dokaz!</a>

											                        	<p style="color:#fff;">
											                        		<strong>
											                        			* Ostavite nam <i class="plava_color">Dokaz</i> (npr: primerak uplatnice sa <i class="plava_color">pecatom</i> od banke).
											                        		</strong>
											                        	</p>
											                        <?php } else { ?> 
											                        	<img src="/assets/img/buy/crnagora.png" style="width:100%;height:100%;">
											                        <?php } ?>

											                    </div>
															</div>
															</div>

									                    <div class="space clear" style="margin-top:50px;"></div>

									                    <div class="col-md-12 text-center">
                                                            <ul class="list-inline">
									                    	<li><a class="btn btn-primary" href=""><i class="plava_color fa fa-credit-card"></i> Banka/Posta</a></li>
										                    <li><a class="btn btn-primary" href=""><i class="plava_color fa fa-paypal"></i> PayPal</a></li>
										                    <li>
										                    	<a class="btn btn-primary" href="">
										                    		<img src="/assets/img/buy/psc.png" style="width:100px;height:18px;">
										                    	</a>
										                    </li>
										                    <li><a class="btn btn-primary" href=""><i class="plava_color fa fa-btc"></i> BTC</a></li>
										                    <li>
										                    	<a class="btn btn-primary" href="">
										                    		<img src="/assets/img/buy/skrill.png" style="width:50px;height:18px;">
										                    	</a>
										                    </li>
										                    <li><a class="btn btn-primary" href=""><i class="plava_color fa fa-credit-card"></i> IBAN</a></li>
										                    <li><a class="btn btn-primary" href=""><i class="plava_color fa fa-comments-o"></i> SMS</a></li>
									                    </ul>
									                    </div>

									                    <div class="install_server">
									                         <div class="panel panel-default">
									                    	<?php if (billing_status_txt($Billing_ID) == 'pending') { ?>
										                    <?php } else { ?>
										                    	<?php if (billing_install_srv($Billing_ID) == false) { ?>
										                    		<?php if (billing_z_install_srv($Billing_ID) == false) { ?>
											                    		<li>
												                    		<a class="btn btn-primary" href="/process.php?a=send_zahtev_inst&bid=<?php echo $Billing_ID; ?>">Zahtev za instalaciju</a>
												                    	</li>
												                    <?php } else { ?>
												                    	<li>
												                    		<a class="btn btn-primary" href="">Zahtev za instalaciju je poslat!</a>
												                    	</li>
												                    <?php } ?>
										                    	<?php } else { ?>
										                    		<li>
											                    		<a class="btn btn-primary" href="/process.php?a=install_server&bid=<?php echo $Billing_ID; ?>">Instaliraj server!</a>
											                    	</li>
										                    	<?php } ?>
										                    <?php } ?>
									                    </div>
									                    </div>

													</div>
												</div>
											</div>
				                        </div>
				                    </div>
				                </div>

	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        </div>
	        				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>