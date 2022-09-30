<?php
function rootsec() {	
$servername = "localhost";	
$username = "root";	
$password = "";	
$dbname = "obgp";	
return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);	
}	
function masterserver() {	
$servername = "localhost";	
$username = "USERNAME";	
$password = "PASSWORD";	
$dbname = "DBNAME";	
return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);	
}	
?>
