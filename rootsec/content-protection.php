<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'content-protection';
    
    if (isset($_POST['rightclick-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['rightclick-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['rightclick-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=1");
    
    if (isset($_POST['rightclick_images-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['rightclick_images-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['rightclick_images-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=2");
    
    if (isset($_POST['cut-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['cut-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['cut-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=3");
    
    if (isset($_POST['copy-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['copy-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['copy-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=4");
    
    if (isset($_POST['paste-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['paste-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['paste-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=5");
    
    if (isset($_POST['drag-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    $update = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled' WHERE id=6");
    
    if (isset($_POST['drop-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    $update = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled' WHERE id=7");
    
    if (isset($_POST['printscreen-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['printscreen-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['printscreen-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=8");
    
    if (isset($_POST['print-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['print-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['print-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=9");
    
    if (isset($_POST['view_source-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['view_source-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['view_source-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=10");
    
    if (isset($_POST['offline_mode-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['offline_mode-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['offline_mode-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=11");
    
    if (isset($_POST['iframe_out-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    $update = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled' WHERE id=12");
    
    if (isset($_POST['exit_confirmation-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    if (isset($_POST['exit_confirmation-alert'])) {
        $alert = 'Yes';
    } else {
        $alert = 'No';
    }
    $message = $_POST['exit_confirmation-message'];
    $update  = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=13");
    
    if (isset($_POST['selecting-enabled'])) {
        $enabled = 'Yes';
    } else {
        $enabled = 'No';
    }
    $update = mysqli_query($connect, "UPDATE `$table` SET enabled='$enabled' WHERE id=14");
	
	if (isset($_POST['jquery_include'])) {
        $jquery_include = 'Yes';
    } else {
        $jquery_include = 'No';
    }
    
	$table2 = $prefix . 'settings';
    $query2 = mysqli_query($connect, "UPDATE `$table2` SET jquery_include='$jquery_include' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-file-text"></i> Content Protection</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Content Protection</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-12">
				
				<form action="" method="post" class="form-horizontal form-bordered">
<?php
$table = $prefix . 'settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
?>

<div class="well col-md-12">
<div class="form-group ">
												<label class="control-label col-md-1">jQuery Include</label>
												<div class="col-md-1">
                                                    <div class="switch switch-success">
                                                        <div class="switch switch-sm switch-success">
														      <input type="checkbox" name="jquery_include" id="ios-switch333" <?php
if ($row['jquery_include'] == 'Yes') {
    echo 'checked="checked" checked';
}
?> />
												        </div>
												    </div>
												</div>
												<div class="col-md-10">
												    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Enable</strong> this option if your website does not have a jquery file included
												    <br />|
												</div>
											</div>
</div>

								<button type="button submit" name="save" class="mb-xs mt-xs mr-xs btn btn-flat btn-success btn-lg btn-block"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Save</button><br />
			
<?php
$i     = 0;
$table = $prefix . 'content-protection';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($row = mysqli_fetch_assoc($query)) {
    ++$i;
    if ($i == 1) {
        echo '<div class="row">';
    }
?>
								<div class="col-md-4">
								    <div class="box box-solid box-primary">
								         <div class="box-header">
                                              <h3 class="box-title">
<?php
    if ($row['function'] == "rightclick") {
        echo '<i class="fa fa-mouse-pointer"></i> Right Click - Context Menu';
    } elseif ($row['function'] == "rightclick_images") {
        echo '<i class="fa fa-hand-pointer-o"></i> Right Click - Context Menu on Images';
    } elseif ($row['function'] == "cut") {
        echo '<i class="fa fa-scissors"></i> Cut';
    } elseif ($row['function'] == "copy") {
        echo '<i class="fa fa-files-o"></i> Copy';
    } elseif ($row['function'] == "paste") {
        echo '<i class="fa fa-clipboard"></i> Paste';
    } elseif ($row['function'] == "drag") {
        echo '<i class="fa fa-arrows"></i> Drag';
    } elseif ($row['function'] == "drop") {
        echo '<i class="fa fa-plus-square-o"></i> Drop';
    } elseif ($row['function'] == "printscreen") {
        echo '<i class="fa fa-desktop"></i> PrintScreen Button';
    } elseif ($row['function'] == "print") {
        echo '<i class="fa fa-print"></i> Print';
    } elseif ($row['function'] == "view_source") {
        echo '<i class="fa fa-code"></i> View Source Code';
    } elseif ($row['function'] == "offline_mode") {
        echo '<i class="fa fa-times-circle"></i> Offline Use of the Website';
    } elseif ($row['function'] == "iframe_out") {
        echo '<i class="fa fa-object-group"></i> Website shows in Frames (Iframe)';
    } elseif ($row['function'] == "exit_confirmation") {
        echo '<i class="fa fa-sign-out"></i> Confirmation on Exit';
    } elseif ($row['function'] == "selecting") {
        echo '<i class="fa fa-arrows-h"></i> Selecting';
    }
?>
                                       </h3>
                                    </div>
									<div class="box-body">
										<p class="text-center">
<?php
    if ($row['function'] == "rightclick") {
        echo 'Prevent the default right menu from popping up.';
    } elseif ($row['function'] == "rightclick_images") {
        echo 'Prevent people being able to download your images.';
    } elseif ($row['function'] == "cut") {
        echo 'Disable the Cut option to prevent Copying information from your site';
    } elseif ($row['function'] == "copy") {
        echo 'Disable the Copy option to prevent Copying information from your site';
    } elseif ($row['function'] == "paste") {
        echo 'Disable the Paste option to prevent Pasting information on your site';
    } elseif ($row['function'] == "drag") {
        echo 'Prevent Dragging information and objects on your site';
    } elseif ($row['function'] == "drop") {
        echo 'Prevent Dropping information and objects on your site';
    } elseif ($row['function'] == "printscreen") {
        echo 'Prevent users to not take screenshots of their screen';
    } elseif ($row['function'] == "print") {
        echo 'Prevent the user from printing pages from your website';
    } elseif ($row['function'] == "view_source") {
        echo 'If you don\'t want users to view the code of your webpage disable the View Source Option';
    } elseif ($row['function'] == "offline_mode") {
        echo 'This option will prevent users to use downloaded pages of your website in offline mode';
    } elseif ($row['function'] == "iframe_out") {
        echo 'You can disable it to ensure that your page never gets loaded into someone else\'s frame';
    } elseif ($row['function'] == "exit_confirmation") {
        echo 'Shows confirmation dialog before user leaving the page';
    } elseif ($row['function'] == "selecting") {
        echo 'Prevent selection on your website.';
    }
?>
										</p>
									    <hr>
										<div class="form-group">
												<label class="control-label col-md-3">Activated</label>
												<div class="col-md-9">
                                                    <div class="switch switch-sm switch-success">
														<input type="checkbox" name="<?php
    echo $row['function'];
?>-enabled" id="ios-switch<?php
    echo $row['id'];
?>" <?php
    if ($row['enabled'] == 'Yes') {
        echo 'checked="checked"';
    }
?>/>
												    </div>
												</div>
									    </div>
										<div class="form-group">
												<label class="control-label col-md-3">Alert</label>
												<div class="col-md-9">
                                                    <div class="switch switch-sm switch-success">
														<input type="checkbox" name="<?php
    echo $row['function'];
?>-alert" id="ios-switch2<?php
    echo $row['id'];
?>" <?php
    if ($row['alert'] == 'Yes') {
        echo 'checked="checked"';
    }
?>
<?php
    if ($row['function'] == 'drag' OR $row['function'] == 'drop' OR $row['function'] == 'iframe_out' OR $row['function'] == 'selecting') {
        echo 'disabled="disabled"';
    }
?>/>
												    </div>
												</div>
									    </div>
										<div class="form-group">
												<label class="control-label col-md-3">Alert Message</label>
													<div class="col-md-6">
													<input type="text" name="<?php
    echo $row['function'];
?>-message" value="<?php
    echo $row['message'];
?>" class="form-control input-rounded" id="inputRounded" 
													<?php
    if ($row['function'] == 'drag' OR $row['function'] == 'drop' OR $row['function'] == 'iframe_out' OR $row['function'] == 'selecting') {
        echo 'disabled';
    }
?>>
												</div>
									    </div>
									</div>
								</div>
							    </div>
<?php
    if ($i == 14) {
        echo '</div>';
    } else if (($i % 3) == 0) {
        echo '</div><div class="row">';
    }
}
?>
                                
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
<?php
$table = $prefix . 'content-protection';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($row = mysqli_fetch_assoc($query)) {
    echo 'new Switchery(document.getElementById("ios-switch' . $row['id'] . '"), { size: "large" });';
    echo 'new Switchery(document.getElementById("ios-switch2' . $row['id'] . '"), { size: "large" });';
}
echo 'new Switchery(document.getElementById("ios-switch333"), { size: "large" });';
?>
});
</script>
<?php
footer();
?>