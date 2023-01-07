				<div class="footer">
					<div class="col-md-4"><a href="https://github.com/obgp/OpenBalkanGamePanel">OpenBalkanGamePanel</a></div>
					<div class="col-md-4">Copyright <?php echo date("Y"); ?> <span style="color: #337ab7;"><?php echo site_name(); ?></span>. All Rights Reserved.</div>
				</div>
			</div>

		</div>
	</body>
	<?php if (is_user_pin() == false) { ?>
<div id="pin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
<form action="/process.php?a=enterPinCode" method="POST" autocomplete="off" id="modal-pin-auth">
            	<p>Unesite vas PIN kod</p>
            	<button type="button" class="close" style="margin-top: -40px;color: #f5f5f5;" data-dismiss="modal">&times;</button>
				<div class="form-group">
					<input type="password" name="pin_code" class="form-control" placeholder="PIN">
				</div>
				<div class="pull-right">
					<button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
				</div>
</form>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>

<div id="serverime" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
<form action="/process.php?a=change_sname" method="POST" autocomplete="off" id="modal-pin-auth">
            	<p>Novo ime servera (ovo menja samo ime servera na panelu)</p>
            	<button type="button" class="close" style="margin-top: -40px;color: #f5f5f5;" data-dismiss="modal">&times;</button>
				<div class="form-group">
                                    	<input hidden="" type="text" name="server_id" value="<?php echo $Server_ID; ?>">
					<input class="form-control" type="text" name="new_name_srv" class="form-control" placeholder="Novo ime">
				</div>
				<div class="pull-right">
					<button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
				</div>
</form>
            </div>
        </div>
    </div>
</div>

<div id="edit_map" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                    <form action="/process.php?a=change_m_name" method="POST" autocomplete="off" id="modal-mapa">
                        <fieldset>
                            <h2>Promena default mape</h2>
                            <ul style="list-style-type: none;">
                                <li>
                                    <p>Promena default mape</p>
                                    <p>Posle promene mape pozeljno je restartovati server ili promeniti mapu.</p>
                                </li>
                                <li>
                                    <label>Ime mape (npr: de_dust2):</label>
                                    <input hidden="" type="text" name="server_id" value="<?php echo $Server_ID; ?>">
                                    <input class="form-control" type="text" name="new_map_name" placeholder="<?php echo server_i_map($Server_ID); ?>" value="<?php echo server_i_map($Server_ID); ?>" class="short">
                                </li>
                                <li style="text-align:center;">
                                    <button class="btn btn-primary"> <span class="fa fa-check-square-o"></span> Save</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal" loginClose="close"> <span class="fa fa-close"></span> Odustani </button>
                                </li>
                            </ul>
                        </fieldset>
                    </form>
                </div>        
            </div>  
        </div>
</div>

<?php } ?>

<div id="baneri" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                    <fieldset>
                    	<p><strong>Banner/Grafik</strong></p>
                        <ul style="list-style-type: none;">
                        	<center>
                        		<li><img src="/gp-banner.php?id=<?php echo $Server_ID; ?>" alt="GRAFIK" class="grafik_img"></li>
                        		
                        		<hr>

                        		<li><img src="/gp-grafik.php?id=<?php echo $Server_ID; ?>" alt="GRAFIK" class="grafik_img"></li>
                        	
                        		<hr>

                        		<button class="btn btn-primary" type="button" data-dismiss="modal" loginClose="close"> 
                        			<span class="fa fa-close"></span> Izadji 
                        		</button>
                        	</center>
                        </ul>
                    </fieldset>
                </div>        
            </div>  
        </div>
</div>

<div id="new-ticket" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header">New Ticket</div>
            <div class="modal-body">
			<form action="/process.php?a=add_newtiket" method="POST" autocomplete="off">

            	<button type="button" class="close" style="margin-top: -40px;color: #f5f5f5;" data-dismiss="modal">&times;</button>
				<div class="form-group">
					<label>Title:</label>
					<input type="text" name="ticket_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Server:</label>
					<select class="form-control" name="server_id" id="sel1">
					<option value="0">Svi serveri</option>
					<?php  
					$rootsec = rootsec();
					$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `user_id` = ?");
					$SQLSEC->Execute(array($_SESSION["user_login"]));

	                while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { ?>
	                <option value="<?php echo txt($row['id']); ?>">
	                <?php echo server_name($row['id']); ?>
	                </option>
	                <?php } ?>
  					</select>
				</div>
				<div class="form-group">
					<label>Prioritet:</label>
					<select class="form-control" name="prioritet" id="sel1">
					<option value="1">Normalno</option>
	                <option value="2">Srednje</option>
	                <option value="3">Hitno</option>
					</select>
				</div>
				<div class="form-group">
					<label>Vas problem:</label>
					<textarea class="form-control" name="ticket_txt" rows="5" id="comment"></textarea>
				</div>
				<div class="pull-right">
					<button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send Ticket</button>
				</div>
				</form>
            </div>
        </div>
    </div>
</div>

<div id="new-admin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
			<form action="/process.php?a=add_admin" method="POST" class="ui-modal-form" id="modal-pin-auth" autocomplete="off">
                        <input type="hidden" name="server_id" value="<?php echo $Server_ID; ?>">
                        <fieldset>
                            <h2>Novi admin</h2>

                            <hr>

                            <ul>
                            	<div class="add_admin_by_owner_panel">
									<label for="vrsta_admina">Vrsta admina: </label>
									<select class="form-control" name="vrsta_admina" id="vrsta_admina" required="">
										<option value="" disabled selected="selected">Izaberi</option>
										<option value="1">Nick+Sifra</option>
										<option value="2">Steam+Sifra</option>
										<option value="3">IP+Sifra</option>
									</select>
								</div> 

								<div class="add_admin_by_owner_panel">
									<label for="name_admin">Nick admina: </label>
									<input class="form-control" type="text" name="name_admin" placeholder="..." required="">
								</div> 

								<div class="add_admin_by_owner_panel">
									<label for="sifra_admina">Sifra admina: </label>
									<input class="form-control" type="text" name="sifra_admina" placeholder="..." required="">
								</div>

								<div class="add_admin_by_owner_panel">
									<label for="admin_perm">Permisije: </label>
									<select class="form-control" name="admin_perm" id="admin_perm" onchange="perm_admin()" required="">
										<option value="" disabled selected="selected">Izaberi</option>
										<option value="1">Slot</option>
										<option value="2">Slot + Imunitet</option>
										<option value="3">Obicni admin</option>
										<option value="4">Full admin</option>
										<option value="5">Head admin</option>
										<option value="6">Custom</option>
									</select>
								</div>

								<div id="adm_flag_custom" style="display:none;">
									<div class="space" style="margin-top:20px;"></div>

									<div class="flaG_">
										<ul style="list-style: none;">
										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="a"> - a - Imunitet 
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="b"> - b - Slot
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="c"> - c - amx_kick
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="d"> - d - amx_ban/unban
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="e"> - e - amx_slay/slap
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="f"> - f - amx_map
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="g"> - g - amx_cvar
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="h"> - h - amx_cfg
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="i"> - i - amx_chat
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="j"> - j - amx_vote
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="k"> - k - sv_password
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="l"> - l - amx_rcon
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="m"> - m - custom level A
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="n"> - n - custom level B
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="o"> - o - custom level C
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="p"> - p - custom level D
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="q"> - q - custom level E
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="r"> - r - custom level F
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="s"> - s - custom level G
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="t"> - t - custom level H
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="u"> - u - menu access
										</li>

										<li>
											<input id="flag_a" name="admin_flag[]" type="checkbox" value="z"> - z - user
										</li>
					</ul>
									</div>

								</div>

								<div class="space clear"></div>

								<div class="add_admin_by_owner_panel">
									<label for="comm_admin">Komentar: </label>
									<input class="form-control" type="text" name="comm_admin" placeholder="..." required="">
								</div>      
                            </ul>

                            <button class="btn btn-primary">
                            	<i class="glyphicon glyphicon-ok"></i> NAPRAVI
                           	</button>

                            <div class="space clear"></div>
                        </fieldset>
                    </form>
            </div>
        </div>
    </div>
</div>
		<script src="/assets/js/jquery-3.2.1.js"></script>
		<script src="/assets/js/bootstrap.js"></script>
		<script src="/assets/js/keystrokes.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
		$("#datum").datepicker();
		function perm_admin() {
        	var Perm 		= $('option:selected', '#admin_perm').val();
        	if (Perm == 6) {
        		$('#adm_flag_custom').show(300);
        	} else {
        		$('#adm_flag_custom').hide(300);
        	}
        }
</script>

</html>
