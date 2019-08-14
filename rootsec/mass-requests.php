<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'massrequests-settings';
    
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
    			  <h1><i class="fa fa-retweet"></i> Security Module</h1>
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
$table = $prefix . 'massrequests-settings';
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
							<h3 class="box-title">Mass Requests - Security Module</h3>
						</div>
						<div class="box-body jumbotron">
<?php
if ($row['protection'] == 'Yes') {
    echo '
        <h1 style="color: #47A447;"><i class="fa fa-check-circle-o"></i> Enabled</h1>
        <p>The website is protected from <strong>Mass Request Attacks (Flood)</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fa fa-times-circle-o"></i> Disabled</h1>
        <p>The website is not protected from <strong>Mass Request Attacks (Flood)</strong></p>
';
}
?>
                        </div>
                    </div>
                
                <div class="callout callout-info media fade in">
                    <strong>It is not recommended use this module on normal working websites, because it could block some of the traffic of the site. Use it only when you think someone is flooding your site!</strong>
				</div>
                    
                </div>
                    
                <div class="col-md-4">
                     <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">What are Mass Requests</h3>
							</div>
							<div class="box-body">
                                <strong>Mass Requests</strong> are repeatedly recharge of website to make a lot of traffic and overloading of the site.
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
    
    new Switchery(document.getElementById('ios-switch'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch2'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch3'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch4'), { size: 'large' });
} );
</script>
<?php
footer();
?>