<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

/**
* User login;
* User INFO;
* UserName;
*/

if (isset($_GET['a']) && $_GET['a'] == "login") {
	$User_Email 		= txt($_POST['email']);
	$User_Password 		= txt($_POST['password']);

	if (empty($User_Email) && $User_Email == "") {
		sMSG("Polje 'Username OR Email' je prazno, molimo popunite ga.", 'error');
		redirect_to('home');
		die();
	} else if (empty($User_Password) && $User_Password == "") {
		sMSG("Polje 'Password' je prazno, molimo popunite ga.", 'error');
		redirect_to('home');
		die();
	} else {
		// Login : INPUT : Email and Password.
		$is_ok = user_login($User_Email, $User_Password);
		if (!$is_ok) {
			sMSG('Podaci za prijavu nisu tacni!', 'error');
			redirect_to('home');
			die();
		} else {
			$rootsec = rootsec();

			$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ?");
			$SQLSEC->Execute(array($_SESSION['user_login']));
			$user = $SQLSEC->fetch(PDO::FETCH_ASSOC);
			
			if($user['mail']) {
				send_mail(site_noreply_mail(), "Security Information System", "Security Information System", get_security_message($_SESSION['user_login'], "Login"), $user['email']);
			}
			
			sMSG(user_name($_SESSION['user_login']).', dobrodosli nazad.', 'success');
			redirect_to('home');
			die();
		}
	}

	redirect_to('home');
	die();
}

if (isset($_GET['a']) && $_GET['a'] == "register") {
	$User_Ime			=	txt($_POST['ime']);
	$User_Prezime		=	txt($_POST['prezime']);
	$User_Username		=	txt($_POST['username']);
	$User_Email			=	txt($_POST['email']);
	$User_Password		=	txt($_POST['pass']);
	$User_Password2		=	txt($_POST['pass2']);
	$User_SigCodC		=	txt($_POST['sig_kod_c']);
	$User_SigCod		=	txt($_SESSION['sig_kod']);
	$User_Drzava		=	txt($_POST['drzava']);
	$User_PinCode		=	txt($_POST['pin_code']);
	$User_Token			=	txt($_POST['token']);
	$Reg_User			=	date('m.d.Y, H:i');
	
	if ($User_SigCodC != $User_SigCod) {
		sMSG("Sigurnosni kod nije tacan! $User_SigCodC | $User_SigCod", 'error');
		redirect_to('register.php');
		die();
	} else {
		if ($User_Password != $User_Password2) {
			sMSG("Sigurnosni kod nije tacan!", 'error');
			redirect_to('register.php');
			die();
		} else {
			if(!is_user_info_free($User_Email, $User_Username)) {
				sMSG("Nalog sa ovim podacima vec postoji!", 'error');
				redirect_to('register.php');
				die();
			} else {
				$User_Password = md5($User_Password);
				$rootsec = rootsec();

				$SQLSEC = $rootsec->prepare("INSERT INTO `klijenti` (`klijentid`, `username`, `sifra`, `ime`, `prezime`, `email`, `novac`, `status`, `kreiran`, `zemlja`, `avatar`, `cover`, `sigkod`, `token`, `mail`) VALUES (NULL, ?, ?, ?, ?, ?, '0', '1', ?, ?, 'avatar.png', 'cover.png', ?, ?, '1')");
				$drkamkurac = $SQLSEC->Execute(array($User_Username, $User_Password, $User_Ime, $User_Prezime, $User_Email, $Reg_User, $User_Drzava, $User_PinCode, $User_Token));

				if (!$drkamkurac) {
					sMSG('Doslo je do greske, molimo pokusajte opet malo kasnije.', 'error');
					redirect_to('register.php');
					die();
				} else {
					send_mail(site_noreply_mail(), "Register", "Register", "Register", $User_Email);
					sMSG('Uspesno ste kreirali nalog!', 'success');
					redirect_to('index.php');
					die();
				}
			}
		}
	}

	redirect_to('home');
	die();
}

if (isset($_GET['a']) && $_GET['a'] == "enterPinCode") {
	if (is_user_pin() == false) {
		$pin_code 		= txt($_POST['pin_code']);
		$rootsec = rootsec();

		$SQLSEC = $rootsec->prepare("SELECT * FROM `klijenti` WHERE `klijentid` = ? AND `sigkod` = ?");
		$SQLSEC->Execute(array($_SESSION["user_login"], $pin_code));
		$p_pin_ = $SQLSEC->fetch(PDO::FETCH_ASSOC);
		if (!$p_pin_) {
			sMSG('Pin code nije validan.', 'error');
			header("Location: ".$_SERVER['HTTP_REFERER']);
			die();
		} else {
			$_SESSION['code'] = md5($p_pin_['sigkod'].time());

			sMSG('Uspesno ste unijeli Pin code.', 'success');
			header("Location: ".$_SERVER['HTTP_REFERER']);
			die();
		}
	} else {
		header("Location: ".$_SERVER['HTTP_REFERER']);
		die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "add_newtiket") {
	$Server_ID 		= txt($_POST['server_id']);
	$Ticket_Name 	= txt($_POST['ticket_name']);
	$Ticket_MSG 	= txt($_POST['ticket_txt']);
	$Ticket_Pro 	= txt($_POST['prioritet']);
	$Ticket_Date 	= date('m.d.Y, H:i');

	if ($Server_ID == '0') {
		$Server_ID = '0';
	} else {
		if (is_valid_server($Server_ID) == false) {
			sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
			redirect_to('gp-new_ticket.php');
			die();
		}
	}

	if (empty($Ticket_Name)||empty($Ticket_MSG)||$Ticket_Name == ''||$Ticket_MSG == '') {
		sMSG('Potrebno je popuniti sva polja!', 'error');
		redirect_to('gp-new_ticket.php');
		die();
	}
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("INSERT INTO `tiketi` (`id`, `admin_id`, `server_id`, `user_id`, `status`, `prioritet`, `vrsta`, `datum`, `naslov`, `text`, `billing`, `admin`, `otvoren`) VALUES (NULL, '0', ?, ?, '1', ?, ?, ?, ?, ?, '0', '0', ?);");
	$drkamkurac = $SQLSEC->Execute(array($Server_ID, $_SESSION["user_login"], $Ticket_Pro, $Ticket_Pro, $Ticket_Date, $Ticket_Name, $Ticket_MSG, $Ticket_Date));

	if (!$drkamkurac) {
		sMSG('Doslo je do greske, molimo pokusajte opet malo kasnije.', 'error');
		redirect_to('gp-support.php');
		die();
	} else {
	/*	$Ticket_ID = $SQLSEC->lastInsertId();
		$Ticket_Red = ticket_new_red();
		if ($Ticket_Red == 0) {
			$Ticket_Red = 1;
		}

		$SQLSEC = $rootsec->prepare("INSERT INTO `ticket_red` (`id`, `ticket_id`, `red`, `status`) VALUES (NULL, ?, ?, '1');");
		$SQLSEC->Execute(array($Ticket_ID, $Ticket_Red));*/
		
		sMSG('Uspesno ste otvorili novi tiket.', 'success');
		redirect_to('gp-support.php');
		die();
	}

}

if (isset($_GET['a']) && $_GET['a'] == "ticket_add_odg") {
	$Ticket_ID 		= txt($_POST['tiket_id']);
	$Ticket_MSG 	= txt($_POST['tiket_odg']);
	$Ticket_Date 	= date('m.d.Y, H:i');

	if (is_valid_ticket($Ticket_ID) == false) {
		sMSG('Ovaj tiket ne postoji ili nemate pristup istom.', 'error');
		redirect_to('gp-support.php');
		die();
	}

	if (empty($Ticket_MSG) || $Ticket_MSG == '') {
		sMSG('Molimo pookusajte opet, polje: "Dodaj odgovor" je bilo prazno!', 'error');
		redirect_to('gp-ticket.php?id='.$Ticket_ID);
		die();
	}

	if(ticket_status_id($Ticket_ID) == 1||ticket_status_id($Ticket_ID) == 2||ticket_status_id($Ticket_ID) == 3) { 
		if(last_odg_time($Ticket_ID) > (time() - 300)) { 
			sMSG('Antispam! Vreme izmedju postavljanja sledeceg odgovora je 5 minuta, molimo strpite se malo!', 'info');
			redirect_to('gp-ticket.php?id='.$Ticket_ID);
			die();
		} else if(ticket_status_id($Ticket_ID) == 4) { 
			sMSG('Ovaj tiket je zakljkucan, ukoliko vam je potrebna pomoc otvorite novi!', 'error');
			redirect_to('gp-support.php');
			die();
		} 
	}

	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("INSERT INTO `tiketi_odgovori` (`id`, `tiket_id`, `user_id`, `admin_id`, `odgovor`, `vreme_odgovora`, `time`) VALUES (NULL, ?, ?, '0', ?, ?, ?);");
	$drkamkurac = $SQLSEC->Execute(array($Ticket_ID, $_SESSION["user_login"], $Ticket_MSG, $Ticket_Date, time()));	

	if (!$drkamkurac) {
		sMSG('Doslo je do greske, molimo pokusajte opet malo kasnije.', 'error');
		redirect_to('gp-ticket.php?id='.$Ticket_ID);
		die();
	} else {
		sMSG('Uspesno ste dodali odgovor na ovaj tiket.', 'success');
		redirect_to('gp-ticket.php?id='.$Ticket_ID);
		die();
	}
}

/* Naruci server */

if (isset($_GET['a']) && $_GET['a'] == "naruci_server") {
	$Buy_Game 		= txt($_POST['game_id']);
	$Buy_Location 	= txt($_POST['lokacija']);
	$Buy_Slot 		= txt($_POST['slotovi']);
	$Buy_Mesec 		= txt($_POST['mesec']);
	$Buy_Name 		= txt($_POST['name']);
	$Buy_Mod 		= txt($_POST['mod']);
	$Buy_Cena 		= txt($_POST['cena']);
	$Buy_Date 		= date('m.d.Y, H:i');
	$User_ID 		= $_SESSION['user_login'];

	if ($Buy_Game == ''||$Buy_Location == ''||$Buy_Slot == ''||$Buy_Mesec == ''||$Buy_Name == ''||$Buy_Mod == '') {
		sMSG('Doslo je do greske!');
		redirect_to('naruci.php?game='.$Buy_Game);
		die();
	}

	if (!($Buy_Cena == cena_slota_code($Buy_Slot, $Buy_Game, $Buy_Location))) {
		$Buy_Cena = cena_slota_code($Buy_Slot, $Buy_Game, $Buy_Location);
	}
	$rootsec = rootsec();
	
	$SQLSEC = $rootsec->prepare("INSERT INTO `billing` (`id`, `user_id`, `game_id`, `mod_id`, `location`, `slotovi`, `mesec`, `name`, `cena`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$drkamkurac = $SQLSEC->Execute(array(NULL, $User_ID, $Buy_Game, $Buy_Mod, $Buy_Location, $Buy_Slot, $Buy_Mesec, $Buy_Name, $Buy_Cena, $Buy_Date, 'pending'));

	if (!$drkamkurac) {
		sMSG('Doslo je do greske, molimo pokusajte opet malo kasnije.', 'error');
		redirect_to('naruci.php?game='.$Buy_Game);
		die();
	} else {
		sMSG('Hvala vam! Uspesno ste narucili novi server. (Bicete obavjesteni putem emaila i vaseg GP-a kada nas support pogleda ovu narudzbu!)', 'success');
		redirect_to('gp-billing.php');
		die();
	}
}

/* Server process WebFTP */

if (isset($_GET['a']) && $_GET['a'] == "delete_folder") {
	$Server_ID 			= txt($_POST['server_id']);
	$Server_Path 		= txt($_POST['path']);
	$Server_Folder 		= txt($_POST['f_name']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
	if(!$ftp_connect) {
		sMSG('Doslo je do greske prilikom spajanja na FTP server.', 'error');
		redirect_to('gp-webftp.php?id='.$Server_ID);
		die();
	}

	if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
		ftp_pasv($ftp_connect, true);

		if(!empty($Server_Path)) {
			ftp_chdir($ftp_connect, $Server_Path);	
		}

		function ftp_delAll($conn_id, $dst_dir) {
			$ar_files = ftp_nlist($conn_id, $dst_dir);
			if (is_array($ar_files)) { 
				for ($i=0;$i<sizeof($ar_files);$i++) { 
					$st_file = basename($ar_files[$i]);
					if($st_file == '.' || $st_file == '..') continue;
					if (ftp_size($conn_id, $dst_dir.'/'.$st_file) == -1) ftp_delAll($conn_id,  $dst_dir.'/'.$st_file); 
					else ftp_delete($conn_id,  $dst_dir.'/'.$st_file);
				}
				sleep(1);
				ob_flush();
			}
			if(ftp_rmdir($conn_id, $dst_dir)) return true;
		}

		function ftp_folderdel($conn_id, $dst_dir) {
			$ar_files = ftp_nlist($conn_id, $dst_dir);
			if (is_array($ar_files)) { 
				for ($i=0;$i<sizeof($ar_files);$i++) { 
					$st_file = basename($ar_files[$i]);
					if($st_file == '.' || $st_file == '..') continue;
					if (ftp_size($conn_id, $dst_dir.'/'.$st_file) == -1) { 
						ftp_delAll($conn_id,  $dst_dir.'/'.$st_file); 
					} else {
						ftp_delete($conn_id,  $dst_dir.'/'.$st_file);
					}
				}
				sleep(1);
				ob_flush();
			}

			if(ftp_rmdir($conn_id, $dst_dir)) {
				return true;
			}
		}			
		
		if(ftp_folderdel($ftp_connect, $Server_Path.'/'.$Server_Folder)) {
			sMSG('Uspesno ste obrisali folder: #'.$Server_Folder, 'success');
			redirect_to('gp-webftp.php?id='.$Server_ID.'&path='.$Server_Path);
			die();
		} else {
			sMSG('Doslo je do greske prilikom brisanja foldera.', 'error');
			redirect_to('gp-webftp.php?id='.$Server_ID.'&path='.$Server_Path);
			die();
		}
	}
	ftp_close($ftp_connect);
}

if (isset($_GET['a']) && $_GET['a'] == "edit_folder") {
	$Server_ID 			= txt($_POST['server_id']);
	$Server_Path 		= txt($_POST['path']);
	$Server_File 		= txt($_POST['f_name']);
	$New_File_Name 		= txt($_POST['new_file_name']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	sMSG('Ova opcija je u izradi..', 'info');
	redirect_to('gp-server.php?id='.$Server_ID);
	die();

}

if (isset($_GET['a']) && $_GET['a'] == "delete_file") {
	$Server_ID 			= txt($_POST['server_id']);
	$Server_Path 		= txt($_POST['path']);
	$Server_File 		= txt($_POST['f_name']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
	if(!$ftp_connect) {
		sMSG('Doslo je do greske prilikom spajanja na FTP server.', 'error');
		redirect_to('gp-webftp.php?id='.$Server_ID);
		die();
	}
		
	if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
		ftp_pasv($ftp_connect, true);

		if(!empty($Server_Path)) {
			ftp_chdir($ftp_connect, $Server_Path);	
		}		
		
		if(ftp_delete($ftp_connect, $Server_Path.'/'.$Server_File)) {
			sMSG('Uspesno ste obrisali file: #'.$Server_File, 'success');
			redirect_to('gp-webftp.php?id='.$Server_ID.'&path='.$Server_Path);
			die();
		} else {
			sMSG('Doslo je do greske prilikom brisanja fajl-a.', 'error');
			redirect_to('gp-webftp.php?id='.$Server_ID.'&path='.$Server_Path);
			die();
		}
	}
	ftp_close($ftp_connect);
}

if (isset($_GET['a']) && $_GET['a'] == "save_ftp_file") {
	$Server_ID 			= txt($_POST['server_id']);
	$Server_Path 		= txt($_POST['path']);
	$Server_File 		= txt($_POST['f_name']);

	$File_Edit 			= $_POST['file_text_edit']; 

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
	if(!$ftp_connect) {
		sMSG('Doslo je do greske prilikom spajanja na FTP server.', 'error');
		redirect_to('gp-webftp.php?id='.$Server_ID);
		die();
	}
		
	if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
		ftp_pasv($ftp_connect, true);
		if(!empty($Server_Path)) {
			ftp_chdir($ftp_connect, $Server_Path);	
		}

		$folder = $_SERVER['DOCUMENT_ROOT'].'/assets/_cache/panel_'.server_username($Server_ID).'_'.$Server_File;
		$fw = fopen(''.$folder.'', 'w+');
		$fb = fwrite($fw, stripslashes($File_Edit));
		$remote_file = ''.$Server_Path.'/'.$Server_File.'';
		if (ftp_put($ftp_connect, $remote_file, $folder, FTP_BINARY)){
			sMSG('Uspesno ste sacuvali file: #'.$Server_File, 'success');
			redirect_to('gp-webftp.php?id='.$Server_ID.'&path='.$Server_Path.'&fajl='.$Server_File.'#server_info_infor2');
			die();
		} else {
			sMSG('Doslo je do greske prilikom editovanja fajl-a. (Promene nisu sacuvane!)', 'error');
			redirect_to('gp-webftp.php?id='.$Server_ID.'&path='.$Server_Path.'&fajl='.$Server_File.'#server_info_infor2');
			die();
		}
		
		fclose($fw);
		unlink($folder);
	}
	ftp_close($ftp_connect);
}

/* Dodaj admina */

if (isset($_GET['a']) && $_GET['a'] == "add_admin") {
	$Server_ID 			= txt($_POST['server_id']);

	$Vrsta_Admina 		= txt($_POST['vrsta_admina']);
	$Name_Admina 		= txt($_POST['name_admin']);
	$Sifra_Admina 		= txt($_POST['sifra_admina']);
	$Perm_Admina 		= txt($_POST['admin_perm']);
	$Comm_Admina 		= txt($_POST['comm_admin']);

	if (isset($_POST['admin_flag'])) {
		$Flag 			= $_POST['admin_flag'];
	} else {
		$Flag 			= '';
	}

	$Flags = '';
	foreach ($Flag as $val) {
		$Flags .= $val;
	}

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (empty($Vrsta_Admina)||empty($Name_Admina)||empty($Perm_Admina)) {
		sMSG('Morate popuniti sva polja!', 'error');
		redirect_to('gp-admins.php?id='.$Server_ID);
		die();
	}

	$ftp_connect = ftp_connect(server_ip($Server_ID), 21);
	if(!$ftp_connect) {
		sMSG('Doslo je do greske prilikom spajanja na FTP server.', 'error');
		redirect_to('gp-admins.php?id='.$Server_ID);
		die();
	}

	if (ftp_login($ftp_connect, server_username($Server_ID), server_password($Server_ID))) {
		ftp_pasv($ftp_connect, true);	
	    ftp_chdir($ftp_connect, '/cstrike/addons/amxmodx/configs');
	    
	    $filename = LoadFile($Server_ID, 'cstrike/addons/amxmodx/configs/users.ini');
        $contents = file_get_contents($filename);
	    
    	if($Perm_Admina == 1) 		{ $privilegije = "a"; }
        if($Perm_Admina == 2)		{ $privilegije = "ab"; }
        if($Perm_Admina == 3) 		{ $privilegije = "abcdei"; }
        if($Perm_Admina == 4) 		{ $privilegije = "abcdefijkmu"; }
        if($Perm_Admina == 5) 		{ $privilegije = "abcdefghijkmnopqrstu"; }
        if($Perm_Admina == 6) 		{ $privilegije = $Flags; }

		if ($Vrsta_Admina == 1) {
			$contents .= PHP_EOL.'"'.$Name_Admina.'" "'.$Sifra_Admina.'" "'.$privilegije.'" "ab" //'.$Comm_Admina.'';
		} elseif ($Vrsta_Admina == 2) {
			$contents .= PHP_EOL.'"'.$Name_Admina.'" "'.$Sifra_Admina.'" "'.$privilegije.'" "ca" //'.$Comm_Admina.'';
		} elseif ($Vrsta_Admina == 3) {
			$contents .= PHP_EOL.'"'.$Name_Admina.'" "'.$Sifra_Admina.'" "'.$privilegije.'" "ca" //'.$Comm_Admina.'';
		}

	    $folder = 'assets/_cache/panel_'.server_username($Server_ID).'_add_admin_users.ini';

	    $fw = fopen(''.$folder.'', 'w+');
	    if(!$fw){
	        sMSG('Ne mogu otvoriti fajl! (Admin nije dodat)', 'error');
			redirect_to('gp-admins.php?id='.$Server_ID);
			die();
	    } else {  
	        $fb = fwrite($fw, stripslashes($contents));
	        if(!$fb) {
	       		sMSG('Doslo je do greske, molimo pokusajte malo kasnije.', 'error');
				redirect_to('gp-admins.php?id='.$Server_ID);
				die();
	        } else {               
	            $remote_file = 'users.ini';
	            if (ftp_put($ftp_connect, $remote_file, $folder, FTP_BINARY)) {
	            	sMSG('Uspesno ste dodali novog admina!', 'success');
					redirect_to('gp-admins.php?id='.$Server_ID);
					die();
	            } else {
	                sMSG('Doslo je do greske! (Admin nije dodat)', 'error');
					redirect_to('gp-admins.php?id='.$Server_ID);
					die();
	            }
	            unlink($folder);                                
	        }
	    }
	}

}

/* Install plugin */

if (isset($_GET['a']) && $_GET['a'] == "install_plugin") {
	$Server_ID 			= txt($_POST['server_id']);
	$Plugin_ID 			= txt($_POST['plugin_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (is_valid_plugin($Plugin_ID) == false) {
		sMSG('Ovaj plugin ne postoji!', 'error');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	}

	$Pl_Install = plugin_action($Server_ID, $Plugin_ID, 1);
	if (!$Pl_Install) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste instalirali plugin: '.plugin_name($Plugin_ID), 'success');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	}

}

/* Obrisi plugin */

if (isset($_GET['a']) && $_GET['a'] == "remove_plugin") {
	$Server_ID 			= txt($_POST['server_id']);
	$Plugin_ID 			= txt($_POST['plugin_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (is_valid_plugin($Plugin_ID) == false) {
		sMSG('Ovaj plugin ne postoji!', 'error');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	}

	$Pl_Install = plugin_action($Server_ID, $Plugin_ID, 2);
	if (!$Pl_Install) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste obrisali plugin: '.plugin_name($Plugin_ID), 'success');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	}

}

/* Install mapu */

if (isset($_GET['a']) && $_GET['a'] == "install_map") {
	$Server_ID 			= txt($_POST['server_id']);
	$Map_ID 			= txt($_POST['plugin_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (is_valid_map($Map_ID) == false) {
		sMSG('Ova mapa ne postoji!', 'error');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	}

	$Map_Install = map_action($Server_ID, $Map_ID, 1);
	if (!$Map_Install) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-maps.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste instalirali mapu: '.plugin_name($Map_ID), 'success');
		redirect_to('gp-maps.php?id='.$Server_ID);
		die();
	}

}

/* Obrisi mapu */

if (isset($_GET['a']) && $_GET['a'] == "remove_map") {
	$Server_ID 			= txt($_POST['server_id']);
	$Map_ID 			= txt($_POST['plugin_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (is_valid_map($Map_ID) == false) {
		sMSG('Ova mapa ne postoji!', 'error');
		redirect_to('gp-plugins.php?id='.$Server_ID);
		die();
	}

	$Map_Install = map_action($Server_ID, $Map_ID, 2);
	if (!$Map_Install) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-maps.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste obrisali mapu: '.plugin_name($Map_ID), 'success');
		redirect_to('gp-maps.php?id='.$Server_ID);
		die();
	}

}

/* Server - AutoRestart */

if (isset($_GET['a']) && $_GET['a'] == "autorestart") {
	$Server_ID 			= txt($_POST['server_id']);
	$Vreme 				= txt($_POST['autorestart']);
	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `autorestart` = ? WHERE `id` = ?");
	$drkamkurac = $SQLSEC->Execute(array($Vreme, $Server_ID));

	if (!$drkamkurac) {
		sMSG('Doslo je do greske! Molimo prijavite ovaj bag (#AutoRestart).', 'error');
		redirect_to('gp-autorestart.php?id='.$Server_ID);
		die();
	} else {
		if ($Vreme == '-1') {
			$s_m = 'Uspesno ste iskljucili autorestart!';
		} else {
			$s_m = 'Uspesno ste ukljucili autorestart! Server ce se od danas restartovati svakim danom u: '.$Vreme.':00h';
		}
		sMSG($s_m, 'success');
		redirect_to('gp-autorestart.php?id='.$Server_ID);
		die();
	}
}

/* Server process Start,Stop,Restart,Reinstall */

if (isset($_GET['s']) && $_GET['s'] == "server_start") {
	$Server_ID 			= txt($_POST['server_id']);

	$Box_ID 			= getBOX($Server_ID); 
	$user = server_username($Server_ID);
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (server_is_start($Server_ID) == true) {
		sMSG('Ovaj server je vec startovan! (Probajte restartovati vas server)', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/core/games/inc.php');

	$start_server = start_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), $S_Command, $S_Install_Dir, $user);
	if (!$start_server == true) {
		sMSG('Server nije startovan. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();

		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `startovan` = '1' WHERE `id` = ?");
		$SQLSEC->Execute(array($Server_ID));

		sMSG('Server je uspesno startovan.', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

}

if (isset($_GET['s']) && $_GET['s'] == "server_restart") {
	$Server_ID 			= txt($_POST['server_id']);

	$Box_ID 			= getBOX($Server_ID); 
	$user = server_username($Server_ID);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/core/games/inc.php');

	$stop_server = stop_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), $S_Command, $S_Install_Dir, $user);
	$start_server = start_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), $S_Command, $S_Install_Dir, $user);
	if (!$stop_server == true && !$start_server == true) {
		sMSG('Server nije restartovan. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();

		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `startovan` = '1' WHERE `id` = ?");
		$SQLSEC->Execute(array($Server_ID));
		
		sMSG('Server je uspesno restartovan.', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

}

if (isset($_GET['s']) && $_GET['s'] == "server_stop") {
	$Server_ID 			= txt($_POST['server_id']);

	$Box_ID 			= getBOX($Server_ID); 
	$user = server_username($Server_ID);
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (server_is_start($Server_ID) == false) {
		sMSG('Ovaj server je vec stopiran! (Probajte startovati vas server)', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$S_Command 		= '';
	$S_Install_Dir 	= '';

	$stop_server = stop_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), $S_Command, $S_Install_Dir, $user);
	if (!$stop_server == true) {
		sMSG('Server nije stopiran. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();

		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `startovan` = '0' WHERE `id` = ?");
		$SQLSEC->Execute(array($Server_ID));

		sMSG('Server je uspesno stopiran.', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

}

if (isset($_GET['s']) && $_GET['s'] == "server_reinstall") {
	$Server_ID 			= txt($_POST['server_id']);

	$Box_ID 			= getBOX($Server_ID); 
	$user = server_username($Server_ID);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (server_is_start($Server_ID) == true) {
		sMSG('Server mora biti stopiran! (Probajte stopirati vas server)', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	include_once($_SERVER['DOCUMENT_ROOT'].'/core/games/inc.php');
	
	$reinstall_server = reinstall_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), $S_Command, $S_Install_Dir, $user);
	if (!$reinstall_server == true) {
		sMSG('Server nije Reinstaliran. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Server je uspesno Reinstaliran. (Sacekajte par minuta "Predlog: 1/2min")', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['s']) && $_GET['s'] == "server_backup") {
	$Server_ID 			= txt($_POST['server_id']);
	
	$Box_ID 			= getBOX($Server_ID); 
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}
	
	if (server_is_start($Server_ID) == true) {
		sMSG('Server mora biti stopiran! (Probajte stopirati vas server)', 'info');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
	$RandomNumber		=		random_s_key(5);
	$Date				=		date("d_m_Y");
	$SrwUser			=		server_username($Server_ID);
	$Bacup_Name			=		"$SrwUser-$Date-$RandomNumber";
	
	$rootsec = rootsec();
	$query = "INSERT INTO `server_backup` SET
		`srvid`		=		?,
		`time`		=		?,
		`name`		=		?,
		`status`	=		'0',
		`size`		=		'0'
	";
	$SQLSEC = $rootsec->prepare($query);
	$seksdrogasekulicgoga = $SQLSEC->Execute(array($Server_ID, $Date, $Bacup_Name));
	
	if (!$seksdrogasekulicgoga) {
		sMSG('Doslo je do greske sa bazom! (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
	
	$backup_server = server_backup($Box_ID, $Server_ID, $Bacup_Name);
	
	if (!$backup_server == true) {
		sMSG('Backup nije napravljen. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Backup je uspjesno napravljen.', 'success');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['s']) && $_GET['s'] == "server_backup_restore") {
	$Server_ID 			= txt($_POST['server_id']);
	$Backup_ID 			= txt($_POST['backup_id']);
	$Box_ID 			= getBOX($Server_ID); 
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}
	
	if (server_is_start($Server_ID) == true) {
		sMSG('Server mora biti stopiran! (Probajte stopirati vas server)', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
	
	$rootsec = rootsec();
	$query = "SELECT * FROM `server_backup` WHERE `id` = ?";
	$SQLSEC = $rootsec->prepare($query);
	$SQLSEC->Execute(array($Backup_ID));
	$Backup = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$Backup_Name	=	txt($Backup['name']);
	
	$server_backup_restore = server_backup_restore($Box_ID, $Server_ID, $Backup_Name);
	
	if (!$server_backup_restore == true) {
		sMSG('Backup nije vracen. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Backup je uspjesno vracen.', 'success');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['s']) && $_GET['s'] == "server_backup_delete") {
	$Server_ID 			= txt($_POST['server_id']);
	$Backup_ID 			= txt($_POST['backup_id']);
	$Box_ID 			= getBOX($Server_ID); 
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}
	
	if (server_is_start($Server_ID) == true) {
		sMSG('Server mora biti stopiran! (Probajte stopirati vas server)', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
	
	$rootsec = rootsec();
	$query = "SELECT * FROM `server_backup` WHERE `id` = ?";
	$SQLSEC = $rootsec->prepare($query);
	$SQLSEC->Execute(array($Backup_ID));
	$Backup = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$Backup_Name	=	txt($Backup['name']);
	
	$query = "DELETE FROM `server_backup` WHERE `id` = ?";
	$SQLSEC = $rootsec->prepare($query);
	$seksdrogasekulicgoga = $SQLSEC->Execute(array($Backup_ID));
		
	if (!$seksdrogasekulicgoga) {
		sMSG('Doslo je do greske sa bazom! (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
	
	$server_backup_delete = server_backup_delete($Box_ID, $Server_ID, $Backup_Name);
	
	if (!$server_backup_delete == true) {
		sMSG('Backup nije vracen. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Backup je uspjesno obrisan.', 'success');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "change_mod") {
	$Server_ID 		= txt($_POST['server_id']);
	$Mod_ID 		= txt($_POST['mod_id']);
	$Box_ID 		= getBOX($Server_ID);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (server_mod($Server_ID) == false) {
		sMSG('Ovaj mod ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	if (server_is_start($Server_ID) == true) {
		sMSG('Server mora biti stopiran!', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$S_Install_Dir = s_mod_install($Mod_ID);

	$install_mod = install_mod($Box_ID, $S_Install_Dir, $Server_ID);
	if (!$install_mod == true) {
		sMSG('Promena moda nije uspela! #ChangeMod | #err1', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
	$rootsec = rootsec();
	$query = "UPDATE `serveri` SET `modovi` = ? WHERE `id` = ?";
	$SQLSEC = $rootsec->prepare($query);
	$seksdrogasekulicgoga = $SQLSEC->Execute(array($Mod_ID, $Server_ID));
		
		if (!$seksdrogasekulicgoga) {
			sMSG('Uspesno ste instalirali '.server_mod_name($Server_ID).' mod! (Mod nije upisan u bazi, prijavite ovaj problem)', 'info');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		} else {
			sMSG('Uspesno ste instalirali '.server_mod_name($Server_ID).' mod! (Sacekajte par minuta "Predlog: 1/2min")', 'success');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		}
	}
}

if (isset($_GET['a']) && $_GET['a'] == "edit_profile") {
	$User_Name 		= txt($_POST['ime']);
	$User_lName 	= txt($_POST['prezime']);
	//$User_Email 	= txt($_POST['email']);
	$User_Pass 		= txt($_POST['password']);
	$User_rPass 	= txt($_POST['r_password']);

	if (empty($User_Name)||empty($User_lName)) {
		sMSG('Molimo kako bismo sacuvali vase izmene potrebno je uneti text u oba inputa!(Ime & Prezime)', 'info');
		redirect_to('gp-settings.php');
		die();
	}

	if (empty($User_Pass)) {
	$rootsec = rootsec();
	$query = "UPDATE `klijenti` SET `ime` = ? WHERE `klijentid` = ?";
	$SQLSEC = $rootsec->prepare($query);
	$in_base = $SQLSEC->Execute(array($User_Name,$_SESSION["user_login"]));
	
	$query = "UPDATE `klijenti` SET `prezime` = '' WHERE `klijentid` = ?";
	$SQLSEC = $rootsec->prepare($query);
	$in_base2 = $SQLSEC->Execute(array($User_lName,$_SESSION["user_login"]));

		if (!$in_base || !$in_base2) {
			sMSG('Doslo je do greske, molimo prijavite ovaj bag nasoj administraciji!', 'error');
			redirect_to('gp-settings.php');
			die();
		} else {
			sMSG('Uspesno ste sacuvali izmene!', 'success');
			redirect_to('gp-settings.php');
			die();
		}
	} else {
		if ($User_Pass == $User_rPass) {
			$User_Pass = md5($User_Pass);
	$rootsec = rootsec();
	$query = "UPDATE `klijenti` SET `ime` = ? WHERE `klijentid` = ?";
	$rootsec->prepare($query);
	$in_base = $SQLSEC->Execute(array($User_Name,$_SESSION["user_login"]));

	$query = "UPDATE `klijenti` SET `prezime` = ? WHERE `klijentid` = ?";
	$rootsec->prepare($query);
	$in_base2 = $SQLSEC->Execute(array($User_lName, $_SESSION["user_login"]));

	$query = "UPDATE `klijenti` SET `sifra` = ? WHERE `klijentid` = ?";
	$rootsec->prepare($query);
	$in_base3 = $SQLSEC->Execute(array($User_Pass,$_SESSION["user_login"]));

			if (!$in_base || !$in_base2 || !$in_base3) {
				sMSG('Doslo je do greske, molimo prijavite ovaj bag nasoj administraciji! #Edit_Prof', 'error');
				redirect_to('gp-settings.php');
				die();
			} else {
				sMSG('Uspesno ste sacuvali izmene!', 'success');
				redirect_to('gp-settings.php');
				die();
			}

			sMSG('Uspesno ste sacuvali izmene!', 'success');
			redirect_to('gp-settings.php');
			die();
		} else {
			sMSG('Molimo kako bismo sacuvali vas password potrebno je uneti isti u oba inputa!(Password & R. Password)', 'info');
			redirect_to('gp-settings.php');
			die();
		}
	}

}

if (isset($_GET['a']) && $_GET['a'] == "produzi_srv") {
	$Server_ID 		= txt($_POST['server_id']);
	$Save_Date 		= txt($_POST['datum_prd']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (empty($Save_Date) || $Save_Date == "") {
		sMSG('Greska, izgleda da cete morati javiti supportu da vam produzi server, dok se ne popravi ovaj bag.', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$moj_novac = money_val(my_money($_SESSION['user_login']), my_contry($_SESSION['user_login']));
	$novac_vvl = my_money($_SESSION['user_login']);
	if (empty($moj_novac) || $novac_vvl == '0') {
		sMSG('Postovani korisnice, stanje na vasem racunu je '.$moj_novac, 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$slot 		= server_slot($Server_ID);
	$cena 		= cena_slota_code_v($slot, gp_game_id($Server_ID));

	$rootsec = rootsec();

	$SQLSEC = $rootsec->prepare("SELECT * FROM `serveri` WHERE `id` = ?");
	$SQLSEC->Execute(array($Server_ID));
	$s_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$istice = $s_info['istice'];

	$date = strtotime(DateTime::createFromFormat('d/m/Y', $istice));
	$sdatum = strtotime($Save_Date);
	

	$oduzetisaracuna = $moj_novac-$cena;
	$produziti = strtotime('+{$dana} day', $date);
	$konvert = new DateTime($produziti);
	$formatiraj = $konvert->format('d/m/Y');

	if($moj_novac<$cena)
	{
		sMSG('Postovani korisnice, nemate dovoljno sredstava na vasem racunu', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else if ($date>$sdatum) {
		sMSG('Postovani korisnice, ne mozete staviti manji datum nego sto je uplacen', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {

		$SQLSEC = $rootsec->prepare("SELECT * FROM `users` SET `novac` = ? WHERE `user_id` = ?");
		$SQLSEC->Execute(array($oduzetisaracuna, $_SESSION["user_login"]));

		$SQLSEC2 = $rootsec->prepare("SELECT * FROM `serveri` SET `istice` = ? WHERE `id` = ?");
		$SQLSEC2->Execute(array($formatiraj, $Server_ID));

		sMSG('Postovani korisnice, Uspesno ste produzili vas server', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();

	}

}

if (isset($_GET['a']) && $_GET['a'] == "change_sname") {
	$Server_ID 		= txt($_POST['server_id']);
	$S_New_Name 	= txt($_POST['new_name_srv']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (empty($S_New_Name) || $S_New_Name == "") {
		sMSG('Molimo proverite dali ste uneli tacno ime.', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
	
	$rootsec = rootsec();
	$query = "UPDATE `serveri` SET `name` = ? WHERE `id` = ?";
	$rootsec->prepare($query);
	$seksdrogasekulicgoga = $SQLSEC->Execute(array($S_New_Name,$Server_ID));
	
	if (!$seksdrogasekulicgoga) {
		sMSG('Doslo je do greske! Ime servera nije sacuvano u bazi.', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste promenili ime servera u GamePanel-u! '.$S_New_Name, 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "change_m_name") {
	$Server_ID 		= txt($_POST['server_id']);
	$S_New_Name 	= txt($_POST['new_map_name']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji ili za njega nemate pristup.', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (empty($S_New_Name) || $S_New_Name == "") {
		sMSG('Molimo proverite dali ste uneli tacno ime mape.', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
	
	$rootsec = rootsec();
	$query = "UPDATE `serveri` SET `map` = ? WHERE `id` = ?";
	$rootsec->prepare($query);
	$seksdrogasekulicgoga = $SQLSEC->Execute(array($S_New_Name,$Server_ID));
	
	if (!$seksdrogasekulicgoga) {
		sMSG('Doslo je do greske! Default mapa nije sacuvana u bazi.', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste promenili default mapu servera! '.$S_New_Name, 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "boost") {
	$mdb = masterserver();
	$rootsec = rootsec();
	$server_id = txt($_POST['server_id']);
	
	if ($server_id == "") {
		$_SESSION['error'] = "Greska - BOOST";
		header("Location: gp-home.php");
		die();
	}
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM serveri WHERE id=?");
	$SQLSEC->Execute(array($server_id));
	$pp_server = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	
	$SQLSEC = $rootsec->prepare("SELECT * FROM `box` WHERE `boxid` = ?");
	$SQLSEC->Execute(array($pp_server["box_id"]));
	$info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$server_ip 		= $info['ip'];
	$ime 		= $info['name'];
	$server_port    = $pp_server['port'];
	$fullip = $server_ip.":".$server_port;
	$vreme = date('Y-m-d H:i:s');
	
	$razlikavremena =($istice-strtotime($vreme)) / 86400;
	
	$SQLSEC = $mdb->prepare("SELECT * FROM servers WHERE `ip`= ?");
	$SQLSEC->Execute(array($fullip));
    	$broj = $SQLSEC->rowCount();
	
	if($pp_server['igra'] != "1") {
	$_SESSION['info'] = "GRESKA! - VAS SERVER NIJE CS 1.6";
	header("Location: $_SERVER[HTTP_REFERER]");
	die();
	}
	
	if($broj == 0)
	{
	$SQLSEC = $mdb->prepare("INSERT INTO servers (ip, ime) VALUES (?,?)");
	if($SQLSEC->Execute(array($fullip, $ime)) === TRUE) {
	$srvid = $rootsec->lastInsertId();
	$SQLSEC = $mdb->prepare("INSERT INTO boost_list (serverid, expiry_time) VALUES (?,?)");
	if($SQLSEC->Execute(array($srvid, $razlikavremena)) === TRUE)
	{
	$_SESSION['info'] = "Uspesno ste boostovali vas server!";
	header("Location: $_SERVER[HTTP_REFERER]");
	die();
	}
	else
	{
		echo $mdb->error;
	}
	} else { 	 
		echo $mdb->error;}
	}
	else 
	{
		$_SESSION['info'] = "Sacekajte 2 dana da bi boostovali opet server!";
		header("Location: $_SERVER[HTTP_REFERER]");
		die();
	}
}
?>
