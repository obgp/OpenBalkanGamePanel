<?php
//SQLi Protection
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);

if ($row['protection'] == "Yes") {
    
    //XSS Protection - Block infected requests
    //@header("X-XSS-Protection: 1; mode=block");
    
    if ($row['protection2'] == "Yes") {
        //XSS Protection - Sanitize infected requests
        @header("X-XSS-Protection: 1");
    }
    
    if ($row['protection3'] == "Yes") {
        //Clickjacking Protection
        @header("X-Frame-Options: sameorigin");
    }
    
    if ($row['protection4'] == "Yes") {
        //Prevents attacks based on MIME-type mismatch
        @header("X-Content-Type-Options: nosniff");
    }
    
    if ($row['protection5'] == "Yes") {
        //Force secure connection
        @header("Strict-Transport-Security: max-age=15552000; preload");
    }
    
    if ($row['protection6'] == "Yes") {
        //Hide PHP Version
        @header('X-Powered-By: Project SECURITY');
    }
    
    if ($row['protection7'] == "Yes") {
        //Sanitization of all fields and requests
        $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    }
    
	//Data Sanitization
    if ($row['protection8'] == "Yes") {

        if (!function_exists('cleanInput')) {
            function cleanInput($input)
            {
                $search = array(
                    '@<script[^>]*?>.*?</script>@si', // Strip out javascript
                    '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
                    '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
                    '@<![\s\S]*?--[ \t\n\r]*>@' // Strip multi-line comments
                );
                
                $output = preg_replace($search, '', $input);
                return $output;
            }
        }
        
        if (!function_exists('sanitize')) {
            function sanitize($input)
            {
                if (is_array($input)) {
                    foreach ($input as $var => $val) {
                        $output[$var] = sanitize($val);
                    }
                } else {
                    $input  = str_replace('"', "", $input);
                    $input  = str_replace("'", "", $input);
                    $input  = cleanInput($input);
                    $output = htmlentities($input, ENT_QUOTES);
                }
                return @$output;
            }
        }
        
        $_POST    = sanitize($_POST);
        $_GET     = sanitize($_GET);
        $_REQUEST = sanitize($_REQUEST);
        $_COOKIE  = sanitize($_COOKIE);
        if (isset($_SESSION)) {
            $_SESSION = sanitize($_SESSION);
        }
    }
    
    $query_string = $_SERVER['QUERY_STRING'];
    
    //Patterns, used to detect Malicous Request (SQL Injection)
    $patterns = array(
        "+select+",
        "+union+",
        "union+",
        "+or+",
        "**/",
        "/**",
        "0x3a",
        "/*",
        "*/",
        "*",
        "--",
        ";",
        "||",
        "' #",
        "or 1=1",
        "'1'='1",
        "S@BUN",
        "`",
        "'",
        '"',
        "[",
        "]",
        "<",
        ">",
        "++",
        "1,1",
        "1=1",
        "sleep(",
        "%27",
        "%22",
        "(",
        ")",
        "<?",
        "<?php",
        "?>",
        "../",
        "/localhost",
        "127.0.0.1",
        "loopback",
        "%0A",
        "%0D",
        "%3C",
        "%3E",
        "%00",
        "%2e%2e",
        "input_file",
        "path=.",
        "mod=.",
        "eval\(",
        "javascript:",
        "base64_",
        "boot.ini",
        "etc/passwd",
        "self/environ",
        "echo.*kae",
        "=%27$"
    );
    foreach ($patterns as $pattern) {
        if (strpos(strtolower($query_string), strtolower($pattern)) !== false) {
            
            $querya = strip_tags(addslashes($query_string));
            $type   = "SQLi";
            
            //Logging
            if ($row['logging'] == "Yes") {
                $ltable     = $prefix . 'logs';
                $queryvalid = mysqli_query($connect, "SELECT ip, page, query, type, date FROM `$ltable` WHERE ip='$ip' and page='$page' and query='$querya' and type='$type' and date='$date' LIMIT 1");
                if (!mysqli_num_rows($queryvalid)) {
                    include_once "lib/ip_details.php";
                    $log = mysqli_query($connect, "INSERT INTO `$ltable` (`ip`, `date`, `time`, `page`, `query`, `type`, `browser`, `browser_code`, `os`, `os_code`, `country`, `country_code`, `region`, `city`, `latitude`, `longitude`, `isp`, `useragent`, `referer_url`) VALUES ('$ip', '$date', '$time', '$page', '$querya', '$type', '$browser', '$browser_code', '$os', '$os_code', '$country', '$country_code', '$region', '$city', '$latitude', '$longitude', '$isp', '$useragent', '$referer')");
                }
            }
            
            //AutoBan
            if ($row['autoban'] == "Yes") {
                $btable        = $prefix . 'bans';
                $bansvalid     = mysqli_query($connect, "SELECT ip FROM `$btable` WHERE ip='$ip' LIMIT 1");
                if (!mysqli_num_rows($bansvalid)) {
                    $log = mysqli_query($connect, "INSERT INTO `$btable` (ip, date, time, reason, autoban) VALUES ('$ip', '$date', '$time', '$type', 'Yes')");
                }
            }
            
            //E-Mail Notification
            if ($srow['mail_notifications'] == "Yes" && $row['mail'] == "Yes") {
                $email   = 'notifications@' . $_SERVER['SERVER_NAME'] . '';
                $to      = $srow['email'];
                $subject = 'Project SECURITY - ' . $type . '';
                $message = '
					<p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">Details of Log - ' . $type . '</p>
					<p>IP Address: <strong>' . $ip . '</strong></p>
					<p>Date: <strong>' . $date . '</strong> at <strong>' . $time . '</strong></p>
					<p>Browser:  <strong>' . $browser . '</strong></p>
					<p>Operating System:  <strong>' . $os . '</strong></p>
					<p>Threat Type:  <strong>' . $type . '</strong> </p>
					<p>Page:  <strong>' . $page . '</strong> </p>
                	<p>Referer URL:  <strong>' . $referer . '</strong> </p>
                	<p>Site URL:  <strong>' . $site_url . '</strong> </p>
                	<p>Project SECURITY URL:  <strong>' . $projectsecurity_path . '</strong> </p>
				';
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'To: ' . $to . ' <' . $to . '>' . "\r\n";
                $headers .= 'From: ' . $email . ' <' . $email . '>' . "\r\n";
                @mail($to, $subject, $message, $headers);
            }
            
            echo '<meta http-equiv="refresh" content="0;url=' . $row['redirect'] . '" />';
            exit;
        }
    }
}
?>