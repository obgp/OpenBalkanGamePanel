<?php


/**

* Site Name;

* Site Version;

* Site Developer;

* Site Link;

* Site Lang;

* Site Backup;

* Site Cron;

* Site Active;

*/


function GT_Site_Name() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info["gt"];
	
}



function site_name() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info["site_name"]);

}



function site_version() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_version']);

}



function site_developer() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_developer']);

}



function site_link() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_link']);

}



function site_lang() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_lang']);

}



function site_backup() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_backup']);

}



function site_cron() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_cron']);

}



function c_add_server() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['client_add_srw']);

}



function site_active() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_active']);

}


function site_noreply_mail() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return txt($get_site_info['site_noreply_mail']);

}

function paymentmail() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info['paymentmail'];

}

function fortumosecretkey() {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info['fmtsecret'];
}

function cryptopubkey() {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info['cryptokey'];
}

function fdllink() {

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info["fdllink"];
	
}

?>
