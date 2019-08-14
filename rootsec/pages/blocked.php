<?php
include "header.php";
$table = $prefix . 'pages-layolt';
$query = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Blocked'");
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
                    <p style="font-size: 30px;"><i class="fa fa-user-secret fa-4x"></i></p>
                <h4>Please contact with the webmaster of the website if you think something is wrong.</h4>
				</center>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php
include "footer.php";
?>