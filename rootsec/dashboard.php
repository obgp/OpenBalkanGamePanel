<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-home"></i> Dashboard</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Dashboard</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">
                    
<h3 class="text-thin">Today's Stats</h3>
<?php
$date   = date('d F Y');
$table  = $prefix . 'logs';
$query  = mysqli_query($connect, "SELECT * FROM $table WHERE date='$date' AND type='SQLi'");
$count  = mysqli_num_rows($query);
$query2 = mysqli_query($connect, "SELECT * FROM $table WHERE date='$date' AND type='Mass Requests'");
$count2 = mysqli_num_rows($query2);
$query3 = mysqli_query($connect, "SELECT * FROM $table WHERE date='$date' AND type='Proxy'");
$count3 = mysqli_num_rows($query3);
$query4 = mysqli_query($connect, "SELECT * FROM $table WHERE date='$date' AND type='Spammer'");
$count4 = mysqli_num_rows($query4);
?>
                <div class="row">
                
					    <div class="col-sm-6 col-lg-3">
                            <div class="small-box bg-aqua">
                               <div class="inner">
                                   <h3><?php
echo $count;
?></h3>
                                   <p>SQLi Attacks</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-code"></i>
                               </div>
                               <a href="sqli-logs.php" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-red">
                               <div class="inner">
                                   <h3><?php
echo $count2;
?></h3>
                                   <p>Mass Requests</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-retweet"></i>
                               </div>
                               <a href="massrequest-logs.php" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-green">
                               <div class="inner">
                                   <h3><?php
echo $count3;
?></h3>
                                   <p>Proxies</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-globe"></i>
                               </div>
                               <a href="proxy-logs.php" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-yellow">
                               <div class="inner">
                                   <h3><?php
echo $count4;
?></h3>
                                   <p>Spammers</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-keyboard-o"></i>
                               </div>
                               <a href="spammer-logs.php" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					</div>
                    
                <h3 class="text-thin">Overall Statistics</h3>
                    
                <div class="row">          
					    <div class="col-lg-7">
					        <div id="panel-network" class="box">
					            <div class="box-header">
					                <h3 class="box-title">Statistics</h3>
					            </div>
					            <div class="box-body">
                                    <div id="log-stats" class="graph"></div>
                                </div>
                            </div>
					
					    </div>
<?php
$table   = $prefix . 'logs';
$querym  = mysqli_query($connect, "SELECT * FROM $table WHERE type='SQLi'");
$countm  = mysqli_num_rows($querym);
$querym2 = mysqli_query($connect, "SELECT * FROM $table WHERE type='Mass Requests'");
$countm2 = mysqli_num_rows($querym2);
$querym3 = mysqli_query($connect, "SELECT * FROM $table WHERE type='Proxy'");
$countm3 = mysqli_num_rows($querym3);
$querym4 = mysqli_query($connect, "SELECT * FROM $table WHERE type='Spammer'");
$countm4 = mysqli_num_rows($querym4);
?>
                        <div class="col-lg-5">
					        <div class="row">
					            <div class="col-sm-6 col-lg-6"> 
					         <div class="box box-primary">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-lg">SQL Injection Attacks</p>
									<i class="fa fa-code fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $countm;
?></p>
								</div>
							 </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					         <div class="box box-danger">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-lg">Mass Requests</p>
									<i class="fa fa-retweet fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $countm2;
?></p>
								</div>
							 </div>
					            </div>
					        </div>
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					        <div class="box box-success">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-lg">Proxies</p>
									<i class="fa fa-globe fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $countm3;
?></p>
								</div>
							 </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					        <div class="box box-warning">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-lg">Spammers</p>
									<i class="fa fa-keyboard-o fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $countm4;
?></p>
								</div>
							 </div>
					            </div>
					        </div>
					
					    </div>
					</div>
                    
                    <div class="box">
						<div class="box-header">
								<h3 class="box-title">Modules & Functions</h3>
						</div>
						<div class="box-body">
<div class="row">
					<div class="col-md-4">
                        <div class="well">
						    <center>
							<h3><i class="fa fa-cog"></i> &nbsp;Security Modules</h3>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-code"></i> SQL Injection</strong><br />Protection
<?php
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>							
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-globe"></i> Proxy</strong><br />Protection 
<?php
$table = $prefix . 'proxy-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
                    <div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-retweet"></i> Mass Requests</strong><br />Protection
<?php
$table = $prefix . 'massrequests-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-keyboard-o"></i> Spam</strong><br />Protection 
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-4">
                        <div class="well">
						    <center>
							<h3><i class="fa fa-list-ul"></i> &nbsp;Logging Settings</h3>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-code"></i> SQL Injection</strong><br />Logging
<?php
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>							
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-globe"></i> Proxy</strong><br />Logging 
<?php
$table = $prefix . 'proxy-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
                    <div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-retweet"></i> Mass Requests</strong><br />Logging
<?php
$table = $prefix . 'massrequests-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-keyboard-o"></i> Spam</strong><br />Logging
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-4">
                        <div class="well">
						    <center>
							<h3><i class="fa fa-ban"></i> &nbsp;AutoBan Settings</h3>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-code"></i> SQL Injection</strong><br />AutoBan
<?php
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>							
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-globe"></i> Proxy</strong><br />AutoBan 
<?php
$table = $prefix . 'proxy-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
                    <div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-retweet"></i> Mass Requests</strong><br />AutoBan
<?php
$table = $prefix . 'massrequests-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-keyboard-o"></i> Spam</strong><br />AutoBan
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					</div>   
						</div>
				   </div>
				   
				   <div class="row">
<?php
$url = 'http://extreme-ip-lookup.com/json/127.0.0.1';
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60');
curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
$ipcontent = curl_exec($ch);
curl_close($ch);

$ip_data = @json_decode($ipcontent);
if ($ip_data && $ip_data->{'status'} == 'success') {
    $gstatus = '<font color="green">Online</font>';
} else {
    $gstatus = '<font color="red">Offline</font>';
}
?>
				        <div class="col-md-6">
						    <div class="info-box">
            			    <span class="info-box-icon bg-blue"><i class="fa fa-globe"></i></span>
            			    <div class="info-box-content">
            			      <span class="info-box-text">GeoIP API Status</span>
            			      <span class="info-box-number"><?php
echo $gstatus;
?></span>
            			    </div>
          			        </div>
						</div>
<?php
$url = 'http://www.shroomery.org/ythan/proxycheck.php?ip=127.0.0.1';
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60');
curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
$proxy_check = curl_exec($ch);
curl_close($ch);

if ($proxy_check == "Y" || $proxy_check == "N" || $proxy_check == "X") {
    $pstatus = '<font color="green">Online</font>';
} else {
    $pstatus = '<font color="red">Offline</font>';
}
?>
				        <div class="col-md-6">
						    <div class="info-box">
            			    <span class="info-box-icon bg-blue"><i class="fa fa-cloud"></i></span>
            			    <div class="info-box-content">
            			      <span class="info-box-text">Proxy API Status</span>
            			      <span class="info-box-number"><?php
echo $pstatus;
?></span>
            			    </div>
          			        </div>
						</div>
				   </div>
				   
				   <div class="row">
				        <div class="col-md-4">
						    <div class="box box-primary">
             			        <div class="box-header with-border">
            			            <h3 class="box-title">Recent Logs</h3>
             			        </div>
            			        <div class="box-body">
<?php
$table = $prefix . 'logs';
$query = mysqli_query($connect, "SELECT * FROM `$table` ORDER BY id DESC LIMIT 2");
$count = mysqli_num_rows($query);
if ($count > 0) {
    foreach ($query as $row) {
        echo '
							<h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;"><i class="fa fa-user pull-left"></i> ' . $row['ip'] . '</h4>
													
							<div class="media">
                            <div class="media-left">
                                <i class="fa fa-user-secret fa-4x"></i>
                            </div>
                            <div class="media-body">
                                <div class="clearfix">
                                    <p class="pull-right">
                                        
										<a href="log-details.php?id=' . $row['id'] . '" class="btn btn-sm btn-flat btn-block btn-primary"><i class="fa fa-tasks"></i> Details</a>
                            			';
        if (get_banned($row['ip']) == 'Yes') {
            echo '
									                <a href="bans-ip.php?delete-id=' . get_bannedid($row['ip']) . '" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-trash"></i> Unban</a>
								                	';
        } else {
            echo '
									                <a href="bans-ip.php?ip=' . $row['ip'] . '&reason=' . $row['type'] . '" class="btn btn-sm btn-flat btn-block btn-warning"><i class="fa fa-ban"></i> Ban</a>
								                    ';
        }
        echo '
							                        <a href="all-logs.php?delete-id=' . $row['id'] . '" class="btn btn-sm btn-flat btn-block btn-danger"><i class="fa fa-times"></i> Delete</a>       

                                    </p>

                                    <p><i class="fa fa-file-text-o"></i> Threat Type:
';
        if ($row['type'] == 'SQLi') {
            echo '<button class="btn btn-xs btn-primary btn-flat"><i class="fa fa-code"></i> <b>' . $row['type'] . '</b></button>';
        } elseif ($row['type'] == 'Mass Requests') {
            echo '<button class="btn btn-xs btn-danger btn-flat"><i class="fa fa-retweet"></i> <b>' . $row['type'] . '</b></button>';
        } elseif ($row['type'] == 'Proxy') {
            echo '<button class="btn btn-xs btn-success btn-flat"><i class="fa fa-globe"></i> <b>' . $row['type'] . '</b></button>';
        } elseif ($row['type'] == 'Spammer') {
            echo '<button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-keyboard-o"></i> <b>' . $row['type'] . '</b></button>';
        } else {
            echo '<button class="btn btn-xs btn-success btn-flat"><i class="fa fa-user-secret"></i> <b>Other</b></button>';
        }
        echo '
		                    </p>
							<p><i class="fa fa-calendar-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '</p>
							
                                </div>
                            </div>
                            </div>
							<hr>
';
    }
    echo '<center><a href="all-logs.php" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> View All</a></center>';
} else {
    echo '<br /><div class="alert alert-info"><p>There are no recent <b>Logs</b></p></div>';
}
?>
            			        </div>
            			    </div>
						</div>
						
						<div class="col-md-4">
						    <div class="box box-primary">
             			        <div class="box-header with-border">
            			            <h3 class="box-title">Recent IP Bans</h3>
             			        </div>
            			        <div class="box-body">
<?php
$table = $prefix . 'bans';
$query = mysqli_query($connect, "SELECT * FROM `$table` ORDER BY id DESC LIMIT 2");
$count = mysqli_num_rows($query);
if ($count > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        echo '	
							<h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;"><i class="fa fa-user pull-left"></i> ' . $row['ip'] . '</h4>
													
							<div class="media">
                            <div class="media-left">
                                <i class="fa fa-ban fa-4x"></i>
                            </div>
                            <div class="media-body">
                                <div class="clearfix">
                                    <p class="pull-right">
                                        
										<a href="bans-ip.php?edit-id=' . $row['id'] . '" class="btn btn-sm btn-flat btn-block btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                            			<a href="bans-ip.php?delete-id=' . $row['id'] . '" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-trash"></i> Unban</a>
                                    </p>

									<p><i class="fa fa-file-text-o"></i> ' . $row['reason'] . '</p>
									<p><i class="fa fa-calendar-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '</p>

                                    <p style="margin-bottom: 0">
                                        <button class="btn btn-xs btn-flat btn-danger"><i class="fa fa-magic"></i> Autobanned: <b>' . $row['autoban'] . '</b></button>
                                    </p>
                                </div>
                            </div>
                            </div>
							<hr />
';
    }
    echo '<center><a href="bans-ip.php" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> View All</a></center>';
} else {
    echo '<br /><div class="alert alert-info"><p>There are no recent <b>IP Bans</b></p></div>';
}
?>
            			        </div>
            			    </div>
						</div>
						
				        <div class="col-md-4">
						    <div class="box box-primary">
             			        <div class="box-header with-border">
            			            <h3 class="box-title">Statistics</h3>
             			        </div>
            			        <div class="box-body">
<table class="table table-bordered table-hover">
				    <tr class="active">
                      <th><i class="fa fa-list"></i> Logs</th>
                      <th>Value</th>
                    </tr>
<?php
$table = $prefix . 'logs';
@$query = mysqli_query($connect, "SELECT id FROM `$table`");
@$count = mysqli_num_rows($query);
?>
                    <tr>
                      <td>Total</td>
                      <td><?php
echo $count;
?></td>
                    </tr>
<?php
$table = $prefix . 'logs';
$date2 = date("d F Y");
@$query2 = mysqli_query($connect, "SELECT id FROM `$table` WHERE date='$date2'");
@$count2 = mysqli_num_rows($query2);
?>
                    <tr>
                      <td>Today</td>
                      <td><?php
echo $count2;
?></td>
                    </tr>
<?php
$table = $prefix . 'logs';
$date3 = date("F Y");
@$query3 = mysqli_query($connect, "SELECT id FROM `$table` WHERE date LIKE '% $date3'");
@$count3 = mysqli_num_rows($query3);
?>
					<tr>
                      <td>This month</td>
                      <td><?php
echo $count3;
?></td>
                    </tr>
<?php
$table = $prefix . 'logs';
$date4 = date("Y");
@$query4 = mysqli_query($connect, "SELECT id FROM `$table` WHERE date LIKE '% $date4'");
@$count4 = mysqli_num_rows($query4);
?>
					<tr>
                      <td>This year</td>
                      <td><?php
echo $count4;
?></td>
                    </tr>
					<tr class="active">
                      <th><i class="fa fa-ban"></i> IP Bans</th>
                      <th>Value</th>
                    </tr>
<?php
$table = $prefix . 'bans';
@$query5 = mysqli_query($connect, "SELECT id FROM `$table`");
@$count5 = mysqli_num_rows($query5);
?>
                    <tr>
                      <td>Total</td>
                      <td><?php
echo $count5;
?></td>
                    </tr>
<?php
$table = $prefix . 'bans';
$date6 = date("d F Y");
@$query6 = mysqli_query($connect, "SELECT id FROM `$table` WHERE date='$date6'");
@$count6 = mysqli_num_rows($query6);
?>
                    <tr>
                      <td>Today</td>
                      <td><?php
echo $count6;
?></td>
                    </tr>
<?php
$table = $prefix . 'bans';
$date7 = date("F Y");
@$query7 = mysqli_query($connect, "SELECT id FROM `$table` WHERE date LIKE '% $date7'");
@$count7 = mysqli_num_rows($query7);
?>
					<tr>
                      <td>This month</td>
                      <td><?php
echo $count7;
?></td>
                    </tr>
<?php
$table = $prefix . 'bans';
$date8 = date("Y");
@$query8 = mysqli_query($connect, "SELECT id FROM `$table` WHERE date LIKE '% $date8'");
@$count8 = mysqli_num_rows($query8);
?>
					<tr>
                      <td>This year</td>
                      <td><?php
echo $count8;
?></td>
                    </tr>
                  </table>
            			        </div>
            			    </div>
						</div>
				    </div>
                    
                    <div class="box">
						<div class="box-header">
								<h3 class="box-title">Threat Map</h3>
						</div>
						<div class="box-body">
					        <div class="col-md-12">
                                <div id="regions_div"></div>
                            </div>
                        </div>
                    </div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<?php
$year = date('Y');

$date1  = "January $year";
$date2  = "February $year";
$date3  = "March $year";
$date4  = "April $year";
$date5  = "May $year";
$date6  = "June $year";
$date7  = "July $year";
$date8  = "August $year";
$date9  = "September $year";
$date10 = "October $year";
$date11 = "November $year";
$date12 = "December $year";

$table = $prefix . 'logs';

$squery1  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date1' AND type='SQLi'");
$scount1  = mysqli_num_rows($squery1);
$squery2  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date2' AND type='SQLi'");
$scount2  = mysqli_num_rows($squery2);
$squery3  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date3' AND type='SQLi'");
$scount3  = mysqli_num_rows($squery3);
$squery4  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date4' AND type='SQLi'");
$scount4  = mysqli_num_rows($squery4);
$squery5  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date5' AND type='SQLi'");
$scount5  = mysqli_num_rows($squery5);
$squery6  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date6' AND type='SQLi'");
$scount6  = mysqli_num_rows($squery6);
$squery7  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date7' AND type='SQLi'");
$scount7  = mysqli_num_rows($squery7);
$squery8  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date8' AND type='SQLi'");
$scount8  = mysqli_num_rows($squery8);
$squery9  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date9' AND type='SQLi'");
$scount9  = mysqli_num_rows($squery9);
$squery10 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date10' AND type='SQLi'");
$scount10 = mysqli_num_rows($squery10);
$squery11 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date11' AND type='SQLi'");
$scount11 = mysqli_num_rows($squery11);
$squery12 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date12' AND type='SQLi'");
$scount12 = mysqli_num_rows($squery12);

$mrquery1  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date1' AND type='Mass Requests'");
$mrcount1  = mysqli_num_rows($mrquery1);
$mrquery2  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date2' AND type='Mass Requests'");
$mrcount2  = mysqli_num_rows($mrquery2);
$mrquery3  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date3' AND type='Mass Requests'");
$mrcount3  = mysqli_num_rows($mrquery3);
$mrquery4  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date4' AND type='Mass Requests'");
$mrcount4  = mysqli_num_rows($mrquery4);
$mrquery5  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date5' AND type='Mass Requests'");
$mrcount5  = mysqli_num_rows($mrquery5);
$mrquery6  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date6' AND type='Mass Requests'");
$mrcount6  = mysqli_num_rows($mrquery6);
$mrquery7  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date7' AND type='Mass Requests'");
$mrcount7  = mysqli_num_rows($mrquery7);
$mrquery8  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date8' AND type='Mass Requests'");
$mrcount8  = mysqli_num_rows($mrquery8);
$mrquery9  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date9' AND type='Mass Requests'");
$mrcount9  = mysqli_num_rows($mrquery9);
$mrquery10 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date10' AND type='Mass Requests'");
$mrcount10 = mysqli_num_rows($mrquery10);
$mrquery11 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date11' AND type='Mass Requests'");
$mrcount11 = mysqli_num_rows($mrquery11);
$mrquery12 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date12' AND type='Mass Requests'");
$mrcount12 = mysqli_num_rows($mrquery12);

$pquery1  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date1' AND type='Proxy'");
$pcount1  = mysqli_num_rows($pquery1);
$pquery2  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date2' AND type='Proxy'");
$pcount2  = mysqli_num_rows($pquery2);
$pquery3  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date3' AND type='Proxy'");
$pcount3  = mysqli_num_rows($pquery3);
$pquery4  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date4' AND type='Proxy'");
$pcount4  = mysqli_num_rows($pquery4);
$pquery5  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date5' AND type='Proxy'");
$pcount5  = mysqli_num_rows($pquery5);
$pquery6  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date6' AND type='Proxy'");
$pcount6  = mysqli_num_rows($pquery6);
$pquery7  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date7' AND type='Proxy'");
$pcount7  = mysqli_num_rows($pquery7);
$pquery8  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date8' AND type='Proxy'");
$pcount8  = mysqli_num_rows($pquery8);
$pquery9  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date9' AND type='Proxy'");
$pcount9  = mysqli_num_rows($pquery9);
$pquery10 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date10' AND type='Proxy'");
$pcount10 = mysqli_num_rows($pquery10);
$pquery11 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date11' AND type='Proxy'");
$pcount11 = mysqli_num_rows($pquery11);
$pquery12 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date12' AND type='Proxy'");
$pcount12 = mysqli_num_rows($pquery12);

$spquery1  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date1' AND type='Spammer'");
$spcount1  = mysqli_num_rows($spquery1);
$spquery2  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date2' AND type='Spammer'");
$spcount2  = mysqli_num_rows($spquery2);
$spquery3  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date3' AND type='Spammer'");
$spcount3  = mysqli_num_rows($spquery3);
$spquery4  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date4' AND type='Spammer'");
$spcount4  = mysqli_num_rows($spquery4);
$spquery5  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date5' AND type='Spammer'");
$spcount5  = mysqli_num_rows($spquery5);
$spquery6  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date6' AND type='Spammer'");
$spcount6  = mysqli_num_rows($spquery6);
$spquery7  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date7' AND type='Spammer'");
$spcount7  = mysqli_num_rows($spquery7);
$spquery8  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date8' AND type='Spammer'");
$spcount8  = mysqli_num_rows($spquery8);
$spquery9  = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date9' AND type='Spammer'");
$spcount9  = mysqli_num_rows($spquery9);
$spquery10 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date10' AND type='Spammer'");
$spcount10 = mysqli_num_rows($spquery10);
$spquery11 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date11' AND type='Spammer'");
$spcount11 = mysqli_num_rows($spquery11);
$spquery12 = mysqli_query($connect, "SELECT * FROM $table WHERE date LIKE '%$date12' AND type='Spammer'");
$spcount12 = mysqli_num_rows($spquery12);
?>
<script>
$(window).on('load', function() {
    
    Morris.Area({
    element: 'log-stats',
    data: [
      {period: '<?php
echo date("Y");
?>-01', sqli: <?php
echo $scount1;
?>, massrequests: <?php
echo $mrcount1;
?>, proxies: <?php
echo $pcount1;
?>, spammers: <?php
echo $spcount1;
?>},
      {period: '<?php
echo date("Y");
?>-02', sqli: <?php
echo $scount2;
?>, massrequests: <?php
echo $mrcount2;
?>, proxies: <?php
echo $pcount2;
?>, spammers: <?php
echo $spcount2;
?>},
      {period: '<?php
echo date("Y");
?>-03', sqli: <?php
echo $scount3;
?>, massrequests: <?php
echo $mrcount3;
?>, proxies: <?php
echo $pcount3;
?>, spammers: <?php
echo $spcount3;
?>},
      {period: '<?php
echo date("Y");
?>-04', sqli: <?php
echo $scount4;
?>, massrequests: <?php
echo $mrcount4;
?>, proxies: <?php
echo $pcount4;
?>, spammers: <?php
echo $spcount4;
?>},
      {period: '<?php
echo date("Y");
?>-05', sqli: <?php
echo $scount5;
?>, massrequests: <?php
echo $mrcount5;
?>, proxies: <?php
echo $pcount5;
?>, spammers: <?php
echo $spcount5;
?>},
      {period: '<?php
echo date("Y");
?>-06', sqli: <?php
echo $scount6;
?>, massrequests: <?php
echo $mrcount6;
?>, proxies: <?php
echo $pcount6;
?>, spammers: <?php
echo $spcount6;
?>},
      {period: '<?php
echo date("Y");
?>-07', sqli: <?php
echo $scount7;
?>, massrequests: <?php
echo $mrcount7;
?>, proxies: <?php
echo $pcount7;
?>, spammers: <?php
echo $spcount7;
?>},
      {period: '<?php
echo date("Y");
?>-08', sqli: <?php
echo $scount8;
?>, massrequests: <?php
echo $mrcount8;
?>, proxies: <?php
echo $pcount8;
?>, spammers: <?php
echo $spcount8;
?>},
      {period: '<?php
echo date("Y");
?>-09', sqli: <?php
echo $scount9;
?>, massrequests: <?php
echo $mrcount9;
?>, proxies: <?php
echo $pcount9;
?>, spammers: <?php
echo $spcount9;
?>},
      {period: '<?php
echo date("Y");
?>-10', sqli: <?php
echo $scount10;
?>, massrequests: <?php
echo $mrcount10;
?>, proxies: <?php
echo $pcount10;
?>, spammers: <?php
echo $spcount10;
?>},
      {period: '<?php
echo date("Y");
?>-11', sqli: <?php
echo $scount11;
?>, massrequests: <?php
echo $mrcount11;
?>, proxies: <?php
echo $pcount11;
?>, spammers: <?php
echo $spcount11;
?>},
      {period: '<?php
echo date("Y");
?>-12', sqli: <?php
echo $scount12;
?>, massrequests: <?php
echo $mrcount12;
?>, proxies: <?php
echo $pcount12;
?>, spammers: <?php
echo $spcount12;
?>}
    ],
    xkey: 'period',
    xLabelFormat: function (x) {
        var IndexToMonth = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
        var month = IndexToMonth[ x.getMonth() ];
        var year = x.getFullYear();
        return month + ' ' + year;
    },
    dateFormat: function (x) {
        var IndexToMonth = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
        var month = IndexToMonth[ new Date(x).getMonth() ];
        var year = new Date(x).getFullYear();
        return month + ' ' + year;
    },
    ykeys: ['sqli', 'massrequests', 'proxies', 'spammers'],
    labels: ['SQLi Attacks', 'Mass Requests', 'Proxies', 'Spammers'],
    pointSize: 5,
	lineColors: ['#3c8dbc', '#dd4b39', '#00a65a', '#f39c12'],
    hideHover: 'auto'
  });

});
</script>
    
<script type="text/javascript">
      google.charts.load('current', {'packages':['geochart']});
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Country', 'Threats'],
<?php
$countries = array(
    "Afghanistan",
    "Albania",
    "Algeria",
    "Andorra",
    "Angola",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Brazil",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Colombi",
    "Comoros",
    "Congo (Brazzaville)",
    "Congo",
    "Costa Rica",
    "Cote d\'Ivoire",
    "Croatia",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "East Timor (Timor Timur)",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Fiji",
    "Finland",
    "France",
    "Gabon",
    "Gambia, The",
    "Georgia",
    "Germany",
    "Ghana",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macedonia",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia and Montenegro",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City",
    "Venezuela",
    "Vietnam",
    "Yemen",
    "Zambia",
    "Zimbabwe"
);


foreach ($countries as $country) {
    $log_result = mysqli_query($connect, "SELECT * FROM `$table` WHERE country = '$country'");
    $log_rows   = mysqli_num_rows($log_result);
    
    echo "['$country', $log_rows]";
    if ($country !== "Zimbabwe") {
        echo ',';
    }
}
?>
        ]);

        var options = {
            colorAxis: {colors: ['red']},
        };
        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
        chart.draw(data, options);
      }
</script>
<?php
footer();
?>