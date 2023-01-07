<?php 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}
?>
		<div class="container">
			<div class="rows">
				<div class="contect">
					<div class="col-md-8">
					<?php  
					$rootsec = rootsec();
					$SQLSEC = $rootsec->prepare("SELECT * FROM `obavestenja` WHERE `vrsta` = '1' ORDER by id DESC LIMIT 5");
					$SQLSEC->Execute();

	                                    while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 

	                                        $naslov = txt($row['naslov']);
	                                        $poruka = txt($row['poruka']);
	                                        $datum 	= txt($row['datum']);

	                                    ?>
						<div class="panel panel-default">
							<div class="panel-heading"><i class="fa fa-bullhorn"></i>  <b> <?php echo $naslov; ?></b> - <?php echo $datum; ?> </div>
							<div class="panel-body">								<p>
								<p><?php echo nl2br($poruka); ?></p>
							</div>
						</div>
	                                	<?php } ?>

					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading"><i class="fa fa-user-circle-o"></i> Profile Information</div>
							<div class="panel-body">
								<p>Name: <b class="white"><?php echo user_full_name($_SESSION['user_login']); ?></b></p>
								<p>E-mail: <b class="white"><?php echo user_email($_SESSION['user_login']); ?></b></p>
								<p>IP: <b class="white"><?php echo host_ip(); ?></b></p>
								<p>Money: <b class="white"><?php echo money_val(my_money($_SESSION['user_login']), my_contry($_SESSION['user_login'])); ?></b></p>
							</div>
						</div>
					</div>
				</div>