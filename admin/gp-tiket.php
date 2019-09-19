<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php');


$Ticket_ID = txt($_GET['id']);

if (is_valid_ticket($Ticket_ID) == false) {
	sMSG('Ovaj tiket ne postoji!', 'error');
	redirect_to('gp-tiketi.php');
	die();
}

if (cp_perm_tiket_view($Ticket_ID) == false) {
	sMSG('Niste support za ovu igru!', 'info');
	redirect_to('gp-tiketi.php');
	die();
}

$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ?");
$SQLSEC->Execute(array($Ticket_ID));
$Tiket_Info 			= $SQLSEC->fetch(PDO::FETCH_ASSOC);

?>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<!-- TICKET -->
		<div class="span12">
			<h1>
				<span class="icon-comment"></span>
				Podrska
			</h1>

			<br />

			<h3><?php echo ticket_name($Ticket_ID); ?></h3>

			<hr>
		</div>

		<div class="span8">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-list"></i>
					<h3>
						<a href="">
							<?php echo user_full_name(ticket_owner($Ticket_ID)); ?>
						</a>
					</h3>
					<span style="float: right;margin-right: 10px;font-weight: bold;">
						<?php echo ticket_date($Ticket_ID); ?>
					</span>
				</div>

				<div class="widget-content">
					<?php echo smile(ticket_text($Ticket_ID)); ?>
				</div>
			</div>

			<?php  

				$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi_odgovori` WHERE `tiket_id` = ? ORDER by id ASC");
				$SQLSEC->Execute(array($Ticket_ID));
				if ($SQLSEC->rowCount() == true) {
					while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) {
						$Odg_Ticket_ID 		= txt($row['id']);

						$Odg_User_ID 		= txt($row['user_id']);
						$Odg_Admin_id 		= txt($row['admin_id']);
			?>
			<!-- -->
			<?php if (!$Odg_Admin_id == "") { ?>
				
				<div class="widget stacked">
					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>
							<a href="/admin/admin.php?id=<?php echo $Odg_User_ID; ?>">
								<?php echo my_name($Odg_Admin_id); ?>
							</a>
						</h3>
						<span style="float: right;margin-right: 10px;font-weight: bold;">
							<?php echo t_odg_time($Odg_Ticket_ID); ?>
						</span>
					</div>

					<div class="widget-content">
						<?php echo smile(t_odg_text($Odg_Ticket_ID)); ?>
						
						<hr>
						
						<div class="potpis_tiket_odg" style="float:left;color:#9c9696;">
							<?php echo admin_signature($Odg_Admin_id); ?>
						</div>

						<div class="obrisi_tiket_odg" style="float:right;">
							<form action="/admin/process.php?a=delete_odg" method="POST">
								<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
								<input type="text" name="odg_id" value="<?php echo $Odg_Ticket_ID; ?>" style="display: none;">
								<button class="btn btn-danger">Obrisi</button>
							</form>
						</div>
					</div>
				</div>
			
			<?php } else { ?>
				
				<div class="widget stacked">
					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>
							<a href="/admin/gp-klijent.php?id=<?php echo $Odg_User_ID; ?>">
								<?php echo user_full_name($Odg_User_ID); ?>
							</a>
						</h3>
						<span style="float: right;margin-right: 10px;font-weight: bold;">
							<?php echo t_odg_time($Odg_Ticket_ID); ?>
						</span>
					</div>

					<div class="widget-content">
						<?php echo smile(t_odg_text($Odg_Ticket_ID)); ?>
						
						<hr>

						<div class="obrisi_tiket_odg" style="float: right;">
							<form action="/admin/process.php?a=delete_odg" method="POST">
								<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
								<input type="text" name="odg_id" value="<?php echo $Odg_Ticket_ID; ?>" style="display: none;">
								<button class="btn btn-danger">Obrisi</button>
							</form>
						</div>
					</div>
				</div>

			<?php } ?>
			<!-- -->
			<?php }} ?>

			<hr>
			<!-- Posalji poruku -->
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-pushpin"></i>
					<h3>Posalji poruku</h3>
				</div>

				<div class="widget-content">
					<form action="/admin/process.php?a=supp_odg" method="POST">
						<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
						<textarea name="supp_odg" placeholder="Posaljite poruku..." style="width: 100%;height: 150px;margin: 0 0 0 -7px;background: #29384D!important;border: 2px solid #364856!important;color: #fff; padding: 5px;"></textarea>
						<div class="button_suup_odg_ticket" style="float: right;margin: 10px -5px -5px -5px;">
							<button class="btn btn-warning">
								<i class="fa fa-send"></i> POSALJITE
							</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	
		<div class="span4">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-list"></i>
					<h3>Tiket #<?php echo $Ticket_ID; ?></h3>
				</div>

				<div class="widget-content">
					<div class="admin_tiket_precice">
						<?php if (ticket_status_id($Ticket_ID) == 4) { ?>
							<li>
								<form action="/admin/process.php?a=unlock_tiket" method="POST">
									<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
									<button class="btn btn-success"> <i class="icon-unlock"></i> OTKLJUCAJ</button>
								</form>
							</li>
						<?php } else { ?>
							<li>
								<form action="/admin/process.php?a=lock_tiket" method="POST">
									<input type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>" style="display: none;">
									<button class="btn btn-danger"> <i class="icon-lock"></i> ZATVORI</button>
								</form>
							</li>
						<?php } ?>
						
						<li>
							<form action="/admin/gp-server.php?id=<?php echo ticket_server($Ticket_ID); ?>" method="POST">
								<button class="btn btn-info"> <i class="icon-screenshot"></i> SERVER</button>
							</form>
						</li>

						<li>
							<form action="/admin/gp-klijent.php?id=<?php echo ticket_owner($Ticket_ID); ?>" method="POST">
								<button class="btn btn-warning"> <i class="icon-user"></i> PROFIL</button>
							</form>
						</li>
						
						<hr>

						<p>IP adresa: <strong> <?php echo server_full_ip(ticket_server($Ticket_ID)); ?> </strong></p>
						<p>Status: <strong> <?php echo ticket_status($Ticket_ID); ?> </strong></p>
						<p>Prioritet: <strong> <?php echo ticket_s_pro($Ticket_ID); ?> </strong></p>
						
					</div>
				</div>
			</div>
		</div>


				</div>
			</div>
		</div>
	</div>

	<?php	include_once($_SERVER['DOCUMENT_ROOT'].'/admin/footer.php'); ?>


	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>

	
</body>
</html>