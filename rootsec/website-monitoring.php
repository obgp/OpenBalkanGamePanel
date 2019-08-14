<?php
require("core.php");
head();

function isUp($domain)
{
    if (!filter_var($domain, FILTER_VALIDATE_URL)) {
        return false;
    }
    
    $curlInit = curl_init($domain);
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($curlInit);
    
    curl_close($curlInit);
    
    if ($response)
        return true;
    
    return false;
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'monitoring';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-desktop"></i> Websites's Security Monitoring</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Website Monitoring</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
if (isset($_POST['add-domain'])) {
    $table = $prefix . "monitoring";
    
    $domain = addslashes(htmlspecialchars($_POST['domain']));
    $url    = addslashes(htmlspecialchars($_POST['url']));
    
    $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE domain='$domain' OR url='$url' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
        echo '<br />
		<div class="callout callout-info">
                <p><i class="fa fa-info-circle"></i> This <strong>Website / Domain</strong> is already added.</p>
        </div>
		';
    } else {
        $query = mysqli_query($connect, "INSERT INTO `$table` (`domain`, `url`) VALUES ('$domain', '$url')");
    }
}
?>
                    
                <div class="row">
                    
				<div class="col-md-9">
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'monitoring';
    
    if (isset($_POST['edit-domain'])) {
        $domain = addslashes(htmlspecialchars($_POST['domain']));
        $url    = addslashes(htmlspecialchars($_POST['url']));
        
        $update = mysqli_query($connect, "UPDATE `$table` SET domain='$domain', url='$url' WHERE id='$id'");
    }
    
    $result = mysqli_query($connect, "SELECT * FROM `$table` WHERE id = '$id'");
    $row    = mysqli_fetch_assoc($result);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=website-monitoring.php">';
        exit();
    }
    if (mysqli_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=website-monitoring.php">';
        exit();
    }
?>         
<form class="form-horizontal" action="" method="post">
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Edit - <?php
    echo $row['domain'];
?></h3>
						</div>
						<div class="box-body">
										<div class="form-group">
											<label class="col-sm-2 control-label">Website: </label>
											<div class="col-sm-10">
												<input name="domain" class="form-control" type="text" value="<?php
    echo $row['domain'];
?>" required>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Project SECURITY Address: </label>
											<div class="col-sm-10">
												<input name="url" class="form-control" type="url" value="<?php
    echo $row['url'];
?>">
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-success" name="edit-domain" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                     </div>
				</form>
<?php
}
?>
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Monitored Websites / Domains</h3>
						</div>
						<div class="box-body">
<table id="dt-basic" class="table table-strdomained table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										  <th><i class="fa fa-list-ul"></i> ID</th>
						                  <th><i class="fa fa-server"></i> Website</th>
                                          <th><i class="fa fa-status"></i> Online</th>
										  <th><i class="fa fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'monitoring';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
						                    <td>' . $row['domain'] . '</td>
                                            <td>';
    if (isUp($row['url'])) {
        echo '<span class="label label-success">Yes</span>';
    } else {
        echo '<span class="label label-danger">No</span>';
    }
    echo '</td>
											<td>
                                            <a href="?view-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fa fa-eye"></i> View / Manage</a>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i> Delete</a>
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

<form class="form-horizontal" action="" method="post">
				<div class="col-md-3">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Add Website / Domain</h3>
						</div>
				        <div class="box-body">
										<div class="form-group">
											<label class="col-sm-4 control-label">Website: </label>
											<div class="col-sm-8">
												<input name="domain" class="form-control" type="text" placeholder="Name" required>
											</div>
										</div><br />
                                        <div class="form-group">
											<label class="col-sm-4 control-label">Project SECURITY Address: </label>
											<div class="col-sm-8">
												<input name="url" class="form-control" type="url" placeholder="website.com/security" required>
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-primary" name="add-domain" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
				</div>
</form>
                    
                <div class="col-md-12">
<?php
if (isset($_GET['view-id'])) {
    $id    = (int) $_GET["view-id"];
    $table = $prefix . 'monitoring';
    
    $result = mysqli_query($connect, "SELECT * FROM `$table` WHERE id = '$id'");
    $row    = mysqli_fetch_assoc($result);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=website-monitoring.php">';
        exit();
    }
    if (mysqli_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=website-monitoring.php">';
        exit();
    }
?>         
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Viewing & Management - <?php
    echo $row['url'];
?></h3>
						</div>
						<div class="box-body">
                             <center><iframe src="<?php
    echo $row['url'];
?>" width="97%" height="700px"></iframe></center>
                        </div>
                        <div class="panel-footer">
							<a href="website-monitoring.php" class="btn btn-flat btn-success" name="edit-domain" type="submit"><i class="fa fa-sign-out"></i>
 Exit</a>
				        </div>
                     </div>
<?php
}
?>
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