<div class="navbar">
<ul class="nav navbar-nav" style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;border: 1px solid #3368b7a6;">
                        <li><a href="server?id=<?php echo $Server_ID; ?>">Server</a></li>
		                <!--<li><a href="config?id=<?php echo $Server_ID; ?>">Podesavanje</a></li>-->
		                <?php if (gp_game_id($Server_ID) == 1) { ?>
		                    <li><a href="admins?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
		                    <li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="plugins?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li class="nav_s_active"><a href="maps?id=<?php echo $Server_ID; ?>">Map installer</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="boost?id=<?php echo $Server_ID; ?>">Boost</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 2) { ?>
		                	<li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 3) { ?>
		                	<li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 4) { ?>
		                	<li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                	<li><a href="plugins?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 5) { ?>
		                	<li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                	<li><a href="plugins?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 6) { ?>
		                	<li><a href="admins?id=<?php echo $Server_ID; ?>">Admini</a></li>
		                	<li><a href="ts-bans?id=<?php echo $Server_ID; ?>">Banovani</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 7) { ?>	
		                	<li><a href="admins?id=<?php echo $Server_ID; ?>">Admini i slotovi</a></li>
		                    <li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="plugins?id=<?php echo $Server_ID; ?>">Plugini</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="boost?id=<?php echo $Server_ID; ?>">Boost</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 8) { ?>
		                	<li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
		                <?php } else if (gp_game_id($Server_ID) == 9) { ?>
		                	<li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
                        <?php } else { ?>
                            <li><a href="webftp?id=<?php echo $Server_ID; ?>">WebFTP</a></li>
		                    <li><a href="mods?id=<?php echo $Server_ID; ?>">Modovi</a></li>
		                    <li><a href="console?id=<?php echo $Server_ID; ?>">Konzola</a></li>
		                    <li><a href="autorestart?id=<?php echo $Server_ID; ?>">Autorestart</a></li>
                        <?php } ?>
                        </ul>
</div>