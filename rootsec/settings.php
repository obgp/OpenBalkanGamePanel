<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'settings';
    
    $email = $_POST['email'];
    
    if (isset($_POST['realtime_protection'])) {
        $realtime_protection = 'Yes';
    } else {
        $realtime_protection = 'No';
    }
    
    if (isset($_POST['mail_notifications'])) {
        $mail_notifications = 'Yes';
    } else {
        $mail_notifications = 'No';
    }
	
	if (isset($_POST['ip_detection'])) {
        $ip_detection = 2;
    } else {
        $ip_detection = 1;
    }
	
	if (isset($_POST['fixed_layout'])) {
        $fixed_layout = 'Yes';
    } else {
        $fixed_layout = 'No';
    }
	
	if (isset($_POST['boxed_layout'])) {
        $boxed_layout = 'Yes';
    } else {
        $boxed_layout = 'No';
    }
	
	if (isset($_POST['sidebar_collapsed'])) {
        $sidebar_collapsed = 'Yes';
    } else {
        $sidebar_collapsed = 'No';
    }
	
	if (isset($_POST['sidebar_hover'])) {
        $sidebar_hover = 'Yes';
    } else {
        $sidebar_hover = 'No';
    }
    
    $query = mysqli_query($connect, "UPDATE `$table` SET email='$email', realtime_protection='$realtime_protection', mail_notifications='$mail_notifications', ip_detection='$ip_detection', fixed_layout='$fixed_layout', boxed_layout='$boxed_layout', sidebar_collapsed='$sidebar_collapsed', sidebar_hover='$sidebar_hover' WHERE id=1");

	echo '<meta http-equiv="refresh" content="0; url=settings.php" />';
	
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-cogs"></i> Settings</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Settings</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
                    
				<div class="col-md-12">
<form class="form-horizontal" method="post">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-cog"></i> Settings</h3>
						</div>
						<div class="box-body">
<?php
$table = $prefix . 'settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
?>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">E-Mail Address:</label>
												<div class="col-md-6">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="email" class="form-control" name="email" value="<?php
echo $row['email'];
?>" required>
                                                    </div>
                                                    The E-Mail address will be used for some of the functions in the script.
												</div>
											</div><hr>
                                            <div class="form-group">
												<label class="control-label col-md-3">RealTime Protection</label>
												<div class="col-md-9">
													<div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="realtime_protection" id="ios-switch" <?php
if ($row['realtime_protection'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div> With this module you can <strong>Enable</strong> or <strong>Disable</strong> the whole script.<br />
												    </div>
                                                </div>
                                            </div><hr>
                                            <div class="form-group">
												<label class="control-label col-md-3">Mail Notifications</label>
												<div class="col-md-9">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="mail_notifications" id="ios-switch2" <?php
if ($row['mail_notifications'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div> If this is <strong>Enabled</strong> you will receive notifications on your E-Mail Address<br />
												    </div>
												</div>
											</div><hr>
											<div class="form-group">
												<label class="control-label col-md-3">IP Detection</label>
												<div class="col-md-9">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="ip_detection" id="ios-switch3" <?php
if ($row['ip_detection'] == 2) {
    echo 'checked="checked" checked';
}
?> />
												        </div> 
														(<b>Basic</b> / <b>Advanced</b>)<br /><br />
														
														Basic IP Detection is used by default. Faster performance but low accuracy.<br />
														If this is <strong>Enabled</strong> will be used Advanced IP Detection. High detection accuracy but slower performance<br />
												    </div>
												</div>
											</div><hr>
											
											<br /><h4 class="box-title"><i class="fa fa-desktop"></i> Interface Options</h4>
											
											<div class="form-group">
												<label class="control-label col-md-3">Fixed Layout</label>
												<div class="col-md-9">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="fixed_layout" id="ios-switch4" <?php
if ($row['fixed_layout'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div> Activates the fixed layout. Fixed and boxed layouts can't work together<br />
												    </div>
												</div>
											</div><hr>
											<div class="form-group">
												<label class="control-label col-md-3">Boxed Layout</label>
												<div class="col-md-9">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="boxed_layout" id="ios-switch5" <?php
if ($row['boxed_layout'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div> Activates the boxed layout<br />
												    </div>
												</div>
											</div><hr>
											<div class="form-group">
												<label class="control-label col-md-3">Collapsed sidebar</label>
												<div class="col-md-9">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="sidebar_collapsed" id="ios-switch6" <?php
if ($row['sidebar_collapsed'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div> Activates the compact sidebar navigation<br />
												    </div>
												</div>
											</div><hr>
											<div class="form-group">
												<label class="control-label col-md-3">Sidebar Expand on Hover</label>
												<div class="col-md-9">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="sidebar_hover" id="ios-switch7" <?php
if ($row['sidebar_hover'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div> Lets the sidebar navigation expand on hover<br />
												    </div>
												</div>
											</div>
                        </div>
                        <div class="panel-footer text-left">
							<button class="btn btn-flat btn-primary" name="save" type="submit">Save</button>
				            <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                     </div>
</form>
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
    new Switchery(document.getElementById('ios-switch'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch2'), { size: 'large' });
	new Switchery(document.getElementById('ios-switch3'), { size: 'large' });
	new Switchery(document.getElementById('ios-switch4'), { size: 'large' });
	new Switchery(document.getElementById('ios-switch5'), { size: 'large' });
	new Switchery(document.getElementById('ios-switch6'), { size: 'large' });
	new Switchery(document.getElementById('ios-switch7'), { size: 'large' });
});
</script>    
<?php
footer();
?>