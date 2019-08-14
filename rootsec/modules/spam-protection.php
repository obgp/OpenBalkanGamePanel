<?php
//Spam Protection
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);

if ($row['protection'] == "Yes") {
    
    $table2 = $prefix . 'dnsbl-databases';
    $query2 = mysqli_query($connect, "SELECT * FROM `$table2`");
    while ($row2 = mysqli_fetch_array($query2)) {
        
        $dnsbl_lookup = array(
            $row2['database']
        );
        $reverse_ip   = implode(".", array_reverse(explode(".", $ip)));
        
        foreach ($dnsbl_lookup as $host) {
            if (checkdnsrr($reverse_ip . "." . $host . ".", "A")) {
                
                $type = "Spammer";
                
                //Logging
                if ($row['logging'] == "Yes") {
                    $ltable     = $prefix . 'logs';
                    $queryvalid = mysqli_query($connect, "SELECT ip, type, date FROM `$ltable` WHERE ip='$ip' and type='$type' and date='$date' LIMIT 1");
                    if (!mysqli_num_rows($queryvalid)) {
						include_once "lib/ip_details.php";
                        $log = mysqli_query($connect, "INSERT INTO `$ltable` (`ip`, `date`, `time`, `page`, `type`, `browser`, `browser_code`, `os`, `os_code`, `country`, `country_code`, `region`, `city`, `latitude`, `longitude`, `isp`, `useragent`, `referer_url`) VALUES ('$ip', '$date', '$time', '$page', '$type', '$browser', '$browser_code', '$os', '$os_code', '$country', '$country_code', '$region', '$city', '$latitude', '$longitude', '$isp', '$useragent', '$referer')");
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
                    $email   = 'notifications@'.$_SERVER['SERVER_NAME'].'';
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
}
?>