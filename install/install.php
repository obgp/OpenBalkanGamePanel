<title>OBGP Instalacija</title>
<form method="post" action="">
<input name="host" placeholder="HOSTNAME">
<input name="username" placeholder="USERNAME">
<input name="password" type="password" placeholder="PASSWORD">
<input name="DB" placeholder="DBNAME">
<input type="submit" value="Instaliraj">
</form>

<?php
if(isset($_POST["submit"])){
$filename = 'BAZA.sql';
$mysql_host = $_POST["host"];
$mysql_username = $_POST["username"];
$mysql_password = $_POST["password"];
$mysql_database = $_POST["DB"];

$sql = file_get_contents($filename);

$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
if (mysqli_connect_errno()) { /* check connection */
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
if ($mysqli->multi_query($sql)) {
    echo "success";
} else {
   echo "error";
}
    
    
$connect = fopen($_SERVER['DOCUMENT_ROOT']."/core/inc/connect_db.php", "w") or die("Ispraznite bazu stavite i podesite permisije na folder /config/inc/ i pokrenite ponovo instalaciju!");
$connectadmin = fopen($_SERVER['DOCUMENT_ROOT']."/admin/core/inc/connect_db.php", "w");
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
