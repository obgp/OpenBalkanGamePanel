<?php
function site_link() {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `site_settings`");
	$SQLSEC->Execute();
	$get_site_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	return $get_site_info['site_link'];
}
?>
