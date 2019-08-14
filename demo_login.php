<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	$User_Email 		= 'demo@gb-hoster.me';
	$User_Password 		= 'demo';

	$is_ok = user_login($User_Email, $User_Password);

	if (!$is_ok) {
		sMSG('Doslo je do greske, molimo pokusajte malo kasnije.', 'error');
		redirect_to('home');
		die();
	} else {
		sMSG('Uspesno ste se ulogovali na demo nalog.', 'success');
		redirect_to('home');
		die();
	}
} else {
	sMSG('Vec ste ulogovani.', 'info');
	redirect_to('home');
	die();
}

if (is_demo($_SESSION['login']) == true) {
	sMSG('Vec ste ulogovani na demo nalog.', 'info');
	redirect_to('home');
	die();
}

?>