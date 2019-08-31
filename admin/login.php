<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/core/inc/config.php');

if (is_login() == true) {
	redirect_to('home');
	die();
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo site_name(); ?> - Login</title>

	<link rel="stylesheet" type="text/css" href="/admin/assets/css/main.css?<?php echo time(); ?>">

	<!-- CSS Povezivanje -->
    <link href="/admin/assets/css/mobile.css?<?php echo time(); ?>" rel="stylesheet" media="all">
    <link href="/admin/assets/css/pages/signin.css?<?php echo time(); ?>" rel="stylesheet" media="all">
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
</head>
<body>
	<!-- Error script -->
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>

    <script type="text/javascript">
    	setTimeout(function() {
    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";
    	}, 5000);
    </script>

	<!-- header -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="index.php">
					<img src="/admin/assets/img/logo.png" alt="GB-Hoster.Me LOGO!"> 
				</a>
			</div>
		</div>
	</div>

	<!-- login -->
	<div class="account-container">
		<div class="content clearfix">
			<form action="/admin/process.php?a=login" method="POST">
				<h1>Admin Panel</h1>		
				<div class="login-fields">
					<p>Welcome to admin panel, please login</p>
					
					<div class="field">
						<label for="email">Username</label>
						<input type="text" id="email" name="email" value="" required="" placeholder="Username or Email" class="login username-field">
					</div>

					<div class="field">
						<label for="password">Password:</label>
						<input type="password" id="password" name="password" value="" required="" placeholder="Password" class="login password-field">
					</div>
				</div>

				<div class="login-actions">
					<span class="login-checkbox">
						<input id="Field" name="Field" type="checkbox" class="field login-checkbox" tabindex="4">
						<label class="choice" for="Field">Zapamti me</label>
					</span>

					<button class="button btn btn-success btn-large">LOGIN</button>
				</div>
			</form>
		</div>
	</div>

	<div class="go_down" style="position:fixed;bottom:0;left:0;right:0;">
		<!-- footer -->
		<div class="extra">
			<div class="extra-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
							<center>
								<img src="/admin/assets/img/gh_logo.png" alt="Gold Hosting LOGO!">
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="footer-inner">
				<div class="container">
					<div class="row">
						<div class="span12"> &copy; 2017 - <?php echo date('Y').' '.real_site_name(); ?>. Sva prava zadrzana. </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS / End -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/assets/php/java.php'); ?>
	
</body>
</html>