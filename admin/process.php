<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

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
		$is_ok = admin_login($User_Email, $User_Password);
		if (!$is_ok) {
			sMSG('Podaci za prijavu nisu tacni!', 'error');
			redirect_to('login');
			die();
		} else {
			sMSG(admin_full_name($_SESSION['admin_login']).' dobrodosli nazad.', 'success');
			redirect_to('home');
			die();
		}
	}

	redirect_to('home');
	die();
}

if (isset($_GET['a']) && $_GET['a'] == "del_all_msg") {
	$Get_True 			= txt($_GET['all']);
	if ($Get_True == 'true') {
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("TRUNCATE `chat_messages`");
		$in_base = $SQLSEC->Execute();
		
		if (!$in_base) {
			$SQLSEC = $rootsec->prepare("DELETE FROM `chat_messages`");
			$in_base = $SQLSEC->Execute();
			die();
		}
		die();
	} else {
		die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "send_msg") {
	$Msg_Text 			= txt($_GET['msg_text']);
	$Msg_User 			= my_name($_SESSION['admin_login']);
	$Msg_Date 			= date('m.d.Y, H:i');
	if (empty($Msg_Text) || $Msg_Text == "" || $Msg_Text == "a") {
		die();
	} else {
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("INSERT INTO `chat_messages` (`Text`, `Autor`, `Datum`, `ID`, `admin_id`) VALUES (?, ?, ?, ?, ?)");
		$in_base = $SQLSEC->Execute(array($Msg_Text, $Msg_User, $Msg_Date, NULL, $_SESSION["admin_login"]));
		
		if (!$in_base) {
			die();
		} else {
			die();
		}
	}
}

if (isset($_GET['a']) && $_GET['a'] == "chat_msg_num") {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `chat_messages` ORDER BY `ID` DESC");
	$SQLSEC->Execute();

	if ($SQLSEC->rowCount() == 0) { ?>
		<div id="cno">
			<li><strong>Na chatu trenutno nema poruka!</strong></li>
		</div>
	<?php }

	while ($row_msg = $SQLSEC->fetch(PDO::FETCH_ASSOC)) { 
		$Chat_Text 	= smile(txt($row_msg['Text']));
		$Admin_ID 	= txt($row_msg['admin_id']);
		$Autor 		= $row_msg['Autor'];
	?>
		<div id="cno">
			<li>
				<a href="/admin/admin.php?id=<?php echo '1'; ?>">
					<?php echo admin_rank_avatar($Admin_ID, 25).' '.$Autor; ?>
				</a> 
				<i class="fa fa-caret-right"></i>
			</li>
			<li><strong><?php echo $Chat_Text; ?></strong></li>
		</div>
	<?php }
}

/* Obrisi klijenta */

if (isset($_GET['a']) && $_GET['a'] == "delete_client") {
	$User_ID 			= txt($_POST['client_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}
	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("DELETE FROM `klijenti` WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	if (!$in_base) {
		sMSG('Doslo je do greske. (Klijent nije obrisan)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste obrisali ovaj nalog!', 'success');
		redirect_to('clients.php');
		die();
	}
}

/* Banuj klijenta */

if (isset($_GET['a']) && $_GET['a'] == "banuj_nalog") {
	$User_ID 			= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `banovan` = '1' WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. (Klijent nije banovan)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste banovali nalog klijentu: '.user_full_name($User_ID), 'success');
		redirect_to('gp-client.php?id='.$User_ID);
		die();
	}
}

/* Un-Banuj klijenta */

if (isset($_GET['a']) && $_GET['a'] == "un_banuj_nalog") {
	$User_ID 			= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `banovan` = '0' WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. (Klijent nije unbanovan)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste un-banovali nalog klijentu: '.user_full_name($User_ID), 'success');
		redirect_to('gp-client.php?id='.$User_ID);
		die();
	}
}

/* Banuj FTP */

if (isset($_GET['a']) && $_GET['a'] == "banuj_ftp") {
	$User_ID 			= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `ftp_ban` = '1' WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. (FTP Klijentu nije banovan)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste banovali FTP klijentu: '.user_full_name($User_ID), 'success');
		redirect_to('gp-client.php?id='.$User_ID);
		die();
	}
}

/* Un-Banuj FTP */

if (isset($_GET['a']) && $_GET['a'] == "un_banuj_ftp") {
	$User_ID 			= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `ftp_ban` = '0' WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. (FTP Klijentu nije unbanovan)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste un-banovali FTP klijentu: '.user_full_name($User_ID), 'success');
		redirect_to('gp-client.php?id='.$User_ID);
		die();
	}
}

/* Banuj Podrsku */

if (isset($_GET['a']) && $_GET['a'] == "banuj_podrsku") {
	$User_ID 			= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `support_ban` = '1' WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. (Podrska Klijentu nije banovana)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste banovali Podrsku klijentu: '.user_full_name($User_ID), 'success');
		redirect_to('gp-client.php?id='.$User_ID);
		die();
	}
}

/* Un-Banuj Podrsku */

if (isset($_GET['a']) && $_GET['a'] == "un_banuj_podrsku") {
	$User_ID 			= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}

	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `support_ban` = '0' WHERE `klijentid` = ?");
	$in_base = $SQLSEC->Execute(array($User_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. (Podrsku Klijentu nije unbanovano)', 'error');
		redirect_to('clients.php');
		die();
	} else {
		sMSG('Uspesno ste un-banovali Podrsku klijentu: '.user_full_name($User_ID), 'success');
		redirect_to('gp-client.php?id='.$User_ID);
		die();
	}
}

/* Admin tiket odgovor */
if (isset($_GET['a']) && $_GET['a'] == "supp_odg") {
	$Ticket_ID 			= txt($_POST['tiket_id']);
	$Sup_ODG 			= txt($_POST['supp_odg']);
	$Date 				= date('m.d.Y, H:i'); 

	if (is_valid_ticket($Ticket_ID) == false) {
		sMSG('Ovaj tiket ne postoji!', 'error');
		redirect_to('gp-tiketi.php');
		die();
	}

	if (empty($Sup_ODG)) {
		sMSG('Ne mozete poslati prazan tiket.', 'error');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("INSERT INTO `tiketi_odgovori` (`id`, `tiket_id`, `user_id`, `admin_id`, `odgovor`, `vreme_odgovora`) VALUES (?, ?, ?, ?, ?, ?)");
	$in_base = $SQLSEC->Execute(array(NULL, $Ticket_ID, 0, $_SESSION["admin_login"], $Sup_ODG, $Date));
	
	if (!$in_base) {
		sMSG('Doslo je do greske, molimo javite nam za ovaj problem!', 'error');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	} else {
		$SQLSEC = $rootsec->prepare("UPDATE `tiketi` SET `status` = '3' WHERE `id` = ?");
		$SQLSEC->Execute(array($Ticket_ID));

		sMSG('Uspesno ste odgovorili na ovaj tiket!', 'success');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	}
}

/* Admin obrisi odgovor */
if (isset($_GET['a']) && $_GET['a'] == "delete_odg") {
	$Ticket_ID 			= txt($_POST['tiket_id']);
	$ODG_ID 			= txt($_POST['odg_id']);
	$d_v 				= date('m.d.Y, H:i'); 

	if (is_valid_ticket($Ticket_ID) == false) {
		sMSG('Ovaj tiket ne postoji!', 'error');
		redirect_to('gp-tiketi.php');
		die();
	}

	if (empty($ODG_ID)) {
		sMSG('Doslo je do greske. #1', 'error');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("DELETE FROM `tiketi_odgovori` WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($ODG_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. #1', 'error');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	} else {
		sMSG('Uspesno ste obrisali odgovor iz ovog tiketa!', 'success');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	}
}

/* Admin zakljucaj tiket */
if (isset($_GET['a']) && $_GET['a'] == "lock_tiket") {
	$Ticket_ID 			= txt($_POST['tiket_id']);
	$d_v 				= date('m.d.Y, H:i'); 

	if (is_valid_ticket($Ticket_ID) == false) {
		sMSG('Ovaj tiket ne postoji!', 'error');
		redirect_to('gp-tiketi.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `tiketi` SET `status` = '4' WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($Ticket_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. #1', 'error');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	} else {
		sMSG('Uspesno ste zakljucali ovaj tiket!', 'success');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	}
}

/* Admin zakljucaj tiket */
if (isset($_GET['a']) && $_GET['a'] == "unlock_tiket") {
	$Ticket_ID 			= txt($_POST['tiket_id']);
	$d_v 				= date('m.d.Y, H:i'); 

	if (is_valid_ticket($Ticket_ID) == false) {
		sMSG('Ovaj tiket ne postoji!', 'error');
		redirect_to('gp-tiketi.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("UPDATE `tiketi` SET `status` = '1' WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($Ticket_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske. #1', 'error');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	} else {
		sMSG('Uspesno ste otkljucali ovaj tiket!', 'success');
		redirect_to('gp-tiket.php?id='.$Ticket_ID);
		die();
	}
}

/* Box ADD */

if (isset($_GET['a']) && $_GET['a'] == "add_box") {
	$Box_IP 		= txt($_POST['box_ip']);
	$Box_Location 	= txt($_POST['box_location']);
	$Box_Name 		= txt($_POST['box_name']);
	$Box_SSH 		= txt($_POST['box_ssh']);
	$Box_Username 	= txt($_POST['box_user']);
	$Box_Password 	= txt($_POST['box_pass']);

	if (valid_ip($Box_IP) == false) {
		sMSG('Ip nije validan!', 'error');
		redirect_to('add_box.php');
		die();
	}

	if (valid_box($Box_IP) == true) {
		sMSG('Ova Masina je vec dodata!', 'info');
		redirect_to('box_info.php?id='.box_id($Box_IP));
		die();
	}

	if ($Box_Location == ''||$Box_Name == ''||$Box_SSH == ''||$Box_Username == ''||$Box_Password == '') {
		sMSG('Molimo proverite dali ste popunili sva polja.', 'error');
		redirect_to('add_box.php');
		die();
	}

	$ssh = new Net_SSH2($Box_IP, $Box_SSH);
	if ($ssh->login($Box_Username, $Box_Password)) {
		// In Base
		$rootsec = rootsec();
		$name = $Box_Name.' - '.$Box_Location;
		$boxpass = box_pass_in_base($Box_Password);

		$SQLSEC = $rootsec->prepare("INSERT INTO `box` (`name`, `location`, `ip`, `login`, `password`, `sshport`, `ftpport`, `maxsrv`, `cache`, `box_load_5min`, `box_load`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if($SQLSEC->Execute(array($name, $Box_Location, $Box_IP, $Box_Username, $boxpass, $Box_SSH, 21, 100, NULL, NULL, NULL)))
		{
		###
		$Box_ID = $rootsec->lastInsertId();
		###
		// Box Cache
		box_cache($Box_ID);
		###
		// Admin log
		
		###
		// Poruka
		sMSG('Masina je uspesno dodata.', 'success');
		redirect_to('box_info.php?id='.$Box_ID);
		die();
		} else {
		sMSG('Greska prilikom dodavanje masine u bazu!', 'error');
		redirect_to('add_box.php');
		die();
		}
	} else {
		sMSG('Podaci za prijavu nisu tacni, molimo preverite sve unete podatke!', 'error');
		redirect_to('add_box.php');
		die();
	}
}

/* Box Edit */

if (isset($_GET['a']) && $_GET['a'] == "edit_box") {

}

/* Box Restart */

if (isset($_GET['a']) && $_GET['a'] == "box_restart") {
	$Box_ID			= txt($_POST['box_id']);
	
	if (valid_box(box_ip($Box_ID)) == false) {
		sMSG('Ova masina ne postoji!', 'error');
		redirect_to('all_box.php');
		die();
	}

	/* fnc box_action()
		1. Restart
		2. Backup
		3. Delete
	*/

	$act_box = box_action($Box_ID, 1);
	if ($act_box == true) {
		sMSG('Uspesno ste restartovali masinu. #'.box_name($Box_ID), 'success');
		redirect_to('box_info.php?id='.$Box_ID);
		die();
	} else {
		sMSG('Doslo je do greske. (Masina nije restartovana) #'.box_name($Box_ID), 'error');
		redirect_to('box_info.php?id='.$Box_ID);
		die();
	}
}

/* Box Backup */

if (isset($_GET['a']) && $_GET['a'] == "box_backup") {
	$Box_ID			= txt($_POST['box_id']);
	
	if (valid_box(box_ip($Box_ID)) == false) {
		sMSG('Ova masina ne postoji!', 'error');
		redirect_to('all_box.php');
		die();
	}

	/* fnc box_action()
		1. Restart
		2. Backup
		3. Delete
	*/

	$act_box = box_action($Box_ID, 2);
	if ($act_box == true) {
		sMSG('Uspesno ste napravili novi backup masine. #'.box_name($Box_ID), 'success');
		redirect_to('box_info.php?id='.$Box_ID);
		die();
	} else {
		sMSG('Doslo je do greske. (Backup nije napravljen) #'.box_name($Box_ID), 'error');
		redirect_to('box_info.php?id='.$Box_ID);
		die();
	}
}

/* Box Delete */

if (isset($_GET['a']) && $_GET['a'] == "box_delete") {
	$Box_ID			= txt($_POST['box_id']);
	
	if (valid_box(box_ip($Box_ID)) == false) {
		sMSG('Ova masina ne postoji!', 'error');
		redirect_to('all_box.php');
		die();
	}

	/* fnc box_action()
		1. Restart
		2. Backup
		3. Delete
	*/
	
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("DELETE FROM `box` WHERE `boxid` = ?");
	$in_base = $SQLSEC->Execute(array($Box_ID));
	
	$act_box = box_action($Box_ID, 3);
	if ($act_box == true) {
		sMSG('Uspesno ste obrisali ovu masinu.', 'success');
		redirect_to('all_box.php?id='.$Box_ID);
		die();
	} else {
		sMSG('Doslo je do greske. (Masina nije obrisana)', 'error');
		redirect_to('box_info.php?id='.$Box_ID);
		die();
	}
}

/* Add server */

if (isset($_GET['a']) && $_GET['a'] == "add_server") {
	$User_ID 		= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('add_server.php');
		die();
	} 
	
	$Box_ID 		= txt($_POST['box_id']);
	if (is_valid_box($Box_ID) == false) {
		sMSG('Ova masina ne postoji!', 'error');
		redirect_to('add_server.php?user_id='.$User_ID);
		die();
	} 
	
	$Game_ID 		= txt($_POST['game_id']);
	if (empty($Game_ID)) {
		sMSG('Morate izabrati igru!', 'error');
		redirect_to('add_server.php?user_id='.$User_ID.'&box_id='.$Box_ID);
		die();
	} 
	
	$Mod_ID 		= txt($_POST['mod']);
	if (empty($Mod_ID)) {
		sMSG('Morate izabrati mod!', 'error');
		redirect_to('add_server.php?user_id='.$User_ID.'&box_id='.$Box_ID);
		die();
	} 
	
	$Srv_Name 		= txt($_POST['ime']);
	if (empty($Srv_Name)) {
		$Host_Name = real_site_name();
		$Srv_Name = 'New Server by '.$Host_Name.'';
	} 
	
	$Srv_Slot 		= txt($_POST['slotovi']);
	if (empty($Srv_Slot)) {
		sMSG('Morate izabrati koliko slotova zelite da ima ovaj server!', 'error');
		redirect_to('add_server.php?user_id='.$User_ID.'&box_id='.$Box_ID);
		die();
	} 
	
	if ($Game_ID == 1) {
		$Port_CS 		= txt($_POST['port_cs']);
		if (empty($Port_CS)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_CS;
		}
		$G_type = 'halflife';
	} else if ($Game_ID == 2) {
		$Port_SAMP 		= txt($_POST['port_samp']);
		if (empty($Port_SAMP)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_SAMP;
		}
		$G_type = 'samp';
	} else if ($Game_ID == 3) {
		$Port_MC 		= txt($_POST['port_mc']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'minecraft';
	} else if ($Game_ID == 4) {
		$Port_MC 		= txt($_POST['port_cod2']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'cod2';
	} else if ($Game_ID == 5) {
		$Port_MC 		= txt($_POST['port_cod4']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'cod4';
	} else if ($Game_ID == 6) {
		$Port_MC 		= txt($_POST['port_ts']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'ts';
	} else if ($Game_ID == 7) {
		$Port_MC 		= txt($_POST['port_csgo']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'csgo';
	} else if ($Game_ID == 8) {
		$Port_MC 		= txt($_POST['port_mta']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'mta';
	} else if ($Game_ID == 9) {
		$Port_MC 		= txt($_POST['port_ark']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'ark';
	} else if ($Game_ID == 10) {
		$Srv_Port = '0';
		$G_type = 'fdl';
	} else if ($Game_ID == 11) {
		$Port_MC 		= txt($_POST['port_fivem']);
		if (empty($Port_MC)) {
			$Srv_Port = '';
		} else {
			$Srv_Port = $Port_MC;
		}
		$G_type = 'fivem';
	}


	if (empty($Srv_Port)) {
		sMSG('Nije podesen port! #no_port', 'error');
		redirect_to('add_server.php?user_id='.$User_ID.'&box_id='.$Box_ID);
		die();
	}
	
	$Srv_Password 	= txt($_POST['password']);
	if (empty($Srv_Password)) {
		$Srv_Password = random_s_key(12);
	}
	
	$Srv_Username = txt($_POST['username']);
	if (empty($Srv_Username)) {
		$Srv_Username = random_s_key(8);
	}

	$Srv_Istice 	= txt($_POST['istice']);
	if (empty($Srv_Istice)) {
		$Srv_Istice = date("m/d/Y", time());
	}

	$Srv_Mapa 		= get_mod_map($Mod_ID);
	$Srv_Komanda 	= get_mod_komanda($Mod_ID);
	$Box_Location 	= box_location($Box_ID);
	$Srv_Cena 		= cena_slota_code($User_ID, $Srv_Slot, $Game_ID, $Box_Location);
	$Srv_mod = get_mod_link($Mod_ID);
	//Install srv
	$srv_install 	= srv_install($Box_ID, $Srv_Username, $Srv_Password, $Srv_mod);
	if ($srv_install == false) {
		sMSG('Doslo je do greske! (Server nije instaliran)', 'error');
		redirect_to('add_server.php?user_id='.$User_ID.'&box_id='.$Box_ID);
		die();
	} else {
		//in base
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("INSERT INTO `serveri` (`user_id`, `box_id`, `name`, `rank`, `modovi`, `map`, `port`, `fps`, `slotovi`, `username`, `password`, `istice`, `status`, `startovan`, `free`, `uplatnica`, `igra`, `komanda`, `cena`, `boost`, `cache`, `graph`, `reinstaliran`, `backup`, `napomena`, `autorestart`, `backupstatus`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$in_base = $SQLSEC->Execute(array($User_ID, $Box_ID, $Srv_Name, '00000', $Mod_ID, $Srv_Mapa, $Srv_Port, 300, $Srv_Slot, $Srv_Username, $Srv_Password, $Srv_Istice, 1, 0, 0, 1, $Game_ID, $Srv_Komanda, $Srv_Cena, 0, NULL, NULL, 0, 0, 'Nema', '-1', 0));
		$Server_ID 	= $rootsec->lastInsertId();
		$Get_IPP 	= box_ip($Box_ID);
		$SQLSEC = $rootsec->prepare("INSERT INTO `lgsl` (`id`, `type`, `ip`, `c_port`, `q_port`, `s_port`, `zone`, `disabled`, `comment`, `status`, `cache`, `cache_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$in_base2 = $SQLSEC->Execute(array($G_type, $Get_IPP, $Srv_Port, $Srv_Port, 0, 0, 0, '$Srv_Name', 0, '', ''));
		if (!$in_base && !$in_base2) {
			sMSG('Server je instaliran, ali dogodila se greska prilikom spajanja na mysql bazu!', 'error');
			redirect_to('add_server.php?user_id='.$User_ID.'&box_id='.$Box_ID);
			die();
		} else {
			sMSG('Uspesno ste instalirali novi server! '.$Srv_Name, 'success');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		}
	}
}

/* Delete server */

if (isset($_GET['s']) && $_GET['s'] == "delete_server") {
	$Server_ID 		= txt($_POST['server_id']); 
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (server_is_start($Server_ID) == true) {
		sMSG('Server mora biti stopiran, da biste ga izbrisali!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$User_ID 		= txt($_POST['user_id']);
	if (is_valid_user($User_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$Box_ID 		= getBOX($Server_ID);
	if (is_valid_box($Box_ID) == false) {
		sMSG('Ova masina ne postoji!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$Srv_Username 	= server_username($Server_ID);

	//Delete srv
	$srv_install 	= srv_delete($Box_ID, $Srv_Username);
	if ($srv_install == false) {
		sMSG('Doslo je do greske! (Server nije obrisan)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		//in base
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("DELETE FROM `serveri` WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Server_ID));
		
		if ($in_base == false) {
			sMSG('Server je izbrisan sa masine, ali dogodila se greska prilikom spajanja na mysql bazu!', 'error');
			redirect_to('gp-server.php?id='.$Server_ID);
			die();
		} else {
			sMSG('Uspesno ste obrisali server!', 'success');
			redirect_to('gp-servers.php');
			die();
		}
	}
}

if (isset($_GET['a']) && $_GET['a'] == "add_client") {
	$Client_Username 	= txt($_POST['username']);
	$Client_Ime 		= txt($_POST['ime']);
	$Client_Prezime 	= txt($_POST['prezime']);
	$Client_Email 		= txt($_POST['email']);
	$Client_Drzava 		= txt($_POST['drzava']);
	$Client_Sifra 		= md5($_POST['sifra']);
	$Client_PinCode 	= txt($_POST['pin_code']);
	$Client_Token 		= txt($_POST['token']);

	$Reg_User  			= date('m.d.Y, H:i');

	if (empty($Client_Username)||empty($Client_Ime)||empty($Client_Prezime)||empty($Client_Email)||empty($Client_Drzava)||empty($Client_Sifra)||empty($Client_PinCode)||empty($Client_Token)) {
		sMSG('Greska! Pogledajte dali su ispravno upisane informacije!', 'error');
		redirect_to('add_client.php');
		die();
	}
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("INSERT INTO `klijenti` (`klijentid`, `username`, `sifra`, `ime`, `prezime`, `email`, `novac`, `status`, `kreiran`, `zemlja`, `avatar`, `cover`, `sigkod`, `token`, `mail`, `dodao`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$in_base = $SQLSEC->Execute(array(NULL, $Client_Username, $Client_Sifra, $Client_Ime, $Client_Prezime, $Client_Email, 0, 1, $Reg_User, $Client_Drzava, 'avatar.png', 'cover.png', $Client_PinCode, $Client_Token, 1, $_SESSION["admin_login"]));
	
	$C_New_ACC_ID = $rootsec->lastInsertId();

	if (!$in_base) {
		sMSG('Doslo je do greske! #ACC nije kreiran', 'error');
		redirect_to('add_client.php');
		die();
	} else {
		sMSG('Uspesno ste kreirali novi acc!', 'success');
		redirect_to('gp-client.php?id='.$C_New_ACC_ID);
		die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "change_profile") {
	$Client_ID 		= txt($_POST['client_id']);
	if (is_valid_user($Client_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('clients.php');
		die();
	}

	$User_Name 		= txt($_POST['ime']);
	$User_lName 	= txt($_POST['prezime']);
	$User_Email 	= txt($_POST['email']);
	$User_Pass 		= txt($_POST['password']);
	$User_Code 		= txt($_POST['pin_code']);

	if (empty($User_Name)||empty($User_lName)||empty($User_Email)||empty($User_Code)) {
		sMSG('Pogledajte dali ste dobro popunili sva polja.', 'info');
		redirect_to('gp-client.php?id='.$Client_ID);
		die();
	}

	if (empty($User_Pass)) {
		//edit bez passworda
		$rootsec = rootsec();
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `ime` = ? WHERE `klijentid` = ?");
		$in_base = $SQLSEC->Execute(array($User_Name, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `prezime` = ? WHERE `klijentid` = ?");
		$in_base2 = $SQLSEC->Execute(array($User_lName, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `email` = ? WHERE `klijentid` = ?");
		$in_base3 = $SQLSEC->Execute(array($User_Email, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `sigkod` = ? WHERE `klijentid` = ?");
		$in_base4 = $SQLSEC->Execute(array($User_Code, $Client_ID));
		
		if (!$in_base || !$in_base2 || !$in_base3 || !$in_base4) {
			sMSG('Doslo je do greske, molimo prijavite ovaj bag nasoj administraciji! #Edit_Prof', 'error');
			redirect_to('gp-client.php?id='.$Client_ID);
			die();
		} else {
			sMSG('Uspesno ste sacuvali izmene!', 'success');
			redirect_to('gp-client.php?id='.$Client_ID);
			die();
		}
	} else {
		//edit sa passwordom
		$User_Pass = md5($User_Pass);

		$rootsec = rootsec();
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `ime` = ? WHERE `klijentid` = ?");
		$in_base = $SQLSEC->Execute(array($User_Name, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `prezime` = ? WHERE `klijentid` = ?");
		$in_base2 = $SQLSEC->Execute(array($User_lName, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `email` = ? WHERE `klijentid` = ?");
		$in_base3 = $SQLSEC->Execute(array($User_Email, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `sigkod` = ? WHERE `klijentid` = ?");
		$in_base4 = $SQLSEC->Execute(array($User_Code, $Client_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `klijenti` SET `sifra` = ? WHERE `klijentid` = ?");
		$in_base5 = $SQLSEC->Execute(array($User_Pass, $Client_ID));
		
		if (!$in_base || !$in_base2 || !$in_base3 || !$in_base4 || !$in_base5) {
			sMSG('Doslo je do greske, molimo prijavite ovaj bag nasoj administraciji! #Edit_Prof', 'error');
			redirect_to('gp-client.php?id='.$Client_ID);
			die();
		} else {
			sMSG('Uspesno ste sacuvali izmene!', 'success');
			redirect_to('gp-client.php?id='.$Client_ID);
			die();
		}
	}
}

//////////////

if (isset($_GET['a']) && $_GET['a'] == "edit_admin") {
	$Admin_ID 		= txt($_POST['admin_id']);
	if (is_valid_admin($Admin_ID) == false) {
		sMSG('Ovaj admin ne postoji!', 'error');
		redirect_to('all_admin.php');
		die();
	}

	$Admin_UserName = txt($_POST['username']);
	$a_name 		= txt($_POST['ime']);
	$Admin_Name1 	= explode(' ', $a_name);
	$Admin_Name 	= txt($Admin_Name1[0]);
	$Admin_lName 	= txt($Admin_Name1[1]);
	$Admin_Email 	= txt($_POST['email']);
	$Admin_Pass 	= txt($_POST['sifra']);

	$Admin_Perm 	= txt($_POST['radnik']);

	if (empty($a_name)||empty($Admin_Name)||empty($Admin_lName)||empty($Admin_Email)) {
		sMSG('Pogledajte dali ste dobro popunili sva polja.', 'info');
		redirect_to('admin_edit.php?id='.$Admin_ID);
		die();
	}

	if (empty($Admin_Pass)) {
		//edit bez passworda
		$rootsec = rootsec();
		
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `fname` = ? WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Admin_Name, $Admin_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `lname` = ? WHERE `id` = ?");
		$in_base2 = $SQLSEC->Execute(array($Admin_lName, $Admin_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `email` = ? WHERE `id` = ?");
		$in_base3 = $SQLSEC->Execute(array($Admin_Email, $Admin_ID));
		

		if (view_admin(a_status($_SESSION['admin_login'])) == false) {
			$in_base4  	= true;
			$in_base5  	= true;
		} else {
			$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `status` = ? WHERE `id` = ?");
			$in_base4 = $SQLSEC->Execute(array($Admin_Perm, $Admin_ID));
			
			$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `username` =  WHERE `id` = ?");
			$in_base5 = $SQLSEC->Execute(array($Admin_UserName, $Admin_ID));
		}

		if (!$in_base||!$in_base2||!$in_base3||!$in_base4||!$in_base5) {
			sMSG('Doslo je do greske!', 'error');
			redirect_to('admin_edit.php?id='.$Admin_ID);
			die();
		} else {
			sMSG('Uspesno ste sacuvali izmene! #'.a_username($Admin_ID), 'success');
			redirect_to('admin_edit.php?id='.$Admin_ID);
			die();
		}

	} else {
		//edit sa passwordom
		$Admin_Pass = md5($Admin_Pass);
		$rootsec = rootsec();
		
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `fname` = ? WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Admin_Name, $Admin_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `lname` = ? WHERE `id` = ?");
		$in_base2 = $SQLSEC->Execute(array($Admin_lName, $Admin_ID));
		
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `email` = ? WHERE `id` = ?");
		$in_base3 = $SQLSEC->Execute(array($Admin_Email, $Admin_ID));
		
		if (view_admin(a_status($_SESSION['admin_login'])) == false) {
			$in_base4  	= true;
			$in_base5  	= true;
		} else {
			$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `status` = ? WHERE `id` = ?");
			$in_base4 = $SQLSEC->Execute(array($Admin_Perm, $Admin_ID));
			
			$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `username` =  WHERE `id` = ?");
			$in_base5 = $SQLSEC->Execute(array($Admin_UserName, $Admin_ID));
		}
		$SQLSEC = $rootsec->prepare("UPDATE `admin` SET `password` = ? WHERE `id` = ?");
		$in_base6 = $SQLSEC->Execute(array($Admin_Pass, $Admin_ID));

		if (!$in_base||!$in_base2||!$in_base3||!$in_base4||!$in_base5||!$in_base6) {
			sMSG('Doslo je do greske!', 'error');
			redirect_to('admin_edit.php?id='.$Admin_ID);
			die();
		} else {
			sMSG('Uspesno ste sacuvali izmene! #'.a_username($Admin_ID), 'success');
			redirect_to('admin_edit.php?id='.$Admin_ID);
			die();
		}
	}
}

//////////////

if (isset($_GET['a']) && $_GET['a'] == "add_mod") {
	$Mod_Name 			= txt($_POST['ime']);
	$Mod_Opis 			= txt($_POST['opis']);
	$Mod_Game 			= txt($_POST['game_']);
	$Mod_Link	 		= $_POST['link'];
	$Mod_Map 			= txt($_POST['def_mapa']);

	if (empty($Mod_Name)||empty($Mod_Opis)||empty($Mod_Game)||empty($Mod_Link)||empty($Mod_Map)) {
		sMSG('Mod nije dodat! -Sva polja moraju biti popunjena!', 'error');
		redirect_to('add_mod.php');
		die();
	}

	if ($Mod_Game == 1) {
		$Mod_Command = './hlds_run -game cstrike +ip {$ip} +port {$port} +maxplayers {$slots} +sys_ticrate 300 +map {$map} +servercfgfile server.cfg';
	} else if($Mod_Game == 2) {
		$Mod_Command = './samp03svr';
	} else if($Mod_Game == 3) {
		$Mod_Command = 'java -d64 -Xincgc -Xms512M -Xmx1024M -XX:MaxPermSize=128M -XX:+DisableExplicitGC -XX:+AggressiveOpts -Dfile.encoding=UTF-8 -jar Server.jar';
	} else if($Mod_Game == 4) {
		$Mod_Command = '';
	} else if($Mod_Game == 5) {
		$Mod_Command = '';
	} else if($Mod_Game == 6) {
		$Mod_Command = '';
	} else if($Mod_Game == 7) {
		$Mod_Command = '';
	} else if($Mod_Game == 8) {
		$Mod_Command = './mta-server64';
	} else if($Mod_Game == 9) {
		$Mod_Command = '';
	} else {
		$Mod_Command = '';
	}

	// Cene slota.
	$Mod_Cena_RS = mod_cena_for_slot(1, $Mod_Game, 'RS');
	$Mod_Cena_HR = mod_cena_for_slot(1, $Mod_Game, 'HR');
	$Mod_Cena_BA = mod_cena_for_slot(1, $Mod_Game, 'BA');
	$Mod_Cena_MK = mod_cena_for_slot(1, $Mod_Game, 'MK');
	$Mod_Cena_ME = mod_cena_for_slot(1, $Mod_Game, 'ME');

	// Primer -- 61din|3.7kn|0.9km|30mkd|0.375eur
	$Mod_Cena = $Mod_Cena_RS.'din|'.$Mod_Cena_HR.'kn|'.$Mod_Cena_BA.'km|'.$Mod_Cena_MK.'mkd|'.$Mod_Cena_ME.'eur';
	$rootsec = rootsec();
		
	$SQLSEC = $rootsec->prepare("INSERT INTO `modovi` (`id`, `link`, `ime`, `opis`, `igra`, `komanda`, `sakriven`, `mapa`, `cena`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$in_base = $SQLSEC->Execute(array(NULL, $Mod_Link, $Mod_Name, $Mod_Opis, $Mod_Game, $Mod_Command, 0, $Mod_Map, $Mod_Cena));
	
	$Mod_ID = $rootsec->lastInsertId();
	if (!$in_base) {
		sMSG('Mod nije dodat!', 'error');
		redirect_to('add_mod.php');
		die();
	} else {
		sMSG('Uspesno ste dodali novi mod! #'.$Mod_Name, 'success');
		redirect_to('list_mods.php');
		die();
	}

}

if (isset($_GET['a']) && $_GET['a'] == "add_plugin") {
	$Plugin_Name 		= txt($_POST['ime']);
	$Plugin_Opis 		= $_POST['opis'];
	$Plugin_Game 		= txt($_POST['game_']);
	$Plugin_Cvars 		= txt($_POST['cvarovi']);
	$Plugin_link		= $_POST['link'];

	if (empty($Plugin_Name)||empty($Plugin_Opis)||empty($Plugin_Game)) {
		sMSG('Plugin nije dodat! -Sva polja moraju biti popunjena!', 'error');
		redirect_to('add_plugin.php');
		die();
	}

	if (empty($Plugin_Cvars)) {
		$Plugin_Cvars = 'Nema.';
	}

	if (!$Plugin_Game == 1) {
		sMSG('Plugin nije dodat! - Ova opcija je omogucena samo za Counter-Strike 1.6 igru!', 'error');
		redirect_to('add_plugin.php');
		die();
	}

	$rootsec = rootsec();
		
	$SQLSEC = $rootsec->prepare("INSERT INTO `plugins` (`id`, `ime`, `deskripcija`, `prikaz`, `text`, `game_id`) VALUES (?, ?, ?, ?, ?, ?);");
	$in_base = $SQLSEC->Execute(array(NULL, $Plugin_Name, $Plugin_Opis, $Plugin_F_Name, $Plugin_link, $Plugin_Game));
	
	$Plugin_ID = $rootsec->lastInsertId();
	if (!$in_base) {
		sMSG('Plugin nije dodat!', 'error');
		redirect_to('add_plugin.php');
		die();
	} else {
	    	sMSG('Plugin nije dodat! Doslo je do greske!', 'error');
			redirect_to('add_plugin.php');
			die();
	}
}

if (isset($_GET['a']) && $_GET['a'] == "add_admin") {
	$Admin_UserName 	= txt($_POST['username']);
	$Admin_Name 		= txt($_POST['ime']);
	$Admin_Prezime 		= txt($_POST['prezime']);
	$Admin_Note 		= txt($_POST['komentar']);
	$Admin_Email 		= txt($_POST['email']);
	$Admin_Radnik 		= txt($_POST['radnik']);
	$Admin_Password 	= txt($_POST['sifra']);
	
	if (empty($Admin_Name)||empty($Admin_Prezime)||empty($Admin_Email)||empty($Admin_Radnik)||empty($Admin_Password)) {
		sMSG('Morate popuniti sva polja!', 'error');
		redirect_to('add_admin.php');
		die();
	}

	if (isset($_POST['admin_perm'])) {
		$Adm_Perm 			= $_POST['admin_perm'];
	} else {
		$Adm_Perm 			= '';
	}

	$Adm_Premission = '';
	foreach ($Adm_Perm as $val) {
		$Adm_Premission .= $val.'|';
	}
	//////////////////////////
	if (isset($_POST['supp_perm'])) {
		$Supp_Perm 			= $_POST['supp_perm'];
	} else {
		$Supp_Perm 			= '';
	}

	$Supp_Premission = '';
	foreach ($Supp_Perm as $val) {
		$Supp_Premission .= $val.'|';
	}

	$Admin_Password = md5($Admin_Password);

	$Host_Name = site_name();
	$Adm_Potpis = "{$Admin_Name} {$Admin_Prezime}
- $Host_Name ".admin_code_to_rank($Admin_Radnik);

	$rootsec = rootsec();
		
	$SQLSEC = $rootsec->prepare("INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `password`, `email`, `status`, `signature`, `support_za`, `adm_perm`, `note`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$in_base = $SQLSEC->Execute(array(NULL, $Admin_Name, $Admin_Prezime, $Admin_UserName, $Admin_Password, $Admin_Email, $Admin_Radnik, $Adm_Potpis, $Supp_Premission, $Adm_Premission, $Admin_Note));
	
	$Admin_ID = $rootsec->lastInsertId();
	if (!$in_base) {
		sMSG('Doslo je do greske! -Admin nije dodat! #Error add_admin', 'error');
		redirect_to('add_admin.php');
		die();
	} else {
		sMSG('Uspesno ste dodali novog admina!', 'success');
		redirect_to('admin.php?id='.$Admin_ID);
		die();
	}

}

////////////////////////////////

/* Server process WebFTP */

if (isset($_GET['a']) && $_GET['a'] == "delete_folder") {
	$Server_ID 			= txt($_POST['server_id']);
	$Server_Path 		= txt($_POST['path']);
	$Server_Folder 		= txt($_POST['f_name']);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
		sMSG('Ovaj server ne postoji!', 'error');
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
	$in_base = $SQLSEC->Execute(array($Vreme, $Server_ID));

	if (!$in_base) {
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

////////////////////////////////////////////////////////////

/* Server process Start,Stop,Restart,Reinstall,BackUP */

if (isset($_GET['s']) && $_GET['s'] == "server_start") {

	$Server_ID 			= txt($_POST['server_id']);
	$Box_ID 			= getBOX($Server_ID); 


	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (server_is_start($Server_ID) == true) {
		sMSG('Ovaj server je vec startovan! (Probajte restartovati vas server)', 'info');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	include_once($_SERVER['DOCUMENT_ROOT'].'/core/admin/games/inc.php');


	$start_server = start_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), game_command($Server_ID), server_username($Server_ID));
	if ($start_server != true) {
		sMSG('Server nije startovan. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `startovan` = '1' WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Server_ID));

		sMSG('Server je uspesno startovan.', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

}

if (isset($_GET['s']) && $_GET['s'] == "server_restart") {
	$Server_ID 			= txt($_POST['server_id']);
	$Box_ID 			= getBOX($Server_ID); 

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	include_once($_SERVER['DOCUMENT_ROOT'].'/core/admin/games/inc.php');

	$stop_server = stop_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), game_command($Server_ID), server_username($Server_ID));
	$start_server = start_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), game_command($Server_ID), server_username($Server_ID));
	
	if ($stop_server != true || $start_server != true) {
		sMSG('Server nije restartovan. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `startovan` = '1' WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Server_ID));

		sMSG('Server je uspesno restartovan.', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

}

if (isset($_GET['s']) && $_GET['s'] == "server_stop") {
	$Server_ID 			= txt($_POST['server_id']);
	$S_Command 			= game_command($Server_ID);
	$Box_ID 			= getBOX($Server_ID); 
	$user = server_username($Server_ID);

	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
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
	if ($stop_server != true) {
		sMSG('Server nije stopiran. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `startovan` = '0' WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Server_ID));

		sMSG('Server je uspesno stopiran.', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

}

if (isset($_GET['s']) && $_GET['s'] == "server_reinstall") {
	$Server_ID 			= txt($_POST['server_id']);
	$Box_ID 			= getBOX($Server_ID); 
	
	if(isset($_POST['mod_id']))
		$Mod_ID 		= txt($_POST['mod_id']); 
	
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
	
	if(!isset($Mod_ID))
		$Mod_ID = server_mod($Server_ID);
	
	$ModLoc = get_mod_link($Mod_ID);
	
	$reinstall_server = reinstall_server(box_ip($Box_ID), box_ssh($Box_ID), box_username($Box_ID), box_password($Box_ID), $ModLoc, server_username($Server_ID));
	if ($reinstall_server != true) {
		$rootsec = rootsec();
		
		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `modovi` = ? WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Mod_ID, $Server_ID));
		
		sMSG('Server nije Reinstaliran. (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();
		
		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `modovi` = ? WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Mod_ID, $Server_ID));
		
		sMSG('Server je uspesno Reinstaliran na '.server_mod_name($Server_ID).' mod. (Sacekajte par minuta "Predlog: 1/2min")', 'success');
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
		
	$SQLSEC = $rootsec->prepare("INSERT INTO `server_backup` SET
		`srvid`		=		?,
		`time`		=		?,
		`name`		=		?,
		`status`	=		'0',
		`size`		=		'0'
	");

	$in_base = $SQLSEC->Execute(array($Server_ID, $Date,$Bacup_Name));

	
	if (!$in_base) {
		sMSG('Doslo je do greske sa bazom! (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
	
	$backup_server = server_backup($Box_ID, $Server_ID, $Bacup_Name);
	
	if ($backup_server != true) {
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
	$SQLSEC = $rootsec->prepare("SELECT * FROM `server_backup` WHERE `id` = ?");
	$SQLSEC = $SQLSEC->Execute(array($Backup_ID));
	$Backup = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$Backup_Name	=	$Backup['name'];
	
	$server_backup_restore = server_backup_restore($Box_ID, $Server_ID, $Backup_Name);
	
	if ($server_backup_restore != true) {
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
	$SQLSEC = $rootsec->prepare("SELECT * FROM `server_backup` WHERE `id` = ?");
	$SQLSEC = $SQLSEC->Execute(array($Backup_ID));
	$Backup = $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$Backup_Name = $Backup['name'];
	
	$SQLSEC = $rootsec->prepare("DELETE FROM `server_backup` WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($Backup_ID));
	
	if (!$in_base) {
		sMSG('Doslo je do greske sa bazom! (GamePanel je u BETA fazi, te vas molimo da nam prijavite ovaj bag)', 'error');
		redirect_to('gp-backup.php?id='.$Server_ID);
		die();
	}
	
	$server_backup_delete = server_backup_delete($Box_ID, $Server_ID, $Backup_Name);
	
	if ($server_backup_delete != true) {
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
		sMSG('Ovaj server ne postoji!', 'error');
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
	if ($install_mod != true) {
		sMSG('Promena moda nije uspela! #ChangeMod | #err1', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		$rootsec = rootsec();
		$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `modovi` = ? WHERE `id` = ?");
		$in_base = $SQLSEC->Execute(array($Mod_ID,$Server_ID));

		if (!$in_base) {
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

////////////////////
if (isset($_GET['s']) && $_GET['s'] == "suspend_server") {
	$Server_ID 		= txt($_POST['server_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	$rootsec = rootsec();
		
	$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `status` = '2' WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($Server_ID));
	if (!$in_base) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste suspendovali ovaj server!', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
}

if (isset($_GET['s']) && $_GET['s'] == "un_suspend_server") {
	$Server_ID 		= txt($_POST['server_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	$rootsec = rootsec();
		
	$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `status` = '1' WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($Server_ID));
	if (!$in_base) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste UN-suspendovali ovaj server!', 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
}
////////////////////////////////
if (isset($_GET['s']) && $_GET['s'] == "change_owner") {
	$Server_ID 		= txt($_POST['server_id']);
	$Client_ID 		= txt($_POST['client_id']);
	
	if (is_valid_server($Server_ID) == false) {
		sMSG('Ovaj server ne postoji!', 'error');
		redirect_to('gp-servers.php');
		die();
	}

	if (is_valid_user($Server_ID) == false) {
		sMSG('Ovaj klijent ne postoji!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}

	$rootsec = rootsec();
		
	$SQLSEC = $rootsec->prepare("UPDATE `serveri` SET `user_id` = ? WHERE `id` = ?");
	$in_base = $SQLSEC->Execute(array($Client_ID, $Server_ID));
	if (!$in_base) {
		sMSG('Doslo je do greske!', 'error');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	} else {
		sMSG('Uspesno ste prebacili server klijentu! #'.user_full_name($Client_ID), 'success');
		redirect_to('gp-server.php?id='.$Server_ID);
		die();
	}
}
if (isset($_GET['s']) && $_GET['s'] == "csfirewallinstall") {
	$boxid		= txt($_POST['boxid']);
	csfirewallinstall($boxid);
}
?>
