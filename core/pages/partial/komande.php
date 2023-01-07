<div class="col-md-3">
					<ul class="list-inline">
<?php if (server_is_start($Server_ID) == false) { ?>
										<li class="list-inline-item">
		                                    <form action="/process.php?s=server_start" method="POST">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
												<a href="#" onclick="$(this).closest('form').submit()" class="btn btn-success"><i class="fa fa-play"></i> Start</a>
											</form>
										</li>
										<?php if (is_user_pin() == false) { ?>
											<li class="list-inline-item">
											<a href="#" data-toggle="modal" data-target="#pin" class="btn btn-warning" ><i class="fa fa-refresh"></i> Reinstall</a>
										</li>
											<?php } else { ?>
												<li class="list-inline-item">
			                                    <form action="/process.php?s=server_reinstall" method="POST">
			                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
													<a href="#" onclick="$(this).closest('form').submit()" class="btn btn-warning"><i class="fa fa-refresh"></i> Reinstall</a>
												</form>
												</li>
										<?php } ?>
									<?php } else { ?>
										<li class="list-inline-item">
		                                    <form action="/process.php?s=server_restart" method="POST">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
												<a href="#" onclick="$(this).closest('form').submit()" class="btn btn-warning"><i class="fa fa-refresh"></i> Restart</a>
											</form>
											</li>
											<li class="list-inline-item">
		                                    <form action="/process.php?s=server_stop" method="POST">
		                                        <input hidden type="text" name="server_id" value="<?php echo $Server_ID; ?>">
												<a href="#" onclick="$(this).closest('form').submit()" class="btn btn-danger"><i class="fa fa-power-off"></i> Stop</a>
											</form>
											</li>
									<?php } ?>
					</ul>
</div>