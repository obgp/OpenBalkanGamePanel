<?php
require("core.php");
head();

if (isset($_POST['save2'])) {
    $table = $prefix . 'badbot-settings';
    
    if (isset($_POST['protection'])) {
        $protection = 'Yes';
    } else {
        $protection = 'No';
    }
    
    if (isset($_POST['protection2'])) {
        $protection2 = 'Yes';
    } else {
        $protection2 = 'No';
    }
    
    if (isset($_POST['protection3'])) {
        $protection3 = 'Yes';
    } else {
        $protection3 = 'No';
    }
    
    $query = mysqli_query($connect, "UPDATE `$table` SET protection='$protection', protection2='$protection2', protection3='$protection3' WHERE id=1");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'badbot-settings';
    
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
    
    $query = mysqli_query($connect, "UPDATE `$table` SET logging='$logging', autoban='$autoban', mail='$mail' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-user-secret"></i> Security Module</h1>
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
$table = $prefix . 'badbot-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
if ($row['protection'] == 'Yes' OR $row['protection2'] == 'Yes' OR $row['protection3'] == 'Yes') {
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
							<h3 class="box-title">Bad Bots - Security Module</h3>
						</div>
						<div class="box-body jumbotron">
<?php
if ($row['protection'] == 'Yes' OR $row['protection2'] == 'Yes' OR $row['protection3'] == 'Yes') {
    echo '
        <h1 style="color: #47A447;"><i class="fa fa-check-circle-o"></i> Enabled</h1>
        <p>The website is protected from <strong>Bad Bots</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fa fa-times-circle-o"></i> Disabled</h1>
        <p>The website is not protected from <strong>Bad Bots</strong></p>
';
}
?>
                        </div>
                    </div>
                    
<form class="form-horizontal form-bordered" action="" method="post">
                        <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">Protection Modules</h3>
							</div>
							<div class="box-body">
                        	    <div class="row">
                                    <div class="col-md-4">
                                        <div class="well">
                                        <center>
                                        <h4>Bad Bots</h4><br />
                                        Detects the <b>bad bots</b> and blocks their access to the website
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection" id="ios-switch" <?php
if ($row['protection'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="well">
                                        <center>
                                        <h4>Fake Bots</h4><br />
                                        Detects the <b>fake bots</b> and blocks their access to the website
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection2" id="ios-switch5" <?php
if ($row['protection2'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="well">
                                        <center>
                                        <h4>Anonymous Bots</h4><br />
                                        Detects the <b>anonymous bots</b> and blocks their access to the website<br />
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection3" id="ios-switch6" <?php
if ($row['protection3'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <center><button class="btn btn-flat btn-lg btn-block btn-primary mar-top" name="save2" type="submit"><i class="fa fa-floppy-o"></i> Save</button></center>
                                </div>
                        	</div>
                        </div>
                    
                    </form>
                    
                </div>
                    
                <div class="col-md-4">
                     <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">What is Bad Bot</h3>
							</div>
							<div class="box-body">
                                <strong>Bad</strong>, <strong>Fake</strong> and <strong>Anonymous Bots</strong> are bots that consume bandwidth, slow down your server, steal your content and look for vulnerability to compromise your server.
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
    new Switchery(document.getElementById('ios-switch5'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch6'), { size: 'large' });
} );
</script>
<?php
footer();
?>