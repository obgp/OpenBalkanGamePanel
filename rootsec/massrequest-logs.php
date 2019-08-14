<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'logs';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}

if (isset($_GET['delete-all'])) {
    $table = $prefix . 'logs';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE type='Mass Requests'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-retweet"></i> Mass Request Logs</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Mass Request Logs</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-12">
                    
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Mass Request Logs</h3>
						</div>
						<div class="box-body">

                                    <center><a href="?delete-all" class="btn btn-flat btn-flat btn-danger" title="Delete all logs"><i class="fa fa-trash-o"></i> Delete All</a></center>
                                    
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
$table = $prefix . 'logs';
$sql   = mysqli_query($connect, "SELECT id, ip, date, browser, browser_code, os, os_code, country, country_code, type FROM `$table` WHERE type='Mass Requests' ORDER by id DESC");
while ($row = mysqli_fetch_assoc($sql)) {
    echo '
										<tr>
                                          <td>' . $row['id'] . '</td>
						                  <td>' . $row['ip'] . '</td>
						                  <td>' . $row['date'] . '</td>
										  <td><img src="assets/img/icons/browser/' . $row['browser_code'] . '.png" /> ' . $row['browser'] . '</td>
										  <td><img src="assets/img/icons/os/' . $row['os_code'] . '.png" /> ' . $row['os'] . '</td>
										  <td><img src="assets/plugins/flags/blank.png" class="flag flag-' . strtolower($row['country_code']) . '" alt="' . $row['country'] . '" /> ' . $row['country'] . '</td>
						                  <td><i class="fa fa-retweet"></i> Mass Requests</td>
										  <td>
                                            <a href="log-details.php?id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-primary"><i class="fa fa-tasks"></i> Details</a>
											';
    if (get_banned($row['ip']) == 'Yes') {
        echo '
										    <a href="bans-ip.php?delete-id=' . get_bannedid($row['ip']) . '" class="btn btn-flat btn-flat btn-success"><i class="fa fa-ban"></i> Unban</a>
									        ';
    } else {
        echo '
										    <a href="bans-ip.php?ip=' . $row['ip'] . '&reason=' . $row['type'] . '" class="btn btn-flat btn-flat btn-warning"><i class="fa fa-ban"></i> Ban</a>
									        ';
    }
    echo '
											<a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-danger"><i class="fa fa-times"></i> Delete</a>
										  </td>
										</tr>
';
}
?>
									</tbody>
								    </table>

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
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
        "order": [[ 0, "desc" ]],
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