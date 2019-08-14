<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$Backups = mysql_query("SELECT * FROM `server_backup`");

while($row = mysql_fetch_array($Backups)) {
	$Server_ID 			=		txt($row['srvid']);
	$Backup_Name 		=		txt($row['name']);
	$BackupStatus 		=		txt($row['status']);
	$BackupSize 		=		txt($row['size']);
	$Box_ID 			=		getBOX($Server_ID);
	
	if($BackupSize == "0" && $BackupStatus == "0") {
		$BackupStatus 		=		GetBackUPStatus($Box_ID, $Server_ID, $Backup_Name);
		$BackupSize 		=		GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
	}
	
	if($BackupStatus == "Failed") {
		$BackupStatus 		=		"Failed";
		$BackupSize 		=		GetBackUPSize($Box_ID, $Server_ID, $Backup_Name);
	} else if($BackupStatus == "Copying") {
		$BackupStatus 		=		"0";
		$BackupSize 		=		"0";
	}
	
	echo "Backup Name : ".$Backup_Name."<br>";
	echo "Backup Status : ".$BackupStatus."<br>";
	echo "Backup Size : ".$BackupSize."<br><br>";
	
	mysql_query("UPDATE `server_backup` SET
		`status`	=		'$BackupStatus',
		`size`		=		'$BackupSize'
	");
	
}
?>