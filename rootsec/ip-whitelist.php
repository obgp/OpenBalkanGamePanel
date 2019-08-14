<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'ip-whitelist';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-flag-o"></i> IP Whitelist</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">IP Whitelist</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
if (isset($_POST['add'])) {
    $table = $prefix . 'ip-whitelist';
    $ip    = addslashes(htmlspecialchars($_POST['ip']));
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo '<br />
		<div class="callout callout-danger">
                <p><i class="fa fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
    } else {
        $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
        $validator  = mysqli_num_rows($queryvalid);
        if ($validator > "0") {
            echo '<br />
		<div class="callout callout-info">
                <p><i class="fa fa-info-circle"></i> This <strong>IP Address</strong> is already whitelisted.</p>
        </div>
		';
        } else {
            $query = mysqli_query($connect, "INSERT INTO `$table` (ip) VALUES('$ip')");
        }
    }
}
?>
                    
                <div class="row">
				<div class="col-md-9">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">IP Whitelist</h3>
						</div>
						<div class="box-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>IP Address</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'ip-whitelist';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
                                            <td>' . $row['ip'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    
				<div class="col-md-3">
<form class="form-horizontal" action="" method="post">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Add IP Address</h3>
						</div>
				        <div class="box-body">
								<div class="form-group">
											<label class="col-sm-4 control-label">IP Address: </label>
											<div class="col-sm-8">
												<input type="text" name="ip" class="form-control" required>
											</div>
								</div>	
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-primary" name="add" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'ip-whitelist';
    $sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE id = '$id'");
    $row   = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=ip-whitelist.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=ip-whitelist.php">';
    }
?>
<form class="form-horizontal" action="" method="post">
                     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Edit IP Address</h3>
						</div>
				        <div class="box-body">
								<div class="form-group">
											<label class="col-sm-4 control-label">IP Address: </label>
											<div class="col-sm-8">
												<input type="text" name="ip" class="form-control" value="<?php
    echo $row['ip'];
?>" required>
											</div>
								</div>	
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
				            <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
    if (isset($_POST['edit'])) {
        $table = $prefix . 'ip-whitelist';
        $ip    = addslashes(htmlspecialchars($_POST['ip']));
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            echo '<br />
		<div class="callout callout-danger">
                <p><i class="fa fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
        } else {
            $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
            $validator  = mysqli_num_rows($queryvalid);
            if ($validator > "0") {
                echo '<br />
		<div class="callout callout-info">
                <p><i class="fa fa-info-circle"></i> This <strong>IP Address</strong> is already whitelisted.</p>
        </div>
		';
            } else {
                $query = mysqli_query($connect, "UPDATE `$table` SET ip='$ip' WHERE id='$id'");
                echo '<meta http-equiv="refresh" content="0;url=ip-whitelist.php">';
            }
        }
    }
    
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