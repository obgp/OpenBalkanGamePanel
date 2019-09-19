<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo site_name(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/assets/css/style2.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap2.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-navbar.css">
	<link rel="stylesheet" type="text/css" href="/assets/fontawesome/css/all.css"> 
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"> 
	<script src="/assets/js/jquery-3.2.1.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/main.js"></script>
	<script>
		$(document).ready(function(){
  			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</head>
<body>
	<div id="gp_msg"> <?php echo eMSG(); ?> </div>



    <script type="text/javascript">

    	setTimeout(function() {

    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";

    	}, 5000);

    </script>
	<div class="container">
		<div class="rows">
			<div class="col-md-12">
			 <div class="space"></div>
<div class="logo hidden-xs">
	<a href="#">
		<img class="img-responsive" style="width:15%;" src="<?php echo logolink(); ?>">
	</a>
</div>
<div class="lang-flag">
	<a href="#"><img width="20" src="/assets/images/flags/rs.png"></a>
    <a href="#"><img width="20" src="/assets/images/flags/fr.png"></a>
	<a href="#"><img width="20" src="/assets/images/flags/us.png"></a>
</div>
<nav class="navbar" style="margin-top:10%">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand visible-xs" rel="home" href="#" title="Buy Sell Rent Everyting">
        <img style="margin-top: -7px;"
             src="<?php echo logolink(); ?>">
    	</a>
	</div>
	<div id="navbar" class="navbar-offcanvas" data-direction="left">
		<button type="button" class="hidden-sm hidden-md hidden-lg" data-toggle="offcanvas" data-target="#navbar">
			&#10005;
		</button>
		<ul class="nav navbar-nav">
			<img class="visible-xs text-center" style="text-align: center;display: inline-block;margin: 0 auto;" src="https://i.imgur.com/VdznoMT.png">
			<li><a href="/"><i class="fas fa-home"></i> Početna</a></li>
			<li><a href="/gp-home.php"><i class="fab fa-windows"></i> Game Panel</a></li>
			<li><a href="/order.php"><i class="fas fa-shopping-basket"></i> Naruči server</a></li>
            <li><a href="https://forum.gb-hoster.me"><i class="fas fa-comments-alt"></i> Forum</a></li>
			<li><a href="https://www.gametracker.xyz" target="_blank"><i class="fas fa-user-tie"></i> GameTracker</a></li>
			<li><a href="ts3server://esb.rs"><i class="fas fa-phone"></i> Kontakt</a></li>
		</ul>
		<?php if (is_login() == false) { ?>
		<ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt"></i> Uloguj se</a></li>
            <li><a href="#" data-toggle="modal" data-target="#register"><i class="fas fa-key"></i> Registruj se</a></li>
		</ul>
		<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/logout.php"><i class="fas fa-key"></i> Logout</a></li>
			</ul>
			<?php } ?>
	</div>
</nav>			</div>

			<!-- Slider -->
			<div class="col-md-12">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
      			<div class="carousel-inner">      
        			<div class="item active">
          				<img src="/assets/images/cs.jpg">
           				<div class="carousel-caption">
            				<h4><a href="#">Counter Strike 1.6</a></h4>
            				<p>Kaunter Strajk je popularna i kritički priznata serija igrica u obliku pucačine iz prvog lica. Kao jedna od prvih igrica svog tipa, originalni Kaunter Strajk je postavio pucanje iz prvog lica na poziciju najpopularnije platforme na svetu.</p>
          				</div>
        			</div><!-- End Item -->
         			<div class="item">
          				<img src="/assets/images/gta.jpg">
           				<div class="carousel-caption">
            				<h4><a href="#">GTA San Andreas MultiPlayer</a></h4>
            				<p>Verovatno nijedna igra ranije nije probudila toliko duhova kao GTA San Andreas, najnoviji nastavak proslavljenog serijala studija Rockstar Games.Prvo prijatno iznenađenje s kojim se suočavamo jeste veličina San Andreasa, megalopolisa koji se sastoji od tri grada raznovrsne arhitekture – pandan Los Anđelesu, San Francisko i Las Vegas.</p>
          				</div>
        			</div><!-- End Item -->       
        			<div class="item">
          				<img src="/assets/images/mc.jpg">
           				<div class="carousel-caption">
            				<h4><a href="#">Minecraft</a></h4>
            				<p>Minecraft igrica je odlična online verzija Minecraft igrice u kojoj imate slobodu da kopate i istražujete beskonačno veliki svet.</p>
          				</div>
        			</div><!-- End Item -->
        	
        			<div class="item">
          				<img src="/assets/images/ts3.jpg">
           				<div class="carousel-caption">
            				<h4><a href="#">Team Speak 3</a></h4>
            				<p>TeamSpeak 3 je vlasnicki softver za glasovne komunikacije (VoIP) koji korisnicima racunara omogucava da govore na kanalu za caskanje sa drugim korisnicima racunara, poput telefonskog poziva.</p>
          				</div>
        			</div><!-- End Item -->
	
        			<div class="item">
          				<img src="/assets/images/csgo.jpg">
           				<div class="carousel-caption">
            				<h4><a href="#">Counter Strike Global Offensive</a></h4>
            				<p>Slično predhodnoj Counter-Strike igri, igrači igraju kao teroristi ili antiteroristi i moraju da završavaju zadatke, dok pokušavaju da eliminišu protivnički tim. Igrači kupuju oružje i opremu na početku svake runde sa novcem koji je dodeljen na osnovu njihovog učinka. Ispunjeni ciljevi, kao što su, postavljanje bombe ili ubijanje neprijatelja igrču donose zaradu, ali negativni postupci, kao što su, pucanje u svog igrača ili taoca će dovesti do novčane kazne.
                            </p>
          				</div>
        			</div><!-- End Item -->              
      			</div><!-- End Carousel Inner -->
    			<ul class="list-group col-sm-4">
      				<li data-target="#myCarousel" data-slide-to="0" class="list-group-item active"><h4><img src="/assets/images/icons/game-cs.png"> Counter Strike 1.6</h4></li>
      				<li data-target="#myCarousel" data-slide-to="1" class="list-group-item"><h4><img src="/assets/images/icons/game-samp.png"> GTA San Andreas MultiPlayer</h4></li>
      				<li data-target="#myCarousel" data-slide-to="2" class="list-group-item"><h4><img src="/assets/images/icons/game-minecraft.png"> Minecraft</h4></li>
      				<li data-target="#myCarousel" data-slide-to="3" class="list-group-item"><h4><img src="/assets/images/icons/game-ts3.png"> Team Speak 3</h4></li>
      				<li data-target="#myCarousel" data-slide-to="4" class="list-group-item"><h4><img src="/assets/images/icons/game-csgo.png"> Counter Strike Global Offensive</h4></li>
    			</ul>
      			<!-- Controls -->
      			<div class="carousel-controls">
          			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
            			<i class="far fa-arrow-left"></i>
          			</a>
          			<a class="right carousel-control" href="#myCarousel" data-slide="next">
            			<i class="far fa-arrow-right"></i>
          			</a>
      			</div>
    		</div>
    		</div>

    		<!-- Games -->
    		<div class="col-md-3">
    			<div class="panel panel-game">
    				<div class="panel-heading">
                        <div class="img">
    					<img class="img-responsive" src="/assets/images/11.png"></div>
    					<div class="game-title">
    						<p>Counter Strike 1.6</p>
    					</div>
    				</div>
    				<div class="panel-body">
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>France</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>0.37€ / slots</span></p>
    					</div>
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>Germany</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>0.37€ / slots</span></p>
    					</div>
    				</div>
    				<div class="panel-footer">
    					<a href="order.php?igrica=cs16" class="btn btn-purple btn-block"><i class="far fa-shopping-cart"></i>  Naruči server</a>
    				</div>
    			</div>
    		</div>

    		<div class="col-md-3">
    			<div class="panel panel-game">
    				<div class="panel-heading">
    					<img class="img-responsive" src="/assets/images/game-6.png">
    					<div class="game-title">
    						<p>Counter Strike GO</p>
    					</div>
    				</div>
    				<div class="panel-body">
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>France</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>4.2€ / slots</span></p>
    					</div>
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>Germany</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>4.2€ / slots</span></p>
    					</div>
    				</div>
    				<div class="panel-footer">
    					<a href="order.php?igrica=csgo" class="btn btn-purple btn-block"><i class="far fa-shopping-cart"></i>  Naruči server</a>
    				</div>
    			</div>
    		</div>

    		<div class="col-md-3">
    			<div class="panel panel-game">
    				<div class="panel-heading">
    					<img class="img-responsive" src="/assets/images/game-3.png">
    					<div class="game-title">
    						<p>GTA San Andreas MP</p>
    					</div>
    				</div>
    				<div class="panel-body">
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>France</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>0.09€ / slots</span></p>
    					</div>
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>Germany</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>0.09€ / slots</span></p>
    					</div>
    				</div>
    				<div class="panel-footer">
    					<a href="order.php?igrica=samp" class="btn btn-purple btn-block"><i class="far fa-shopping-cart"></i>  Naruči server</a>
    				</div>
    			</div>
    		</div>

    		<div class="col-md-3">
    			<div class="panel panel-game">
    				<div class="panel-heading">
    					<img class="img-responsive" src="/assets/images/1.png">
    					<div class="game-title">
    						<p>Minecraft</p>
    					</div>
    				</div>
    				<div class="panel-body">
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>France</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>3€ / 1GB</span></p>
    					</div>
    					<div class="col-md-6 col-sm-6">
    						<p>Location: <span>Germany</span></p>
    						<p>Ping: <span>45-50m/s</span></p>
    						<p>Price: <span>3€ / 1GB</span></p>
    					</div>
    				</div>
    				<div class="panel-footer">
    					<a href="order.php?igrica=mc" class="btn btn-purple btn-block"><i class="far fa-shopping-cart"></i>  Naruči server</a>
    				</div>
    			</div>
    		</div>
			
			<!-- Features -->
			<div class="col-md-12">
				<div class="features-main">
					<div class="col-md-6">
						<div class="features">
                            <h1><i class="far fa-stars"></i> Karakteristike</h1>
							<li>
            		    	    <i class="fas fa-ticket-alt"></i>
            		    	    <div>
            		    	    	<span class="heading">Podrška</span>
            		    	    	<span class="summary text-muted">Podrška spremna da pomogne u svakom trenutku i pruži potrebnu pomoć kada je ona neophodna.</span>
            		    	    </div>
            		    	</li>
            		    	<li>
            		    	    <i class="fas fa-bomb" style="margin-left: 2px;"></i>
            		    	    <div>
            		    	    	<span class="heading">Sigurnost</span>
            		    	    	<span class="summary text-muted">Bezbednost servera i održavanje integriteta podataka je od najveće važnosti za našu kompaniju.</span>
            		    	    </div>
            		    	</li>
            		    	<li>
            		    	    <i class="fas fa-server" style="margin-left: 2px;"></i>
            		    	    <div>
            		    	    	<span class="heading">Game Panel</span>
            		    	    	<span class="summary text-muted">Naš kontrolni panel je prilagođen svim početnicima, a u isto vreme nudi dodatke za one naprednije.</span>
            		    	    </div>
            		    	</li>
            		    	<li>
            		    	    <i class="fas fa-wallet" style="margin-left: 2px;"></i>
            		    	    <div>
            		    	    	<span class="heading">Garancija za povrat novca u skladu sa uslovima koriscenja</span>
            		    	    	<span class="summary text-muted">Ukoliko se ispostavi da Vas nismo usluzili u skladu sa nasim pravilima vraticemo Vam novac u roku od 5 dana.</span>
            		    	    </div>
            		    	</li>
            			</div>
					</div>
					<div class="col-md-6">
                        <h1><i class="fas fa-server"></i> Naše mašine</h1>
						<div id="map">
	  						<div class="img-container">
		  						<img src="/assets/image/upload/v1496891721/map_no-dots_mptb8a.png" alt="Map">
	 						</div>
	  						<div id="dots">
		  						<div class="dot dot-1" data-toggle="tooltip" title="Nemačka , Frankfurt"></div>
		  						<div class="dot dot-2" data-toggle="tooltip" title="Francuska , Roubaix"></div>
	  						</div>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-12">
                <div class="footer">
    <div class="pull-left">Kodirao <a href="https://github.com/R00tS3c">RootSec</a></div>
    <div class="pull-right">
        <a href="#">Naruči server</a>
        <a href="#">Game panel</a>
        <a href="knowledge-base.html">Baza znanja</a>
        <a href="tos.html">Uslovi korišcenja</a>
    </div>
</div>
<!-- Login -->
<div id="login" class="modal fade" role="dialog" style="margin-top: 100px;">
  	<div class="modal-dialog" style="width: 300px;max-width: 100%;margin-left: 15px;margin-right: 15px;display: block;margin: 0 auto;">
  		<div class="login-content">
    	<div class="modal-content">
      		<div class="modal-body">
            <button type="button" class="close" style="color: #fff;" data-dismiss="modal">&times;</button>
            <h1><i class="fas fa-users-cog"></i> Uloguj se <a href="/demo_login.php">(DEMO)</a></h1>   			
      			<form action="/process.php?a=login" method="POST" autocomplete="off">
      				<div class="form-group">
      					<label>Korisničko ime:</label>
      					<input type="" name="email" class="form-control">
      				</div>
      				<div class="form-group">
      					<label>Lozinka:</label>
      					<input type="password" name="password" class="form-control">
      				</div>
      				<div class="form-group">
                <a href="#" class="pull-left forgot">Zaboravljena lozinka?</a>
                <div class="pull-right">
      					 <button class="btn btn-purple" type="sumbit"><i class="far fa-sign-in-alt"></i> Uloguj se</button>
                </div>
      				</div>
      			</form>       		
      		</div>
    	</div>
    	</div>
  	</div>
</div>
<div id="register" class="modal fade" role="dialog" style="margin-top: 100px;">
  	<div class="modal-dialog" style="width: 300px;max-width: 100%;margin-left: 15px;margin-right: 15px;display: block;margin: 0 auto;">
  		<div class="login-content">
    	<div class="modal-content">
      		<div class="modal-body">
            <button type="button" class="close" style="color: #fff;" data-dismiss="modal">&times;</button>
            <h1><i class="fas fa-users-cog"></i> Uloguj se</h1>   			
      			<form action="/process.php?a=register" method="POST" autocomplete="off">
      				<div class="form-group">
      					<label>Ime:</label>
      					<input type="" name="ime" class="form-control">
      				</div>
      				<div class="form-group">
      					<label>Prezime:</label>
      					<input type="" name="prezime" class="form-control">
					  </div>
					  <div class="form-group">
      					<label>Username:</label>
      					<input type="" name="username" class="form-control">
      				</div>      				<div class="form-group">
      					<label>E-mail:</label>
      					<input type="" name="email" class="form-control">
      				</div>      				<div class="form-group">
      					<label>Password:</label>
      					<input type="password" name="pass" class="form-control">
      				</div>      				<div class="form-group">
      					<label>Ponovi Password:</label>
      					<input type="password" name="pass2" class="form-control">
      				</div>      				<div class="form-group">
      					<label>Sigurnosni kod:</label>
						  <input type="" name="sig_kod_c" class="form-control">
					  </div>      			
					  <?php
									$sig_kod = random_s_key(5);
									$_SESSION['sig_kod'] = $sig_kod;
								?> 
								      				<div class="form-group">
						  <input disabled name="sig_kod" type="text" value="<?php echo $sig_kod; ?>" required="" class="form-control">
					  </div>    
					  <div class="form-group">
      					<label>PIN:</label>
      					<input name="pin_code" type="text" value="<?php echo random_n_key(5); ?>" required="" class="form-control">
      				</div>      				<div class="form-group">
      					<label>Token:</label>
      					<input disabled name="token" type="text" value="<?php echo md5('token_'.time()); ?>" required="" class="form-control">
					  </div>      				
					<div class="form-group">
      					<label>Drzava:</label>
						  <select name="drzava" id="drzava" class="form-control" required="">
										<option value="" disabled selected="selected">Izaberi</option>
										<option value="RS">Srbija</option>
										<option value="HR">Hrvatska</option>
										<option value="BA">Bosna i Hercegovina</option>
										<option value="MK">Makedonija</option>
										<option value="ME">Montenegro</option>
										<option value="other">No Balkan</option>
									</select>      				
					</div>
      				<div class="form-group">
                <div class="pull-right">
      					 <button class="btn btn-purple" type="sumbit"><i class="far fa-sign-in-alt"></i> Uloguj se</button>
                </div>
      				</div>
      			</form>       		
      		</div>
    	</div>
    	</div>
  	</div>
</div>  
</div>
		</div>
	</div>
</body>

</html>