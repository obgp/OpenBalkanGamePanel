<?php
	session_start();
	
	if(session_destroy()) {
		setcookie('admin_login', NULL, time() - 604800);
		header('Location: /admin/login');
		exit();
	}
?>