<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
		<div class="container">
			<div class="rows">
				<div class="contect">
	        <div class="col-md-12" style="color: #fff;">    
	            <div id="server_info_infor">
	                <div id="server_info_infor2">
	                    <div class="space" style="margin-top: 20px;"></div>
	                    <div class="gp-home">
	                        <h2>Licni podaci</h2>
	                        <h3 style="font-size: 12px;color: #fff;">Ovde mozete promeniti licne podatke!</h3>                       
	                        
	                        <div class="podForm" style="">
	                            <?php if (is_user_pin() == false) { ?>
	                                <strong style="color: #fff;">
	                                    Kako bi pristupili opciji za editovanje vaših informacija potrebno je da ispravno unesete vaš pin kod!
	                                </strong> 
	                                <br /> <br />
	                                <button class="btn btn-info btn-large btn-block" data-toggle="modal" data-target="#pin"> <i class="fa fa-unlock"></i> OTKLJUČAJ
	                                </button>
	                            <?php } else { ?>
	                                <form action="/process.php?a=edit_profile" method="POST" autocomplete="off">
	                                    <label for="ime">IME </label>
	                                    <input class="form-control" type="text" name="ime" value="<?php echo user_ime($_SESSION['user_login']); ?>" >
	                                    <br />

	                                    <label for="prezime">PREZIME </label>
	                                    <input class="form-control" type="text" name="prezime" value="<?php echo user_prezime($_SESSION['user_login']); ?>" > <br />

	                                    <label for="email">EMAIL </label>
	                                    <input class="form-control" disabled name="email" value="<?php echo user_email($_SESSION['user_login']); ?>" >
	                                    <?php if (is_user_pin() == true) { ?>
	                                        <!-- <span style="margin-left:10px;color:#bbb;cursor:pointer;" data-toggle="modal" data-target="#email-auth"> Zahtijev za promenu email adrese</span> -->
	                                    <?php } ?>
	                                    <br />

	                                    <label for="password">PASSWORD </label>
	                                    <input class="form-control" type="password" name="password" placeholder="Ako ne zelite menjat ostavite prazno polje" > <br />

	                                    <label for="password">R. PASSWORD </label>
	                                    <input class="form-control" type="password" name="r_password" placeholder="Molimo ponovite password" > <br />
	                                    <i class="plava_color">Ako ne zelite menjat password ostavite prazna polja (Password i R. Password)</i> <br />

	                                    <!--<label for="token">TOKEN </label>
	                                    <?php if (is_user_pin() == false) { ?>
	                                        <input disabled name="token" style="margin-left: 76px;" value="SAKRIVEN -(ovo ne mozete da menjate)">
	                                    <?php } else { ?>
	                                        <input disabled name="token" style="margin-left: 76px;" value="<?php echo user_token($_SESSION['user_login']); ?>">
	                                        <span style="margin-left:10px;color:#bbb;cursor:pointer;" data-toggle="modal" data-target="#token-auth"> Prikazi key token</span><br />
	                                    <?php } ?> -->
	                                    <br />

	                                    <button class="pull-right btn btn-primary"><i class="fa fa-save"></i> SACUVAJ</button>
	                                </form>
	                            <?php } ?>
	                        </div>
	                    </div>
	                    <div class="space" style="margin-bottom: 20px;"></div>
	                </div>
	            </div>
	        </div>

	        </div>

    <?php if (is_user_pin() == true) { ?>
    <!-- TOKEN (POPUP)-->
    <div class="modal fade" id="token-auth" role="dialog">
        <div class="modal-dialog">
            <div id="popUP"> 
                <div class="popUP">
                    <form action="process.php?task=client_new_token" method="POST" class="ui-modal-form" id="modal-token-auth">
                        <?php
                            $new_token = random_s_key(30).'_'.$_SESSION['user_login'];
                            $_SESSION['new_token'] = $new_token;
                        ?>
                        <fieldset>
                            <h2>PHP API Token</h2>
                            <ul>
                                <li>
                                    <p>
                                        Token sluzi za dodeljivanje privilegija vasih servera nekoj eksternoj aplikaciji. <br />
                                        Ako ne znate cemu ovo sluzi, onda vam verovatno nece ni trebati :) <br />
                                        Korisne PHP API TOKEN SKRIPTE: <a href="/api.php?token">KLIK!</a> <br />
                                    </p>
                                </li>

                                <li>
                                    <label for="token">Trenutni <br /> TOKEN</label>
                                    <input hidden type="text" name="stari_token" value="<?php echo user_token($_SESSION['user_login']); ?>">
                                    <input disabled type="text" value="<?php echo user_token($_SESSION['user_login']); ?>" style="width: 85%;">
                                </li>

                                <br />

                                <p>
                                    Ovde mozete generisati novi PHP API token! <br />
                                    Ako ga promenite, sve aplikacije koje ga trenutno koriste gube pristup i moracete im ponovo upisati novi token! <br />
                                    Ukolio ocete da ostavite stari kliknite na 'dugme' "ODUSTANI" .
                                </p>
                                
                                <li>
                                    <label for="token">Novi <br /> TOKEN</label>
                                    <input hidden type="text" name="new_token" value="<?php echo $new_token; ?>">
                                    <input disabled type="text" value="<?php echo $new_token; ?>" style="width: 85%;">
                                </li>

                                <li style="text-align:center;">
                                    <button> <span class="fa fa-check-square-o"></span> SACUVAJ</button>
                                    <button type="button" data-dismiss="modal" loginClose="close"> <span class="fa fa-close"></span> Odustani </button>
                                </li>
                            </ul>
                        </fieldset>
                    </form>
                </div>        
            </div>  
        </div>
    </div>
    <!-- KRAJ - TOKEN (POPUP) -->
<?php } ?>

				<?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>