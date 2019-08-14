<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-list"></i> IP Blacklist Checker</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">IP Blacklist Checker</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">
                    
                <div class="row">
				<div class="col-md-12">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">IP Blacklist Checker</h3>
						</div>
						<div class="box-body">
<form method="post" >
	IP Address: 
	<input type="text" class="form-control" name="ip" placeholder="1.2.3.4" required/><br /> 
	<input type="submit" class="btn btn-primary btn-block btn-flat" value="Lookup" />
</form>
                        </div>
                    </div>
					 
<?php
if (!empty($_POST['ip'])) {
    
    $ip = $_POST['ip'];
    
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo '<div class="alert alert-danger"><strong>The entered IP Address is invalid</strong></div>';
    } else {
        
        @set_time_limit(360);
        ini_set('max_execution_time', 300); //300 Seconds = 5 Minutes
        ini_set('memory_limit', '512M');
        
        $dnsbl_lookup = array(
            "all.s5h.net",
            "b.barracudacentral.org",
            "bl.spamcannibal.org",
            "bl.spamcop.net",
            "blacklist.woody.ch",
            "bogons.cymru.com",
            "cbl.abuseat.org",
            "cdl.anti-spam.org.cn",
            "combined.abuse.ch",
            "db.wpbl.info",
            "dnsbl-1.uceprotect.net",
            "dnsbl-2.uceprotect.net",
            "dnsbl-3.uceprotect.net",
            "dnsbl.anticaptcha.net",
            "dnsbl.cyberlogic.net",
            "dnsbl.dronebl.org",
            "dnsbl.inps.de",
            "dnsbl.sorbs.net",
            "drone.abuse.ch",
            "drone.abuse.ch",
            "duinv.aupads.org",
            "dul.dnsbl.sorbs.net",
            "dyna.spamrats.com",
            "dynip.rothen.com",
            "exitnodes.tor.dnsbl.sectoor.de",
            "http.dnsbl.sorbs.net",
            "ips.backscatterer.org",
            "ix.dnsbl.manitu.net",
            "korea.services.net",
            "misc.dnsbl.sorbs.net",
            "noptr.spamrats.com",
            "orvedb.aupads.org",
            "pbl.spamhaus.org",
            "proxy.bl.gweep.ca",
            "psbl.surriel.com",
            "relays.bl.gweep.ca",
            "relays.nether.net",
            "sbl.spamhaus.org",
            "short.rbl.jp",
            "singular.ttk.pte.hu",
            "smtp.dnsbl.sorbs.net",
            "socks.dnsbl.sorbs.net",
            "spam.abuse.ch",
            "spam.dnsbl.anonmails.de",
            "spam.dnsbl.sorbs.net",
            "spam.spamrats.com",
            "spambot.bls.digibase.ca",
            "spamrbl.imp.ch",
            "spamsources.fabel.dk",
            "ubl.lashback.com",
            "ubl.unsubscore.com",
            "virus.rbl.jp",
            "web.dnsbl.sorbs.net",
            "wormrbl.imp.ch",
            "xbl.spamhaus.org",
            "z.mailspike.net",
            "zen.spamhaus.org",
            "zombie.dnsbl.sorbs.net"
        );
        
        $AllCount = count($dnsbl_lookup);
        $BadCount = 0;
        
        $reverse_ip = implode(".", array_reverse(explode(".", $ip)));
        
        echo '<div class="box">
			<div class="box-header">
				<h3 class="box-title">Results for <b>' . $_POST['ip'] . '</b></h3>
			</div>
			<div class="box-body">';
        
        echo '<table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><i class="fa fa-database"></i> DNSBL</th>
        <th><i class="fa fa-cogs"></i> Reverse IP</th>
        <th><i class="fa fa-info-circle"></i> Status</th>
      </tr>
    </thead>
    <tbody>';
        
        foreach ($dnsbl_lookup as $host) {
            echo '<tr><td>' . $host . '</td><td>' . $reverse_ip . '.' . $host . '</td>';
            if (@checkdnsrr($reverse_ip . "." . $host . ".", "A")) {
                echo '<td><font class="label bg-red" style="font-size: 13px;"><i class="fa fa-times-circle"></i> Listed</font></td></tr>';
                $BadCount++;
            } else {
                echo '<td><font class="label bg-green" style="font-size: 13px;"><i class="fa fa-check-circle"></i> Not Listed</font></td></tr>';
            }
        }
        
        echo '</tbody>
    </table><br />';
        
        echo "Thе IP Address is listed in " . $BadCount . " blacklists of " . $AllCount . " total<br/>";
        
        echo '</div></div></div>';
    }
} else {
    echo '</div>';
}
?>

				</div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<?php
footer();
?>