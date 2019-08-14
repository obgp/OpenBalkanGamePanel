<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'adblocker-settings';
    
    if (isset($_POST['detection'])) {
        $detection = 'Yes';
    } else {
        $detection = 'No';
    }
    
    $redirect = $_POST['redirect'];
    
    $query = mysqli_query($connect, "UPDATE `$table` SET detection='$detection', redirect='$redirect' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-window-maximize"></i> Security Module</h1>
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
$table = $prefix . 'adblocker-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
if ($row['detection'] == 'Yes') {
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
							<h3 class="box-title">AdBlocker Detection - Security Module</h3>
						</div>
						<div class="box-body jumbotron">
<?php
if ($row['detection'] == 'Yes') {
    echo '
        <h1 style="color: #47A447;"><i class="fa fa-check-circle-o"></i> Enabled</h1>
        <p>Visitors with enabled <strong>AdBlockers</strong> are not allowed</p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fa fa-times-circle-o"></i> Disabled</h1>
        <p>Visitors with enabled <strong>AdBlockers</strong> are allowed</p>
';
}
?>
                            </div>
                        </div>
						
						
                        <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">What is AdBlocker</h3>
							</div>
							<div class="box-body">
                        	    <strong>AdBlocker</strong> is a piece of software that is designed to prevent advertisements from appearing on a web page.
                        	</div>
                        </div>
						
                    </div>
                    
                    <div class="col-md-4">
						
<form class="form-horizontal form-bordered" action="" method="post">
                        <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">Settings</h3>
							</div>
							<div class="box-body">
                                 <ul class="list-group bg-trans">
<form class="form-horizontal form-bordered" action="" method="post">
										<li class="list-group-item">
											<div class="pull-right">
												<div class="switch switch-sm switch-success">
														<input type="checkbox" name="detection" id="ios-switch" <?php
if ($row['detection'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
												</div>
											</div>
											<p>Detection</p>
											<small class="text-muted">If the security module is enabled all visits of this type will be blocked</small>
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
							    <button class="btn btn-flat btn-block btn-primary" name="save" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
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

    new Switchery(document.getElementById('ios-switch'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch2'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch3'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch4'), { size: 'large' });
} );
</script>
<?php
footer();
?>