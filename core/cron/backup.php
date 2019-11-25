<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$rootsec = rootsec();
$SQLSEC = $rootsec->prepare("SELECT * FROM `server_backup`");
$SQLSEC->Execute();

while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) {
	$Server_ID 		=		txt($row['srvid']);
	$Backup_Name 		=		txt($row['name']);
	$BackupStatus 		=		txt($row['status']);
	$BackupSize 		=		txt($row['size']);
	$Box_ID 		=		getBOX($Server_ID);
	
	if($BackupSize == "0" && $BackupStatus == "0") {
		$BackupStatus 	=		GetBackUPStatus($Box_ID, $Server_ID, $Backup_Name);
		$BackupSize 	=		GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
	}
	if($BackupStatus == "Failed") {
		$BackupStatus 	=		"Failed";
		$BackupSize 	=		GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
	} else if($BackupStatus == "Copying") {
		$BackupStatus 	=		"0";
		$BackupSize 	=		"0";
	}
	
	$SQLSEC = $rootsec->prepare("UPDATE `server_backup` SET `status` = ?, `size` = ?");
	$SQLSEC->Execute(array($BackupStatus, $BackupSize));
	
	echo "Backup Name : ".$Backup_Name." | Backup Status : ".$BackupStatus." | ".$BackupSize."<hr>";
}
?>
