<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/db_connect.php');

$connect = firewallsec();

// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($connect, "utf8");

$client = "No";

function site_link() {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info['site_link'];
}

$prefix = "firewall_";
$site_url             = site_link();
$projectsecurity_path = site_link()."/rootsec";
?>
