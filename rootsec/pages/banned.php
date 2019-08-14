<?php
include "header.php";
$table = $prefix . 'pages-layolt';
$query = mysqli_query($connect, "SELECT * FROM `$table` WHERE page='Banned'");
$row   = mysqli_fetch_assoc($query);
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
                    <p style="font-size: 50px;">
<span class="fa-stack fa-lg">
  <i class="fa fa-user fa-stack-1x"></i>
  <i class="fa fa-ban fa-stack-2x text-danger"></i>
</span></p>
<?php
//Getting the Real IP Address
function get_realip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'Unknown';
    return $ipaddress;
}

$ip          = get_realip();
$table2      = $prefix . 'bans';
$querybanned = mysqli_query($connect, "SELECT * FROM `$table2` WHERE ip='$ip'");
$banned      = mysqli_num_rows($querybanned);
$row         = mysqli_fetch_array($querybanned);
$reason      = $row['reason'];
$redirect    = $row['redirect'];
$url         = $row['url'];
if ($banned > "0") {
    echo '<p>Reason: <strong>' . $reason . '</strong></p>';
}
if ($redirect == "Yes") {
    echo '<br /><center>You will be redirected</center><br />
<meta http-equiv="refresh" content="4;url=' . $url . '">';
}
?>
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