<?php
require("core.php");
head();

if (isset($_GET['ip'])) {
    $ip = $_GET["ip"];
    
    if (empty($ip)) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php">';
        exit();
    }
    
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php">';
        exit();
    }
    
    $url = 'http://extreme-ip-lookup.com/json/' . $ip;
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
        $country     = $ip_data->{'country'};
        $countrycode = $ip_data->{'countryCode'};
        $region      = $ip_data->{'region'};
        $city        = $ip_data->{'city'};
        $latitude    = $ip_data->{'lat'};
        $longitude   = $ip_data->{'lon'};
        $isp         = $ip_data->{'isp'};
    } else {
        $country     = "Unknown";
        $countrycode = "XX";
        $region      = "Unknown";
        $city        = "Unknown";
        $latitude    = "0";
        $longitude   = "0";
        $isp         = "Unknown";
    }
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-search"></i> IP Lookup</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">IP Lookup</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-12">
                    
                <div class="box box-primary">
						<div class="box-header">
                            <h3 class="box-title">IP Details - <?php
    echo $ip;
?></h3>
						</div>
						<div class="box-body">

						                <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fa fa-map"></i> Country
                                                    </label>
                                                    <div class="input-group mar-btm">
											            <span class="input-group-addon">
                                                            <img src="assets/plugins/flags/blank.png" class="flag flag-<?php
    echo strtolower($countrycode);
?>" alt="<?php
    echo $country;
?>" />
                                                        </span>
                                                        <input type="text" class="form-control" value="<?php
    echo $country;
?>" readonly>
                                                    </div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fa fa-map-pin"></i> Region
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $region;
?>" readonly>
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fa fa-map-o"></i> City
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $city;
?>" readonly>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fa fa-cloud"></i> Internet Service Provider
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $isp;
?>" readonly>
												</div>
											</div>
										</div>
										
								        <hr>

                                        <label class="control-label">
                                            <i class="fa fa-location-arrow"></i> Possible Location
                                        </label>
									    <center><div id="mapdiv" style="width: 99%; height:450px"></div></center>
						            
                        </div>
                </div>
				
				<div class="box box-primary">
						<div class="box-header">
                            <h3 class="box-title">Log Search</h3>
						</div>
						<div class="box-body">
<?php
    $table  = $prefix . 'logs';
    $result = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip = '$ip'");
    
    if (mysqli_num_rows($result) == 0) {
        echo '<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No results found for this IP Address</strong>
</div>';
    } else {
?>
                                <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
								          <th><i class="fa fa-list-ol"></i> ID</th>
						                  <th><i class="fa fa-user"></i> IP Address</th>
						                  <th><i class="fa fa-calendar-o"></i> Date</th>
										  <th><i class="fa fa-globe"></i> Browser</th>
										  <th><i class="fa fa-desktop"></i> OS</th>
										  <th><i class="fa fa-map"></i> Country</th>
						                  <th><i class="fa fa-bomb"></i> Type</th>
										  <th><i class="fa fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
										<tr>
                                          <td>' . $row['id'] . '</td>
						                  <td>' . $row['ip'] . '</td>
						                  <td>' . $row['date'] . '</td>
										  <td><img src="assets/img/icons/browser/' . $row['browser_code'] . '.png" /> ' . $row['browser'] . '</td>
										  <td><img src="assets/img/icons/os/' . $row['os_code'] . '.png" /> ' . $row['os'] . '</td>
										  <td><img src="assets/plugins/flags/blank.png" class="flag flag-' . strtolower($row['country_code']) . '" alt="' . $row['country'] . '" /> ' . $row['country'] . '</td>
						                  <td><i class="fa fa-user-secret"></i> ' . $row['type'] . '</td>
										  <td>
                                            <a href="log-details.php?id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fa fa-tasks"></i> Details</a>
											';
            if (get_banned($row['ip']) == 'Yes') {
                echo '
										    <a href="bans-ip.php?delete-id=' . get_bannedid($row['ip']) . '" class="btn btn-flat btn-success"><i class="fa fa-ban"></i> Unban</a>
									        ';
            } else {
                echo '
										    <a href="bans-ip.php?ip=' . $row['ip'] . '&reason=' . $row['type'] . '" class="btn btn-flat btn-warning"><i class="fa fa-ban"></i> Ban</a>
									        ';
            }
            echo '
											<a href="all-logs.php?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fa fa-times"></i> Delete</a>
										  </td>
										</tr>
';
        }
?>
									</tbody>
								</table>
<?php
    }
?>
						
                        </div>
                </div>	 
				
				<div class="box box-primary">
						<div class="box-header">
                            <h3 class="box-title">Ban Search</h3>
						</div>
						<div class="box-body">
<?php
    $table = $prefix . 'bans';
    $query = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip = '$ip'");
    
    if (mysqli_num_rows($query) == 0) {
        echo '<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No results found for this IP Address</strong>
</div>';
    } else {
?>
                                <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										  <th><i class="fa fa-list-ul"></i> ID</th>
						                  <th><i class="fa fa-user"></i> IP Address</th>
										  <th><i class="fa fa-calendar-o"></i> Banned On</th>
										  <th><i class="fa fa-share"></i> Redirect</th>
										  <th><i class="fa fa-magic"></i> Autobanned</th>
										  <th><i class="fa fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
        while ($row = mysqli_fetch_assoc($query)) {
            echo '
										<tr>
											<td>' . $row['id'] . '</td>
						                    <td>' . $row['ip'] . '</td>
										    <td>' . $row['date'] . '</td>
										    <td>' . $row['redirect'] . '</td>
										    <td>' . $row['autoban'] . '</td>
											<td>
                                            <a href="bans-ip.php?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="bans-ip.php?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fa fa-trash"></i> Unban</a>
											</td>
										</tr>
';
        }
?>
									</tbody>
								</table>
<?php
    }
?>
						
                        </div>
                </div>	

                </div>
                    
				</div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<script>
    map = new OpenLayers.Map("mapdiv");
    map.addLayer(new OpenLayers.Layer.OSM());

    var lonLat = new OpenLayers.LonLat(<?php
    echo $longitude;
?>,<?php
    echo $latitude;
?>)
          .transform(
            new OpenLayers.Projection("EPSG:4326"),
            map.getProjectionObject()
          );
          
    var zoom=18;
    var markers = new OpenLayers.Layer.Markers( "Markers" );
	
    map.addLayer(markers);
    markers.addMarker(new OpenLayers.Marker(lonLat));
    map.setCenter (lonLat, zoom);
</script>
<?php
    footer();
} else {
    echo '<meta http-equiv="refresh" content="0; url=dashboard.php">';
    exit();
}
?>