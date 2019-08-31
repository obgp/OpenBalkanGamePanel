<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	die();
}

if (cp_perm_srv_view($Server_ID) == false) {
	die();
}

///////////////////////////////////////
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