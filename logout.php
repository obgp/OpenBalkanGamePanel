<?php
	session_start();
	
	if(session_destroy()) {
		setcookie('user_login', NULL, time() - 604800);
		header('Location: /index.php');
		exit();
	}
?>