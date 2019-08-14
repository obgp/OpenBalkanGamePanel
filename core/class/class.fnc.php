<?php

/**
* 
*/

function update_cron() {
	$CronName = basename($_SERVER["SCRIPT_FILENAME"], '.php');

	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `crons` WHERE `cron_name` = ?");
	$SQLSEC->Execute($CronName);
	
	if( $SQLSEC->rowCount() == 1 ) {
		$SQLSEC = $rootsec->prepare("UPDATE `crons` SET `cron_value` = ? WHERE `cron_name` = ?");
		$SQLSEC->Execute($CronName, date('Y-m-d H:i:s'));
	} else {
		$SQLSEC = $rootsec->prepare("INSERT INTO `crons` SET `cron_name` = ?, `cron_value` = ?" );
		$SQLSEC->Execute($CronName, date('Y-m-d H:i:s'));
	}
}

function client_activity() {
	$rootsec = rootsec();

	if (is_login() == true) {
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `lastactivity` = ? WHERE `klijentid` = '".$_SESSION['user_login']."'");
		$SQLSEC->Execute(array(time()));
	}
}

function random_string($key) {
	$r_key = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
	$string = str_shuffle($r_key);
	$random_pw = substr($string, 0, $key);

	return $random_pw;
}

function random_n_key($key) {
	$r_key = "1234567890";
	$string = str_shuffle($r_key);
	$random_pw = substr($string, 0, $key);

	return $random_pw;
}

function random_s_key($length = 32, $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890") {
	$chars_length = strlen( $chars ) - 1;
    $string = $chars[rand( 0, $chars_length )];
    $i = 1;
    while ( $i < $length ) {
        $r = $chars[rand( 0, $chars_length )];
        if ( $r != $string[$i - 1] ) {
            $string .= $r;
        }
        $i = strlen( $string );
    }

    return $string;
}

function get_size( $size ) {
	if ( $size < 0 - 1 )
	{
		return 'Nepoznato';
	}
    if ( $size < 1024 )
	{
		return round( $size, 2 )." Byte";
	}
	if ( $size < 1024 * 1024 )
	{
		return round( $size / 1024, 2 )." Kb";
	}
	if ( $size < 1024 * 1024 * 1024 )
	{
		return round( $size / 1024 / 1024, 2 )." Mb";
	}
	if ( $size < 1024 * 1024 * 1024 * 1024 )
	{
		return round( $size / 1024 / 1024 / 1024, 2 )." Gb";
	}
	if ( $size < 1024 * 1024 * 1024 * 1024 * 1024 )
	{
		return round( $size / 1024 / 1024 / 1024 / 1024, 2 )." Tb";
	}
}

function cs_cfg($find, $s_id) {
	$file = 'ftp://'.server_username($s_id).':'.server_password($s_id).'@'.server_ip($s_id).':21/cstrike/server.cfg';
				
	$contents = file_get_contents($file);
	
	$pattern = preg_quote($find, '/');

	$pattern = "/^.*$pattern.*\$/m";

	if(preg_match_all($pattern, $contents, $matches)) {
	   $text = implode("\n", $matches[0]);
	   $g = explode('"', $text);

	   return $g[1];
	}
}

?>