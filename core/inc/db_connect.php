<?php
function rootsec() {
    $servername = "localhost";
    $username = "root";
    $password = "1312";
    $dbname = "obgp";
    return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
}
function masterserver() {
    $servername = "localhost";
    $username = "USERNAME";
    $password = "PASSWORD";
    $dbname = "DBNAME";
    return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
}
?>