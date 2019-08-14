<?php
include "core.php";
head();

if (isset($_POST['nextstep'])) {
    if ($_POST['type'] == "Main") {
        @$_SESSION['client'] = 'No';
    } else {
        @$_SESSION['client'] = 'Yes';
    }
}

include "database.inc.php";

@$_SESSION['database_host'] = $_POST['database_host'];
@$_SESSION['database_username'] = $_POST['database_username'];
@$_SESSION['database_password'] = $_POST['database_password'];
@$_SESSION['database_name'] = $_POST['database_name'];
@$_SESSION['table_prefix'] = $_POST['table_prefix'];
?>
                                <center><h4><?php
echo lang_key("database_info");
?></h4></center><br /><hr /><br />
                                
                                <form method="post" action="" class="form-horizontal row-border"> 
                        
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("database_host");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-database"></i>
							</span>
						<input type="text" name="database_host" class="form-control" placeholder="localhost" value="<?php
echo $_SESSION['database_host'];
?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("database_name");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-list-alt"></i>
							</span>
						<input type="text" name="database_name" class="form-control" placeholder="project-security" value="<?php
echo $_SESSION['database_name'];
?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("database_username");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
						<input type="text" name="database_username" class="form-control" placeholder="root" value="<?php
echo $_SESSION['database_username'];
?>" required>
					   </div>
					</div>
				</div>
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("database_password");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-key"></i>
							</span>
						<input type="text" name="database_password" class="form-control" placeholder="" value="<?php
echo $_SESSION['database_password'];
?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("table_prefix");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-terminal"></i>
							</span>
						<input type="text" name="table_prefix" class="form-control" placeholder="security_" value="<?php
echo $_SESSION['table_prefix'];
?>">
						</div>
					</div>
				</div>		
<?php
if (isset($_POST['submit'])) {
    $database_host     = $_POST['database_host'];
    $database_name     = $_POST['database_name'];
    $database_username = $_POST['database_username'];
    $database_password = $_POST['database_password'];
    
    $table_prefix = $_POST['table_prefix'];
    
    $db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, DATABASE_TYPE);
    if (!$db->Open()) {
        echo '
			   <br />
			    <div class="callout callout-danger">
					<h5>' . lang_key("error_check_db_connection") . '</h5>
			    </div>
			   ';
    } else {
        if ($_SESSION['client'] == 'No') {
            echo '<meta http-equiv="refresh" content="0; url=settings.php" />';
        } else {
            echo '<meta http-equiv="refresh" content="0; url=done.php" />';
        }
    }
}
?>
				
				</div>
				<div class="panel-footer">
					<div class="row">
						<center>
							<a href="index.php" class="btn-default btn btn-flat"><i class="fa fa-arrow-circle-o-left"></i> <?php
echo lang_key("back");
?></a>
							<input class="btn-primary btn btn-flat" type="submit" name="submit" value="<?php
echo lang_key("next");
?>" />
						</center>
					</div>
				</div>
				</form>
                            

<?php
footer();
?>