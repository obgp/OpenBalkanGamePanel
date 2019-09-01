<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');


function cp_perm_srv_view($s_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($_SESSION["admin_login"]));
	$a_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);

	$Supp_Status = txt($a_info['status']);

	if (!($Supp_Status == 3||$Supp_Status == 4)) {
		$exp = explode('|', $a_info['support_za']);
		$exp = implode('', $exp);

		if (server_game_id($s_id) == 1) {
			$pp = stristr($exp, '1');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 2) {
			$pp = stristr($exp, '2');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 3) {
			$pp = stristr($exp, '3');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 4) {
			$pp = stristr($exp, '4');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 5) {
			$pp = stristr($exp, '5');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 6) {
			$pp = stristr($exp, '6');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 7) {
			$pp = stristr($exp, '7');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 8) {
			$pp = stristr($exp, '8');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		} else if (server_game_id($s_id) == 9) {
			$pp = stristr($exp, '9');
			if (!$pp) {
				$return = false;
			} else {
				$return = true;
			}
		}
	} else {
		$return = true;
	}

	return $return;
}

function cp_perm_tiket_view($t_id) {
	$rootsec = rootsec();
	$SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi` WHERE `id` = ?");
	$SQLSEC->Execute(array($t_id));	
	$t_id 	= $SQLSEC->fetch(PDO::FETCH_ASSOC);
	$s_id 	= txt($t_id['server_id']);

	if (empty($s_id)||$s_id == 0) {
		$return = true;
	} else {
	$SQLSEC = $rootsec->prepare("SELECT * FROM `admin` WHERE `id` = ?");
	$SQLSEC->Execute(array($_SESSION["admin_login"]));
	$a_info = $SQLSEC->fetch(PDO::FETCH_ASSOC);
		
	$Supp_Status = txt($a_info['status']);

		if (!($Supp_Status == 3||$Supp_Status == 4)) {
			$exp = explode('|', $a_info['support_za']);
			$exp = implode('', $exp);

			if (server_game_id($s_id) == 1) {
				$pp = stristr($exp, '1');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 2) {
				$pp = stristr($exp, '2');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 3) {
				$pp = stristr($exp, '3');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 4) {
				$pp = stristr($exp, '4');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 5) {
				$pp = stristr($exp, '5');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 6) {
				$pp = stristr($exp, '6');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 7) {
				$pp = stristr($exp, '7');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 8) {
				$pp = stristr($exp, '8');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			} else if (server_game_id($s_id) == 9) {
				$pp = stristr($exp, '9');
				if (!$pp) {
					$return = false;
				} else {
					$return = true;
				}
			}
		} else {
			$return = true;
		}
	}

	return $return;
}

function view_developer($a_status) {
	if (empty($a_status)) {
		$return = false;
	} else if ($a_status == '4') {
		$return = true;
	} else {
		$return = false;
	}

	return $return;
}

?>
