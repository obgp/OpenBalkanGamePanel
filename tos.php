<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');

?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo site_name(); ?></title>



	<link rel="stylesheet" type="text/css" href="/assets/css/main.css?<?php echo time(); ?>">



	<!-- CSS Povezivanje -->

    <link href="/assets/css/mobile.css?<?php echo time(); ?>" rel="stylesheet" media="all">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">




</head>

<body>

      <script src="https://use.fontawesome.com/4ae75e425f.js"></script>

	<!-- Error script -->

	<div id="gp_msg"> <?php echo eMSG(); ?> </div>



    <script type="text/javascript">

    	setTimeout(function() {

    		document.getElementById('gp_msg').innerHTML = "<?php echo unset_msg(); ?>";

    	}, 5000);

    </script>



	<!-- header -->

	<header>

		<div id="top_bar">

			<div class="top_bar_vesti">

				<li><a href="">INFO</a></li>

			</div>

			

			<div class="top_bar_info">

				<p>Dobrodosli na novi Sajt sa integrisanim panelom, ovo je Beta verzija sajta i panela! Sve korisnike ukoliko imaju problema savjetujem da nas kontaktirate. <a href="/contact">KLIK</a></p>

			</div>



			<div class="top_bar_flag right">

				<li><a href="?lang=rs"><img src="/assets/img/icon/flag/RS.png" alt=""></a></li>

				<li><a href="?lang=de"><img src="/assets/img/icon/flag/DE.png" alt=""></a></li>

				<li><a href="?lang=en"><img src="/assets/img/icon/flag/US.png" alt=""></a></li>

			</div>

		</div>

	</header>



	<div class="containerr">



		<!-- section -->

		<section>

			<li>

				<a href="/index.php"><img src="/assets/img/icon/gb_logo.png" alt="LOGO"></a>

			</li>



			<?php if (is_login() == false) { ?>

				<li class="right">

					<div class="login_form">

						<ul style="width:100%;">

							<form action="/process.php?a=login" method="POST" autocomplete="off">

								<li class="inline" style="float:right;display:block;">

									<ul class="inline">

										<li style="display:block;">

											<span class="inline" id="span_for_name">

												<div class="none">

													<img src="/assets/img/icon/login-bg.png" style="width:33px;position:absolute;margin:3px -18px;">

													<img src="/assets/img/icon/user-icon-username.png" style="width:11px;margin:9px -9px;position:absolute;">

												</div>

											</span>

											<input type="text" name="email" placeholder="email" required autocomplete="email">

										</li>

										<li style="display:block;">

											<span class="inline" id="span_for_pass">

												<div class="none">

													<img src="/assets/img/icon/login-bg.png" style="width:33px;position:absolute;margin:3px -18px;">

													<img src="/assets/img/icon/katanac-pw.png" style="width:9px;margin:9px -9px;position:absolute;">

												</div>

											</span>

											<input type="password" name="password" placeholder="password" required>

										</li>

										

										<div id="loginBox">

											<li><a href="/demo_login.php">DEMO</a></li>

											<li><button>LOGIN <img src="/assets/img/icon/KATANAC-submit.png" style="width: 7px;"></button></li>

										</div>



									</ul>

								</li>

							</form>

						</ul>

					</div>

				</li>

			<?php } else { ?>

				<li class="right">

					<div class="login_form">

						<ul style="width:100%;">

							<li class="inline prof_inf_hdr">

								<div class="av left">

									<img src="/assets/img/icon/G-logo.png" style="width:90px;height:90px;">

								</div>



								<ul class="inline right" style="margin-right:30px;">

									<li style="display:block;">

										<span class="fa fa-user" style="color:#bbb;"></span> 

										<span style="color: #fff;"><?php echo user_full_name($_SESSION['user_login']); ?></span>

									</li>

									<li style="display:block;">

										<span class="fa fa-send" style="color:#bbb;"></span> 

										<span style="color: #fff;"><?php echo user_email($_SESSION['user_login']); ?></span>

									</li>

									<li style="display:block;">

										<span class="fa fa-mail-forward" style="color:#bbb;"></span> 

										<span style="color: #fff;"><?php echo host_ip(); ?></span>

									</li>

									<li style="display:block;">

										<span class="fa fa-money" style="color:#bbb;"></span> 

										<span style="color: #fff;"><?php echo money_val(my_money($_SESSION['user_login']), my_contry($_SESSION['user_login'])); ?></span>

									</li>

									<br>

									<div id="loginBox" style="margin-left:-100px;">

										<li><a href="/gp-settings.php">EDIT</a></li>

										<li><a href="/gp-billing.php">BILLING</a></li>

										<li><a href="/logout.php">LOGOUT</a></li>

									</div>

								</ul>

							</li>

						</ul>

					</div>

				</li>

			<?php } ?>

		</section>



		<div class="space clear" style="margin-top: 20px;"></div>



		<!-- NAVIGACIJA - MENI -->

		<nav>

			<ul style="margin-left: 20px;">

				<li class="selected"><a href="/home">Početna</a></li>

				<li><a href="/gp-home.php">Game Panel</a></li>

				<li><a href="">Forum</a></li>

				<li><a href="/naruci.php">Naruci</a></li>

				<li><a href="">O nama</a></li>

				<li><a href="">Kontakt</a></li>

			</ul>



			<?php if (is_login() == false) { ?>

				<div id="reg">

					<a href="#">REGISTRUJ SE</a>

				</div>

			<?php } else { ?>

				<div id="reg">

					<a href="#">MOJ PROFIL</a>

				</div>

			<?php } ?>

		</nav>

	 
	<article>
		<div class="uslovi_tos" style="padding: 10px;">
			<center>
				<div class="tos_naslov"><h3>Opšti uslovi za korišćenje usluga Game Balkan Hoster-a</h3></div>
			</center>
			
			<strong>Predmet, objavljivanje i izmene Opštih uslova</strong>
			
			<p>
				<strong>~</strong> Ovim opštim uslovima za pružanje game hosting usluga na internetu utvrduju se uslovi pod
				kojima GH hosting pruža usluge na oslovu dodeljenih dozvola.
				
				<br /> 

				<strong>1.</strong> Opšti uslovi objavljeni su na internet sajtu GB-Hoster.me, svaki korisnik je
				dužan da ih procita pre narudžbe, time izbegava nesporazume.
				
				<br />

				<strong>1.2.</strong> GB hosting pruža usluge Game Servera kao svoju osnovnu uslugu. Usluge web
				hostinga, audio streaming­a, domena su dodatne, srodne usluge koje nudimo kao bonus uz
				game servere i NE ODGOVARAMO ZA NJIH niti nužno dajemo podršku.
				
				<br />

				<strong>1.3.</strong> GB hosting zadržava pravo izmene "Ugovora o korišcenju usluga" bez prethodnog
				obaveštenja korisnika. Elektronskim potpisivanjem ugovora (klikom na "Slažem se") korisnik
				prihvata primenu Opštih uslova.
				
				<br />

				<strong>1.4.</strong> Zadržavamo pravo odbijanja usluge bilo kome. Bilo koji materijal koji je, po našem sudu,
				nesiguran za naš server, ilegalan, ili krši naše uslove pružanja usluge na bilo koji nacin, bice
				uklonjen (ili na drugi nacin onemogucen) sa ili bez obaveštenja.
				GH game hosting zadržava pravo suspenzije i otkazivanja svojih usluga korisnicima koji krše
				pravila (tacka 3, 4)
			</p>

			<strong>Ugovor</strong>

			<p>
				<strong>2.</strong> Korisnik zakljucenjem Ugovora potvrduje prihvatanje Opštih uslova i njihovu
				obavezujucu
				primenu u svemu što nije izricito drugacije regulisano Ugovorom.
				
				<br />

				<strong>2.1.</strong> Ugovor se zakljucuje na neodredeno vreme, osim ako drugacije nije definisano od strane korisnika i GH game hostinga (posebni vremenski ugovori na 1. god. i sl.)
			</p>

			<strong>Korišcenje game servera</strong>
			<p>Član 3.</p>
			<p>
				<strong>3.</strong> Sopstveni nalog koristi samo klijent i kao takav nije poželjno da omogucuje pristup drugim
				licima. GH game hosting ne odgovara za štetu nastalu pristupanjem trecih lica na nalog.
			</p>
			

			<strong>Zasnivanje odnosa i otkazivanje usluga</strong>

			<p>
				<strong>4.</strong> Korisnik naših usluga može postati bilo koje lice starije od 12 godina koje prihvata Opšte
				Usluge Korišcenja GB usluga.
				Narudžba tj. zahtjev za zasnivanje korisnickog odnosa se podnosi narudžbom preko
				zvanicnog
				sajta GB-Hoster.me gde je neophodno upisati tacne podatke (ime, prezime,
				adresa,
				email, broj telefona).
				Korisnik može birati igru, broj slotova i period zakupa servera. Nakon završetka narudžbe
				korisnik dobija email koji sadrži uputstva o nacinu placanja, predracun i informacije o nalogu
				(username, password).
				Nakon placanja usluge preporucuje se skeniranje/fotografisanje kopije uplatnice od strane
				korisnika koji nama treba poslati u obliku .jpg ili .png fajla što ce omoguciti maksimalno brzo
				procesuiranje narudžbe.
				Svaki korisnik dobija IP adresu koja se deli sa ostalim korisnicima na istom serveru i port koji
				je
				jedinstven. IP:port su u korisnickom vlasništvu dok je server aktivan (placen)
				Korisnik nije dužan obavestiti GH Game Hosting o otkazivanju usluge za koju nema
				vremenski
				ugovor koji je dužan poštovati.
			</p>

			<strong>Plaćanje</strong>

			<p>
				<strong>5.</strong> Mesecna naknada za korišcenje Servisa se placa shodno izabranom paketu i važecem
				cenovniku
				Provajdera koji je dostupan na adresi GB-Hoster.me smatra se sastavnim delom
				ovog
				Ugovora.

				<br />

				<strong>5.1.</strong> Uplatu usluge Korisnik može da izvrši u banci ili pošti na broj žiro racuna koji ste dobili
				na
				mail prilikom narudžbe (zavisno od države iz koje narucujete). Uplatu je moguce izvršiti i
				elektronski preko servisa Banka transfer ,PayPal, 2co, Moneybookers, tj. VISA, MasterCard i
				SMSpay.
				
				<br />
				
				<strong>5.2.</strong> GB zadržava pravo da jednostrano izmeni cenovnik kojim odreduje visinu naknade o
				cemu
				ce blagovremeno na uobicajen nacin obavestiti korisnika.
				
				<br />

				<strong>5.3.</strong> Sve usluga GB provajdera su iskljucivo PRE­PAID, što znaci, da korisnik placa za
				definisani
				period pre uspostavljanja usluge.
			</p>

			<strong>Privatnost</strong>

			<p>
				<strong>6.</strong> GB poštuje Vašu privatnost i ne vrši pregled fajlova na hostingu osim u slucaju Vašeg
				pismenog
				zahteva.
				Bilo koja informacija ili podatak na Vašem nalogu cuva se strogo poverljivo, a sve licne
				informacije i lozinke su kriptovane.
				Zabranjeno je da bilo ko iz GH game hostinga uzima delove Vaših skripti, sajtova i ostale
				intelektualne svojine.
				E­mail lista se koristi samo za obaveštenja korisnika, Vaše e­mail adrese ne prodajemo niti
				iznajmljujemo trecim licima.
			</p>

			<strong>Povrat novca / Prevremeno otkazivanje</strong>
			<p>Član 7.</p>
			<p>
				<strong>7.</strong> Povrat novca je onemogucen za usluge koje ste platili za 1, 2, 3. mjeseca.
				Usluge povrata možete dobiti samo i samo ako ste za uslugu platili za 4 i više mjeseci.
			</p>

			<strong>Odricanje odgovornosti / Odbijanje usluživanja</strong>

			<p>
				GB game hosting je oslobodjen odgovornosti prema bilo kome za bilo kakvu štetu – direktnu,
				posrednu, slucajnu, posebnu ili posledicnu, koja bi nastala ili proistekla korištenjem naših
				servisa ili ovog sajta kao i sajtova sa kojima je on povezan.
				
				<br />

				<strong>8.1.</strong> Provajder ne odgovara za zagušenja, kašnjenja ili greške u funkcionisanju delova
				Interneta
				na koja objektivno ne može da utice.
				
				<br />

				<strong>8.2.</strong> Korisnik samostalno snosi potpunu odgovornost za sigurnost prava pristupa i pristup
				Internetu u okviru svoje lokalne mreže.
				
				<br /> 

				<strong>8.3.</strong> Provajder ne odgovara za povredu prava na privatnost i sigurnost korisnika koje na
				Internetu izvrši trece lice.
				
				<br />
				
				<strong>8.4.</strong> Provajder ne odgovara za sigurnost i tacnost informacija koje korisnik razmenjuje sa
				ostalim
				korisnicima na internet.
				
				<br />

				<strong>8.5.</strong> Ukoliko Korisnik bude objekat ugrožavanja, Provjader ce mu u granicama svojih
				mogucnosti
				i bez garancija za uspeh pružiti strucnu pomoc u otkrivanju i onemogucivanju takvih
				aktivnosti
				prema njemu.
				
				<br />

				<strong>8.6.</strong> Provajder ne odgovara za štetu koju Korisnik nacini nestrucnim korišcenjem sopstvenih
				usluga.
				
				<br />

				<strong>8.7.</strong> Ukoliko prekid Servisa, koji je prethodno prijavljen od strane Korisnika provajderu, nije
				rešen u roku od 72 sata od momenta prekida, korisniku se produžava usluga za 15 dana,
				ukoliko
				prekid Servisa nije uzrokovao sam Korisnik
			</p>

			<strong>Nacin komunikacije</strong>
			
			<p>
				<strong>9.</strong> Komunikacija izmedu korisnika i GH hosting provajdera vrši se iskljucivo elektronski, preko zvanicnih email adresa za podršku koje možete videti na sajtu i ticketa za podršku kao i ostalih vidova komunikacije dostupnih na sajtu.
			</p>

			<strong>Stupanje opštih uslova na snagu i početak korišćenja</strong>
			
			<br /> <br />

			<span>
				Ovi opšti uslovi stupaju na snagu dana donošenja i objavljivanja od strane direktora.
				<br /> <br />
				Original iz: 03.02.2013. <br /> Prva izmena: 09.02.2016. <br /> Zadnja izmena: 09.04.2017.
				<br />
				Prvi Potpis u Beogradu dana 03.02.2013<br />
				Zadnji Potpis u Beogradu dana 01.09.2018

				<br /> <br />

				Branko Stosic
				CEO & Founder
			</span>
		</div>
	</article>

	
	<div class="space" style="margin-top: 30px;"></div>

    <!-- FOOTER -->
    
       
<div class="copyright">

		<div class="container">

			<div class="col-md-6">

				<p>&copy; Copyright 2017-<?php echo date('Y').' '.site_name(); ?>. Sva prava zadrzana.</p>

			</div>

			

			<div class="col-md-6">

				<ul class="bottom_ul">

					<li><a href="/home">Početna</a></li>

					<li><a href="/gp-home.php">Game Panel</a></li>

					<li><a href="">Forum</a></li>

					<li><a href=""><?php echo GT_Site_Name(); ?></a></li>

				</ul>

			</div>

		</div>

	</div>

	<script src="/assets/js/jquery.min.js"></script>

    <script src="/assets/js/bootstrap.min.js"></script>



    <script>

	var stop_css = "font-size:50px;color:red;text-shadow:-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;";

	console.log("%c %s", stop_css, 'STOP!');



	var msg_css = "font-size:15px;color:black;";

	console.log("%c %s", msg_css, 'This function browser is for developers, if you have a river that over conzola can hack or break into someone\'s GamePanel, you are so wrong this is just a lie!');

	</script>

    

</body>

</html>