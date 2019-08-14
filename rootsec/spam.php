<?php
require("core.php");
head();

if (isset($_POST['add-database'])) {
    $table      = $prefix . 'dnsbl-databases';
    $database   = $_POST['database'];
    $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE `database`='$database' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
    } else {
        $query = mysqli_query($connect, "INSERT INTO `$table` (`database`) VALUES ('$database')");
    }
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'dnsbl-databases';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'spam-settings';
    
    if (isset($_POST['protection'])) {
        $protection = 'Yes';
    } else {
        $protection = 'No';
    }
    
    if (isset($_POST['logging'])) {
        $logging = 'Yes';
    } else {
        $logging = 'No';
    }
    
    if (isset($_POST['autoban'])) {
        $autoban = 'Yes';
    } else {
        $autoban = 'No';
    }
    
    if (isset($_POST['mail'])) {
        $mail = 'Yes';
    } else {
        $mail = 'No';
    }
    
    $redirect = $_POST['redirect'];
    
    $query = mysqli_query($connect, "UPDATE `$table` SET protection='$protection', logging='$logging', autoban='$autoban', mail='$mail', redirect='$redirect' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-keyboard-o"></i> Security Module</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Security Module</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-8">
                    	    
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
if ($row['protection'] == 'Yes') {
    echo '
              <div class="box box-solid box-success">
';
} else {
    echo '
              <div class="box box-solid box-danger">
';
}
?>
						<div class="box-header">
							<h3 class="box-title">Spam - Security Module</h3>
						</div>
						<div class="box-body jumbotron">
<?php
if ($row['protection'] == 'Yes') {
    echo '
        <h1 style="color: #47A447;"><i class="fa fa-check-circle-o"></i> Enabled</h1>
        <p>The website is protected from <strong>Spammers</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fa fa-times-circle-o"></i> Disabled</h1>
        <p>The website is not protected from <strong>Spammers</strong></p>
';
}
?>
                        </div>
                    </div>
                    
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Spam Databases (DNSBL)</h3>
						</div>
						<div class="box-body">

                                    <center><button data-target="#add" data-toggle="modal" class="btn btn-flat btn-primary btn-lg"><i class="fa fa-plus-circle"></i> Add Spam Database (DNSBL)</button></center>
                                    
<form class="form-horizontal mb-lg" method="POST">
    <div class="modal fade" id="add" role="dialog" tabindex="-1" aria-labelledby="add" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
										  <!--Modal header-->
										  <div class="modal-header">
										  <button data-dismiss="modal" class="close" type="button">
										  <span aria-hidden="true">&times;</span>
										  </button>
										  <h4 class="modal-title">Add Spam Database (DNSBL)</h4>
										  </div>
                                            
											<div class="box-body">
												<div class="form-group">
                                                        <label class="col-sm-3 control-label">Spam Database (DNSBL):</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" name="database" required/>
														</div>
												</div>
											</div>
								            <!--Modal footer-->
				                            <div class="modal-footer">
												<div class="row">
													<div class="col-md-8 text-left">
									                    <input class="btn btn-flat btn-primary" name="add-database" type="submit" value="Add">
													</div> 
                                                    <div class="col-md-4 text-right">
														<button data-dismiss="modal" class="btn btn-flat btn-default" type="button">Close</button>
													</div>
												</div>
											</div>
										
									</div>
        </div>
    </div>
                                    </form>
                                    
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>DNSBL Database</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'dnsbl-databases';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($rowd = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
                                            <td>' . $rowd['database'] . '</td>
											<td>
                                            <a href="?delete-id=' . $rowd['id'] . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    
                <div class="col-md-4">
                     <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">What is Spam & DNSBL</h3>
							</div>
							<div class="box-body">
                                <strong>Electronic Spamming</strong> is the use of electronic messaging systems to send unsolicited messages (spam), especially advertising, as well as sending messages repeatedly on the same site.
                                <br /><br />
                                A <strong>DNS-based Blackhole List (DNSBL)</strong> or <strong>Real-time Blackhole List (RBL)</strong> is a list of IP addresses which are most often used to publish the addresses of computers or networks linked to spamming.<br /><br />
                                    
                                All <strong>Blacklists</strong> can be found here: <strong><a href="https://www.dnsbl.info/dnsbl-list.php" target="_blank">https://www.dnsbl.info/dnsbl-list.php</a></strong>
                        	</div>
                     </div>
                     <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">Module Settings</h3>
							</div>
							<div class="box-body">
									<ul class="list-group bg-trans">
<form class="form-horizontal form-bordered" action="" method="post">
										<li class="list-group-item">
											<div class="pull-right">
												<div class="switch switch-sm switch-success">
														<input type="checkbox" name="protection" id="ios-switch" <?php
if ($row['protection'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
												</div>
											</div>
											<p>Protection</p>
											<small class="text-muted">If the security module is enabled all attacks of this type will be blocked</small>
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<div class="switch switch-sm switch-success">
														<input type="checkbox" name="logging" id="ios-switch2" <?php
if ($row['logging'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
												</div>
											</div>
											<p>Logging</p>
											<small class="text-muted">Logging every attack of this type</small>
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<div class="switch switch-sm switch-success">
														<input type="checkbox" name="autoban" id="ios-switch3" <?php
if ($row['autoban'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
												</div>
											</div>
											<p>AutoBan </p>
											<small class="text-muted">Automatically ban anyone who has done this type of attack</small>
										</li>
                                        <li class="list-group-item">
											<div class="pull-right">
												<div class="switch switch-sm switch-success">
														<input type="checkbox" name="mail" id="ios-switch4" <?php
if ($row['mail'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
												</div>
											</div>
											<p>Mail Notifications </p>
											<small class="text-muted">You will receive email notification when someone has done an attack of this type</small>
										</li>
                                        <li class="list-group-item">
											<p>Redirect URL </p>
											<input name="redirect" class="form-control" type="text" value="<?php
echo $row['redirect'];
?>" required>
										</li>
									</ul>
                        	</div>
                            <div class="panel-footer">
                                <button class="btn btn-flat btn-block btn-primary mar-top" name="save" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
                            </div>
</form>
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
    
    new Switchery(document.getElementById('ios-switch'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch2'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch3'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch4'), { size: 'large' });
} );
</script>
<?php
footer();
?>