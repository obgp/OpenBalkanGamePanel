<?php
$host     = "localhost"; // Database Host
$user     = "nerd_s"; // Database Username
$password = "astalavistabane"; // Database's user Password
$database = "nerd_s"; // Database Name
$prefix   = "firewall_"; // Database Prefix for the script tables

$connect = new mysqli($host, $user, $password, $database);

// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($connect, "utf8");

$client = "No";

$site_url             = "http://nerds-hosting.com";
$projectsecurity_path = "http://nerds-hosting.com/rootsec";
?>