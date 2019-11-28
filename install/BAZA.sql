-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 12:04 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obgp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `status` text NOT NULL,
  `signature` text CHARACTER SET latin1 NOT NULL,
  `lastactivity` text CHARACTER SET latin1 NOT NULL,
  `boja` text CHARACTER SET latin1 NOT NULL,
  `login_session` text CHARACTER SET latin1 NOT NULL,
  `avatar` varchar(999) CHARACTER SET latin1 DEFAULT 'nema_avatar.png',
  `lastactivityname` text DEFAULT NULL,
  `lastip` text NOT NULL,
  `lasthost` text NOT NULL,
  `last_login` text NOT NULL,
  `support_za` text NOT NULL,
  `adm_perm` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `password`, `email`, `status`, `signature`, `lastactivity`, `boja`, `login_session`, `avatar`, `lastactivityname`, `lastip`, `lasthost`, `last_login`, `support_za`, `adm_perm`, `note`) VALUES
(1, 'Admin', 'OBGP', 'Admin', 'fe01ce2a7fbac8fafaed7c982a04e229', 'obgp@pm.me', '3', 'OBGP <3', '1568930689', 'red', '', 'default.png', '', '::1', 'DESKTOP-0T4A71K', '19.09.2019, 13:06', '1|2|3|4|5|6|7|8|9', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `banovi`
--

CREATE TABLE `banovi` (
  `id` int(11) NOT NULL,
  `klijentid` int(11) DEFAULT NULL,
  `vreme` int(11) DEFAULT NULL,
  `razlog` text DEFAULT NULL,
  `trajanje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `game_id` text NOT NULL,
  `mod_id` text NOT NULL,
  `location` text NOT NULL,
  `slotovi` text NOT NULL,
  `mesec` text NOT NULL,
  `name` text NOT NULL,
  `cena` text NOT NULL,
  `date` text NOT NULL,
  `dokaz` text DEFAULT NULL,
  `status` text NOT NULL,
  `srv_z_install` varchar(100) NOT NULL DEFAULT '0',
  `srv_install` varchar(100) DEFAULT '0',
  `buy_sms` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billing_currency`
--

CREATE TABLE `billing_currency` (
  `cid` int(11) NOT NULL,
  `multiply` double NOT NULL DEFAULT 1,
  `name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sign` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `zemlja` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_log`
--

CREATE TABLE `billing_log` (
  `logid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL,
  `adminid` int(11) NOT NULL DEFAULT 0,
  `time` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `box`
--

CREATE TABLE `box` (
  `boxid` int(8) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `routeip` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `password` blob NOT NULL,
  `sshport` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ftpport` int(11) NOT NULL DEFAULT 21,
  `maxsrv` int(11) NOT NULL,
  `cache` blob DEFAULT NULL,
  `box_load_5min` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `box_load` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `tspass` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `Text` text DEFAULT NULL,
  `Autor` text NOT NULL,
  `Datum` text NOT NULL,
  `ID` int(11) NOT NULL,
  `admin_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crons`
--

CREATE TABLE `crons` (
  `id` int(11) NOT NULL,
  `cron_name` varchar(255) NOT NULL,
  `cron_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crons`
--

INSERT INTO `crons` (`id`, `cron_name`, `cron_value`) VALUES
(1, 'box_info', '2019-06-23 01:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE `error_log` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `string` varchar(255) DEFAULT NULL,
  `file` mediumtext DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `datum` mediumtext DEFAULT NULL,
  `vrsta` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `firewall_adblocker-settings`
--

CREATE TABLE `firewall_adblocker-settings` (
  `id` int(11) NOT NULL,
  `detection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/adblocker-detected.php'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_adblocker-settings`
--

INSERT INTO `firewall_adblocker-settings` (`id`, `detection`, `redirect`) VALUES
(1, 'No', 'http://dev.gb-hoster.me/rootsec/pages/adblocker-detected.php');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_badbot-settings`
--

CREATE TABLE `firewall_badbot-settings` (
  `id` int(11) NOT NULL,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_badbot-settings`
--

INSERT INTO `firewall_badbot-settings` (`id`, `protection`, `protection2`, `protection3`, `logging`, `autoban`, `mail`) VALUES
(1, 'No', 'No', 'No', 'Yes', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_bans`
--

CREATE TABLE `firewall_bans` (
  `id` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firewall_bans-country`
--

CREATE TABLE `firewall_bans-country` (
  `id` int(11) NOT NULL,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned countries table';

-- --------------------------------------------------------

--
-- Table structure for table `firewall_bans-other`
--

CREATE TABLE `firewall_bans-other` (
  `id` int(11) NOT NULL,
  `type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firewall_content-protection`
--

CREATE TABLE `firewall_content-protection` (
  `id` int(11) NOT NULL,
  `function` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `alert` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_content-protection`
--

INSERT INTO `firewall_content-protection` (`id`, `function`, `enabled`, `alert`, `message`) VALUES
(1, 'rightclick', 'No', 'Yes', 'Context Menu not allowed'),
(2, 'rightclick_images', 'No', 'Yes', 'Context Menu on Images not allowed'),
(3, 'cut', 'No', 'Yes', 'Cut not allowed'),
(4, 'copy', 'No', 'Yes', 'Copy not allowed'),
(5, 'paste', 'No', 'Yes', 'Paste not allowed'),
(6, 'drag', 'No', 'No', ''),
(7, 'drop', 'No', 'No', ''),
(8, 'printscreen', 'No', 'Yes', 'It is not allowed to use the Print Screen button'),
(9, 'print', 'No', 'Yes', 'It is not allowed to Print'),
(10, 'view_source', 'No', 'Yes', 'It is not allowed to view the source code of the site'),
(11, 'offline_mode', 'No', 'Yes', 'You have no access to save the page'),
(12, 'iframe_out', 'No', 'No', ''),
(13, 'exit_confirmation', 'No', 'Yes', 'Do you really want to exit our website?'),
(14, 'selecting', 'No', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_dnsbl-databases`
--

CREATE TABLE `firewall_dnsbl-databases` (
  `id` int(11) NOT NULL,
  `database` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_dnsbl-databases`
--

INSERT INTO `firewall_dnsbl-databases` (`id`, `database`) VALUES
(1, 'sbl.spamhaus.org'),
(2, 'xbl.spamhaus.org');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_ip-whitelist`
--

CREATE TABLE `firewall_ip-whitelist` (
  `id` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firewall_logs`
--

CREATE TABLE `firewall_logs` (
  `id` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `query` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `browser_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `os_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `country_code` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'XX',
  `region` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `city` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `latitude` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `longitude` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isp` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `useragent` text COLLATE utf8_unicode_ci NOT NULL,
  `referer_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_logs`
--

INSERT INTO `firewall_logs` (`id`, `ip`, `date`, `time`, `page`, `query`, `type`, `browser`, `browser_code`, `os`, `os_code`, `country`, `country_code`, `region`, `city`, `latitude`, `longitude`, `isp`, `useragent`, `referer_url`) VALUES
(1, '87.116.179.55', '15 July 2019', '21:25', '/gp-view-billing.php', 'id=%22%3E%3Cscript%3Ealert(0)%3C/script%3E', 'SQLi', 'Google Chrome 75.0.3770.54', 'chrome', 'Windows 10 x64', 'win-6', 'Serbia', 'RS', 'Vojvodina', 'Subotica', '46.1', '19.66667', 'Serbia BroadBand-Srpske Kablovske mreze d.o.o.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.54 Safari/537.36', ''),
(2, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(3, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(4, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(5, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(6, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(7, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(8, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(9, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(10, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(11, '127.0.0.2', '09 August 2019', '23:05', '/index.php', '', 'TOR Detected', 'Firefox 5.0', 'firefox', 'GNU/Linux', 'linux', '', '', '', '', '', '', '', 'Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0', ''),
(12, '78.46.157.59', '09 August 2019', '23:26', '/index.php', 'WsPQ=H4jR3TN8xN7er&d8u=CG6IXUJQ3m6Ns06QlNI&PAjwS61=1l3QDIy3&UohblWnlO=LiG02JuEO', 'SQLi', 'Internet Explorer 7.0', 'msie7', 'Mac OS X 10.8.1', 'mac-3', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (compatible; MSIE 7.0; Macintosh; .NET CLR 3.2.21422; Intel Mac OS X 10_8_1)', ''),
(13, '78.46.157.59', '09 August 2019', '23:27', '/index.php', 'CdiJDDX=071CxGaj&GHC=I58LjsocJBx6Ww273b&crCF=838mUff&pdq=cPBqRtIMRDYFbdNeh&2dkqh1=1VK7cu4TE', 'SQLi', 'Safari 4.1.5', 'safari', 'Windows XP x64', 'win-2', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows NT 5.1; Win64; x64) AppleWebKit/537.23 (KHTML, like Gecko) Version/4.1.5 Safari/536.1', ''),
(14, '78.46.157.59', '09 August 2019', '23:27', '/index.php', 'mpFWQKakE1=15acM4CLkiT0woe4HV&UrJnO=Ruuvebv1kG708FCnG7k&QuNU8oLW2=WWGNdQjXmqyW8NbN&5CxQaNu=lmwDCKl&tKW5=oSK7Ky6aOo0GTABx', 'SQLi', 'Google Chrome 31.0.982.66', 'chrome', 'GNU/Linux x64', 'linux', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Linux x86_64; X11) AppleWebKit/537.34 (KHTML, like Gecko) Chrome/31.0.982.66 Safari/535.14', ''),
(15, '78.46.157.59', '09 August 2019', '23:27', '/index.php', '5Vb6=K4aYMuXnYDT3V7HMmDs&53Mj=sXs6&UB1=1EYOVSn25aAH', 'SQLi', 'Firefox 24.0', 'firefox', 'GNU/Linux x64', 'linux', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Linux x86_64; X11) Gecko/20070905 Firefox/24.0', 'http://www.yandex.com/8Q5PjUQwc?2YwH58qjtA=aKrJVmmmKjtnbwq&lybK=UOhxO&7q5KA5B=d6LEpbmLXdLS&5FYbKc=Tj3VTktw6dbAAJVDn81n&tJccMekjP=cJSfLN&Q6mmG5y5=FgALqQIx6&aAuX=iaFhBao5lagM17kVcMT&wce1=SfyLrr5Ey2&VQi2pdDh=lDIU58EQBRkjD7ux'),
(16, '78.46.157.59', '09 August 2019', '23:27', '/index.php', '2UBFiTL=Gd0chAyLi&HWis=YwyaulFr&oKayDp1=1owwFjVhjS7&niC=dvM2uC&FpYFcv=WRA0XQ', 'SQLi', 'Internet Explorer 8.0', 'msie7', 'GNU/Linux', 'linux', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (compatible; MSIE 8.0; Linux i386; .NET CLR 2.2.20842; X11)', 'http://www.baidu.com/4rjl8x?oAsTN5C5d=Tf13jLyVpCgvAsiy&cAPm=B26k2LgF&KM1eI=kXQLc5lY3h1Fxnpv3JI&8swe6xE=ThKI8F6VFoW&dYnTU4=CegdW&g1l=20KtVCugoJtrYHaSbTlR&jvot=5PvOEhPbymFiJewa2'),
(17, '78.46.157.59', '09 August 2019', '23:27', '/index.php', 'CgJr=pjnOMVTguBpvYdnUT7D&R6cDI1=1fpwN8elm&p2QfBT=8hETL&fi1=MviOdiDEn0k1', 'SQLi', 'Internet Explorer 9.0', 'msie9', 'Windows 8.1 x64', 'win-5', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.3; .NET CLR 1.1.2205; WOW64)', ''),
(18, '78.46.157.59', '09 August 2019', '23:29', '/index.php', 'WU1=1r7XapNFsP1uV&Uv5DVqhI=C0IjHvL8d586xN6', 'SQLi', 'Firefox 22.0', 'firefox', 'Windows 7 x64', 'win-4', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows NT 6.1; WOW64) Gecko/20040711 Firefox/22.0', 'http://www.google.com/Cjg1Q0?A4D=AKOwoydaIWhHpa&Qcvs=IT2QPVJ&VUNER77rm=5QLK&yYdgpGv=lUWGjsrejy5h4CtWv&XnE68G5KB=1UkchbljRCwYPt4oIqr&nqXX25KBH=WgLxWa&Q8p5DWYUl=AIxxyqBIYmh30v'),
(19, '78.46.157.59', '09 August 2019', '23:29', '/index.php', 'G0IDKhm=tjNTvUH6Gn8F4SdNx&jjE00EnUp=J2s8Ac&rOp80I=bag4fCP&4nKv8bwvBp=KmP&50V1=1dgSfDxDxyAobPIxR', 'SQLi', 'Firefox 21.0', 'firefox', 'Windows 7 x64', 'win-4', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows NT 6.1; WOW64) Gecko/20062911 Firefox/21.0', 'http://nerds-hosting.com/aSBeSP'),
(20, '78.46.157.59', '09 August 2019', '23:29', '/index.php', 'kDXYXNb0V4=wQUOemS6DoKCAkE&ywhESTUE=T1AQBX56w&lPR8suNk=MsDaJPFoOY2f6LIdF&4iX61=1hbTsWyO6H7uEn&3I4ArFCw=AjoWRMBsV0H1vyp', 'SQLi', 'Google Chrome 29.0.1077.43', 'chrome', 'Windows XP x64', 'win-2', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows NT 5.1; WOW64) AppleWebKit/535.32 (KHTML, like Gecko) Chrome/29.0.1077.43 Safari/537.22', 'http://www.baidu.com/RHfgSV75b?UNJ=0spkxUhic&XfcL72YX=nXRB&WqgqkBIeo=ogGj8'),
(21, '78.46.157.59', '09 August 2019', '23:29', '/index.php', 'WgDRTYX1=1INLrAuy7VDfqmKI6X&kmTSX5R=ovFkdwnK1G1oYasg', 'SQLi', 'Google Chrome 27.0.917.97', 'chrome', 'Mac OS X 10.6.2', 'mac-3', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_2) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/27.0.917.97 Safari/536.9', 'http://www.baidu.com/cxnA10P1pj?n13CWojyH=esCofUwdndK&h28H=6DVv0E4sHrsiqxFLGgl7&UbTJgGW6=Bpf1OJf4HOuIKV&pg06NSwTgj=wraNfDCnRmLQmSaqbOAM&lvNmNs7RY=D5IUvWUAthT4OWf88&L5S2=ARblrWx'),
(22, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'oIGa=crgItK&tfH1=1LaOfEak&MFybE=E4bvole', 'SQLi', 'Firefox 19.0', 'firefox', 'Windows 7 x64', 'win-4', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) Gecko/20090907 Firefox/19.0', 'http://www.baidu.com/4uCVaD?HqK5UK=0CmKWlDov1&7diKd7eP=y7uHv&YOe=LEayE6cqSFJjvmyNPl&KPBv5=y6VRuLBGHRJW&bUI07=FLdLofp8P1e0yHdp'),
(23, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'l7oU0KiLl=biYuHJp2D&H24D2=1einioCqXG&est=cguk2Ago2L17o&dQ0hBDRr8=RQAeUc8UKYerq6Stqo&qRvV1=1n1UctGLwkQ', 'SQLi', 'Google Chrome 22.0.1149.51', 'chrome', 'Mac OS X 11.7.3', 'mac-3', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_7_3) AppleWebKit/536.25 (KHTML, like Gecko) Chrome/22.0.1149.51 Safari/536.15', ''),
(24, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'D1B1O6WQ=AkeMpthvpwyYEugqKQ&dQe48CS=aIFndxBFgWf8JkaBiMwB&cLtX2bJQ81=1bXtF', 'SQLi', 'Internet Explorer 8.0', 'msie7', 'Mac OS X 10.2.1', 'mac-3', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (compatible; MSIE 8.0; Macintosh; Trident/4.0; Intel Mac OS X 10_2_1)', ''),
(25, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'KT06DobpGy=gBxKqTqdmVduA3lgFS&MI7RJ1=1YmOOdV', 'SQLi', 'Internet Explorer 6.0', 'msie6', 'Windows 8.1 x64', 'win-5', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows; U; MSIE 6.0; Windows NT 6.3; Trident/5.0; WOW64)', 'http://www.yandex.com/kjXElGN'),
(26, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'nr1GNpw1=1bnsu06M0kIBmDc6hDVg&CewlC00p=AYyjPeMlL6KjA2sNaI&I3UGFs=tpxr1ErdqHJFFIkyB3', 'SQLi', 'Firefox 23.0', 'firefox', 'Mac OS X 11.5.4', 'mac-3', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_5_4) Gecko/20022706 Firefox/23.0', 'http://www.yandex.com/n2cWUpwi'),
(27, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'vsAeR=6tt1&XBQavduK=IPX7D4MFr35VDm&i4g=Sp1&S8sxD=2iyh1IE8Jw&HUk1=1brnUHNB', 'SQLi', 'Internet Explorer 9.0', 'msie9', 'Mac OS X 11.7.3', 'mac-3', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (compatible; MSIE 9.0; Macintosh; .NET CLR 1.5.18543; Intel Mac OS X 11_7_3)', 'http://www.baidu.com/q4mA4MuI'),
(28, '78.46.157.59', '09 August 2019', '23:30', '/index.php', 'gSlHRkdiRL=3dPcqOxwmx&ONwjW0sTdg=PFJimUhEcpt0n1LG2&ID5Q=pM5cHivVAaDbw&eu1=1piFNSowlvPkfVD4Vo&rk2wOdiRp=dcmgovF6BuWT7BKTyQ', 'SQLi', 'Firefox 25.0', 'firefox', 'Windows x64', 'win-2', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Windows NT.6.2; WOW64) Gecko/20070407 Firefox/25.0', ''),
(29, '209.141.35.128', '10 August 2019', '20:04', '/index.php', '2DA6QyQoI1=1xyaweshJcHuSXdW&P4rkoi=mRnRmPCcDk&P4DV48=hQKWg6tl&XMcFmy=WcBXkCBb6tCCRfFDLYth&vdekgy=d6JkMMnO4bjwQGvP', 'SQLi', 'Opera Mini 4.2.14912', 'opera-2', 'J2ME/MIDP Device', 'java', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Opera/9.60 (J2ME/MIDP; Opera Mini/4.2.14912/812; U; ru) Presto/2.4.15', ''),
(30, '209.141.35.128', '10 August 2019', '20:04', '/index.php', 'nkFo1=1emtbd03&Wqi0gPnT=POuNio21pC', 'SQLi', 'Links 2.2', 'null', 'FreeBSD', 'freebsd', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Links (2.2; GNU/kFreeBSD 6.3-1-486 i686; 80x25', ''),
(31, '205.185.127.95', '10 August 2019', '20:05', '/index.php', 'f71=1rdCsVEU5v&gBNiyQchKo=ePktvlgOebL', 'SQLi', 'Firefox 3.5.7', 'firefox', 'Windows Vista', 'win-3', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7', ''),
(32, '209.141.57.143', '10 August 2019', '20:05', '/index.php', 'BtoQ1=1he&V1B=CLW5OY8b7t4hhqt0&mabrK=lPGrBopKRllYUMl&LotSiu=N7DHOLfWwhFIs15GiI0&c1DQv5P=mUO5iCKF4gC1pk0lm', 'SQLi', 'Safari 4.0', 'safari', 'Windows Vista', 'win-3', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; he-IL) AppleWebKit/528.16 (KHTML, like Gecko) Version/4.0 Safari/528.16', 'http://engadget.search.aol.com/search?q=urSOsTOruX'),
(33, '209.141.35.128', '10 August 2019', '20:05', '/index.php', 'VbABF=l4vcPWpISq&Q0qvI=8lsV1F7JCF&QdiwM=M8whtDBl&Qw1=1E8MXwL', 'SQLi', 'Shiira 1.2.2', 'shiira', 'Mac OS X', 'mac-3', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; de-de) AppleWebKit/418 (KHTML, like Gecko) Shiira/1.2.2 Safari/125', ''),
(34, '209.141.45.251', '10 August 2019', '20:05', '/index.php', 'PbA52GaFR=7IYOp3GVeepr0jf&jMp1=1U1cn4rACpv4V&Lirtj0Gh=VC4cIQ6uHCVWySY2FS2', 'SQLi', 'Firefox 3.5.3', 'firefox', 'Windows 7', 'win-4', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3 (.NET CLR 2.0.50727', 'http://engadget.search.aol.com/search?q=24OMmq'),
(35, '205.185.127.95', '10 August 2019', '20:05', '/index.php', 'AT1rOP46uA=Fm8tCUEsFM&H16LII1=1BdYWhBIoxvlPNc8&R6l=PuP4jiNJC2Jdr&IDm6=HEYBwwmJSvYm&UTB2=blMG4MOyWdf', 'SQLi', 'Shiira 1.2.2', 'shiira', 'Mac OS X', 'mac-3', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; de-de) AppleWebKit/418 (KHTML, like Gecko) Shiira/1.2.2 Safari/125', ''),
(36, '209.141.61.187', '10 August 2019', '20:06', '/index.php', 'LPTtNdBkS=FlQ2&VRN=5bfj0KD2bXXU4nhFtoVE&UYdKj=KJvBQhv7rXpABoC5&G8OH4JDSHc=8FGkmoqRaxlxA&rhqQYuV1=11Pg0ots4MNYVl', 'SQLi', 'Internet Explorer 9.0', 'msie9', 'Windows XP', 'win-2', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'Mozilla/4.0 (compatible; MSIE 9.0; Windows NT 5.1; Trident/5.0', 'http://vk.com/profile.php?redirect=vtWAHqN8'),
(37, '209.141.61.187', '10 August 2019', '20:06', '/index.php', 'Ai2=QYavIj2gmiqW36Nma&2t1=1KRepAuXItaY3hhdOVKm', 'SQLi', 'Unknown', 'null', '', 'null', 'United States', 'US', 'Nevada', 'Las Vegas', '36.17497', '-115.13722', 'FranTech Solutions', 'BlackBerry9000/5.0.0.93 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/179', ''),
(38, '78.46.157.38', '11 August 2019', '19:42', '/index.php', 'tBQPh1=1X3vv1U', 'SQLi', 'Google Chrome 14.0.375.65', 'chrome', 'GNU/Linux x64', 'linux', 'Germany', 'DE', 'Hessen', 'Melsungen', '51.13029', '9.55236', 'Hetzner Online GmbH', 'Mozilla/5.0 (Linux x86_64; X11) AppleWebKit/535.24 (KHTML, like Gecko) Chrome/14.0.375.65 Safari/536.22', '');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_malwarescanner-settings`
--

CREATE TABLE `firewall_malwarescanner-settings` (
  `id` int(11) NOT NULL,
  `file-extensions` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'php|php3|php4|php5|phps|htm|html|htaccess|js',
  `ignored-dirs` text COLLATE utf8_unicode_ci NOT NULL,
  `scan-dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_malwarescanner-settings`
--

INSERT INTO `firewall_malwarescanner-settings` (`id`, `file-extensions`, `ignored-dirs`, `scan-dir`) VALUES
(1, 'php|phtml|php3|php4|php5|phps|htaccess|txt|gif', '.|..|.DS_Store|.svn|.git', '../');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_massrequests-settings`
--

CREATE TABLE `firewall_massrequests-settings` (
  `id` int(11) NOT NULL,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/mass-requests.php',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_massrequests-settings`
--

INSERT INTO `firewall_massrequests-settings` (`id`, `protection`, `logging`, `autoban`, `redirect`, `mail`) VALUES
(1, 'No', 'Yes', 'No', 'http://dev.gb-hoster.me/rootsec/pages/mass-requests.php', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_monitoring`
--

CREATE TABLE `firewall_monitoring` (
  `id` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firewall_optimization-settings`
--

CREATE TABLE `firewall_optimization-settings` (
  `id` int(11) NOT NULL,
  `html-minify` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_optimization-settings`
--

INSERT INTO `firewall_optimization-settings` (`id`, `html-minify`) VALUES
(1, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_pages-layolt`
--

CREATE TABLE `firewall_pages-layolt` (
  `id` int(11) NOT NULL,
  `page` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_pages-layolt`
--

INSERT INTO `firewall_pages-layolt` (`id`, `page`, `text`) VALUES
(1, 'Banned', 'You are banned and you cannot continue to the site'),
(2, 'Blocked', 'Attack was detected'),
(3, 'Mass_Requests', 'Attention, you performed too many connections'),
(4, 'Proxy', 'Access to the website via Proxy is not allowed (Disable Browser Data Compression if you have it enabled)'),
(5, 'Spam', 'You are in the Blacklist of Spammers and you cannot continue to the website'),
(6, 'Tor', 'We detected that you are using Tor'),
(7, 'Banned_Country', 'Sorry, but your country is banned and you cannot continue to the website'),
(8, 'Blocked_Browser', 'Access to the website through your Browser is not allowed, please use another Internet Browser'),
(9, 'Blocked_OS', 'Access to the website through your Operating System is not allowed'),
(10, 'Blocked_ISP', 'Your Internet Service Provider is blacklisted and you cannot continue to the website'),
(11, 'Bad_Bot', 'You were identified as a Bad Bot and you cannot continue to the website'),
(12, 'Fake_Bot', 'You were identified as a Fake Bot and you cannot continue to the website'),
(13, 'Tor', 'We detected that you are using Tor'),
(14, 'AdBlocker', 'AdBlocker detected. Please support this website by disabling your AdBlocker');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_proxy-settings`
--

CREATE TABLE `firewall_proxy-settings` (
  `id` int(11) NOT NULL,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://dev.gb-hoster.me/rootsec/pages/proxy.php',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_proxy-settings`
--

INSERT INTO `firewall_proxy-settings` (`id`, `protection`, `protection2`, `protection3`, `logging`, `autoban`, `redirect`, `mail`) VALUES
(1, 'No', 'No', 'No', 'Yes', 'No', 'http://dev.gb-hoster.me/rootsec/pages/proxy.php', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_settings`
--

CREATE TABLE `firewall_settings` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `realtime_protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `mail_notifications` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `ip_detection` int(1) NOT NULL DEFAULT 1,
  `countryban_blacklist` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `jquery_include` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `error_reporting` int(11) NOT NULL DEFAULT 1,
  `display_errors` int(11) NOT NULL DEFAULT 0,
  `fixed_layout` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `boxed_layout` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `sidebar_collapsed` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `sidebar_hover` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='All Project SECURITY settings will be stored here.';

--
-- Dumping data for table `firewall_settings`
--

INSERT INTO `firewall_settings` (`id`, `email`, `realtime_protection`, `mail_notifications`, `ip_detection`, `countryban_blacklist`, `jquery_include`, `error_reporting`, `display_errors`, `fixed_layout`, `boxed_layout`, `sidebar_collapsed`, `sidebar_hover`) VALUES
(1, 'microfix1252002@gmail.com', 'Yes', 'Yes', 2, 'Yes', 'No', 1, 0, 'Yes', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_spam-settings`
--

CREATE TABLE `firewall_spam-settings` (
  `id` int(11) NOT NULL,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://dev.gb-hoster.me/rootsec/pages/spammer.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_spam-settings`
--

INSERT INTO `firewall_spam-settings` (`id`, `protection`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 'No', 'Yes', 'http://dev.gb-hoster.me/rootsec/pages/spammer.php', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_sqli-settings`
--

CREATE TABLE `firewall_sqli-settings` (
  `id` int(11) NOT NULL,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `protection4` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection5` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection6` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection7` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `protection8` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://dev.gb-hoster.me/rootsec/pages/blocked.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_sqli-settings`
--

INSERT INTO `firewall_sqli-settings` (`id`, `protection`, `protection2`, `protection3`, `protection4`, `protection5`, `protection6`, `protection7`, `protection8`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'No', 'No', 'Yes', 'http://dev.gb-hoster.me/rootsec/pages/blocked.php', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_tor-settings`
--

CREATE TABLE `firewall_tor-settings` (
  `id` int(11) NOT NULL,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/tor-detected.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_tor-settings`
--

INSERT INTO `firewall_tor-settings` (`id`, `protection`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 'Yes', 'Yes', 'http://dev.gb-hoster.me/rootsec/pages/tor-detected.php', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_users`
--

CREATE TABLE `firewall_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firewall_users`
--

INSERT INTO `firewall_users` (`id`, `username`, `password`, `email`) VALUES
(1, 'RootSec', 'ae3d4a84fdec96d4a0afae705979591614d0e6990726480f53919e461096104b', 'cik3r@protonmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `gp_cene`
--

CREATE TABLE `gp_cene` (
  `id` int(11) NOT NULL,
  `game_id` text NOT NULL,
  `cena_slota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gp_cene`
--

INSERT INTO `gp_cene` (`id`, `game_id`, `cena_slota`) VALUES
(1, '1', '61din|3.7kn|0.9km|30mkd|0.375eur'),
(2, '2', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(3, '3', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(4, '4', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(5, '5', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(6, '6', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(7, '7', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(8, '8', '61din|3.7kn|0.9km|30mkd|0.5eur'),
(9, '9', '61din|3.7kn|0.9km|30mkd|0.5eur');

-- --------------------------------------------------------

--
-- Table structure for table `klijenti`
--

CREATE TABLE `klijenti` (
  `klijentid` int(8) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `sifra` text NOT NULL,
  `ime` text DEFAULT NULL,
  `prezime` text DEFAULT NULL,
  `email` text NOT NULL,
  `beleske` text DEFAULT NULL,
  `novac` double NOT NULL DEFAULT 0,
  `currency` int(2) NOT NULL DEFAULT 1,
  `status` text NOT NULL,
  `lastlogin` datetime NOT NULL,
  `lastactivity` text NOT NULL,
  `lastip` text NOT NULL,
  `lasthost` text NOT NULL,
  `kreiran` text NOT NULL,
  `zemlja` text NOT NULL,
  `avatar` text NOT NULL,
  `cover` varchar(11) NOT NULL DEFAULT 'cover.jpg',
  `banovan` int(2) NOT NULL DEFAULT 0,
  `ftp_ban` varchar(100) NOT NULL DEFAULT '0',
  `support_ban` varchar(100) NOT NULL DEFAULT '0',
  `sigkod` int(11) NOT NULL,
  `token` text DEFAULT NULL,
  `mail` int(2) NOT NULL DEFAULT 1,
  `dodao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klijenti`
--

INSERT INTO `klijenti` (`klijentid`, `username`, `sifra`, `ime`, `prezime`, `email`, `beleske`, `novac`, `currency`, `status`, `lastlogin`, `lastactivity`, `lastip`, `lasthost`, `kreiran`, `zemlja`, `avatar`, `cover`, `banovan`, `ftp_ban`, `support_ban`, `sigkod`, `token`, `mail`, `dodao`) VALUES
(1, 'Demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Demo', 'Demo', 'demo@obgp.me', NULL, 10, 1, '1', '0000-00-00 00:00:00', '1568921059', '19.09.2019, 12:37', 'DESKTOP-0T4A71K', '', 'ME', 'avatar.jpg', 'cover.jpg', 0, '0', '0', 20000, '0', 1, ''),
(2, 'RootSec', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Nikita', 'Sibul', 'cik3r@protonmail.com', NULL, 0, 1, '1', '0000-00-00 00:00:00', '1563120057', '14.07.2019, 18:00', '31.223.128.149', '06.06.2019, 16:13', 'RS', 'avatar.png', 'cover.png', 0, '0', '0', 1693, '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `lgsl`
--

CREATE TABLE `lgsl` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `c_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `q_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `s_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `cache` text COLLATE utf8_unicode_ci NOT NULL,
  `cache_time` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logovi`
--

CREATE TABLE `logovi` (
  `id` int(11) NOT NULL,
  `clientid` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `vreme` varchar(255) DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logovi`
--

INSERT INTO `logovi` (`id`, `clientid`, `message`, `name`, `ip`, `vreme`, `adminid`) VALUES
(497, NULL, 'Nikita Sibul dobrodosli nazad.', 'success', '::1', '19.09.2019, 13:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` int(11) NOT NULL,
  `game_id` text NOT NULL,
  `map_name` text NOT NULL,
  `map_description` text NOT NULL,
  `map_file` text NOT NULL,
  `map_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`id`, `game_id`, `map_name`, `map_description`, `map_file`, `map_img`) VALUES
(1, '1', 'de_dust2', 'Default Mapa ', 'de_dust2.bsp', 'de_dust2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `modovi`
--

CREATE TABLE `modovi` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `ime` text NOT NULL,
  `opis` mediumtext NOT NULL,
  `igra` text NOT NULL,
  `komanda` text NOT NULL,
  `sakriven` int(11) NOT NULL DEFAULT 1,
  `mapa` mediumtext DEFAULT NULL,
  `cena` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

CREATE TABLE `obavestenja` (
  `id` int(11) NOT NULL,
  `naslov` text DEFAULT NULL,
  `poruka` text DEFAULT NULL,
  `datum` text DEFAULT NULL,
  `vrsta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obavestenja`
--

INSERT INTO `obavestenja` (`id`, `naslov`, `poruka`, `datum`, `vrsta`) VALUES
(1, 'OBGP', 'Uspesno ste instalirali OBGP', '12.2.2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `online` varchar(2) DEFAULT NULL,
  `poruka` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL,
  `ime` text DEFAULT NULL,
  `deskripcija` text DEFAULT NULL,
  `prikaz` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `game_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reputacija`
--

CREATE TABLE `reputacija` (
  `rep` int(5) NOT NULL,
  `adminid` int(5) NOT NULL,
  `d` int(11) NOT NULL,
  `f` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `serveri`
--

CREATE TABLE `serveri` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `rank` int(12) NOT NULL DEFAULT 99999,
  `modovi` mediumtext NOT NULL,
  `map` text NOT NULL,
  `port` mediumtext NOT NULL,
  `fps` int(11) NOT NULL DEFAULT 300,
  `slotovi` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `istice` mediumtext NOT NULL,
  `status` text NOT NULL,
  `startovan` int(11) NOT NULL DEFAULT 0,
  `free` mediumtext DEFAULT NULL,
  `uplatnica` mediumtext DEFAULT NULL,
  `igra` mediumtext DEFAULT NULL,
  `komanda` mediumtext NOT NULL,
  `cena` mediumtext NOT NULL,
  `boost` mediumtext NOT NULL,
  `cache` blob NOT NULL,
  `graph` text DEFAULT NULL,
  `reinstaliran` int(11) NOT NULL,
  `backup` varchar(12) NOT NULL DEFAULT '0',
  `napomena` text NOT NULL,
  `autorestart` varchar(11) DEFAULT '-1',
  `backupstatus` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `serveri_naruceni`
--

CREATE TABLE `serveri_naruceni` (
  `id` int(11) NOT NULL,
  `klijentid` int(11) DEFAULT NULL,
  `igra` int(2) DEFAULT NULL,
  `lokacija` int(2) DEFAULT NULL,
  `slotovi` int(4) DEFAULT NULL,
  `meseci` int(3) DEFAULT NULL,
  `cena` varchar(8) DEFAULT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `server_backup`
--

CREATE TABLE `server_backup` (
  `id` int(11) NOT NULL,
  `srvid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) NOT NULL DEFAULT '0',
  `size` varchar(20) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shared`
--

CREATE TABLE `shared` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `perms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` text NOT NULL,
  `site_version` text NOT NULL,
  `site_developer` text NOT NULL,
  `site_link` text NOT NULL,
  `site_noreply_mail` text NOT NULL,
  `site_lang` text DEFAULT NULL,
  `site_backup` text NOT NULL,
  `client_add_srw` text DEFAULT NULL,
  `site_active` text NOT NULL,
  `cron_lgsl` text NOT NULL,
  `cron_backup` text NOT NULL,
  `cron_server` text NOT NULL,
  `gt` text NOT NULL,
  `paymentmail` text NOT NULL,
  `cryptokey` text NOT NULL,
  `fdllink` text NOT NULL,
  `logolink` text NOT NULL,
  `fmtsecret` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_version`, `site_developer`, `site_link`, `site_noreply_mail`, `site_lang`, `site_backup`, `client_add_srw`, `site_active`, `cron_lgsl`, `cron_backup`, `cron_server`, `gt`, `paymentmail`, `cryptokey`, `fdllink`, `logolink`, `fmtsecret`) VALUES
(1, 'OBGP', '3.0.0', 'RootSec', 'http://obgp.me', 'obgp@pm.me', 'en', '0', '1', '1', '', '0', '', 'https://gametracker.xyz', 'paymentobgp@pm.me', 'BITCOIN API KEY', 'http://fdl.obgp.me', 'https://i.imgur.com/unnxAPA.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_red`
--

CREATE TABLE `ticket_red` (
  `id` int(11) NOT NULL,
  `ticket_id` text NOT NULL,
  `red` text DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_red`
--

INSERT INTO `ticket_red` (`id`, `ticket_id`, `red`, `status`) VALUES
(1, '1', '1', '1'),
(2, '2', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tiketi`
--

CREATE TABLE `tiketi` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 1,
  `prioritet` int(11) NOT NULL,
  `vrsta` int(11) NOT NULL,
  `datum` text DEFAULT NULL,
  `naslov` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `billing` int(11) NOT NULL DEFAULT 0,
  `admin` int(11) NOT NULL,
  `otvoren` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tiketi_odgovori`
--

CREATE TABLE `tiketi_odgovori` (
  `id` int(11) NOT NULL,
  `tiket_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `odgovor` longtext CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `vreme_odgovora` text NOT NULL,
  `time` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banovi`
--
ALTER TABLE `banovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_currency`
--
ALTER TABLE `billing_currency`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `billing_log`
--
ALTER TABLE `billing_log`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `box`
--
ALTER TABLE `box`
  ADD PRIMARY KEY (`boxid`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crons`
--
ALTER TABLE `crons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_adblocker-settings`
--
ALTER TABLE `firewall_adblocker-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_badbot-settings`
--
ALTER TABLE `firewall_badbot-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_bans`
--
ALTER TABLE `firewall_bans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_bans-country`
--
ALTER TABLE `firewall_bans-country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_bans-other`
--
ALTER TABLE `firewall_bans-other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_content-protection`
--
ALTER TABLE `firewall_content-protection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_dnsbl-databases`
--
ALTER TABLE `firewall_dnsbl-databases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_ip-whitelist`
--
ALTER TABLE `firewall_ip-whitelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_logs`
--
ALTER TABLE `firewall_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_malwarescanner-settings`
--
ALTER TABLE `firewall_malwarescanner-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_massrequests-settings`
--
ALTER TABLE `firewall_massrequests-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_monitoring`
--
ALTER TABLE `firewall_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_optimization-settings`
--
ALTER TABLE `firewall_optimization-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_pages-layolt`
--
ALTER TABLE `firewall_pages-layolt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_proxy-settings`
--
ALTER TABLE `firewall_proxy-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_settings`
--
ALTER TABLE `firewall_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_spam-settings`
--
ALTER TABLE `firewall_spam-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_sqli-settings`
--
ALTER TABLE `firewall_sqli-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_tor-settings`
--
ALTER TABLE `firewall_tor-settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firewall_users`
--
ALTER TABLE `firewall_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gp_cene`
--
ALTER TABLE `gp_cene`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klijenti`
--
ALTER TABLE `klijenti`
  ADD PRIMARY KEY (`klijentid`);

--
-- Indexes for table `lgsl`
--
ALTER TABLE `lgsl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logovi`
--
ALTER TABLE `logovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modovi`
--
ALTER TABLE `modovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obavestenja`
--
ALTER TABLE `obavestenja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serveri`
--
ALTER TABLE `serveri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rank` (`rank`);

--
-- Indexes for table `serveri_naruceni`
--
ALTER TABLE `serveri_naruceni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_backup`
--
ALTER TABLE `server_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared`
--
ALTER TABLE `shared`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_red`
--
ALTER TABLE `ticket_red`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiketi`
--
ALTER TABLE `tiketi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiketi_odgovori`
--
ALTER TABLE `tiketi_odgovori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banovi`
--
ALTER TABLE `banovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `billing_currency`
--
ALTER TABLE `billing_currency`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_log`
--
ALTER TABLE `billing_log`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `box`
--
ALTER TABLE `box`
  MODIFY `boxid` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crons`
--
ALTER TABLE `crons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `error_log`
--
ALTER TABLE `error_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firewall_adblocker-settings`
--
ALTER TABLE `firewall_adblocker-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_badbot-settings`
--
ALTER TABLE `firewall_badbot-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_bans`
--
ALTER TABLE `firewall_bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firewall_bans-country`
--
ALTER TABLE `firewall_bans-country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firewall_bans-other`
--
ALTER TABLE `firewall_bans-other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firewall_content-protection`
--
ALTER TABLE `firewall_content-protection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `firewall_dnsbl-databases`
--
ALTER TABLE `firewall_dnsbl-databases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firewall_ip-whitelist`
--
ALTER TABLE `firewall_ip-whitelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firewall_logs`
--
ALTER TABLE `firewall_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `firewall_malwarescanner-settings`
--
ALTER TABLE `firewall_malwarescanner-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_massrequests-settings`
--
ALTER TABLE `firewall_massrequests-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_monitoring`
--
ALTER TABLE `firewall_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firewall_optimization-settings`
--
ALTER TABLE `firewall_optimization-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_pages-layolt`
--
ALTER TABLE `firewall_pages-layolt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `firewall_proxy-settings`
--
ALTER TABLE `firewall_proxy-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_settings`
--
ALTER TABLE `firewall_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_spam-settings`
--
ALTER TABLE `firewall_spam-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_sqli-settings`
--
ALTER TABLE `firewall_sqli-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_tor-settings`
--
ALTER TABLE `firewall_tor-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firewall_users`
--
ALTER TABLE `firewall_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gp_cene`
--
ALTER TABLE `gp_cene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `klijenti`
--
ALTER TABLE `klijenti`
  MODIFY `klijentid` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lgsl`
--
ALTER TABLE `lgsl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `logovi`
--
ALTER TABLE `logovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modovi`
--
ALTER TABLE `modovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obavestenja`
--
ALTER TABLE `obavestenja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `serveri`
--
ALTER TABLE `serveri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `serveri_naruceni`
--
ALTER TABLE `serveri_naruceni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server_backup`
--
ALTER TABLE `server_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shared`
--
ALTER TABLE `shared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_red`
--
ALTER TABLE `ticket_red`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiketi`
--
ALTER TABLE `tiketi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiketi_odgovori`
--
ALTER TABLE `tiketi_odgovori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
