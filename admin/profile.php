<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == false) {
	sMSG('Morate se ulogovati!', 'error');
	redirect_to('login');
	die();
}

redirect_to('admin.php?id='.$_SESSION['admin_login']);
die();

?>