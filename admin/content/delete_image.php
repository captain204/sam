<?php include("includes/connection.php");?> 
<?php
if (isset($_GET['id'])) {
	
	$id = $_GET['id'];
	$sql ="DELETE FROM images WHERE id ='$id'";
	$result = mysqli_query($connection, $sql);
	header("Location:view_images.php");
}


?>