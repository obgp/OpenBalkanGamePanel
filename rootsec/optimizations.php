<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'optimization-settings';
    
    if (isset($_POST['htmlminify'])) {
        $htmlminify = 'Yes';
    } else {
        $htmlminify = 'No';
    }
    
    $query = mysqli_query($connect, "UPDATE `$table` SET `html-minify`='$htmlminify' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-rocket"></i> Website Optimizations</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Website Optimizations</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-9">
                    	    
<?php
$table = $prefix . 'optimization-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
if ($row['html-minify'] == 'Yes') {
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
							<h3 class="box-title">HTML Minify - Optimization Module</h3>
						</div>
						<div class="box-body jumbotron">
<?php
if ($row['html-minify'] == 'Yes') {
    echo '
        <h1 style="color: #47A447;"><i class="fa fa-check-circle-o"></i> Minified</h1>
        <p>The html code of your website is <strong>Compressed</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fa fa-times-circle-o"></i> Not Minified</h1>
        <p>The html code of your website is <strong>Not Compressed</strong></p>
';
}
?>
                        </div>
                        </div>
                    </div>
                    
<form class="form-horizontal form-bordered" action="" method="post">
                    <div class="col-md-3">
                        <div class="box">
                        	<div class="box-header">
								<h3 class="box-title">Settings</h3>
							</div>
							<div class="box-body">
                                      <div class="form-group">
											<label class="col-sm-4 control-label">HTML Minify: </label>
											<div class="col-sm-8">
<div class="switch switch-sm switch-success">
    <input type="checkbox" name="htmlminify" id="ios-switch" <?php
if ($row['html-minify'] == 'Yes') {
    echo 'checked="checked"';
}
?> />
</div>
											</div>
										</div>
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
} );
</script>
<?php
footer();
?>