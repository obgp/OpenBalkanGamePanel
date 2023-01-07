<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css?v2">
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
		<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700,900" rel="stylesheet"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>



<script type="text/javascript">

	setTimeout(function() {

		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";

	}, 5000);

</script>

		<div class="container">
		<div class="logo hidden-xs">
	<a href="/">
		<img class="img-responsive" style="width:20%;" src="<?php echo logolink(); ?>">
	</a>
</div>
			<div class="rows">
				<nav class="navbar navbar-default">
  					<div class="container">
  						<div class="rows">
    						<div class="navbar-header">
      							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        							<span class="sr-only">Toggle navigation</span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
      							</button>
      							<a class="navbar-brand visible-xs" href="/"><?php echo site_name(); ?></a>
    						</div>
    						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      							<ul class="nav navbar-nav">
        							<li><a href="home"><i class="fa fa-home"></i> Home</a></li>
        							<li><a href="servers"><i class="fa fa-server"></i> Servers</a></li>
        							<li><a href="billing"><i class="fa fa-shopping-cart"></i> Billing</a></li>
        							<li><a href="support"><i class="fa fa-support"></i> Support</a></li>
        							<li><a href="settings"><i class="fa fa-user"></i> Account</a></li>
        							<li><a href="logout"><i class="fa fa-sign-out"></i> Logout</a></li>
      							</ul>
      							<ul class="nav navbar-nav navbar-right">
      							</ul>
    						</div>
  						</div>
  					</div>
				</nav>
			</div>
		</div>
