<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

if(isset($_GET['action'])) {
  $action = stripslashes(htmlspecialchars(trim($_GET['action'])));
  $url = explode('/', $action);
} else {
  $url[0] = "home";
}
if (!(is_login()) == true) {
switch ($url[0]) {
	case 'home': {
    		$title = 'Home | '.site_name();
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/index.php');
		break;
   	}
/*   	case 'login': {
   		$title = 'Login | '.site_name();
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/login.php');
   		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/footer.php');
    		break;
  	}
	case 'register': {	   
    		$title = 'Register | '.site_name();
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/head.php');
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/register.php');
   	        require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/footer.php');
   		break;
  	}*/
	case 'demo': {
		if (!user_login('demo@obgp.me', 'demo')) {
			sMSG('Doslo je do greske, molimo pokusajte malo kasnije.', 'error');
			redirect_to('home');
			die();
		} else {
			sMSG('Uspesno ste se ulogovali na demo nalog.', 'success');
			redirect_to('home');
			die();
		}
   		break;
  	}
	default: {
		header('Location: /');
	}
}
} else {
switch ($url[0]) {
	case 'home': {
    		$title = 'Home | '.site_name();
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/home.php');
    		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
		break;
   	}
	case 'webftp': {
		$title = 'WebFTP | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/webftp.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'view-billing': {
		$title = 'View billing | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/view-billing.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'ticket': {
		$title = 'Ticket | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/ticket.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'support': {
		$title = 'Support | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/support.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'settings': {
		$title = 'Settings | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/settings.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'servers': {
		$title = 'Servers | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/servers.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'server': {
		$title = 'Server | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/server.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'plugins': {
		$title = 'Plugins | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/plugins.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'order': {
		$title = 'Order | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/order.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'mods': {
		$title = 'Mods | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/mods.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'maps': {
		$title = 'Maps | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/maps.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'iplogs': {
		$title = 'IP Logs | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/iplog.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'console': {
		$title = 'Console | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/console.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'boost': {
		$title = 'Boost | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/boost.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'billing': {
		$title = 'Billing | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/billing.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'backup': {
		$title = 'Backup | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/backup.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'autorestart': {
		$title = 'Auto Restart | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/autorestart.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'admins': {
		$title = 'Admins | '.site_name();
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/head.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/admins.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/pages/partial/footer.php');
	break;
    }
	case 'logout': {
    		if(session_destroy()) {
			setcookie('user_login', NULL, time() - 604800);
			header('Location: /');
			exit();
		}
   	}
	break;
	default: {
		header('Location: /');
	}
}
}