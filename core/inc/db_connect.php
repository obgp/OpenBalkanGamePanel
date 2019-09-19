<?php 
//ISTA BAZA IDE ZA "rootsec()" i "firewallsec()"
function rootsec() {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obgp";
return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
}
function firewallsec() {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obgp";
return new mysqli($servername, $username, $password, $dbname);
}
function masterserver() {
$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";
return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
}
?>
