<?php
   if (gp_game_id($Server_ID) == 6) {
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
	?>