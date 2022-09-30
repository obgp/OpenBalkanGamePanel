<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Open Balkan GamePanel Installer</title>
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
   
    <div class="container">
        <h2>Open Balkan GamePanel Instaler</h2>  <hr>
 
        <form action="" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="Host">DB HOST:</label>
                <input class="form-control" id="Host" placeholder="localhost" value="localhost" name="Host">
            </div>
            <div class="form-group">
                <label for="User">DB Username:</label>
                <input class="form-control" id="User" placeholder="username" name="User">
            </div>
            <div class="form-group">
                <label for="Pass">DB Password:</label>
                <input class="form-control" id="Pass" placeholder="password" name="Pass">
            </div>
            <div class="form-group">
                <label for="DN_Name">DB Name:</label>
                <input class="form-control" id="DN_Name" placeholder="name" name="DB_Name">
            </div>
            <div class="form-gorup" style="float:right;">
                <button type="submit" name="install" class="btn btn-danger">Instaliraj</button>
            </div>
        </form>
    </div>
 
</body>
</html>
<?php
 
/* Configure */
if (isset($_POST['install'])) {
    $POST       = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
 
    //Get information
    $Host       = htmlspecialchars(trim($POST['Host']), ENT_QUOTES);
    $User       = htmlspecialchars(trim($POST['User']), ENT_QUOTES);
    $Pass       = htmlspecialchars(trim($POST['Pass']), ENT_QUOTES);
    $DB_Name    = htmlspecialchars(trim($POST['DB_Name']), ENT_QUOTES);
 
    //Save
    importujbazu($Host, $User, $Pass, $DB_Name);
}

function importujbazu($mysql_host, $mysql_username, $mysql_password, $mysql_database) {
    $FileArr = Array(
        'panel' => $_SERVER['DOCUMENT_ROOT'].'/core/inc/db_connect.php',
        'admin' => $_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php' //$_SERVER['DOCUMENT_ROOT'].'/core/inc/db_connect.php';
    );
    $filename = 'BAZA.sql';
    $con = @new mysqli($mysql_host,$mysql_username,$mysql_password,$mysql_database);
     
    if ($con->connect_errno) {
        echo "Greška prilikom konektovanja baze: " . $con->connect_errno;
    }
     
    $templine = '';
    $lines = file($filename);
    foreach ($lines as $line) {
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
     
        $templine .= $line;
        if (substr(trim($line), -1, 1) == ';') {
            $con->query($templine) or print ("Dogodila se greska prilikom importovanja baze!");
            $templine = '';
        }
    }
    $con->close();
    if (!SaveCondig($mysql_host, $mysql_username, $mysql_password, $mysql_database, $FileArr['panel'],1)) {
        die('Nesto nije ok :(');
    }
    if (!SaveCondig($mysql_host, $mysql_username, $mysql_password, $mysql_database, $FileArr['admin'],2)) {
        die('Nesto nije ok :(');
    } else {
        die('OBGP je uspesno instaliran!');
    }
} 
//Save information
function SaveCondig($Host, $User, $Pass, $DB_Name, $FileLoc, $type) {
$OpenFile = fopen($FileLoc, 'w') or die("Unable to open file!");
if($type==1) {
$SaveOvo = '<?php
function rootsec() {
    $servername = "'.$Host.'";
    $username = "'.$User.'";
    $password = "'.$Pass.'";
    $dbname = "'.$DB_Name.'";
    return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
}
function masterserver() {
    $servername = "localhost";
    $username = "USERNAME";
    $password = "PASSWORD";
    $dbname = "DBNAME";
    return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
}
?>';
} else if($type==2){
	$SaveOvo = '<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	ob_start();
	date_default_timezone_set("Europe/Belgrade");
	if ($_SERVER["HTTP_HOST"] == "localhost") {
		// Database for localhost (Not-Live)
		function rootsec() {
			$servername = "'.$Host.'";
			$username   = "'.$User.'";
			$password   = "'.$Pass.'";
			$dbname     = "'.$DB_Name.'";
			return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
		}
	} else {
		//Database for Live
		function rootsec() {
			$servername = "'.$Host.'";
			$username   = "'.$User.'";
			$password   = "'.$Pass.'";
			$dbname     = "'.$DB_Name.'";
			return new PDO("mysql:host=".$servername.";dbname=$dbname", $username, $password);
		}
	}
	/**
	* Include file 
	*/
	include_once($_SERVER["DOCUMENT_ROOT"]."/admin/core/inc/inc.php");

	echo admin_activity();
	?>';
}
 
    $pr = fwrite($OpenFile, $SaveOvo);
    fclose($OpenFile);
 
    if (!$pr) {
        return false;
    } else {
        return true;
    }
}
 
?>
