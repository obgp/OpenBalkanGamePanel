<?php 
function rootsec() {
$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";

return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
}

function firewallsec() {
$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";

return new mysqli($host, $user, $password, $database);
}

function masterserver() {
$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";

return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
}
?>
