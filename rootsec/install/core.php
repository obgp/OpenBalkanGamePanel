<?php
@session_start();

include_once "settings.inc.php";
include_once "functions.inc.php";
include_once "languages.inc.php";

if (file_exists(CONFIG_FILE_PATH)) {
    echo '<meta http-equiv="refresh" content="0; url=../" />';
    exit;
}

function head()
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project SECURITY - <?php
    echo lang_key("installation_wizard");
?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="../assets/css/admin.min.css" media="screen">
    <link type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <br /><center><h2><i class="fa fa-get-pocket"></i> Project SECURITY - <?php
    echo lang_key("installation_wizard");
?></h2></center><br />
                    <div class="bs-example">
                        <div class="jumbotron">
<?php
}

function footer()
{
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php
}
?>