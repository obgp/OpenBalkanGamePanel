<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'bans-other';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-desktop"></i> Other Bans</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Other Bans</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">
                    
<?php
if (isset($_POST['block'])) {
    $table = $prefix . "bans-other";
    $value = addslashes($_POST['value']);
    $type  = $_POST['type'];
    
    $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE value='$value' and type='$type' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
        echo '<br />
		<div class="callout callout-info">
                <p><i class="fa fa-info-circle"></i> There is already such record in the database.</p>
        </div>
    ';
    } else {
        $table = $prefix . "bans-other";
        $query = mysqli_query($connect, "INSERT INTO `$table` (value, type) VALUES('$value', '$type')");
    }
}
?>
                    
                <div class="row">
                   
<form class="form-horizontal" action="" method="post">
				<div class="col-md-6">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Ban Browser, OS or ISP</h3>
						</div>
				        <div class="box-body">
										<div class="form-group">
											<label class="col-sm-2 control-label">Browser, OS or ISP Name: </label>
											<div class="col-sm-10">
												<input name="value" class="form-control" type="text" required>
											</div>
										</div><br />
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Type: </label>
											<div class="col-sm-10">
	<select name="type" class="form-control" required>
        <option value="browser" selected>Browser</option>
        <option value="os">Operating System</option>
        <option value="isp">Internet Service Provider</option>
    </select>
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-danger" name="block" type="submit">Block</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
				</div>
</form>
                    
                    <div class="col-md-6">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Blocked <strong>Internet Service Providers</strong></h3>
						</div>
				        <div class="box-body">
<table id="dt-basic3" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
						                  <th><i class="fa fa-globe"></i> Browser</th>
										  <th><i class="fa fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'bans-other';
$query = mysqli_query($connect, "SELECT * FROM `$table` WHERE type='isp'");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
						                    <td>' . $row['value'] . '</td>
											<td>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fa fa-unlock"></i> Unblock</a>
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
                    
                <div class="row">
				<div class="col-md-6">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Blocked <strong>Browsers</strong></h3>
						</div>
						<div class="box-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
						                  <th><i class="fa fa-globe"></i> Browser</th>
										  <th><i class="fa fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'bans-other';
$query = mysqli_query($connect, "SELECT * FROM `$table` WHERE type='browser'");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
						                    <td>' . $row['value'] . '</td>
											<td>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fa fa-unlock"></i> Unblock</a>
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
                    
				<div class="col-md-6">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Blocked <strong>Operating Systems</strong></h3>
						</div>
				        <div class="box-body">
<table id="dt-basic2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
						                  <th><i class="fa fa-globe"></i> Browser</th>
										  <th><i class="fa fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'bans-other';
$query = mysqli_query($connect, "SELECT * FROM `$table` WHERE type='os'");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
						                    <td>' . $row['value'] . '</td>
											<td>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fa fa-unlock"></i> Unblock</a>
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
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			}
		}
	} );
    
    $('#dt-basic2').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			}
		}
	} );
    
    $('#dt-basic3').dataTable( {
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