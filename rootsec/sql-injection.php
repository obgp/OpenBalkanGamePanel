<?php
require("core.php");
head();

if (isset($_POST['save2'])) {
    $table = $prefix . 'sqli-settings';
    
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
    
    if (isset($_POST['protection4'])) {
        $protection4 = 'Yes';
    } else {
        $protection4 = 'No';
    }
    
    if (isset($_POST['protection5'])) {
        $protection5 = 'Yes';
    } else {
        $protection5 = 'No';
    }
    
    if (isset($_POST['protection6'])) {
        $protection6 = 'Yes';
    } else {
        $protection6 = 'No';
    }
    
    if (isset($_POST['protection7'])) {
        $protection7 = 'Yes';
    } else {
        $protection7 = 'No';
    }
	
	if (isset($_POST['protection8'])) {
        $protection8 = 'Yes';
    } else {
        $protection8 = 'No';
    }
    
    $query = mysqli_query($connect, "UPDATE `$table` SET protection2='$protection2', protection3='$protection3', protection4='$protection4', protection5='$protection5', protection5='$protection5', protection6='$protection6', protection7='$protection7', protection8='$protection8' WHERE id=1");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'sqli-settings';
    
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
    			  <h1><i class="fa fa-code"></i> Security Module</h1>
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
$table = $prefix . 'sqli-settings';
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
							<h3 class="box-title">SQL Injection - Security Module</h3>
						</div>
						<div class="box-body jumbotron">
<?php
if ($row['protection'] == 'Yes') {
    echo '
        <h1 style="color: #47A447;"><i class="fa fa-check-circle-o"></i> Enabled</h1>
        <p>The website is protected from <strong>SQL Injection Attacks (SQLi)</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fa fa-times-circle-o"></i> Disabled</h1>
        <p>The website is not protected from <strong>SQL Injection Attacks (SQLi)</strong></p>
';
}
?>
                        </div>
                    </div>
                    
                    <form class="form-horizontal form-bordered" action="" method="post">
                    
                        <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">Additional Security Modules</h3>
							</div>
							<div class="box-body">
                        	    <div class="row">
                                    <div class="col-md-4">
                                        <div class="well">
                                        <center>
                                        <h4>XSS Protection</h4><br />
                                        Sanitizes infected requests
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
                                        <h4>Clickjacking Protection</h4><br />
                                        Detecting and blocking clickjacking attempts
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
									<div class="col-md-4">
                                        <div class="well">
                                        <center>
                                        <h4>Hide PHP Information</h4><br />
                                        Hides the PHP version to remote requests
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection6" id="ios-switch9" <?php
if ($row['protection6'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="well">
                                        <center>
                                        <h4>MIME Mismatch Attacks Protection</h4><br />
                                        Prevents attacks based on MIME-type mismatch
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection4" id="ios-switch7" <?php
if ($row['protection4'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="well">
                                        <center>
                                        <h4>Secure connection</h4><br />
                                        Force the website to use secure connection
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection5" id="ios-switch8" <?php
if ($row['protection5'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="well">
                                        <center>
                                        <h4>Data Filtering</h4><br />
                                        Basic Sanitization of all fields, inputs, forms and requests. Low sensativity but faster performance.
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection7" id="ios-switch10" <?php
if ($row['protection7'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
									<div class="col-md-6">
                                        <div class="well">
                                        <center>
                                        <h4>Requests Sanitization</h4><br />
                                        Advanced Sanitization of all fields, inputs, forms and requests. High sensativity but slower performance.
                                        <br /><br /><br />
                                        <div class="switch switch-sm switch-success">
											<input type="checkbox" name="protection8" id="ios-switch11" <?php
if ($row['protection8'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <center><button class="btn btn-flat btn-lg btn-block btn-primary" name="save2" type="submit"><i class="fa fa-floppy-o"></i> Save</button></center>
                                </div>
                        	</div>
                        </div>
                    
                    </form>
                </div>
                    
                <div class="col-md-4">
                     <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">What is SQL Injection</h3>
							</div>
							<div class="box-body">
                                <strong>SQL Injection</strong> is a technique where malicious users can inject SQL commands into an SQL statement, via web page input. Injected SQL commands can alter SQL statement and compromise the security of a web application.
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
    
    new Switchery(document.getElementById('ios-switch5'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch6'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch7'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch8'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch9'), { size: 'large' });
    new Switchery(document.getElementById('ios-switch10'), { size: 'large' });
	new Switchery(document.getElementById('ios-switch11'), { size: 'large' });
} );
</script>
<?php
footer();
?>