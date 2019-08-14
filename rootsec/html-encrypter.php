<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-code"></i> HTML Encrypter</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">HTML Encrypter</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-9">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">HTML Encrypter</h3>
						</div>
						<div class="box-body">
                              <form method="post" class="form-horizontal form-bordered">
                                  <?php
@$_SESSION['htmltext-session'] = $_POST['htmltext'];
?>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="htmltext" rows="10" type="text" required><?php
echo $_SESSION['htmltext-session'];
?></textarea>
                                        
<?php
if (isset($_POST['encrypt'])) {
    
    $htmltext = $_POST['htmltext'];
    $a        = "";
    $b        = "";
    for ($i = 0; $i < strlen($htmltext); $i++) {
        $a = (string) dechex(ord($htmltext[$i]));
        switch (strlen($a)) {
            case 1:
                $b .= "\\u000" . $a;
                break;
            case 2:
                $b .= "\\u00" . $a;
                break;
            case 3:
                $b .= "\\u0" . $a;
                break;
            case 4:
                $b .= "\\u" . $a;
                break;
            default:
        }
    }
    $encrypted = "
<script type=\"text/javascript\">
<!-- HTML Encryption provided by Project SECURITY -->
<!--
document.write('{$b}')
//-->
</script>
";
    
    echo '<br /><br />
<strong>Encrypted HTML Code:</strong>
<textarea class="form-control" name="htmltext-encrypted" rows="10" type="text" readonly>' . $encrypted . '</textarea>
</script>
';
    
}
?>     
                                    </div>
                                    <div class="col-md-4">
                                    <p>
                                        <ol>
                                        <li>Insert your HTML code you want to encrypt.
                                        <li>Click <strong>Encrypt</strong> and copy and paste the <strong>Encrypted HTML Code</strong> to your website.</li>
                                        </ol>
                                    </p>
                                    </div>
                                    
                                    
                        </div>
                        <div class="panel-footer">
				              <input class="btn btn-flat btn-primary" type="submit" name="encrypt" value="Encrypt">
                              <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                        </form>
                     </div>
                </div>
                    
				<div class="col-md-3">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Information & Tips</h3>
						</div>
				        <div class="box-body">
				              <strong>HTML Encryption</strong> means you can convert your web page contents to a non-easily understandable format. This may protect your code from being stolen by others upto great extent. The one limitation of it is that your page will be seen on JavaScript enabled browsers only.
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

<?php
footer();
?>