<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'users';
    $query = mysqli_query($connect, "DELETE FROM `$table` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-users"></i> Users</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Users</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
if (isset($_POST['add'])) {
    $table    = $prefix . 'users';
    $username = addslashes($_POST['username']);
    $email    = addslashes(htmlspecialchars($_POST['email']));
    $password = hash('sha256', $_POST['password']);
    
    $queryvalid = mysqli_query($connect, "SELECT * FROM `$table` WHERE username='$username' OR email='$email' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
        echo '
		<div class="callout callout-warning">
                <p><i class="fa fa-info-circle"></i> The entered <strong>Username / E-Mail Address</strong> is already used by other user.</p>
        </div>
    ';
    } else {
        $query = mysqli_query($connect, "INSERT INTO `$table` (username, email, password) VALUES('$username', '$email', '$password')");
    }
}
?>
                    
                <div class="row">                  
                    
				<div class="col-md-9">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Users</h3>
						</div>
						<div class="box-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Username</th>
                                            <th>E-Mail</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'users';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
                                            <td><img src="assets/img/avatar.png" width="25px" height="25px"> ' . $row['username'] . '</td>
                                            <td>' . $row['email'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i> Delete</a>
											</td>
										</tr>
';
}
?>   
								</tbody>
								</table>
                        </div>
                     </div>
                </div>
                    
				<div class="col-md-3">
<form class="form-horizontal" action="" method="post">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Add User</h3>
						</div>
				        <div class="box-body">
                               <div class="form-group">
									 <label class="col-sm-4 control-label">Username: </label>
									 <div class="col-sm-8">
								           <input type="text" name="username" class="form-control" required>
									 </div>
							   </div>
                               <div class="form-group">
									       <label class="col-sm-4 control-label">E-Mail Address: </label>
								           <div class="col-sm-8">
										   <input type="email" name="email" class="form-control" required>
									 </div>
				               </div>
                               <div class="form-group">
									<label class="col-sm-4 control-label">Password: </label>
									 <div class="col-sm-8">
										   <input type="password" name="password" class="form-control" required>
								     </div>
								</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-primary" name="add" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'users';
    $sql   = mysqli_query($connect, "SELECT * FROM `$table` WHERE id = '$id'");
    $row   = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=users.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=users.php">';
    }
?>
<form class="form-horizontal" action="" method="post">
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Edit User</h3>
						</div>
				        <div class="box-body">
                               <div class="form-group">
											<label class="col-sm-4 control-label">Username: </label>
											<div class="col-sm-8">
												<input type="text" name="username" class="form-control" value="<?php
    echo $row['username'];
?>" required>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-4 control-label">E-Mail Address: </label>
											<div class="col-sm-8">
												<input type="email" name="email" class="form-control" value="<?php
    echo $row['email'];
?>" required>
											</div>
										</div>
                                        <hr>
                                        <div class="form-group">
											<label class="col-sm-4 control-label">New Password: </label>
											<div class="col-sm-8">
												<input type="text" name="password" class="form-control">
											</div>
										</div>
                                        <br /><i>Fill this field only if you want to change the password.</i>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
    if (isset($_POST['edit'])) {
        $table    = $prefix . 'users';
        $username = addslashes($_POST['username']);
        $email    = addslashes(htmlspecialchars($_POST['email']));
        $password = hash('sha256', $_POST['password']);
        
        $query = mysqli_query($connect, "UPDATE `$table` SET username='$username', email='$email' WHERE id='$id'");
        if ($password != null) {
            $query = mysqli_query($connect, "UPDATE `$table` SET username='$username', email='$email', password='$password' WHERE id='$id'");
        }
        echo '<meta http-equiv="refresh" content="0;url=users.php">';
    }
}
?>
				</div>
				</div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<?php
footer();
?>