<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

function send_mail($From, $FromName, $Subject, $Body, $Adress) {
	require $_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->IsHTML(true);
	$mail->Username = "csmodovi@gmail.com";
	$mail->Password = "csmods123";
	
	$mail->From			=	$From;
	$mail->FromName		=	$FromName;
	$mail->Subject		=	$Subject;
	$mail->Body			=	$Body;
	$mail->AddAddress($Adress);
	
	if(!$mail->Send()) {
		return $mail->ErrorInfo;
	} else {
		return "Uspesno";
	}
}

//echo send_mail("noreply@gb-hoster.me", "Test", "Test", "Test", "jevtic.zec@gmail.com");

function get_security_message($UserID, $Action) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
	$SQLSEC->Execute(array($_SESSION['user_login']));
	$UserInfo = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	return "<b>".$UserInfo['ime']." ".$UserInfo['prezime']."</b>
	Neko je upravo izvrsio akciju : <b>".$Action."</b>
	IP : ".host_ip()."";
}

?>