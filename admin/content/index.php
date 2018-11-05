<?php include("includes/header_two.php");?>
<?php include("includes/connection.php");?>
<?php session_start()?>
<?php 
	
	if (isset($_POST['submit'])) {
		
		$username = trim(htmlspecialchars(strtolower($_POST['username'])));
		$password = trim(htmlspecialchars(strtolower($_POST['password'])));	

		if (empty($username) || empty($password)) {
			echo "One or more fields cannot be empty";
		}else{
		$sql ="SELECT * FROM users WHERE username ='$username' OR email ='$username'";
		$result = mysqli_query($connection, $sql);
		if (mysqli_num_rows($result)<1) {	
			echo "Invalid username or password";
		} else{

	 	while ($row = mysqli_fetch_assoc($result)) {
	 			$user_password = $row['password'];
	 			if ($password == $user_password) {
	 				header("Location:admin.php");
	 				} else{

	 					echo "Enter a valid username and password";
	 				}
	 		

	 			}
	 	

	 		}
	 

	
		}


}		


?>


<div class="cntainer-fluid" id="login">
<form action="index.php" method="post" role="" id="form">
<div class="form-group col-md-6 offset-3">
	<div id="legend">
		<legend>Login</legend>
	</div>
 <div id="content">
   <label for="username" id="label">Username</label>
 	<input type="text" name="username" class="form-control" placeholder="Enter username or email">
 </div>
 <div id="content">
 	<label for="password" id="label"> Password </label>
 	<input type="password" name="password" class="form-control" placeholder="Enter your password">
 </div>
 <button type="submit" name="submit" id="button" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>Submit</button>	
</div>	
</form>
</div>
<?php include("includes/footer.php");?>