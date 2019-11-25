<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

/**
* Valid plugin;
*/

function is_valid_plugin($pl_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `plugins` WHERE `id` = ?");
	$SQLSEC->Execute(array($pl_id));
	$pl_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if (!$pl_info) {
		return false;
	} else {
		return true;
	}
}

function plugin_name($pl_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `plugins` WHERE `id` = ?");
	$SQLSEC->Execute(array($pl_id));
	$pl_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($pl_info['ime']);
}

function plugin_amxx($pl_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `plugins` WHERE `id` = ?");
	$SQLSEC->Execute(array($pl_id));
	$pl_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($pl_info['prikaz']);
}

function save_plugin_name($pl_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `plugins` WHERE `id` = ?");
	$SQLSEC->Execute(array($pl_id));
	$pl_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($pl_info['text']);
}

function plugin_action($Server_ID, $Plugin_ID, $Plugin_Action_ID) {
	/* fnc plugin_action() -- $Plugin_Action_ID
		1. install
		2. remove
	*/

	$Box_ID = getBOX($Server_ID);

	if ($Plugin_Action_ID == 1) {
		if (!function_exists("ssh2_connect")) {
			$return = false;
		}

		if(!($ssh_conn = ssh2_connect(server_ip($Server_ID), box_ssh($Box_ID)))) {
		    $return = false;
		} else {
			if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
		    	$return = false;
		    } else {
		   		$stream = ssh2_shell($ssh_conn, 'xterm');

		   		fwrite($stream, 'cd /home/'.server_username($Server_ID).'/cstrike/addons/amxmodx/plugins/'.PHP_EOL);
				sleep(1);

				fwrite($stream, 'wget '.plugin_amxx($Plugin_ID).PHP_EOL);
				sleep(2);

				$add_to_pl_list = add_to_plugin_list($Server_ID, $Plugin_ID);
				if (!$add_to_pl_list) {
					$return = false;
				} else {
					$return = true;
				}
			}
		}
	} else if ($Plugin_Action_ID == 2) {
		if (!function_exists("ssh2_connect")) {
			$return = false;
		}

		if(!($ssh_conn = ssh2_connect(server_ip($Server_ID), box_ssh($Box_ID)))) {
		    $return = false;
		} else {
			if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
		    	$return = false;
		    } else {
		   		$stream = ssh2_shell($ssh_conn, 'xterm');

		   		fwrite($stream, 'cd /home/'.server_username($Server_ID).'/cstrike/addons/amxmodx/plugins/'.PHP_EOL);
				sleep(1);

				fwrite($stream, 'rm '.plugin_amxx($Plugin_ID).PHP_EOL);
				sleep(2);

				$add_to_pl_list = delete_p_line_plugin_list($Server_ID, $Plugin_ID);
				if (!$add_to_pl_list) {
					$return = false;
				} else {
					$return = true;
				}
			}
		}
	}

	return $return;
}

function add_to_plugin_list($Server_ID, $Plugin_ID) {
	if (empty($Server_ID)||empty($Plugin_ID)) {
		$return = false;
	}

	$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
	if(!$ftp_connect) {
		$return = false;
	}

	$File_Path 	= '/cstrike/addons/amxmodx/configs/';

	$File_Edit 	= file_get_contents(LoadFile($Server_ID, $File_Path.'plugins.ini')).PHP_EOL.PHP_EOL;
    $File_Edit .= "; OBGP | Auto Install plugin: ".plugin_name($Plugin_ID).PHP_EOL;
    $File_Edit .= plugin_amxx($Plugin_ID);
		
	if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
		ftp_pasv($ftp_connect, true);
		if(!empty($File_Path)) {
			ftp_chdir($ftp_connect, $File_Path);	
		}

		$folder = $_SERVER['DOCUMENT_ROOT'].'/assets/_cache/panel_'.server_username($Server_ID).'_plugins.ini';
		$fw = fopen(''.$folder.'', 'w+');
		$fb = fwrite($fw, stripslashes($File_Edit));
		$remote_file = ''.$File_Path.'/plugins.ini';
		if (ftp_put($ftp_connect, $remote_file, $folder, FTP_BINARY)){
			$return = true;
		} else {
			$return = false;
		}
		
		fclose($fw);
		unlink($folder);		
	}
	ftp_close($ftp_connect);

	return $return;
}

function delete_p_line_plugin_list($Server_ID, $Plugin_ID) {
	if (empty($Server_ID)||empty($Plugin_ID)) {
		$return = false;
	}

	$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
	if(!$ftp_connect) {
		$return = false;
	}

	$File_Path 	= '/cstrike/addons/amxmodx/configs/';
	$File_Edit = file_get_contents(LoadFile($Server_ID, $File_Path.'plugins.ini'));
    $File_Edit = str_replace("; OBGP | Auto Install plugin: ".plugin_name($Plugin_ID), "", $File_Edit);
    $File_Edit = str_replace("".plugin_amxx($Plugin_ID)."", "", $File_Edit);
    $File_Edit = str_replace("


", "", $File_Edit);
		
	if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
		ftp_pasv($ftp_connect, true);
		if(!empty($File_Path)) {
			ftp_chdir($ftp_connect, $File_Path);	
		}

		$folder = $_SERVER['DOCUMENT_ROOT'].'/assets/_cache/panel_'.server_username($Server_ID).'_plugins.ini';
		$fw = fopen(''.$folder.'', 'w+');
		$fb = fwrite($fw, stripslashes($File_Edit));
		$remote_file = ''.$File_Path.'/plugins.ini';
		if (ftp_put($ftp_connect, $remote_file, $folder, FTP_BINARY)){
			$return = true;
		} else {
			$return = false;
		}
		
		fclose($fw);
		unlink($folder);		
	}
	ftp_close($ftp_connect);

	return $return;
}


/**
* Valid plugin;
*/

function is_valid_map($map_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `maps` WHERE `id` = ?");
	$SQLSEC->Execute(array($map_id));
	$map_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	if (!$map_info) {
		return false;
	} else {
		return true;
	}
}

function map_name($map_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `maps` WHERE `id` = ?");
	$SQLSEC->Execute(array($map_id));
	$map_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	return txt($map_info['map_name']);
}

function map_file($map_id) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `maps` WHERE `id` = ?");
	$SQLSEC->Execute(array($map_id));
	$map_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return txt($map_info['map_file']);
}

function map_action($Server_ID, $Map_ID, $Map_Action_ID) {
	/* fnc map_action() -- $Map_Action_ID
		1. install
		2. remove
	*/

	$Box_ID = getBOX($Server_ID);

	if ($Map_Action_ID == 1) {
		if (!function_exists("ssh2_connect")) {
			$return = false;
		}

		if(!($ssh_conn = ssh2_connect(server_ip($Server_ID), box_ssh($Box_ID)))) {
		    $return = false;
		} else {
			if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
		    	$return = false;
		    } else {
		   		$stream = ssh2_shell($ssh_conn, 'xterm');

		   		fwrite($stream, 'cd /home/'.server_username($Server_ID).'/cstrike/maps/'.PHP_EOL);
				sleep(1);

				fwrite($stream, 'wget '.map_file($Map_ID).PHP_EOL);
				sleep(2);

				$add_to_pl_list = add_to_plugin_list($Server_ID, $Map_ID);
				if (!$add_to_pl_list) {
					$return = false;
				} else {
					$return = true;
				}
			}
		}
	} else if ($Plugin_Action_ID == 2) {
		if (!function_exists("ssh2_connect")) {
			$return = false;
		}

		if(!($ssh_conn = ssh2_connect(server_ip($Server_ID), box_ssh($Box_ID)))) {
		    $return = false;
		} else {
			if(!ssh2_auth_password($ssh_conn, box_username($Box_ID), box_password($Box_ID))) {
		    	$return = false;
		    } else {
		   		$stream = ssh2_shell($ssh_conn, 'xterm');

		   		fwrite($stream, 'cd /home/'.server_username($Server_ID).'/cstrike/addons/maps/'.PHP_EOL);
				sleep(1);

				fwrite($stream, 'rm '.map_file($Plugin_ID).PHP_EOL);
				sleep(2);

				$return = true;
			}
		}
	}

	return $return;
}

?>
