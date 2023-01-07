<?php 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('servers');
	die();
}

?>
		<div class="container">
			<div class="rows">
				<div class="contect">
				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/nav.php'); ?>
					<div class="col-md-9"><span class="server-name"><?php echo server_name($Server_ID); ?></span></div>
					<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/komande.php'); ?>
					<div class="space1"></div>
					<div class="col-md-12">
		                        <div id="konzolaajax" server_id="<?php echo $Server_ID; ?>">
<pre style="width:100%;height:550px;background:none;color:#fff;">
<?php
    if(!($con = ssh2_connect(server_ip($Server_ID), box_ssh(getBOX($Server_ID))))) { 
        return "error";
    } else {
        if(!ssh2_auth_password($con, box_username(getBOX($Server_ID)), box_password(getBOX($Server_ID)))) {
            return "error";
        } else {
            $stream = ssh2_exec($con, "cat /home/".server_username($Server_ID)."/screenlog.0"); 
            stream_set_blocking($stream, true );

            $resp = '';
            $text = '';

            while ($line=fgets($stream)){ 
                if (!preg_match("/rm log.log/", $line) || !preg_match("/Creating bot.../", $line)){
                    $resp .= $line; 
                }
            } 

            if(empty($resp)){ 
                $result_info = "Could not load console log";
            } else { 
                $result_info = $resp;
            }
        }
    }

    $result_info = str_replace("/home", "", $result_info);
    $result_info = str_replace("/home", "", $result_info);  
    $result_info = str_replace(">", "", $result_info);

    if(gp_game_id($Server_ID) == 2) {
		$filename = LoadFile($Server_ID, 'server_log.txt');
		$text .= file_get_contents($filename);
		echo $text;
    } else {
		$text .= htmlspecialchars($result_info);
		echo $text;
    }
?>
</pre>
									<?php if (server_game_id($Server_ID) == 1) {
		                                $rcon_provera = cs_cfg('rcon_password', $Server_ID);
		                                if(!$rcon_provera == "") { ?>
		                                    <form action="" method="POST">
		                                        <input  hidden="" type="text" name="server_id" value="<?php echo $Server_ID; ?>" required="">
		                                        <input class="form-control" type="text" name="komanda" placeholder="amx_map <mapname>" required="" style="background: none;border: 1px solid #ccc;padding: 5px 10px;border-radius: 2px;color: #fff;width: 250px;">
		                                        <button style="background: none;padding: 5px 10px;border: 1px solid #ccc;border-radius: 2px;color: #fff;">></button>
		                                    </form>
		                                    <p style="color:#ccc;"><span style="color:red;">(napomena)</span> koristite input bez zagrada, navodnika i html znakova jer u suprotnom skripta nece raditi kako treba!</p>
		                                <?php }
		                            } ?>
		                        </div>
		                    </div>
		                </div>
                    </div>
