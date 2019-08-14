<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

$myfile = fopen("SendedWithGetMethod.ini", "w");

fwrite($myfile, print_r($_GET, true));

fclose($myfile);

$billing_reports_enabled = false;
$secret = '375db3f3a30407ef762eaecd91e5ee7c';
$sender = $_GET[ 'sender' ];

PrintReply( );

$user_id = userIdId( $_GET[ 'cuid' ] );
$user_name = userIme( $user_id );
$username = userName( $user_id );

$novac = convertCurrency( $_GET[ "revenue" ], $_GET[ 'currency' ], "EUR" );

$novac = round($novac, 2);

$novac = str_replace(",", ".", $novac);

$link = "SMS UPLATA";
$drzava = $_GET[ "country" ];
$d_v = date("h.m.s, d-m-Y");

if( $_GET[ 'status' ] == "completed" ) {
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `novac`=`novac`+'{$novac}' WHERE `username`='{$username}'");
	$SQLSEC->Execute();

}

function PrintReply( ) {
	$supportEmail = "support@gb-hoster.me";
	$companyName = "GB Hoster";

	echo "You purchased " . $_GET[ 'amount' ] . " " . $_GET[ 'credit_name' ] . " for " . $_GET[ 'price' ] . " " . $_GET[ 'currency' ] . ". Thank You! Support: " . $supportEmail;
}

function check_signature( $params_array, $secret ) {
	ksort( $params_array );

	$str = '';
	foreach( $params_array as $k => $v ) {
		if( $k != 'sig' )
			$str .= "$k=$v";
	}

	$str .= $secret;
	$signature = md5( $str );

	return ( $params_array[ 'sig' ] == $signature );
}

?>