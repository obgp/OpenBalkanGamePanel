<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Server_ID = txt($_GET['id']);

if (is_valid_server($Server_ID) == false) {
	sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
	redirect_to('gp-servers.php');
	die();
} else {
	sMSG('Ova stranica je nedostupna za vas, trenutno se radi na popoljsavanju trenutnih funkcija!', 'info');
	redirect_to('gp-server.php?id='.$Server_ID);
	die();
}
?>