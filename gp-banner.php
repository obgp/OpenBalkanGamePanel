<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 



if (is_login() == false) {

    sMSG('Morate se ulogovati.', 'error');

    redirect_to('home');

    die();

}



$Server_ID = txt($_GET['id']);



if (is_valid_server($Server_ID) == false) {

	echo 'Ovaj server ne postoji';

    die();

}



/*---------------------------------------------------------------------------------*/

require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/lgsl_files/lgsl_class.php');



if (gp_game_id($Server_ID) == 1) {

    $game_name = 'halflife';

    $server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');



    $Srv_Id_Status = @$server_info['b']['status'] == '1';



    if(@$server_info['b']['status'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$server_info['s']['name'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];



    $Server_Map         = @$server_info['s']['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }



} else if (gp_game_id($Server_ID) == 2) {

    $game_name = 'samp';

    $server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');



    $Srv_Id_Status = @$server_info['b']['status'] == '1';



    if(@$server_info['b']['status'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$server_info['s']['name'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];



    $Server_Map         = @$server_info['s']['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }



} else if (gp_game_id($Server_ID) == 3) {

    #Include GameQ-3

    require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/gameq/src/GameQ/Autoloader.php');



    $game_name = 'minecraft';



    $GameQ = new \GameQ\GameQ();

    $GameQ->addServer([

        'type' => $game_name,

        'host' => server_ip($Server_ID).':'.server_port($Server_ID),

    ]);

    $GameQ->setOption('timeout', 3); // seconds

    $results = $GameQ->process();

    //print_r($results);



    $Srv_Id_Status = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1';



    if(@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['numplayers'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['maxplayers'];



    $Server_Map         = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }

} else if (gp_game_id($Server_ID) == 4) {

    $game_name = 'callofduty2';

    $server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');



    $Srv_Id_Status = @$server_info['b']['status'] == '1';



    if(@$server_info['b']['status'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$server_info['s']['name'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];



    $Server_Map         = @$server_info['s']['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }



} else if (gp_game_id($Server_ID) == 5) {

    $game_name = 'callofduty4mw';

    $server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');



    $Srv_Id_Status = @$server_info['b']['status'] == '1';



    if(@$server_info['b']['status'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$server_info['s']['name'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];



    $Server_Map         = @$server_info['s']['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }



} else if (gp_game_id($Server_ID) == 6) {

    #Include ts3admin.class.php

    require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/ts/lib/ts3admin.class.php');

    #build a new ts3admin object

    $tsAdmin = new ts3admin(server_ip($Server_ID), 10011);



    if($tsAdmin->getElement('success', $tsAdmin->connect())) {

        #login as serveradmin

        $tsAdmin->login(server_username($Server_ID), server_password($Server_ID));

        

        #select teamspeakserver

        $tsAdmin->selectServer(server_port($Server_ID));



        //print_r($clients);

    } else {

        //Error.

        sMSG('Doslo je do greske.', 'error');

    }



    #get serverInfo

    $ts_s_info      = $tsAdmin->serverInfo();



    #poke client

    if (isset($_POST['c_id']) && isset($_POST['poke_msg']) && isset($_POST['poke_true'])) {

        $Client_ID  = txt($_POST['c_id']);

        $Poke_MSG   = txt($_POST['poke_msg']);



        $poke_msg_ok = $tsAdmin->clientPoke($Client_ID, $Poke_MSG);

        if (!$poke_msg_ok) {

            sMSG('Doslo je do greske.', 'error');

            redirect_to('gp-server.php?id='.$Server_ID);

            die();

        } else {

            sMSG('Uspesno ste izvrsili komandu.', 'success');

            redirect_to('gp-server.php?id='.$Server_ID);

            die();

        }

    }



    #kick client

    if (isset($_POST['c_id']) && isset($_POST['kick_msg']) && isset($_POST['kick_true'])) {

        $Client_ID  = txt($_POST['c_id']);

        $Kick_MSG   = txt($_POST['kick_msg']);



        $kick_msg_ok = $tsAdmin->clientKick($Client_ID, 'server', $Kick_MSG);

        if (!$kick_msg_ok) {

            sMSG('Doslo je do greske.', 'error');

            redirect_to('gp-server.php?id='.$Server_ID);

            die();

        } else {

            sMSG('Uspesno ste izvrsili komandu.', 'success');

            redirect_to('gp-server.php?id='.$Server_ID);

            die();

        }

    }



    $Server_Online  = txt($ts_s_info['data']['virtualserver_status']);



    if($Server_Online == 'online') {

        $Server_Online = 'Online'; 

        $Srv_Id_Status = 0;

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

            $Srv_Id_Status = 0;

        } else {

            $Server_Online = 'Offline';

            $Srv_Id_Status = 0;

        }

    }



    $Server_Name    = txt($ts_s_info['data']['virtualserver_name']);



    $Server_Players = txt($ts_s_info['data']['virtualserver_clientsonline'].'/'.$ts_s_info['data']['virtualserver_maxclients']);



    $ts_s_platform  = txt($ts_s_info['data']['virtualserver_platform']);

    $ts_s_version   = txt($ts_s_info['data']['virtualserver_version']);

    $ts_s_pass      = txt($ts_s_info['data']['virtualserver_password']);

    if ($ts_s_pass == '') {

        $ts_s_pass = "<span style='color:red;'>No</span>";

    } else {

        $ts_s_pass = "<span style='color:#54ff00;'>Yes</span>";

    }



    $ts_s_autostart = txt($ts_s_info['data']['virtualserver_autostart']);



    if ($ts_s_autostart == 1) {

        $ts_s_autostart = "<span style='color:#54ff00;'>Yes</span>";

    } else {

        $ts_s_autostart = "<span style='color:red;'>No</span>";

    }



    $Server_Map         = @$server_info['s']['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }



    if(isset($ts_s_info['data']['virtualserver_uptime'])) {

        $ts_s_uptime = $tsAdmin->convertSecondsToStrTime(($ts_s_info['data']['virtualserver_uptime']));

    } else {

        $ts_s_uptime = '-';

    }

} else if (gp_game_id($Server_ID) == 7) {

    $game_name = 'source';

    $server_info = lgsl_query_live($game_name, server_ip($Server_ID), NULL, server_port($Server_ID), NULL, 's');



    $Srv_Id_Status = @$server_info['b']['status'] == '1';



    if(@$server_info['b']['status'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$server_info['s']['name'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$server_info['s']['players'].'/'.@$server_info['s']['playersmax'];



    $Server_Map         = @$server_info['s']['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }

} else if (gp_game_id($Server_ID) == 8) {

    #Include GameQ-3

    require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/gameq/src/GameQ/Autoloader.php');



    $game_name = 'mta';



    $GameQ = new \GameQ\GameQ();

    $GameQ->addServer([

        'type' => $game_name,

        'host' => server_ip($Server_ID).':'.server_port($Server_ID),

    ]);

    $GameQ->setOption('timeout', 3); // seconds

    $results = $GameQ->process();

    //print_r($results);



    $Srv_Id_Status = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1';



    if(@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['max_players'];



    $Server_Map         = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }

} else if (gp_game_id($Server_ID) == 9) {

    #Include GameQ-3

    require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/gameq/src/GameQ/Autoloader.php');



    $game_name = 'arkse';



    $GameQ = new \GameQ\GameQ();

    $GameQ->addServer([

        'type' => $game_name,

        'host' => server_ip($Server_ID).':'.server_port($Server_ID),

    ]);

    $GameQ->setOption('timeout', 3); // seconds

    $results = $GameQ->process();

    //print_r($results);



    $Srv_Id_Status = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1';



    if(@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_online'] == '1') {

        $Server_Online = 'Online'; 

    } else {

        if (server_is_start($Server_ID) == true) {

            $Server_Online = 'Offline';

        } else {

            $Server_Online = 'Offline';

        }

    }



    $Server_Name        = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['gq_hostname'];

    if ($Server_Name == "") {

        $Server_Name = "n/a";

    }



    $Server_Players     = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['num_players'].'/'.@$results[server_ip($Server_ID).':'.server_port($Server_ID)]['max_players'];



    $Server_Map         = @$results[server_ip($Server_ID).':'.server_port($Server_ID)]['map'];

    if ($Server_Map == "") {

        $Server_Map = "n/a";

    }

}

/*---------------------------------------------------------------------------------*/



header('Content-type: image/png');



if (!function_exists('imagettftextblur')) {

    function imagettftextblur(&$image, $size, $angle, $x, $y, $color, $fontfile, $text, $blur_intensity = null) {

        $blur_intensity = !is_null($blur_intensity) && is_numeric($blur_intensity) ? (int)$blur_intensity : 0;

        if ($blur_intensity > 0) {

            $text_shadow_image = imagecreatetruecolor(imagesx($image),imagesy($image));

            imagefill($text_shadow_image,0,0,imagecolorallocate($text_shadow_image,0x00,0x00,0x00));

            imagettftext($text_shadow_image,$size,$angle,$x,$y,imagecolorallocate($text_shadow_image,0xFF,0xFF,0xFF),$fontfile,$text);

            for ($blur = 1;$blur <= $blur_intensity;$blur++) {

                imagefilter($text_shadow_image,IMG_FILTER_GAUSSIAN_BLUR);

            }

            

            for ($x_offset = 0;$x_offset < imagesx($text_shadow_image);$x_offset++) {

                for ($y_offset = 0;$y_offset < imagesy($text_shadow_image);$y_offset++) {

                    $visibility = (imagecolorat($text_shadow_image,$x_offset,$y_offset) & 0xFF) / 255;

                    if ($visibility > 0){

                        imagesetpixel($image,$x_offset,$y_offset,imagecolorallocatealpha($image,($color >> 16) & 0xFF,($color >> 8) & 0xFF,$color & 0xFF,(1 - $visibility) * 127));

                    }

                }

            }

            imagedestroy($text_shadow_image);

        } else {

            return imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);

        }

    }

}



function LoadPNG($location) {

    $image = @imagecreatefrompng($location);



    if(!$image) {

        $image      = imagecreatetruecolor(560, 95);

        $bgcolor    = imagecolorallocate($image, 10, 27, 36);

        $white      = imagecolorallocate($image, 255, 255, 255);

        $gh_color   = imagecolorallocate($image, 209, 229, 149);



        imagefilledrectangle($image, 0, 0, 560, 95, $bgcolor);



        imagestring($image, 6, 15, 30, 'ERROR', $white);

        imagestring($image, 5, 15, 45, 'Error loading ' . $location, $gh_color);

    }



    return $image;

}



$image      = LoadPNG($_SERVER['DOCUMENT_ROOT'].'/assets/img/banner/cs.png');



$white      = imagecolorallocate($image, 255, 255, 255);

$black      = imagecolorallocate($image, 0, 0, 0);

$gh_color   = imagecolorallocate($image, 209, 229, 149);

$font       = $_SERVER['DOCUMENT_ROOT'].'/assets/fonts/zekton.ttf';





if ($Srv_Id_Status == 0) {

    /*offline*/

    $status = imagecolorallocate($image, 200, 0, 0);

} else {

    /*online*/

    $status = imagecolorallocate($image, 20, 200, 0);

}





// Server name

imagettftextblur($image, 10, 0, 35 + 1, 50 + 1, $black, $font, $Server_Name, 0);

imagettftextblur($image, 10, 0, 35, 50, $white, $font, $Server_Name);



// IP address

imagettftextblur($image, 10, 0, 35 + 1, 88 + 1, $black, $font, server_full_ip($Server_ID), 0);

imagettftextblur($image, 10, 0, 35, 88, $white, $font, server_full_ip($Server_ID));



// Status

imagettftextblur($image, 10, 0, 210 + 1, 88 + 1, $black, $font, $Server_Online, 0);

imagettftextblur($image, 10, 0, 210, 88, $status, $font, $Server_Online);



// Map

imagettftextblur($image, 10, 0, 35 + 1, 126 + 1, $black, $font, $Server_Map, 0);

imagettftextblur($image, 10, 0, 35, 126, $white, $font, $Server_Map);



// Players

imagettftextblur($image, 10, 0, 155 + 1, 126 + 1, $black, $font, $Server_Players, 0);

imagettftextblur($image, 10, 0, 155, 126, $white, $font, $Server_Players);



// Rank

imagettftextblur($image, 10, 0, 225 + 1, 126 + 1, $black, $font, '#1', 0);

imagettftextblur($image, 10, 0, 225, 126, $white, $font, '#1');



//Finish!

imagepng($image);

imagedestroy($image);



?>