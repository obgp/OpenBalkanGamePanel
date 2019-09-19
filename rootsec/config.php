<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/db_connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/rootsec/func.php');

$connect = firewallsec();

// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($connect, "utf8");

$client = "No";

$prefix = "firewall_";
$site_url             = site_link();
$projectsecurity_path = site_link()."/rootsec";
?>
