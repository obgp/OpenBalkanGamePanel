DROP TABLE IF EXISTS `<DB_PREFIX>adblocker-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>badbot-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>bans`;
DROP TABLE IF EXISTS `<DB_PREFIX>bans-country`;
DROP TABLE IF EXISTS `<DB_PREFIX>bans-other`;
DROP TABLE IF EXISTS `<DB_PREFIX>content-protection`;
DROP TABLE IF EXISTS `<DB_PREFIX>dnsbl-databases`;
DROP TABLE IF EXISTS `<DB_PREFIX>ip-whitelist`;
DROP TABLE IF EXISTS `<DB_PREFIX>logs`;
DROP TABLE IF EXISTS `<DB_PREFIX>malwarescanner-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>massrequests-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>optimization-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>pages-layolt`;
DROP TABLE IF EXISTS `<DB_PREFIX>proxy-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>spam-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>sqli-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>tor-settings`;

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>adblocker-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `detection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/adblocker-detected.php'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>adblocker-settings` (`id`, `detection`, `redirect`) VALUES
(1, 'No', '<PROJECTSECURITY_PATH>/pages/adblocker-detected.php');

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>badbot-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>badbot-settings` (`id`, `protection`, `protection2`, `protection3`, `logging`, `autoban`, `mail`) VALUES
(1, 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'No');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bans-country` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned countries table';

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bans-other` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>content-protection` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `function` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `alert` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>content-protection` (`id`, `function`, `enabled`, `alert`, `message`) VALUES
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

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>dnsbl-databases` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `database` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>dnsbl-databases` (`id`, `database`) VALUES
(1, 'sbl.spamhaus.org'),
(2, 'xbl.spamhaus.org');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ip-whitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
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

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>malwarescanner-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `file-extensions` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'php|php3|php4|php5|phps|htm|html|htaccess|js',
  `ignored-dirs` text COLLATE utf8_unicode_ci NOT NULL,
  `scan-dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>malwarescanner-settings` (`id`, `file-extensions`, `ignored-dirs`, `scan-dir`) VALUES
(1, 'php|phtml|php3|php4|php5|phps|htaccess|txt|gif', '.|..|.DS_Store|.svn|.git', '../');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>massrequests-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/mass-requests.php',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>massrequests-settings` (`id`, `protection`, `logging`, `autoban`, `redirect`, `mail`) VALUES
(1, 'No', 'Yes', 'No', '<PROJECTSECURITY_PATH>/pages/mass-requests.php', 'No');

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>optimization-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `html-minify` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>optimization-settings` (`id`, `html-minify`) VALUES
(1, 'No');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>pages-layolt` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `page` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>pages-layolt` (`id`, `page`, `text`) VALUES
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

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>proxy-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '<PROJECTSECURITY_PATH>/pages/proxy.php',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>proxy-settings` (`id`, `protection`, `protection2`, `protection3`, `logging`, `autoban`, `redirect`, `mail`) VALUES
(1, 'Yes', 'No', 'No', 'Yes', 'No', '<PROJECTSECURITY_PATH>/pages/proxy.php', 'No');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
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
  `sidebar_hover` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='All Project SECURITY settings will be stored here.';


INSERT INTO `<DB_PREFIX>settings` (`id`, `email`, `mail_notifications`, `realtime_protection`, `ip_detection`, `countryban_blacklist`, `jquery_include`, `error_reporting`, `display_errors`, `fixed_layout`, `boxed_layout`, `sidebar_collapsed`, `sidebar_hover`) VALUES
(1, 'admin@mail.com', 'Yes', 'Yes', 1, 'Yes', 'No', 1, 0, 'Yes', 'No', 'No', 'No');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>spam-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '<PROJECTSECURITY_PATH>/pages/spammer.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>spam-settings` (`id`, `protection`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 'No', 'Yes', '<PROJECTSECURITY_PATH>/pages/spammer.php', 'No', 'No');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>sqli-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection2` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `protection4` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection5` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection6` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `protection7` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `protection8` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '<PROJECTSECURITY_PATH>/pages/blocked.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>sqli-settings` (`id`, `protection`, `protection2`, `protection3`, `protection4`, `protection5`, `protection6`, `protection7`, `protection8`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'No', 'No', 'Yes', '<PROJECTSECURITY_PATH>/pages/blocked.php', 'No', 'No');

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>tor-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `logging` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/tor-detected.php',
  `autoban` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `mail` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>tor-settings` (`id`, `protection`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 'Yes', 'Yes', '<PROJECTSECURITY_PATH>/pages/tor-detected.php', 'No', 'No');