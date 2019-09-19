<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/head.php'); ?>

	<!-- Main -->
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					<!-- Stats -->
					<div class="span12">
						<div class="widget widget-nopad">
							<div class="widget-header">
								<i class="icon-list-alt"></i>
								<h3> Statistika</h3>
								<div id="target-1"></div>
							</div>
							
							<div class="widget-content">
								<div class="widget big-stats-container">
									<div class="widget-content">
										<div id="big_stats" class="cf">
											<div class="stat">
												<i class="icon-signal"></i> 
												<span class="value" style="color:#fff;"><?php echo $stats_klijenti; ?></span>
												<br />
												<span>Korisnika</span> 
											</div>

											<div class="stat"> 
												<i class="icon-comments-alt"></i> 
												<span class="value" style="color:#fff;"><?php echo $stats_tiketi; ?></span> 
												<br />
												<span>Tiketa</span> 
											</div>
											
											<div class="stat"> 
												<i class="fa fa-gamepad"></i> 
												<span class="value" style="color:#fff;"><?php echo $stats_server; ?></span> 
												<br />
												<span>Servera</span> 
											</div>

											<div class="stat"> 
												<i class="fa fa-server"></i> 
												<span class="value" style="color:#fff;"><?php echo $stats_masine; ?></span> 
												<br />
												<span>Masina</span> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Chat -->
					<div class="span8">			
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-signal"></i>				
								<h3>Chat</h3>
								<div class="right" style="margin-right:10px;">
									<button class="btn btn-danger" onclick="del_all_msg()">
										<i class="fa fa-remove"></i> Delete all messages
									</button>
								</div>
							</div>

							<div class="widget-content" style="height: 250px;">				
								<div id="chat_main">
									<div id="chat_messages">
										<div id="chat_messages1">
											<div id="load_msg">
												<center>
													<img src="/admin/assets/img/icon/load/load1.gif" style="margin-top: 100px;border-radius: 50%;width: 120px;">
												</center>
											</div>
										</div>
									</div>		
								</div>

								<div class="down_inp_send_msg">
									<input type="text" id="send_msg" placeholder="Zabranjen spam i vredjanje..." onkeypress="return send_msg_event(event)">
									<button onclick="send_msg()"> <i class="fa fa-chevron-right"></i> </button>
								</div>
							</div>
						</div>
					</div>

					<!-- News ticket -->
					<div class="span4">
						<div class="widget widget-nopad">
							<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3> Novi tiketi </h3>
								<div id="target-3"></div>
							</div>

							<?php
								$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` ORDER BY `id` DESC LIMIT 4");
								$SQLSEC->Execute();

								while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
									$Tiket_ID	 			= txt($row['id']);
									$Tiket_Name 			= txt($row['naslov']);
									$Tiket_Text 			= txt($row['text']);
									$Tiket_Date 			= txt($row['datum']);
									
									$Exploded = multiexplode(array(".",", ",":"), $Tiket_Date);
									$timestamp = mktime($Exploded[3], $Exploded[4], 0, $Exploded[0], $Exploded[1], $Exploded[2]);
							?>

							<div class="widget-content">
								<ul class="news-items">
									<li style="width:100%;">
										<div class="news-item-date"> 
											<span class="news-item-day"><?php echo date('d', $timestamp); ?></span> 
											<span class="news-item-month"><?php echo date('M', $timestamp); ?></span>
										</div>

										<div class="news-item-detail">
											<a href="/admin/gp-tiket.php?id=<?php echo $Tiket_ID; ?>" class="news-item-title">
												<?php echo $Tiket_Name; ?>
											</a>
											<p class="news-item-preview" style="color:#bbb;">
												<?php echo $Tiket_Text; ?>
											</p>
										</div>
									</li>
								</ul>
							</div>
							<?php } ?>
						</div>
					</div>
					
					<!-- Cronovi -->
					<div class="span8">			
						<div class="widget stacked">
							<div class="widget-header">
								<i class="icon-signal"></i>				
								<h3>Cronovi</h3>
							</div>

							<div class="widget-content">
								<table class="table table-striped table-bordered tabela-asd">
									<thead>
										<tr>
											<th>ID</th>
											<th>Cron Name</th>
											<th>Cron Last Update</th>
										</tr>
									</thead>
									<tbody>
									
										<?php
										$SQLSEC = $rootsec->prepare("SELECT * FROM `crons`");
										$SQLSEC->Execute();
											while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
												$Cron_ID 			= txt($row['id']);
												$Cron_Name 			= txt($row['cron_name']);
												$Cron_Update 		= txt($row['cron_value']);
											?>
											<tr>
												<td>
													#<?php echo $Cron_ID; ?>
												</td>
												<td>
													<?php echo $Cron_Name; ?>
												</td>
												<td>
													<?php echo $Cron_Update; ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/footer.php'); ?>


	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>
	<script type="text/javascript">
		function del_all_msg() {
			$.ajax({
		    	type: 	'GET',
		    	url: 	'/admin/process.php?a=del_all_msg',
		    	data: 	'all=' + true + '',
		    	success:function() {
		    		$('#send_msg').val('');
		    	}
			});
		}
		function send_msg_event(e) {
			if (e.which == 13 || e.keyCode == 13) {
		        send_msg();
		        var msg_send = $('#send_msg').val('');
		        return false;
		    }
		}
		function send_msg() {
			var msg_send = $('#send_msg').val();
			
			if (msg_send == '') {
				alert('Ne mozete poslati prazan input! :)');
			} else {
				$.ajax({
			    	type: 	'GET',
			    	url: 	'/admin/process.php?a=send_msg',
			    	data: 	'msg_text=' + msg_send + '',
			    	success:function() {
			    		$('#send_msg').val('');
			    	}
				});
			}
		}
		function load_msg() {
	    	$('#chat_messages1').load('/admin/process.php?a=chat_msg_num');      
		}
		setInterval('load_msg()', 1000);		
	</script>

	<!--script for this page-->
    <script type="text/javascript" src="/admin/assets/js/gritter/js/jquery.gritter.js"></script>
    <!--<script type="text/javascript" src="/admin/assets/js/gritter/js/gritter-conf.js"></script>-->

    <script type="text/javascript">
    	$(document).ready(function(){
	        $.gritter.add({
	            // (string | mandatory) the heading of the notification
	            title: 'Dobrodošao/la',
	            // (string | mandatory) the text inside the notification
	            text: '<?php echo my_name($_SESSION['admin_login']); ?>',
	            // (string | optional) the image to display on the left
	            image: '/assets/img/rank/dev.png',
	            // (bool | optional) if you want it to fade out on its own or just sit there
	            sticky: false,
	            // (int | optional) the time you want it to be alive for before fading out
	            time: ''
	        });

	        return false;
        });
    </script>
    
</body>
</html>