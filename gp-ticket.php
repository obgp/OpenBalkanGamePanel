<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php'); 

if (is_login() == false) {
	sMSG('Morate se ulogovati.', 'error');
	redirect_to('home');
	die();
}

$Ticket_ID = txt($_GET['id']);
if (is_valid_ticket($Ticket_ID) == false) {
	sMSG('Ovaj tiket ne postoji ili nemate pristup istom.', 'error');
	redirect_to('gp-support.php');
	die();
}

if (ban_support($_SESSION['user_login']) == 1) {
	sMSG('Vas nalog, je na nasoj ban listi za ovu stranicu. Ukoliko mislite da je ovo neka greska obratite se nasem support timu!', 'info');
	redirect_to('gp-home.php');
	die();
}

?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>

    <div class="container">
      <div class="rows">
        <div class="contect">
          <h2><i class="fa fa-comments-o"></i> Tickets</h2>
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-user"></i> <?php echo user_name($_SESSION['user_login']); ?> <span class="pull-right"><?php echo ticket_date($Ticket_ID); ?></span></div>
              <div class="panel-body">
                <p><font size="3"><?php echo smile(ticket_text($Ticket_ID)); ?></font></p>
              </div>
            </div>
            <?php 
            				$rootsec = rootsec();

                    $SQLSEC = $rootsec->prepare("SELECT * FROM `tiketi_odgovori` WHERE `tiket_id` = ? ORDER by id ASC");
                    $SQLSEC->Execute(array($Ticket_ID));

                    while ($t_row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) {
                      $ODG_ID				= txt($t_row['id']);
                      $User_Odg_ID		= txt($t_row['user_id']);
                      $Admin_Odg_ID		= txt($t_row['admin_id']);

                      if (empty($User_Odg_ID)||$User_Odg_ID == "0") {
                        $Odg_Ime = admin_user_name($Admin_Odg_ID);
                        if (admin_rank_id($Admin_Odg_ID) == 1) {
                          /*$Admin_Rank_Name = '
                            <i style="color:#bbb;">'.$Odg_Ime.'</i> 
                            <a href="" class="rep_plus" title="Pohvalite naseg radnika: '.admin_user_name($Admin_Odg_ID).'"><i class="fa fa-plus"></i></a>';*/
                          $Admin_Rank_Name = adm_r_name($Admin_Odg_ID);
                          $Odg_Avatar = admin_rank_avatar($Admin_Odg_ID);
                        } else if (admin_rank_id($Admin_Odg_ID) == 2) {
                          /*$Admin_Rank_Name = '
                            <i style="color:yellow;">'.$Odg_Ime.'</i> 
                            <a href="" class="rep_plus" title="Pohvalite naseg radnika: '.admin_user_name($Admin_Odg_ID).'"><i class="fa fa-plus"></i></a>';*/
                          $Admin_Rank_Name = adm_r_name($Admin_Odg_ID);
                          $Odg_Avatar = admin_rank_avatar($Admin_Odg_ID);
                        } else if (admin_rank_id($Admin_Odg_ID) == 3) {
                          /*$Admin_Rank_Name = '
                            <i style="color:red;">'.$Odg_Ime.'</i> 
                            <a href="" class="rep_plus" title="Pohvalite naseg radnika: '.admin_user_name($Admin_Odg_ID).'"><i class="fa fa-plus"></i></a>';*/
                          $Admin_Rank_Name = adm_r_name($Admin_Odg_ID);
                          $Odg_Avatar = admin_rank_avatar($Admin_Odg_ID);
                        } else if (admin_rank_id($Admin_Odg_ID) == 4) {
                          /*$Admin_Rank_Name = '
                            <i style="color:#0ba3fd;">'.$Odg_Ime.'</i> 
                            <a href="" class="rep_plus" title="Pohvalite naseg radnika: '.admin_user_name($Admin_Odg_ID).'"><i class="fa fa-plus"></i></a>';*/
                          $Admin_Rank_Name = adm_r_name($Admin_Odg_ID);
                          $Odg_Avatar = admin_rank_avatar($Admin_Odg_ID);
                        }
                        $Odg_Color = "red;";
                        $Odg_BG = "support-odg";
                        $Odg_Rank = admin_rank($Admin_Odg_ID);
                      } else if (empty($Admin_Odg_ID)||$Admin_Odg_ID == "0") {
                        $Odg_Ime = user_name($User_Odg_ID);
                        $Admin_Rank_Name = $Odg_Ime;
                        $Odg_Color = "#fff;"; 
                        $Odg_BG = "client-odg";
                        $Odg_Rank = "Korisnik";
                        $Odg_Avatar = cl_avatar();
                      } else {
                        $Odg_Ime = user_name($User_Odg_ID);
                        $Admin_Rank_Name = 'Ime Prezime';
                        $Odg_Color = "#fff;"; 
                        $Odg_BG = "client-odg";
                        $Odg_Rank = "Korisnik";
                        $Odg_Avatar = cl_avatar();
                      }
            ?>
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-user"></i> <?php echo $Admin_Rank_Name; ?> <span class="pull-right"><?php echo t_odg_time($ODG_ID); ?></span></div>
              <div class="panel-body">
                <p><font size="3"><?php echo smile(t_odg_text($ODG_ID)); ?></font></p>
              </div>
            </div>
            <?php } ?>

            <div class="form-group">
              <label>Comments:</label>
              <form action="/process.php?a=ticket_add_odg" method="POST" autocomplete="off">
			        <input hidden type="text" name="tiket_id" value="<?php echo $Ticket_ID; ?>">
              <textarea name="tiket_odg" class="form-control" rows="5" id="comment" <?php if(ticket_status_id($Ticket_ID) == 1||ticket_status_id($Ticket_ID) == 2||ticket_status_id($Ticket_ID) == 3) { if(last_odg_time($Ticket_ID) > (time() - 300)) { echo 'readonly="readonly" style="cursor: wait;" placeholder="Antispam! Vreme izmedju postavljanja sledeceg odgovora je 5 minuta, molimo strpite se malo!"'; } else if(ticket_status_id($Ticket_ID) == 4) { echo ' readonly="readonly" style="cursor: wait;" placeholder="Tiket je zakljucan"'; } } else { echo ' placeholder="Dodajte odgovor na ovaj tiket."'; } ?>></textarea>
            </div>
            <div class="pull-right">
              <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send Ticket</button>
            </div>
            </form>
          </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>