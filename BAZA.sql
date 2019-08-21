-- MySQL dump 10.16  Distrib 10.1.41-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: nerd_s
-- ------------------------------------------------------
-- Server version	10.1.41-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `lastactivityname` text,
  `lastip` text NOT NULL,
  `lasthost` text NOT NULL,
  `last_login` text NOT NULL,
  `support_za` text NOT NULL,
  `adm_perm` text NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Nikita','Sibul','RootSec','fe01ce2a7fbac8fafaed7c982a04e229','obgp@pm.me','4','OBGP <3','1565454037','red','','default.png','','87.116.178.90','87.116.178.90','10.08.2019, 11:02','1|2|3|4|5|6|7|8|9','',''),(3,'Pesta','Pesta','Pesta','ba154095374b21de3908657f316369b3','esbpesta@gmail.com','3','Pesta Pesta\n- Nerds Hosting Administrator','1565465892','','','nema_avatar.png',NULL,'80.110.85.48','80-110-85-48.cgn.dynamic.surfer.at','09.08.2019, 21:17','1|2|3|4|5|6|7|8|9|','1|2|3|','');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banovi`
--

DROP TABLE IF EXISTS `banovi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `klijentid` int(11) DEFAULT NULL,
  `vreme` int(11) DEFAULT NULL,
  `razlog` text,
  `trajanje` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banovi`
--

LOCK TABLES `banovi` WRITE;
/*!40000 ALTER TABLE `banovi` DISABLE KEYS */;
/*!40000 ALTER TABLE `banovi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `buy_sms` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `billing_currency`
--

DROP TABLE IF EXISTS `billing_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_currency` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `multiply` double NOT NULL DEFAULT '1',
  `name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sign` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `zemlja` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_currency`
--

LOCK TABLES `billing_currency` WRITE;
/*!40000 ALTER TABLE `billing_currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_log`
--

DROP TABLE IF EXISTS `billing_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `adminid` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_log`
--

LOCK TABLES `billing_log` WRITE;
/*!40000 ALTER TABLE `billing_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `box`
--

DROP TABLE IF EXISTS `box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `box` (
  `boxid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `routeip` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `login` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `password` blob NOT NULL,
  `sshport` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ftpport` int(11) NOT NULL DEFAULT '21',
  `maxsrv` int(11) NOT NULL,
  `cache` blob,
  `box_load_5min` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `box_load` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `tspass` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`boxid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `box`
--


--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_messages` (
  `Text` text,
  `Autor` text NOT NULL,
  `Datum` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `crons`
--

DROP TABLE IF EXISTS `crons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cron_name` varchar(255) NOT NULL,
  `cron_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crons`
--

LOCK TABLES `crons` WRITE;
/*!40000 ALTER TABLE `crons` DISABLE KEYS */;
INSERT INTO `crons` VALUES (1,'box_info','2019-06-23 01:44:15');
/*!40000 ALTER TABLE `crons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_log`
--

DROP TABLE IF EXISTS `error_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `string` varchar(255) DEFAULT NULL,
  `file` mediumtext,
  `line` int(11) DEFAULT NULL,
  `datum` mediumtext,
  `vrsta` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_log`
--

LOCK TABLES `error_log` WRITE;
/*!40000 ALTER TABLE `error_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `error_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_adblocker-settings`
--

DROP TABLE IF EXISTS `firewall_adblocker-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_adblocker-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/adblocker-detected.php',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_adblocker-settings`
--

LOCK TABLES `firewall_adblocker-settings` WRITE;
/*!40000 ALTER TABLE `firewall_adblocker-settings` DISABLE KEYS */;
INSERT INTO `firewall_adblocker-settings` VALUES (1,'No','http://dev.gb-hoster.me/rootsec/pages/adblocker-detected.php');
/*!40000 ALTER TABLE `firewall_adblocker-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_badbot-settings`
--

DROP TABLE IF EXISTS `firewall_badbot-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_badbot-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_badbot-settings`
--

LOCK TABLES `firewall_badbot-settings` WRITE;
/*!40000 ALTER TABLE `firewall_badbot-settings` DISABLE KEYS */;
INSERT INTO `firewall_badbot-settings` VALUES (1,'No','No','No','Yes','No','No');
/*!40000 ALTER TABLE `firewall_badbot-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_bans`
--

DROP TABLE IF EXISTS `firewall_bans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_bans`
--

LOCK TABLES `firewall_bans` WRITE;
/*!40000 ALTER TABLE `firewall_bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `firewall_bans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_bans-country`
--

DROP TABLE IF EXISTS `firewall_bans-country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_bans-country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned countries table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_bans-country`
--

LOCK TABLES `firewall_bans-country` WRITE;
/*!40000 ALTER TABLE `firewall_bans-country` DISABLE KEYS */;
/*!40000 ALTER TABLE `firewall_bans-country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_bans-other`
--

DROP TABLE IF EXISTS `firewall_bans-other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_bans-other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_bans-other`
--

LOCK TABLES `firewall_bans-other` WRITE;
/*!40000 ALTER TABLE `firewall_bans-other` DISABLE KEYS */;
/*!40000 ALTER TABLE `firewall_bans-other` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_content-protection`
--

DROP TABLE IF EXISTS `firewall_content-protection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_content-protection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `alert` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_content-protection`
--

LOCK TABLES `firewall_content-protection` WRITE;
/*!40000 ALTER TABLE `firewall_content-protection` DISABLE KEYS */;
INSERT INTO `firewall_content-protection` VALUES (1,'rightclick','No','Yes','Context Menu not allowed'),(2,'rightclick_images','No','Yes','Context Menu on Images not allowed'),(3,'cut','No','Yes','Cut not allowed'),(4,'copy','No','Yes','Copy not allowed'),(5,'paste','No','Yes','Paste not allowed'),(6,'drag','No','No',''),(7,'drop','No','No',''),(8,'printscreen','No','Yes','It is not allowed to use the Print Screen button'),(9,'print','No','Yes','It is not allowed to Print'),(10,'view_source','No','Yes','It is not allowed to view the source code of the site'),(11,'offline_mode','No','Yes','You have no access to save the page'),(12,'iframe_out','No','No',''),(13,'exit_confirmation','No','Yes','Do you really want to exit our website?'),(14,'selecting','No','No','');
/*!40000 ALTER TABLE `firewall_content-protection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_dnsbl-databases`
--

DROP TABLE IF EXISTS `firewall_dnsbl-databases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_dnsbl-databases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `database` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_dnsbl-databases`
--

LOCK TABLES `firewall_dnsbl-databases` WRITE;
/*!40000 ALTER TABLE `firewall_dnsbl-databases` DISABLE KEYS */;
INSERT INTO `firewall_dnsbl-databases` VALUES (1,'sbl.spamhaus.org'),(2,'xbl.spamhaus.org');
/*!40000 ALTER TABLE `firewall_dnsbl-databases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_ip-whitelist`
--

DROP TABLE IF EXISTS `firewall_ip-whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_ip-whitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_ip-whitelist`
--

LOCK TABLES `firewall_ip-whitelist` WRITE;
/*!40000 ALTER TABLE `firewall_ip-whitelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `firewall_ip-whitelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_logs`
--

DROP TABLE IF EXISTS `firewall_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `referer_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_logs`
--

LOCK TABLES `firewall_logs` WRITE;
/*!40000 ALTER TABLE `firewall_logs` DISABLE KEYS */;
INSERT INTO `firewall_logs` VALUES (1,'87.116.179.55','15 July 2019','21:25','/gp-view-billing.php','id=%22%3E%3Cscript%3Ealert(0)%3C/script%3E','SQLi','Google Chrome 75.0.3770.54','chrome','Windows 10 x64','win-6','Serbia','RS','Vojvodina','Subotica','46.1','19.66667','Serbia BroadBand-Srpske Kablovske mreze d.o.o.','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.54 Safari/537.36',''),(2,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(3,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(4,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(5,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(6,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(7,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(8,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(9,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(10,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(11,'127.0.0.2','09 August 2019','23:05','/index.php','','TOR Detected','Firefox 5.0','firefox','GNU/Linux','linux','','','','','','','','Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20100101 Firefox/5.0',''),(12,'78.46.157.59','09 August 2019','23:26','/index.php','WsPQ=H4jR3TN8xN7er&d8u=CG6IXUJQ3m6Ns06QlNI&PAjwS61=1l3QDIy3&UohblWnlO=LiG02JuEO','SQLi','Internet Explorer 7.0','msie7','Mac OS X 10.8.1','mac-3','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (compatible; MSIE 7.0; Macintosh; .NET CLR 3.2.21422; Intel Mac OS X 10_8_1)',''),(13,'78.46.157.59','09 August 2019','23:27','/index.php','CdiJDDX=071CxGaj&GHC=I58LjsocJBx6Ww273b&crCF=838mUff&pdq=cPBqRtIMRDYFbdNeh&2dkqh1=1VK7cu4TE','SQLi','Safari 4.1.5','safari','Windows XP x64','win-2','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows NT 5.1; Win64; x64) AppleWebKit/537.23 (KHTML, like Gecko) Version/4.1.5 Safari/536.1',''),(14,'78.46.157.59','09 August 2019','23:27','/index.php','mpFWQKakE1=15acM4CLkiT0woe4HV&UrJnO=Ruuvebv1kG708FCnG7k&QuNU8oLW2=WWGNdQjXmqyW8NbN&5CxQaNu=lmwDCKl&tKW5=oSK7Ky6aOo0GTABx','SQLi','Google Chrome 31.0.982.66','chrome','GNU/Linux x64','linux','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Linux x86_64; X11) AppleWebKit/537.34 (KHTML, like Gecko) Chrome/31.0.982.66 Safari/535.14',''),(15,'78.46.157.59','09 August 2019','23:27','/index.php','5Vb6=K4aYMuXnYDT3V7HMmDs&53Mj=sXs6&UB1=1EYOVSn25aAH','SQLi','Firefox 24.0','firefox','GNU/Linux x64','linux','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Linux x86_64; X11) Gecko/20070905 Firefox/24.0','http://www.yandex.com/8Q5PjUQwc?2YwH58qjtA=aKrJVmmmKjtnbwq&lybK=UOhxO&7q5KA5B=d6LEpbmLXdLS&5FYbKc=Tj3VTktw6dbAAJVDn81n&tJccMekjP=cJSfLN&Q6mmG5y5=FgALqQIx6&aAuX=iaFhBao5lagM17kVcMT&wce1=SfyLrr5Ey2&VQi2pdDh=lDIU58EQBRkjD7ux'),(16,'78.46.157.59','09 August 2019','23:27','/index.php','2UBFiTL=Gd0chAyLi&HWis=YwyaulFr&oKayDp1=1owwFjVhjS7&niC=dvM2uC&FpYFcv=WRA0XQ','SQLi','Internet Explorer 8.0','msie7','GNU/Linux','linux','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (compatible; MSIE 8.0; Linux i386; .NET CLR 2.2.20842; X11)','http://www.baidu.com/4rjl8x?oAsTN5C5d=Tf13jLyVpCgvAsiy&cAPm=B26k2LgF&KM1eI=kXQLc5lY3h1Fxnpv3JI&8swe6xE=ThKI8F6VFoW&dYnTU4=CegdW&g1l=20KtVCugoJtrYHaSbTlR&jvot=5PvOEhPbymFiJewa2'),(17,'78.46.157.59','09 August 2019','23:27','/index.php','CgJr=pjnOMVTguBpvYdnUT7D&R6cDI1=1fpwN8elm&p2QfBT=8hETL&fi1=MviOdiDEn0k1','SQLi','Internet Explorer 9.0','msie9','Windows 8.1 x64','win-5','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.3; .NET CLR 1.1.2205; WOW64)',''),(18,'78.46.157.59','09 August 2019','23:29','/index.php','WU1=1r7XapNFsP1uV&Uv5DVqhI=C0IjHvL8d586xN6','SQLi','Firefox 22.0','firefox','Windows 7 x64','win-4','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows NT 6.1; WOW64) Gecko/20040711 Firefox/22.0','http://www.google.com/Cjg1Q0?A4D=AKOwoydaIWhHpa&Qcvs=IT2QPVJ&VUNER77rm=5QLK&yYdgpGv=lUWGjsrejy5h4CtWv&XnE68G5KB=1UkchbljRCwYPt4oIqr&nqXX25KBH=WgLxWa&Q8p5DWYUl=AIxxyqBIYmh30v'),(19,'78.46.157.59','09 August 2019','23:29','/index.php','G0IDKhm=tjNTvUH6Gn8F4SdNx&jjE00EnUp=J2s8Ac&rOp80I=bag4fCP&4nKv8bwvBp=KmP&50V1=1dgSfDxDxyAobPIxR','SQLi','Firefox 21.0','firefox','Windows 7 x64','win-4','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows NT 6.1; WOW64) Gecko/20062911 Firefox/21.0','http://nerds-hosting.com/aSBeSP'),(20,'78.46.157.59','09 August 2019','23:29','/index.php','kDXYXNb0V4=wQUOemS6DoKCAkE&ywhESTUE=T1AQBX56w&lPR8suNk=MsDaJPFoOY2f6LIdF&4iX61=1hbTsWyO6H7uEn&3I4ArFCw=AjoWRMBsV0H1vyp','SQLi','Google Chrome 29.0.1077.43','chrome','Windows XP x64','win-2','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows NT 5.1; WOW64) AppleWebKit/535.32 (KHTML, like Gecko) Chrome/29.0.1077.43 Safari/537.22','http://www.baidu.com/RHfgSV75b?UNJ=0spkxUhic&XfcL72YX=nXRB&WqgqkBIeo=ogGj8'),(21,'78.46.157.59','09 August 2019','23:29','/index.php','WgDRTYX1=1INLrAuy7VDfqmKI6X&kmTSX5R=ovFkdwnK1G1oYasg','SQLi','Google Chrome 27.0.917.97','chrome','Mac OS X 10.6.2','mac-3','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_2) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/27.0.917.97 Safari/536.9','http://www.baidu.com/cxnA10P1pj?n13CWojyH=esCofUwdndK&h28H=6DVv0E4sHrsiqxFLGgl7&UbTJgGW6=Bpf1OJf4HOuIKV&pg06NSwTgj=wraNfDCnRmLQmSaqbOAM&lvNmNs7RY=D5IUvWUAthT4OWf88&L5S2=ARblrWx'),(22,'78.46.157.59','09 August 2019','23:30','/index.php','oIGa=crgItK&tfH1=1LaOfEak&MFybE=E4bvole','SQLi','Firefox 19.0','firefox','Windows 7 x64','win-4','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows NT 6.1; Win64; x64) Gecko/20090907 Firefox/19.0','http://www.baidu.com/4uCVaD?HqK5UK=0CmKWlDov1&7diKd7eP=y7uHv&YOe=LEayE6cqSFJjvmyNPl&KPBv5=y6VRuLBGHRJW&bUI07=FLdLofp8P1e0yHdp'),(23,'78.46.157.59','09 August 2019','23:30','/index.php','l7oU0KiLl=biYuHJp2D&H24D2=1einioCqXG&est=cguk2Ago2L17o&dQ0hBDRr8=RQAeUc8UKYerq6Stqo&qRvV1=1n1UctGLwkQ','SQLi','Google Chrome 22.0.1149.51','chrome','Mac OS X 11.7.3','mac-3','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Macintosh; Intel Mac OS X 11_7_3) AppleWebKit/536.25 (KHTML, like Gecko) Chrome/22.0.1149.51 Safari/536.15',''),(24,'78.46.157.59','09 August 2019','23:30','/index.php','D1B1O6WQ=AkeMpthvpwyYEugqKQ&dQe48CS=aIFndxBFgWf8JkaBiMwB&cLtX2bJQ81=1bXtF','SQLi','Internet Explorer 8.0','msie7','Mac OS X 10.2.1','mac-3','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (compatible; MSIE 8.0; Macintosh; Trident/4.0; Intel Mac OS X 10_2_1)',''),(25,'78.46.157.59','09 August 2019','23:30','/index.php','KT06DobpGy=gBxKqTqdmVduA3lgFS&MI7RJ1=1YmOOdV','SQLi','Internet Explorer 6.0','msie6','Windows 8.1 x64','win-5','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows; U; MSIE 6.0; Windows NT 6.3; Trident/5.0; WOW64)','http://www.yandex.com/kjXElGN'),(26,'78.46.157.59','09 August 2019','23:30','/index.php','nr1GNpw1=1bnsu06M0kIBmDc6hDVg&CewlC00p=AYyjPeMlL6KjA2sNaI&I3UGFs=tpxr1ErdqHJFFIkyB3','SQLi','Firefox 23.0','firefox','Mac OS X 11.5.4','mac-3','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Macintosh; Intel Mac OS X 11_5_4) Gecko/20022706 Firefox/23.0','http://www.yandex.com/n2cWUpwi'),(27,'78.46.157.59','09 August 2019','23:30','/index.php','vsAeR=6tt1&XBQavduK=IPX7D4MFr35VDm&i4g=Sp1&S8sxD=2iyh1IE8Jw&HUk1=1brnUHNB','SQLi','Internet Explorer 9.0','msie9','Mac OS X 11.7.3','mac-3','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (compatible; MSIE 9.0; Macintosh; .NET CLR 1.5.18543; Intel Mac OS X 11_7_3)','http://www.baidu.com/q4mA4MuI'),(28,'78.46.157.59','09 August 2019','23:30','/index.php','gSlHRkdiRL=3dPcqOxwmx&ONwjW0sTdg=PFJimUhEcpt0n1LG2&ID5Q=pM5cHivVAaDbw&eu1=1piFNSowlvPkfVD4Vo&rk2wOdiRp=dcmgovF6BuWT7BKTyQ','SQLi','Firefox 25.0','firefox','Windows x64','win-2','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Windows NT.6.2; WOW64) Gecko/20070407 Firefox/25.0',''),(29,'209.141.35.128','10 August 2019','20:04','/index.php','2DA6QyQoI1=1xyaweshJcHuSXdW&P4rkoi=mRnRmPCcDk&P4DV48=hQKWg6tl&XMcFmy=WcBXkCBb6tCCRfFDLYth&vdekgy=d6JkMMnO4bjwQGvP','SQLi','Opera Mini 4.2.14912','opera-2','J2ME/MIDP Device','java','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Opera/9.60 (J2ME/MIDP; Opera Mini/4.2.14912/812; U; ru) Presto/2.4.15',''),(30,'209.141.35.128','10 August 2019','20:04','/index.php','nkFo1=1emtbd03&Wqi0gPnT=POuNio21pC','SQLi','Links 2.2','null','FreeBSD','freebsd','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Links (2.2; GNU/kFreeBSD 6.3-1-486 i686; 80x25',''),(31,'205.185.127.95','10 August 2019','20:05','/index.php','f71=1rdCsVEU5v&gBNiyQchKo=ePktvlgOebL','SQLi','Firefox 3.5.7','firefox','Windows Vista','win-3','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Mozilla/5.0 (Windows; U; Windows NT 6.0; en; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7',''),(32,'209.141.57.143','10 August 2019','20:05','/index.php','BtoQ1=1he&V1B=CLW5OY8b7t4hhqt0&mabrK=lPGrBopKRllYUMl&LotSiu=N7DHOLfWwhFIs15GiI0&c1DQv5P=mUO5iCKF4gC1pk0lm','SQLi','Safari 4.0','safari','Windows Vista','win-3','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Mozilla/5.0 (Windows; U; Windows NT 6.0; he-IL) AppleWebKit/528.16 (KHTML, like Gecko) Version/4.0 Safari/528.16','http://engadget.search.aol.com/search?q=urSOsTOruX'),(33,'209.141.35.128','10 August 2019','20:05','/index.php','VbABF=l4vcPWpISq&Q0qvI=8lsV1F7JCF&QdiwM=M8whtDBl&Qw1=1E8MXwL','SQLi','Shiira 1.2.2','shiira','Mac OS X','mac-3','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; de-de) AppleWebKit/418 (KHTML, like Gecko) Shiira/1.2.2 Safari/125',''),(34,'209.141.45.251','10 August 2019','20:05','/index.php','PbA52GaFR=7IYOp3GVeepr0jf&jMp1=1U1cn4rACpv4V&Lirtj0Gh=VC4cIQ6uHCVWySY2FS2','SQLi','Firefox 3.5.3','firefox','Windows 7','win-4','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3 (.NET CLR 2.0.50727','http://engadget.search.aol.com/search?q=24OMmq'),(35,'205.185.127.95','10 August 2019','20:05','/index.php','AT1rOP46uA=Fm8tCUEsFM&H16LII1=1BdYWhBIoxvlPNc8&R6l=PuP4jiNJC2Jdr&IDm6=HEYBwwmJSvYm&UTB2=blMG4MOyWdf','SQLi','Shiira 1.2.2','shiira','Mac OS X','mac-3','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Mozilla/5.0 (Macintosh; U; PPC Mac OS X; de-de) AppleWebKit/418 (KHTML, like Gecko) Shiira/1.2.2 Safari/125',''),(36,'209.141.61.187','10 August 2019','20:06','/index.php','LPTtNdBkS=FlQ2&VRN=5bfj0KD2bXXU4nhFtoVE&UYdKj=KJvBQhv7rXpABoC5&G8OH4JDSHc=8FGkmoqRaxlxA&rhqQYuV1=11Pg0ots4MNYVl','SQLi','Internet Explorer 9.0','msie9','Windows XP','win-2','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','Mozilla/4.0 (compatible; MSIE 9.0; Windows NT 5.1; Trident/5.0','http://vk.com/profile.php?redirect=vtWAHqN8'),(37,'209.141.61.187','10 August 2019','20:06','/index.php','Ai2=QYavIj2gmiqW36Nma&2t1=1KRepAuXItaY3hhdOVKm','SQLi','Unknown','null','','null','United States','US','Nevada','Las Vegas','36.17497','-115.13722','FranTech Solutions','BlackBerry9000/5.0.0.93 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/179',''),(38,'78.46.157.38','11 August 2019','19:42','/index.php','tBQPh1=1X3vv1U','SQLi','Google Chrome 14.0.375.65','chrome','GNU/Linux x64','linux','Germany','DE','Hessen','Melsungen','51.13029','9.55236','Hetzner Online GmbH','Mozilla/5.0 (Linux x86_64; X11) AppleWebKit/535.24 (KHTML, like Gecko) Chrome/14.0.375.65 Safari/536.22','');
/*!40000 ALTER TABLE `firewall_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_malwarescanner-settings`
--

DROP TABLE IF EXISTS `firewall_malwarescanner-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_malwarescanner-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file-extensions` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'php|php3|php4|php5|phps|htm|html|htaccess|js',
  `ignored-dirs` text COLLATE utf8_unicode_ci NOT NULL,
  `scan-dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_malwarescanner-settings`
--

LOCK TABLES `firewall_malwarescanner-settings` WRITE;
/*!40000 ALTER TABLE `firewall_malwarescanner-settings` DISABLE KEYS */;
INSERT INTO `firewall_malwarescanner-settings` VALUES (1,'php|phtml|php3|php4|php5|phps|htaccess|txt|gif','.|..|.DS_Store|.svn|.git','../');
/*!40000 ALTER TABLE `firewall_malwarescanner-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_massrequests-settings`
--

DROP TABLE IF EXISTS `firewall_massrequests-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_massrequests-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/mass-requests.php',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_massrequests-settings`
--

LOCK TABLES `firewall_massrequests-settings` WRITE;
/*!40000 ALTER TABLE `firewall_massrequests-settings` DISABLE KEYS */;
INSERT INTO `firewall_massrequests-settings` VALUES (1,'No','Yes','No','http://dev.gb-hoster.me/rootsec/pages/mass-requests.php','No');
/*!40000 ALTER TABLE `firewall_massrequests-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_monitoring`
--

DROP TABLE IF EXISTS `firewall_monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_monitoring` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_monitoring`
--

LOCK TABLES `firewall_monitoring` WRITE;
/*!40000 ALTER TABLE `firewall_monitoring` DISABLE KEYS */;
/*!40000 ALTER TABLE `firewall_monitoring` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_optimization-settings`
--

DROP TABLE IF EXISTS `firewall_optimization-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_optimization-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `html-minify` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_optimization-settings`
--

LOCK TABLES `firewall_optimization-settings` WRITE;
/*!40000 ALTER TABLE `firewall_optimization-settings` DISABLE KEYS */;
INSERT INTO `firewall_optimization-settings` VALUES (1,'No');
/*!40000 ALTER TABLE `firewall_optimization-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_pages-layolt`
--

DROP TABLE IF EXISTS `firewall_pages-layolt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_pages-layolt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_pages-layolt`
--

LOCK TABLES `firewall_pages-layolt` WRITE;
/*!40000 ALTER TABLE `firewall_pages-layolt` DISABLE KEYS */;
INSERT INTO `firewall_pages-layolt` VALUES (1,'Banned','You are banned and you cannot continue to the site'),(2,'Blocked','Attack was detected'),(3,'Mass_Requests','Attention, you performed too many connections'),(4,'Proxy','Access to the website via Proxy is not allowed (Disable Browser Data Compression if you have it enabled)'),(5,'Spam','You are in the Blacklist of Spammers and you cannot continue to the website'),(6,'Tor','We detected that you are using Tor'),(7,'Banned_Country','Sorry, but your country is banned and you cannot continue to the website'),(8,'Blocked_Browser','Access to the website through your Browser is not allowed, please use another Internet Browser'),(9,'Blocked_OS','Access to the website through your Operating System is not allowed'),(10,'Blocked_ISP','Your Internet Service Provider is blacklisted and you cannot continue to the website'),(11,'Bad_Bot','You were identified as a Bad Bot and you cannot continue to the website'),(12,'Fake_Bot','You were identified as a Fake Bot and you cannot continue to the website'),(13,'Tor','We detected that you are using Tor'),(14,'AdBlocker','AdBlocker detected. Please support this website by disabling your AdBlocker');
/*!40000 ALTER TABLE `firewall_pages-layolt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_proxy-settings`
--

DROP TABLE IF EXISTS `firewall_proxy-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_proxy-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://dev.gb-hoster.me/rootsec/pages/proxy.php',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_proxy-settings`
--

LOCK TABLES `firewall_proxy-settings` WRITE;
/*!40000 ALTER TABLE `firewall_proxy-settings` DISABLE KEYS */;
INSERT INTO `firewall_proxy-settings` VALUES (1,'No','No','No','Yes','No','http://dev.gb-hoster.me/rootsec/pages/proxy.php','No');
/*!40000 ALTER TABLE `firewall_proxy-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_settings`
--

DROP TABLE IF EXISTS `firewall_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `realtime_protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `mail_notifications` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `ip_detection` int(1) NOT NULL DEFAULT '1',
  `countryban_blacklist` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `jquery_include` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `error_reporting` int(11) NOT NULL DEFAULT '1',
  `display_errors` int(11) NOT NULL DEFAULT '0',
  `fixed_layout` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `boxed_layout` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `sidebar_collapsed` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `sidebar_hover` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='All Project SECURITY settings will be stored here.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_settings`
--

LOCK TABLES `firewall_settings` WRITE;
/*!40000 ALTER TABLE `firewall_settings` DISABLE KEYS */;
INSERT INTO `firewall_settings` VALUES (1,'microfix1252002@gmail.com','Yes','Yes',2,'Yes','No',1,0,'Yes','No','No','No');
/*!40000 ALTER TABLE `firewall_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_spam-settings`
--

DROP TABLE IF EXISTS `firewall_spam-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_spam-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://dev.gb-hoster.me/rootsec/pages/spammer.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_spam-settings`
--

LOCK TABLES `firewall_spam-settings` WRITE;
/*!40000 ALTER TABLE `firewall_spam-settings` DISABLE KEYS */;
INSERT INTO `firewall_spam-settings` VALUES (1,'No','Yes','http://dev.gb-hoster.me/rootsec/pages/spammer.php','No','No');
/*!40000 ALTER TABLE `firewall_spam-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_sqli-settings`
--

DROP TABLE IF EXISTS `firewall_sqli-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_sqli-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_sqli-settings`
--

LOCK TABLES `firewall_sqli-settings` WRITE;
/*!40000 ALTER TABLE `firewall_sqli-settings` DISABLE KEYS */;
INSERT INTO `firewall_sqli-settings` VALUES (1,'Yes','Yes','No','Yes','Yes','Yes','No','No','Yes','http://dev.gb-hoster.me/rootsec/pages/blocked.php','No','No');
/*!40000 ALTER TABLE `firewall_sqli-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_tor-settings`
--

DROP TABLE IF EXISTS `firewall_tor-settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_tor-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/tor-detected.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_tor-settings`
--

LOCK TABLES `firewall_tor-settings` WRITE;
/*!40000 ALTER TABLE `firewall_tor-settings` DISABLE KEYS */;
INSERT INTO `firewall_tor-settings` VALUES (1,'Yes','Yes','http://dev.gb-hoster.me/rootsec/pages/tor-detected.php','No','No');
/*!40000 ALTER TABLE `firewall_tor-settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firewall_users`
--

DROP TABLE IF EXISTS `firewall_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewall_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewall_users`
--

LOCK TABLES `firewall_users` WRITE;
/*!40000 ALTER TABLE `firewall_users` DISABLE KEYS */;
INSERT INTO `firewall_users` VALUES (1,'RootSec','ae3d4a84fdec96d4a0afae705979591614d0e6990726480f53919e461096104b','cik3r@protonmail.com');
/*!40000 ALTER TABLE `firewall_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_cene`
--

DROP TABLE IF EXISTS `gp_cene`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_cene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` text NOT NULL,
  `cena_slota` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_cene`
--

LOCK TABLES `gp_cene` WRITE;
/*!40000 ALTER TABLE `gp_cene` DISABLE KEYS */;
INSERT INTO `gp_cene` VALUES (1,'1','61din|3.7kn|0.9km|30mkd|0.375eur'),(2,'2','61din|3.7kn|0.9km|30mkd|0.5eur'),(3,'3','61din|3.7kn|0.9km|30mkd|0.5eur'),(4,'4','61din|3.7kn|0.9km|30mkd|0.5eur'),(5,'5','61din|3.7kn|0.9km|30mkd|0.5eur'),(6,'6','61din|3.7kn|0.9km|30mkd|0.5eur'),(7,'7','61din|3.7kn|0.9km|30mkd|0.5eur'),(8,'8','61din|3.7kn|0.9km|30mkd|0.5eur'),(9,'9','61din|3.7kn|0.9km|30mkd|0.5eur');
/*!40000 ALTER TABLE `gp_cene` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klijenti`
--

DROP TABLE IF EXISTS `klijenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `klijenti` (
  `klijentid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `sifra` text NOT NULL,
  `ime` text,
  `prezime` text,
  `email` text NOT NULL,
  `beleske` text,
  `novac` double NOT NULL DEFAULT '0',
  `currency` int(2) NOT NULL DEFAULT '1',
  `status` text NOT NULL,
  `lastlogin` datetime NOT NULL,
  `lastactivity` text NOT NULL,
  `lastip` text NOT NULL,
  `lasthost` text NOT NULL,
  `kreiran` text NOT NULL,
  `zemlja` text NOT NULL,
  `avatar` text NOT NULL,
  `cover` varchar(11) NOT NULL DEFAULT 'cover.jpg',
  `banovan` int(2) NOT NULL DEFAULT '0',
  `ftp_ban` varchar(100) NOT NULL DEFAULT '0',
  `support_ban` varchar(100) NOT NULL DEFAULT '0',
  `sigkod` int(11) NOT NULL,
  `token` text,
  `mail` int(2) NOT NULL DEFAULT '1',
  `dodao` text NOT NULL,
  PRIMARY KEY (`klijentid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klijenti`
--

LOCK TABLES `klijenti` WRITE;
/*!40000 ALTER TABLE `klijenti` DISABLE KEYS */;
INSERT INTO `klijenti` VALUES (1,'Demo','fe01ce2a7fbac8fafaed7c982a04e229','Demo','Demo','demo@obgp.me',NULL,10,1,'1','0000-00-00 00:00:00','1565602718','12.08.2019, 11:26','87.116.176.18','','ME','avatar.jpg','cover.jpg',0,'0','0',20000,'0',1,''),(2,'RootSec','fe01ce2a7fbac8fafaed7c982a04e229','Nikita','Sibul','cik3r@protonmail.com',NULL,0,1,'1','0000-00-00 00:00:00','1563120057','14.07.2019, 18:00','31.223.128.149','06.06.2019, 16:13','RS','avatar.png','cover.png',0,'0','0',1693,'',1,''),(6,'Underline','e8df51a6d4f285d50f1c2ff32d284081','Mario','Mlinaric','mario.mlinaric133@gmail.com',NULL,0,1,'1','0000-00-00 00:00:00','1565434691','10.08.2019, 12:54','cpe-109-60-98-227.zg3.cable.xnet.hr','08.10.2019, 12:54','HR','avatar.png','cover.png',0,'0','0',13755,'',1,''),(7,'dajno123','3ec7c9e4c4a1c8954792893f109a667d','Hajrudin','softic','dajnotest@gmail.com',NULL,0,1,'1','0000-00-00 00:00:00','','','','08.10.2019, 13:12','BA','avatar.png','cover.png',0,'0','0',63281,'',1,'');
/*!40000 ALTER TABLE `klijenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lgsl`
--

DROP TABLE IF EXISTS `lgsl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lgsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `c_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `q_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `s_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `cache` text COLLATE utf8_unicode_ci NOT NULL,
  `cache_time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logovi`
--

DROP TABLE IF EXISTS `logovi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `vreme` varchar(255) DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=497 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `maps`
--

DROP TABLE IF EXISTS `maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` text NOT NULL,
  `map_name` text NOT NULL,
  `map_description` text NOT NULL,
  `map_file` text NOT NULL,
  `map_img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maps`
--

LOCK TABLES `maps` WRITE;
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
INSERT INTO `maps` VALUES (1,'1','de_dust2','Default Mapa ','de_dust2.bsp','de_dust2.jpg');
/*!40000 ALTER TABLE `maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modovi`
--

DROP TABLE IF EXISTS `modovi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `ime` text NOT NULL,
  `opis` mediumtext NOT NULL,
  `igra` text NOT NULL,
  `komanda` text NOT NULL,
  `sakriven` int(11) NOT NULL DEFAULT '1',
  `mapa` mediumtext,
  `cena` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obavestenja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` text,
  `poruka` text,
  `datum` text,
  `vrsta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obavestenja`
--

LOCK TABLES `obavestenja` WRITE;
/*!40000 ALTER TABLE `obavestenja` DISABLE KEYS */;
INSERT INTO `obavestenja` VALUES (1,'OBGP','Uspesno ste instalirali OBGP','12.2.2019',1);
/*!40000 ALTER TABLE `obavestenja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online`
--

DROP TABLE IF EXISTS `online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online` (
  `online` varchar(2) DEFAULT NULL,
  `poruka` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online`
--

LOCK TABLES `online` WRITE;
/*!40000 ALTER TABLE `online` DISABLE KEYS */;
/*!40000 ALTER TABLE `online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugins`
--

DROP TABLE IF EXISTS `plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` text,
  `deskripcija` text,
  `prikaz` text,
  `text` text,
  `game_id` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reputacija`
--

DROP TABLE IF EXISTS `reputacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reputacija` (
  `rep` int(5) NOT NULL,
  `adminid` int(5) NOT NULL,
  `d` int(11) NOT NULL,
  `f` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reputacija`
--

LOCK TABLES `reputacija` WRITE;
/*!40000 ALTER TABLE `reputacija` DISABLE KEYS */;
/*!40000 ALTER TABLE `reputacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server_backup`
--

DROP TABLE IF EXISTS `server_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `srvid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '0',
  `size` varchar(20) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_backup`
--

LOCK TABLES `server_backup` WRITE;
/*!40000 ALTER TABLE `server_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `server_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serveri`
--

DROP TABLE IF EXISTS `serveri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serveri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `box_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `rank` int(12) NOT NULL DEFAULT '99999',
  `modovi` mediumtext NOT NULL,
  `map` text NOT NULL,
  `port` mediumtext NOT NULL,
  `fps` int(11) NOT NULL DEFAULT '300',
  `slotovi` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `istice` mediumtext NOT NULL,
  `status` text NOT NULL,
  `startovan` int(11) NOT NULL DEFAULT '0',
  `free` mediumtext,
  `uplatnica` mediumtext,
  `igra` mediumtext,
  `komanda` mediumtext NOT NULL,
  `cena` mediumtext NOT NULL,
  `boost` mediumtext NOT NULL,
  `cache` blob NOT NULL,
  `graph` text,
  `reinstaliran` int(11) NOT NULL,
  `backup` varchar(12) NOT NULL DEFAULT '0',
  `napomena` text NOT NULL,
  `autorestart` varchar(11) DEFAULT '-1',
  `backupstatus` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rank` (`rank`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `serveri_naruceni`
--

DROP TABLE IF EXISTS `serveri_naruceni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serveri_naruceni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `klijentid` int(11) DEFAULT NULL,
  `igra` int(2) DEFAULT NULL,
  `lokacija` int(2) DEFAULT NULL,
  `slotovi` int(4) DEFAULT NULL,
  `meseci` int(3) DEFAULT NULL,
  `cena` varchar(8) DEFAULT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serveri_naruceni`
--

LOCK TABLES `serveri_naruceni` WRITE;
/*!40000 ALTER TABLE `serveri_naruceni` DISABLE KEYS */;
/*!40000 ALTER TABLE `serveri_naruceni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shared`
--

DROP TABLE IF EXISTS `shared`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shared` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serverid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `perms` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shared`
--

LOCK TABLES `shared` WRITE;
/*!40000 ALTER TABLE `shared` DISABLE KEYS */;
/*!40000 ALTER TABLE `shared` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'OBGP','3.0.0','RootSec','http://obgp.me','obgp@pm.me','en','0','1','1','','0','','https://gametracker.xyz','paymentobgp@pm.me','BITCOIN API KEY','http://fdl.obgp.me','https://i.imgur.com/unnxAPA.png');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_red`
--

DROP TABLE IF EXISTS `ticket_red`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_red` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` text NOT NULL,
  `red` text,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_red`
--

LOCK TABLES `ticket_red` WRITE;
/*!40000 ALTER TABLE `ticket_red` DISABLE KEYS */;
INSERT INTO `ticket_red` VALUES (1,'1','1','1'),(2,'2','1','1');
/*!40000 ALTER TABLE `ticket_red` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiketi`
--

DROP TABLE IF EXISTS `tiketi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiketi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `prioritet` int(11) NOT NULL,
  `vrsta` int(11) NOT NULL,
  `datum` text,
  `naslov` text,
  `text` text,
  `billing` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL,
  `otvoren` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-
-- Table structure for table `tiketi_odgovori`
--

DROP TABLE IF EXISTS `tiketi_odgovori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiketi_odgovori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiket_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `odgovor` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `vreme_odgovora` text NOT NULL,
  `time` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
