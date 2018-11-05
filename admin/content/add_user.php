<?php include("includes/header.php");?>
<?php include("includes/connection.php");?>
<?php include("includes/functions.php");?>

<?php
$err = $success = ''; 
if (isset($_POST['submit'])) {
	$username = trim(htmlspecialchars(strtolower($_POST['username'])));
	$password = trim(htmlspecialchars(strtolower($_POST['password'])));
	$email = trim(htmlspecialchars(strtolower($_POST['email'])));

	if (empty($username)||empty($password)||empty($email)) {
		$err ="<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <strong>One or more fields empty! </strong>All felds must be completed
            </div>";
;
		/*echo $err;*/
		user_exist($email);
		
	} else{
	 
	$sql ="INSERT INTO users VALUES('', '$username', '$password', '$email')";
	$result = mysqli_query($connection, $sql);
	if (!$result) {
			$err = "Unable to insert user to database";
		} else{
		$success ='<div class="alert alert-success" id="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>User added succesfully!</strong> 
                         </div>';
		
		} 
	}
}

?>
<form action="add_user.php" method="post" role =""> 
 <div class="form-group col-md-4 offset-3">
 	<?php echo $err;?>
 	<?php echo $success;?>
    <legend><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Add new admin</legend>
	 <label for="username">Username</label>

		<input type="text" name="username" class="form-control" placeholder="Enter name">

	  <label for="password"> Password </label>

		<input type="password" name="password" class="form-control" placeholder=" password">
		
	  <label for="email"> Email </label>

	  	<input type="text" name="email" class="form-control" placeholder="Enter admin email">
	 <button type ="submit" name="submit" value="submit" id="button" class="btn btn-primary">
	 	<span class="glyphicon glyphicon-send"></span> Submit </button>
	 
</div>
</form>
<?php include("includes/footer.php");?>
