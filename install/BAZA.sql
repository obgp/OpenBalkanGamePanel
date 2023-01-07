-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2023 at 04:48 PM
-- Server version: 8.0.31-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

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
  `id` int NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `status` text NOT NULL,
  `signature` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastactivity` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `boja` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `login_session` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `avatar` varchar(999) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'nema_avatar.png',
  `lastactivityname` text,
  `lastip` text NOT NULL,
  `lasthost` text NOT NULL,
  `last_login` text NOT NULL,
  `support_za` text NOT NULL,
  `adm_perm` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `password`, `email`, `status`, `signature`, `lastactivity`, `boja`, `login_session`, `avatar`, `lastactivityname`, `lastip`, `lasthost`, `last_login`, `support_za`, `adm_perm`, `note`) VALUES
(1, 'Admin', 'OBGP', 'Admin', 'fe01ce2a7fbac8fafaed7c982a04e229', 'obgp@pm.me', '3', 'OBGP <3', '1669682305', 'red', '', 'default.png', '', '192.168.142.1', '192.168.142.1', '29.11.2022, 00:11', '1|2|3|4|5|6|7|8|9', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `banovi`
--

CREATE TABLE `banovi` (
  `id` int NOT NULL,
  `klijentid` int DEFAULT NULL,
  `vreme` int DEFAULT NULL,
  `razlog` text,
  `trajanje` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int NOT NULL,
  `user_id` text NOT NULL,
  `game_id` text NOT NULL,
  `mod_id` text NOT NULL,
  `location` text NOT NULL,
  `slotovi` text NOT NULL,
  `mesec` text NOT NULL,
  `name` text NOT NULL,
  `cena` text NOT NULL,
  `date` text NOT NULL,
  `dokaz` text,
  `status` text NOT NULL,
  `srv_z_install` varchar(100) NOT NULL DEFAULT '0',
  `srv_install` varchar(100) DEFAULT '0',
  `buy_sms` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `user_id`, `game_id`, `mod_id`, `location`, `slotovi`, `mesec`, `name`, `cena`, `date`, `dokaz`, `status`, `srv_z_install`, `srv_install`, `buy_sms`) VALUES
(5, '1', '3', '', 'lite1', '35', '1', 'test', '17.50', '11.29.2022, 01:06', NULL, 'pending', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `billing_currency`
--

CREATE TABLE `billing_currency` (
  `id` int NOT NULL,
  `country` text NOT NULL,
  `countryshort` text NOT NULL,
  `currencysign` text NOT NULL,
  `currencynameplural` text NOT NULL,
  `currencyname` text NOT NULL,
  `multiply` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing_currency`
--

INSERT INTO `billing_currency` (`id`, `country`, `countryshort`, `currencysign`, `currencynameplural`, `currencyname`, `multiply`) VALUES
(0, 'Other', 'other', '€', 'Euro', 'Euro', 1),
(1, 'Srbija', 'RS', 'Din', 'Dinara', 'Dinar', 125);

-- --------------------------------------------------------

--
-- Table structure for table `billing_log`
--

CREATE TABLE `billing_log` (
  `logid` int NOT NULL,
  `clientid` int NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `adminid` int NOT NULL DEFAULT '0',
  `time` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `box`
--

CREATE TABLE `box` (
  `boxid` int UNSIGNED NOT NULL,
  `name` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `location` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `login` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` blob NOT NULL,
  `sshport` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ftpport` int NOT NULL DEFAULT '21',
  `maxsrv` int NOT NULL,
  `cache` blob,
  `box_load_5min` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `box_load` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `box`
--

INSERT INTO `box` (`boxid`, `name`, `location`, `ip`, `login`, `password`, `sshport`, `ftpport`, `maxsrv`, `cache`, `box_load_5min`, `box_load`) VALUES
(7, 'demo - lite1', 'lite1', '127.0.0.1', 'root', 0x125b73a679c413be6012fa16e3857c26, '22', 21, 100, 0x785e6d52cb6edb3010fc1582a7e660970f8994d7a7a0af4b6d044803f41630166b0bb5458394120581ffbd4b5a52a53637ef683cb3c31d031cde2ad06b035cc25b000df47c34afd6071ab17fa10ad8fa126005f4c9d4e54b553687c8cb22af00eabbc73698bda5eb484c50f33f84acc635e638674d2074904077e7366aa7b5325ccbbb1d454d89bf6f379fc9d79f1f9ad3cd4249c6c87dd52d3e396fc91d926c08ce47668e1a0862920ac475eeb72b31f1d5c49bd31800f9b3bdd0a80db61cd6c4f197b76336648f6adbdb6dd4c3c73b3a539ae7fdf4f14628c5604bce6924e3db1c5c686a7342c9fea96758d273e1c9753102fe43c471e4f6533ac6b7edc3c7ef55dd7689872ea569feaa8e333e1e07ba71351105d9ba6722981084e5c0054846ee36e4cbfd8f24a180feb6beb678a37eb5091280e366f992cb255b48b6d8dbdafa0a8f73f5367e974a91ca83ded7396976857a54d9e0d09e9b6a121ebf0f0866c58991d2bc0622c9c1b53e1021c90933363690c12abc98f3bbe75b69c6a41659115b38b9236722d3b9d6aac78783164ae78a675a447c7a59ce96b9eabb7228b10b7dd9a75d1152305d68ae56a298db1505537aa5258ff59bf447709e71aea412229b195690ad2f97cb1f12500ea1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `Text` text,
  `Autor` text NOT NULL,
  `Datum` text NOT NULL,
  `ID` int NOT NULL,
  `admin_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`Text`, `Autor`, `Datum`, `ID`, `admin_id`) VALUES
('test', '<span style=\"color:red;\">Admin OBGP</span>', '11.29.2022, 00:26', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `crons`
--

CREATE TABLE `crons` (
  `id` int NOT NULL,
  `cron_name` varchar(255) NOT NULL,
  `cron_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `crons`
--

INSERT INTO `crons` (`id`, `cron_name`, `cron_value`) VALUES
(1, 'box_info', '2019-06-23 01:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `gamename` text NOT NULL,
  `gameshort` text NOT NULL,
  `defaultstartcmd` text NOT NULL,
  `priceperslot` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `priceperram` int NOT NULL,
  `pricepercore` int NOT NULL,
  `icon` text NOT NULL,
  `maxslots` int NOT NULL,
  `maxramgb` int NOT NULL,
  `maxcore` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `gamename`, `gameshort`, `defaultstartcmd`, `priceperslot`, `priceperram`, `pricepercore`, `icon`, `maxslots`, `maxramgb`, `maxcore`) VALUES
(1, 'Counter Strike 1.6', 'CS 1.6', './hlds_run -game cstrike +ip {$ip} +port {$port} +maxplayers {$slots} +sys_ticrate 300 +map {$map} +servercfgfile server.cfg', '0.10', 0, 0, '<img src=\"/assets/img/icon/gp/game/cs.ico\" class=\"gp_game_icon\"> Counter-Strike 1.6', 32, 0, 0),
(2, 'San Andreas Multiplayer', 'SAMP', './samp03svr', '0.10', 0, 0, '<img src=\"/assets/img/icon/gp/game/samp.jpg\" class=\"gp_game_icon\"> San Andreas Multiplayer', 1000, 0, 0),
(3, 'Minecraft', 'MC', 'java -Xms512M -Xmx1024M -XX:MaxPermSize=128M -XX:+DisableExplicitGC -XX:+AggressiveOpts -Dfile.encoding=UTF-8 -jar Server.jar', '10', 0, 0, '<img src=\"/assets/img/icon/gp/game/mc.png\" class=\"gp_game_icon\"> Minecraft', 1000, 0, 0),
(4, 'Call of Duty 2', 'CoD2', '', '0.10', 0, 0, '<img src=\"/assets/img/icon/gp/game/cod2.png\" class=\"gp_game_icon\"> Call of Duty 2', 60, 0, 0),
(5, 'Call of Duty 4', 'CoD4', '', '0.10', 0, 0, '<img src=\"/assets/img/icon/gp/game/cod4.png\" class=\"gp_game_icon\"> Call of Duty 4', 60, 0, 0),
(6, 'TeamSpeak3', 'TS3', '', '0.10', 0, 0, '<img src=\"/assets/img/icon/gp/game/ts3.png\" class=\"gp_game_icon\"> TeamSpeak 3', 512, 0, 0),
(7, 'Counter-Strike GO', 'CSGO', '', '10', 0, 0, '<img src=\"/assets/img/icon/gp/game/csgo.jpg\" class=\"gp_game_icon\"> Counter-Strike GO', 64, 0, 0),
(8, 'Multi Theft Auto', 'MTA', '', '10', 0, 0, '<img src=\"/assets/img/icon/gp/game/mta.png\" class=\"gp_game_icon\"> Multi Theft Auto', 1000, 0, 0),
(9, 'Ark Survival Evolved', 'ARK', '', '10', 0, 0, '<img src=\"/assets/img/icon/gp/game/ark.png\" class=\"gp_game_icon\"> ARK', 200, 0, 0),
(10, 'FastDL', 'FDL', '', '10', 0, 0, '<img src=\"/assets/img/icon/gp/game/fdl.png\" class=\"gp_game_icon\"> FDL', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `klijenti`
--

CREATE TABLE `klijenti` (
  `klijentid` int UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `sifra` text NOT NULL,
  `ime` text,
  `prezime` text,
  `email` text NOT NULL,
  `beleske` text,
  `novac` double NOT NULL DEFAULT '0',
  `currency` int NOT NULL DEFAULT '1',
  `status` text NOT NULL,
  `lastlogin` datetime NOT NULL,
  `lastactivity` text NOT NULL,
  `lastip` text NOT NULL,
  `lasthost` text NOT NULL,
  `kreiran` text NOT NULL,
  `zemlja` text NOT NULL,
  `avatar` text NOT NULL,
  `cover` varchar(11) NOT NULL DEFAULT 'cover.jpg',
  `banovan` int NOT NULL DEFAULT '0',
  `ftp_ban` varchar(100) NOT NULL DEFAULT '0',
  `support_ban` varchar(100) NOT NULL DEFAULT '0',
  `sigkod` int NOT NULL,
  `token` text,
  `mail` int NOT NULL DEFAULT '1',
  `dodao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `klijenti`
--

INSERT INTO `klijenti` (`klijentid`, `username`, `sifra`, `ime`, `prezime`, `email`, `beleske`, `novac`, `currency`, `status`, `lastlogin`, `lastactivity`, `lastip`, `lasthost`, `kreiran`, `zemlja`, `avatar`, `cover`, `banovan`, `ftp_ban`, `support_ban`, `sigkod`, `token`, `mail`, `dodao`) VALUES
(1, 'Demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Demo', 'Demo', 'demo@obgp.me', NULL, 10, 1, '1', '0000-00-00 00:00:00', '1669942213', '01.12.2022, 23:51', '192.168.142.1', '', 'fdsfs', 'avatar.jpg', 'cover.jpg', 0, '0', '0', 20000, '0', 1, ''),
(2, 'RootSec', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Nikita', 'Sibul', 'cik3r@protonmail.com', NULL, 0, 1, '1', '0000-00-00 00:00:00', '1563120057', '14.07.2019, 18:00', '31.223.128.149', '06.06.2019, 16:13', 'RS', 'avatar.png', 'cover.png', 0, '0', '0', 1693, '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `lgsl`
--

CREATE TABLE `lgsl` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `c_port` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `q_port` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `s_port` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `zone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `cache` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `cache_time` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL,
  `country` text NOT NULL,
  `countryshort` text NOT NULL,
  `premium` int NOT NULL,
  `premiumprice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country`, `countryshort`, `premium`, `premiumprice`) VALUES
(1, 'Srbija', 'RS', 1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `logovi`
--

CREATE TABLE `logovi` (
  `id` int NOT NULL,
  `clientid` int DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `vreme` varchar(255) DEFAULT NULL,
  `adminid` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `logovi`
--

INSERT INTO `logovi` (`id`, `clientid`, `message`, `name`, `ip`, `vreme`, `adminid`) VALUES
(497, NULL, 'Nikita Sibul dobrodosli nazad.', 'success', '::1', '19.09.2019, 13:06', 1),
(498, NULL, 'Admin OBGP dobrodosli nazad.', 'success', '192.168.142.1', '28.11.2022, 22:13', 1),
(499, NULL, 'Admin OBGP dobrodosli nazad.', 'success', '192.168.142.1', '28.11.2022, 22:15', 1),
(500, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:15', 1),
(501, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:15', 1),
(502, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:15', 1),
(503, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:15', 1),
(504, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:16', 1),
(505, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:16', 1),
(506, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:18', 1),
(507, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:18', 1),
(508, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:18', 1),
(509, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:18', 1),
(510, NULL, 'Ip nije validan!', 'error', '192.168.142.1', '28.11.2022, 22:27', 1),
(511, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:27', 1),
(512, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:27', 1),
(513, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:32', 1),
(514, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:32', 1),
(515, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:33', 1),
(516, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:33', 1),
(517, NULL, 'Podaci za prijavu nisu tacni, molimo preverite sve unete podatke!', 'error', '192.168.142.1', '28.11.2022, 22:37', 1),
(518, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:38', 1),
(519, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:38', 1),
(520, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:38', 1),
(521, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:38', 1),
(522, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:38', 1),
(523, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:38', 1),
(524, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:43', 1),
(525, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:43', 1),
(526, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:44', 1),
(527, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:44', 1),
(528, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:45', 1),
(529, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:45', 1),
(530, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:54', 1),
(531, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:54', 1),
(532, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:54', 1),
(533, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:54', 1),
(534, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:55', 1),
(535, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:55', 1),
(536, NULL, 'Molimo proverite dali ste popunili sva polja.', 'error', '192.168.142.1', '28.11.2022, 22:59', 1),
(537, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 22:59', 1),
(538, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 22:59', 1),
(539, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 23:01', 1),
(540, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 23:01', 1),
(541, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 23:07', 1),
(542, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 23:07', 1),
(543, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 23:07', 1),
(544, NULL, 'Ova masina ne postoji!', 'error', '192.168.142.1', '28.11.2022, 23:07', 1),
(545, NULL, 'Greska prilikom dodavanje masine u bazu!', 'error', '192.168.142.1', '28.11.2022, 23:08', 1),
(546, NULL, 'Greska prilikom dodavanje masine u bazu!', 'error', '192.168.142.1', '28.11.2022, 23:10', 1),
(547, NULL, 'Masina je uspesno dodata.', 'success', '192.168.142.1', '28.11.2022, 23:12', 1),
(548, NULL, 'Uspesno ste dodali novi mod! #test', 'success', '192.168.142.1', '28.11.2022, 23:15', 1),
(549, NULL, 'Uspesno ste dodali novi mod! #1312', 'success', '192.168.142.1', '28.11.2022, 23:16', 1),
(550, NULL, 'Server je instaliran, ali dogodila se greska prilikom spajanja na mysql bazu!', 'error', '192.168.142.1', '28.11.2022, 23:25', 1),
(551, NULL, 'Server je instaliran, ali dogodila se greska prilikom spajanja na mysql bazu!', 'error', '192.168.142.1', '28.11.2022, 23:35', 1),
(552, NULL, 'Admin OBGP dobrodosli nazad.', 'success', '192.168.142.1', '29.11.2022, 00:11', 1),
(553, NULL, 'Server je uspesno startovan.', 'success', '192.168.142.1', '29.11.2022, 00:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` int NOT NULL,
  `game_id` text NOT NULL,
  `map_name` text NOT NULL,
  `map_description` text NOT NULL,
  `map_file` text NOT NULL,
  `map_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `id` int NOT NULL,
  `link` text NOT NULL,
  `ime` text NOT NULL,
  `opis` mediumtext NOT NULL,
  `igra` text NOT NULL,
  `komanda` text NOT NULL,
  `sakriven` int NOT NULL DEFAULT '1',
  `mapa` mediumtext,
  `cena` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `modovi`
--

INSERT INTO `modovi` (`id`, `link`, `ime`, `opis`, `igra`, `komanda`, `sakriven`, `mapa`, `cena`) VALUES
(7, '/home/gamefiles/cs16', 'test', 'ide gas', '1', './hlds_run -game cstrike +ip {$ip} +port {$port} +maxplayers {$slots} +sys_ticrate 300 +map {$map} +servercfgfile server.cfg', 0, 'default', '61.00din|3.70kn|0.90km|30.00mkd|0.38eur'),
(8, '/home/gamefiles/mc', '1312', 'test', '3', 'java -Xms512M -Xmx1024M -XX:MaxPermSize=128M -XX:+DisableExplicitGC -XX:+AggressiveOpts -Dfile.encoding=UTF-8 -jar Server.jar', 0, 'default', '61.00din|3.70kn|0.90km|30.00mkd|0.50eur');

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

CREATE TABLE `obavestenja` (
  `id` int NOT NULL,
  `naslov` text,
  `poruka` text,
  `datum` text,
  `vrsta` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int NOT NULL,
  `ime` text,
  `deskripcija` text,
  `prikaz` text,
  `text` text,
  `game_id` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `serveri`
--

CREATE TABLE `serveri` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `box_id` int NOT NULL,
  `name` text NOT NULL,
  `rank` int NOT NULL DEFAULT '99999',
  `modovi` mediumtext NOT NULL,
  `map` text NOT NULL,
  `port` mediumtext NOT NULL,
  `fps` int NOT NULL DEFAULT '300',
  `slotovi` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `istice` mediumtext NOT NULL,
  `status` text NOT NULL,
  `startovan` int NOT NULL DEFAULT '0',
  `free` mediumtext,
  `uplatnica` mediumtext,
  `igra` mediumtext,
  `komanda` mediumtext NOT NULL,
  `cena` mediumtext NOT NULL,
  `boost` mediumtext NOT NULL,
  `cache` blob,
  `graph` text,
  `reinstaliran` int NOT NULL,
  `backup` varchar(12) NOT NULL DEFAULT '0',
  `napomena` text NOT NULL,
  `autorestart` varchar(11) DEFAULT '-1',
  `backupstatus` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `serveri`
--

INSERT INTO `serveri` (`id`, `user_id`, `box_id`, `name`, `rank`, `modovi`, `map`, `port`, `fps`, `slotovi`, `username`, `password`, `istice`, `status`, `startovan`, `free`, `uplatnica`, `igra`, `komanda`, `cena`, `boost`, `cache`, `graph`, `reinstaliran`, `backup`, `napomena`, `autorestart`, `backupstatus`) VALUES
(27, 1, 7, '1111', 0, '8', 'default', '25565', 300, 100, 'srv_1_zPGx9', '4j4X5jlX', '11/28/2022', '1', 1, '0', '1', '3', 'java -Xms512M -Xmx1024M -XX:MaxPermSize=128M -XX:+DisableExplicitGC -XX:+AggressiveOpts -Dfile.encoding=UTF-8 -jar Server.jar', '50.00', '0', NULL, NULL, 0, '0', 'Nema', '-1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `serveri_naruceni`
--

CREATE TABLE `serveri_naruceni` (
  `id` int NOT NULL,
  `klijentid` int DEFAULT NULL,
  `igra` int DEFAULT NULL,
  `lokacija` int DEFAULT NULL,
  `slotovi` int DEFAULT NULL,
  `meseci` int DEFAULT NULL,
  `cena` varchar(8) DEFAULT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `server_backup`
--

CREATE TABLE `server_backup` (
  `id` int NOT NULL,
  `srvid` int NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '0',
  `size` varchar(20) NOT NULL DEFAULT '0',
  `time` int NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `sitename` text NOT NULL,
  `logo` text NOT NULL,
  `lang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shared`
--

CREATE TABLE `shared` (
  `id` int NOT NULL,
  `serverid` int NOT NULL,
  `userid` int NOT NULL,
  `perms` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int NOT NULL,
  `site_name` text NOT NULL,
  `site_version` text NOT NULL,
  `site_developer` text NOT NULL,
  `site_link` text NOT NULL,
  `site_noreply_mail` text NOT NULL,
  `site_lang` text,
  `site_backup` text NOT NULL,
  `client_add_srw` text,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `id` int NOT NULL,
  `ticket_id` text NOT NULL,
  `red` text,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `id` int NOT NULL,
  `admin_id` int DEFAULT NULL,
  `server_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` int DEFAULT '1',
  `prioritet` int NOT NULL,
  `vrsta` int NOT NULL,
  `datum` text,
  `naslov` text,
  `text` text,
  `billing` int NOT NULL DEFAULT '0',
  `admin` int NOT NULL,
  `otvoren` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tiketi`
--

INSERT INTO `tiketi` (`id`, `admin_id`, `server_id`, `user_id`, `status`, `prioritet`, `vrsta`, `datum`, `naslov`, `text`, `billing`, `admin`, `otvoren`) VALUES
(3, 0, 27, 1, 1, 3, 3, '11.29.2022, 00:27', 'test', 'test', 0, 0, '11.29.2022, 00:27');

-- --------------------------------------------------------

--
-- Table structure for table `tiketi_odgovori`
--

CREATE TABLE `tiketi_odgovori` (
  `id` int NOT NULL,
  `tiket_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `odgovor` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `vreme_odgovora` text NOT NULL,
  `time` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `games`
--
ALTER TABLE `games`
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
-- Indexes for table `locations`
--
ALTER TABLE `locations`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banovi`
--
ALTER TABLE `banovi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `billing_currency`
--
ALTER TABLE `billing_currency`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing_log`
--
ALTER TABLE `billing_log`
  MODIFY `logid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `box`
--
ALTER TABLE `box`
  MODIFY `boxid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crons`
--
ALTER TABLE `crons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `klijenti`
--
ALTER TABLE `klijenti`
  MODIFY `klijentid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lgsl`
--
ALTER TABLE `lgsl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logovi`
--
ALTER TABLE `logovi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=554;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modovi`
--
ALTER TABLE `modovi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `obavestenja`
--
ALTER TABLE `obavestenja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `serveri`
--
ALTER TABLE `serveri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `serveri_naruceni`
--
ALTER TABLE `serveri_naruceni`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server_backup`
--
ALTER TABLE `server_backup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shared`
--
ALTER TABLE `shared`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_red`
--
ALTER TABLE `ticket_red`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiketi`
--
ALTER TABLE `tiketi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tiketi_odgovori`
--
ALTER TABLE `tiketi_odgovori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
