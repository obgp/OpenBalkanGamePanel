<?php
include "header.php";
$table = $prefix . 'pages-layolt';
$query = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Spam'");
$row   = mysqli_fetch_array($query);
?>
	  <div class="page-header">
        <div class="row">
          <div class="col-lg-12">
            <div class="bs-example">
              <div class="jumbotron">
                <center>
				<div class="well" style="background-color: #d9534f; color: white;">
                    <h3><?php
echo $row['text'];
?></h3>
                </div>
                    <p style="font-size: 30px;"><i class="fa fa-keyboard-o fa-4x"></i></p>
                <h4>Please contact with the webmaster of the website if you think something is wrong.</h4>
                <h4>To check in which Spam Database (DNSBL) you attend click the button below:</h4><br />
                <a href="https://www.dnsbl.info/dnsbl-database-check.php" type="button" class="btn btn-primary btn-md btn-block" target="_blank">Check</a>
				</center>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php
include "footer.php";
?>