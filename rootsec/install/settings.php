<?php
include "core.php";
head();

@$_SESSION['username'] = $_POST['username'];
@$_SESSION['email'] = $_POST['email'];
@$_SESSION['password'] = $_POST['password'];
?>
                                <center><h4><?php
echo lang_key("settings_info");
?></h4></center><br /><hr /><br />
                                
                                <form method="post" action="" class="form-horizontal row-border">
                        
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("username");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
						<input type="text" name="username" class="form-control" placeholder="admin" value="<?php
echo $_SESSION['username'];
?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("password");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-key"></i>
							</span>
						<input type="text" name="password" class="form-control" placeholder="" value="<?php
echo $_SESSION['password'];
?>" required>
						</div>
					</div>
				</div>
                <div class="form-group">
					<h4 class="col-sm-3"><?php
echo lang_key("email");
?>: </h4>
					<div class="col-sm-8">
					    <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							</span>
						<input type="text" name="email" class="form-control" placeholder="admin@mail.com" value="<?php
echo $_SESSION['email'];
?>" required>
						</div>
					</div>
				</div>
				
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];
    
    echo '<meta http-equiv="refresh" content="0; url=done.php" />';
}
?>
				
				</div>
				<div class="panel-footer">
					<div class="row">
						<center>
							<a href="database.php" class="btn-default btn btn-flat"><i class="fa fa-arrow-left"></i> <?php
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