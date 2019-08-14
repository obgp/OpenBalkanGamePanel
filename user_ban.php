<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>You are banned!</title>

	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="/assets/css/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" media="all">

	<!-- CSS Povezivanje -->
	<link rel="stylesheet" type="text/css" href="/assets/css/ban/style.css?<?php echo time(); ?>">
    <link href="/assets/css/mobile.css?<?php echo time(); ?>" rel="stylesheet" media="all">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
</head>
<body onload="getTime()">
	<!-- Error script -->
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>

    <script type="text/javascript">
    	setTimeout(function() {
    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";
    	}, 5000);
    </script>

	<div class="container">
		
		<div id="showtime"></div>

		<div class="col-lg-4 col-lg-offset-4">
			<div class="lock-screen">
				<h2>
					<a data-toggle="modal" href="#un_ban">
						<i class="fa fa-lock"></i>
					</a>
				</h2>
				<p><strong> UNBAN </strong></p>
			
				<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="un_ban" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Request for unban</h4>
							</div>

							<div class="modal-body">
								<br />
								
								<p>To be redeemed, you need to enter the code that the administration sent you.</p>

								<br />
								
								<input id="unban_code" type="text" name="unban_code" required="" class="form-control" placeholder="Please write the code that was sent to you by the administration." maxlength="5">
							</div>

							<div class="modal-footer">
								<a data-dismiss="modal" class="btn btn-theme04">Cancel</a>
								<button class="btn btn-theme03" type="button" onclick="send_unban_code()">Send Code</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/ban/jquery.backstretch.min.js"></script>

    <script type="text/javascript">
    	$.backstretch("/assets/img/ban-bg.jpg", {speed: 500});

		function getTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();

            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('showtime').innerHTML = h + ":" + m + ":" + s;
            t = setTimeout(function() {
            	getTime()
            }, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

		function send_unban_code() {
			var unban_code = document.getElementById('unban_code').value;

			if (unban_code == "") {
				alert('Please enter the code sent by our administration.');
			} else {
				$.ajax({
		            type:'POST',
		            url:'/process.php?a=unban_with_the_code',
		            data:'unban_code=' + unban_code,
		            success: function() {
		            	setTimeout(function() {
		            		document.location = "/index.php";
		            	}, 300);
		            },
		            error: function() {
		            	alert('Please enter the code sent by our administration.');
		            }
		      	});
			}
		}
    </script>
</body>
</html>