<?php

$filename = 'BAZA.sql';

$mysql_host = $_POST["host"];
$mysql_username = $_POST["username"];
$mysql_password = $_POST["password"];
$mysql_database = $_POST["DB"];

if(!$_GET["step"])
{
?>
<title>OBGP Instalacija</title>
<form method="post" action="/install/install.php?step=2">
<input name="host" placeholder="HOSTNAME">
<input name="username" placeholder="USERNAME">
<input name="password" type="password" placeholder="PASSWORD">
<input name="DB" placeholder="DBNAME">
<input type="submit" value="Instaliraj">
</form>

<?php
}
else if ($_GET["step"]==2)
{
$con = @new mysqli($mysql_host,$mysql_username,$mysql_password,$mysql_database);

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_errno;
    echo "<br/>Error: " . $con->connect_error;
}

$templine = '';
$lines = file($filename);
foreach ($lines as $line) {
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    $templine .= $line;
    if (substr(trim($line), -1, 1) == ';') {
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
        $templine = '';
    }
}
$connect = fopen($_SERVER['DOCUMENT_ROOT']."/core/inc/connect_db.php", "w") or die("Unable to open file!");
$connectadmin = fopen($_SERVER['DOCUMENT_ROOT']."/admin/core/inc/connect_db.php", "w") or die("Unable to open file!");

$string = '
<?php 
//ISTA BAZA IDE ZA "rootsec()" i "firewallsec()"
function rootsec() {
$servername = "'.$mysql_host.'";
$username = "'.$mysql_username.'";
$password = "'.$mysql_password.'";
$dbname = "'.$mysql_database.'";
return new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
}
function firewallsec() {
$servername = "'.$mysql_host.'";
$username = "'.$mysql_username.'";
$password = "'.$mysql_password.'";
$dbname = "'.$mysql_database.'";
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
';
fwrite($connect, $string);
fclose($connect);
fwrite($connectadmin, $string);
fclose($connectadmin);

echo "Uspesno ste instalirali OBGP, obrisite ovaj folder.";
$con->close($con);
}
?>
