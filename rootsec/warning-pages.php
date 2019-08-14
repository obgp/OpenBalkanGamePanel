<?php
require("core.php");
head();

if (isset($_POST['update'])) {
    $text  = addslashes(htmlentities($_POST['text']));
    
    $text2  = addslashes(htmlentities($_POST['text2']));
    
    $text3  = addslashes(htmlentities($_POST['text3']));
    
    $text4  = addslashes(htmlentities($_POST['text4']));
    
    $text5  = addslashes(htmlentities($_POST['text5']));
    
    $text6  = addslashes(htmlentities($_POST['text6']));
    
    $text7  = addslashes(htmlentities($_POST['text7']));
    
    $text8  = addslashes(htmlentities($_POST['text8']));
    
    $text9  = addslashes(htmlentities($_POST['text9']));
    
    $text10  = addslashes(htmlentities($_POST['text10']));
    
    $text11  = addslashes(htmlentities($_POST['text11']));
    
    $text12  = addslashes(htmlentities($_POST['text12']));
	
	$text13  = addslashes(htmlentities($_POST['text13']));
    
    $table         = $prefix . 'pages-layolt';
    $update_banned = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text' 
WHERE page='Banned'");
    
    $update_blocked = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text2' 
WHERE page='Blocked'");
    
    $update_massrequests = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text3' 
WHERE page='Mass_Requests'");
    
    $update_proxy = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text4' 
WHERE page='Proxy'");
    
    $update_spam = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text5' 
WHERE page='Spam'");
    
    $update_bannedc = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text6' 
WHERE page='Banned_Country'");
    
    $update_blockedbr = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text7' 
WHERE page='Blocked_Browser'");
    
    $update_blockedos = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text8' 
WHERE page='Blocked_OS'");
    
    $update_blockedisp = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text9' 
WHERE page='Blocked_ISP'");
    
    $update_badbot = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text10' 
WHERE page='Bad_Bot'");
    
    $update_fakebot = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text11' 
WHERE page='Fake_Bot'");
    
    $update_tor = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text12' 
WHERE page='Tor'");

    $update_adblocker = mysqli_query($connect, "UPDATE `$table` SET 
`text` = '$text13' 
WHERE page='AdBLocker'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-file-text-o"></i> Warning Pages</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Warning Pages</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<form action="" method="post">
                         <div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#sqli-layout">SQL Injection</a>
									</li>
									<li>
										<a data-toggle="tab" href="#massrequests-layout">Mass Requests</a>
									</li>
									<li>
										<a data-toggle="tab" href="#proxy-layout">Proxy</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#spam-layout">Spam</a>
									</li>
									<li>
										<a data-toggle="tab" href="#banned-layout">Banned</a>
									</li>
									<li>
										<a data-toggle="tab" href="#bannedc-layout">Banned Countries</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#bannedbr-layout">Blocked Browsers</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#bannedos-layout">Blocked OS</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#bannedisp-layout">Blocked ISP</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#badbot-layout">Bad Bot</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#fakebot-layout">Fake Bot</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#tor-layout">Tor</a>
									</li>
									<li>
										<a data-toggle="tab" href="#adblocker-layout">AdBlocker</a>
									</li>
								</ul>
					
								<!--Tabs Content-->
								<div class="tab-content">
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Blocked'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="sqli-layout" class="tab-pane fade active in">
<fieldset>
	        <center>	  
            <label>Page Text:</label>
	        <textarea name="text2" class="form-control" rows="5" type="text" required><?php
echo html_entity_decode($row['text']);
?></textarea>
			</center>
</fieldset>
									</div>

<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Mass_Requests'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="massrequests-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text3" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>

<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Proxy'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="proxy-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text4" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
	        </center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Spam'");
$row   = mysqli_fetch_assoc($sql);
?>
                                    <div id="spam-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text5" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
	        </center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Banned'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="banned-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Banned_Country'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedc-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text6" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Blocked_Browser'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedbr-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text7" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Blocked_OS'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedos-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text8" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Blocked_ISP'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedisp-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text9" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Bad_Bot'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="badbot-layout" class="tab-pane fade">
<fieldset>
	        <center>	  
            <label>Page Text:</label>
	        <textarea name="text10" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Fake_Bot'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="fakebot-layout" class="tab-pane fade">
<fieldset>
	        <center>	  
            <label>Page Text:</label>
	        <textarea name="text11" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Tor'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="tor-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text12" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
									
<?php
$table = $prefix . 'pages-layolt';
$sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='AdBlocker'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="adblocker-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text13" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>

								</div>
							</div>
    
<input type="submit" class="btn btn-flat btn-success btn-lg btn-block" name="update" value="Save" />
<button type="reset" class="btn btn-flat btn-default btn-lg btn-block">Reset</button>
</form>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
    
<?php
footer();
?>