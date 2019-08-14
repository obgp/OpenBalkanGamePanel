<?php
require("core.php");
head();

if (isset($_GET['delete-all'])) {
    $table = $prefix . 'bans';
    $query = mysqli_query($connect, "TRUNCATE TABLE `$table`");
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'bans';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-user"></i> IP Bans</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">IP Bans</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">
				
<?php
if (isset($_POST['ban-ip'])) {
    $table = $prefix . "bans";
    
    $ip       = addslashes(htmlspecialchars($_POST['ip']));
    $date     = date("d F Y");
    $time     = date("H:i");
    $reason   = addslashes(htmlspecialchars($_POST['reason']));
    $redirect = $_POST['redirect'];
    $url      = addslashes(htmlspecialchars($_POST['url']));
    
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo '<br />
		<div class="callout callout-danger">
                <p><i class="fa fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
    } else if ($redirect == 'Yes' and $url == NULL) {
        echo '<br />
		<div class="callout callout-danger">
                <p><i class="fa fa-exclamation-triangle"></i> Please enter a link to which will be redirected the banned user.</p>
        </div>
		';
    } else {
        $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
        $validator  = mysqli_num_rows($queryvalid);
        if ($validator > "0") {
            echo '<br />
		<div class="callout callout-info">
                <p><i class="fa fa-info-circle"></i> This <strong>IP Address</strong> is already banned.</p>
        </div>
		';
        } else {
            $query = mysqli_query($connect, "INSERT INTO `$table` (`ip`, `date`, `time`, `reason`, `redirect`, `url`) VALUES ('$ip', '$date', '$time', '$reason', '$redirect', '$url')");
        }
    }
}
?>
                    
                <div class="row">
                    
				<div class="col-md-9">
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'bans';
    
    if (isset($_POST['edit-ban'])) {
        $ip       = $_POST['ip'];
        $redirect = $_POST['redirect'];
        $url      = $_POST['url'];
        $reason   = $_POST['reason'];
        
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            echo '<br />
		<div class="callout callout-danger">
                <p><i class="fa fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
        } else if ($redirect == 'Yes' and $url == NULL) {
            echo '<br />
		<div class="callout callout-danger">
                <p><i class="fa fa-exclamation-triangle"></i> Please enter a link to which will be redirected the banned user.</p>
        </div>
		';
        } else {
            $update = mysqli_query($connect, "UPDATE `$table` SET ip='$ip', redirect='$redirect', url='$url', reason='$reason' WHERE id='$id'");
        }
    }
    
    $result = mysqli_query($connect, "SELECT * FROM `$table` WHERE id = '$id'");
    $row    = mysqli_fetch_assoc($result);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=bans-ip.php">';
        exit();
    }
    if (mysqli_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=bans-ip.php">';
        exit();
    }
?>         
<form class="form-horizontal" action="" method="post">
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Edit - IP Address Ban #<?php
    echo $id;
?></h3>
						</div>
						<div class="box-body">
										<div class="form-group">
											<label class="col-sm-2 control-label">IP Address: </label>
											<div class="col-sm-10">
												<input name="ip" class="form-control" type="text" value="<?php
    echo $row['ip'];
?>" required>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Reason: </label>
											<div class="col-sm-10">
												<input name="reason" class="form-control" type="text" value="<?php
    echo $row['reason'];
?>">
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Redirecting to page / site: </label>
											<div class="col-sm-10">
	<select name="redirect" class="form-control" required>
        <option value="No" <?php
    if ($row['redirect'] == 'No') {
        echo 'selected';
    }
?>>No</option>
        <option value="Yes" <?php
    if ($row['redirect'] == 'Yes') {
        echo 'selected';
    }
?>>Yes</option>
    </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Redirect URL: </label>
											<div class="col-sm-10">
												<input name="url" class="form-control" type="url" value="<?php
    echo $row['url'];
?>">
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Banned On: </label>
											<div class="col-sm-10">
												<input name="date" class="form-control" type="text" value="<?php
    echo $row['date'];
?>" readonly>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Banned At: </label>
											<div class="col-sm-10">
												<input name="time" class="form-control" type="text" value="<?php
    echo $row['time'];
?>" readonly>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">AutoBanned: </label>
											<div class="col-sm-10">
												<input name="autoban" class="form-control" type="text" value="<?php
    echo $row['autoban'];
?>" readonly>
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-success" name="edit-ban" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                     </div>
				</form>
<?php
}
?>
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Ban IP Address</h3>
						</div>
						<div class="box-body">
						
						<center><a href="?delete-all" class="btn btn-flat btn-danger" title="Delete all IP Bans"><i class="fa fa-trash-o"></i> Delete All</a></center>
						
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
$table = $prefix . 'bans';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
						                    <td>' . $row['ip'] . '</td>
										    <td>' . $row['date'] . '</td>
										    <td>' . $row['redirect'] . '</td>
										    <td>' . $row['autoban'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fa fa-trash"></i> Unban</a>
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
                   
<?php
@$ip = $_GET['ip'];
@$reason = $_GET['reason'];
@$url = $_POST['url'];
if (empty($ip)) {
    @$ip = $_POST['ip'];
} else {
    $ip;
}
if (empty($reason)) {
    @$reason = $_POST['reason'];
} else {
    $reason;
}
?>

<form class="form-horizontal" action="" method="post">
				<div class="col-md-3">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Ban IP Address</h3>
						</div>
				        <div class="box-body">
										<div class="form-group">
											<label class="col-sm-4 control-label">IP Address: </label>
											<div class="col-sm-8">
												<input name="ip" class="form-control" type="text" value="<?php
echo $ip;
?>" required>
											</div>
										</div><br />
                                        <div class="form-group">
											<label class="col-sm-4 control-label">Reason: </label>
											<div class="col-sm-8">
												<input name="reason" class="form-control" type="text" value="<?php
echo $reason;
?>">
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-4 control-label">Redirecting to page / site: </label>
											<div class="col-sm-8">
	<select name="redirect" class="form-control" required>
        <option value="No" selected>No</option>
        <option value="Yes">Yes</option>
    </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-4 control-label">Redirect URL: </label>
											<div class="col-sm-8">
												<input name="url" class="form-control" type="url" value="<?php
echo $url;
?>">
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-danger" name="ban-ip" type="submit">Ban</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
				</div>
</form>
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