<?php include("includes/header.php");?>
<?php include("includes/connection.php");?>
<?php include("includes/functions.php");?>
<?php 
$success = $err = '';

if (isset($_POST['submit'])) {
	
	$file = $_FILES['img'];

	$image_name = $_FILES['img']['name'];

	/*echo $image_name;*/

	$image_temp_location = $_FILES["img"]["tmp_name"];

	$move_image = move_uploaded_file($image_temp_location, "./img/$image_name");

	$title = trim(strtolower($_POST['title']));

	if (empty($title)) {
		
		$err ="<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <strong>One or more fields empty! </strong>All felds must be completed
            </div>";

          /*echo $err;*/
	} else{

	$sql ="INSERT INTO images VALUES('', '$image_name', '$title')";

	$result = mysqli_query($connection, $sql);

	if (!$result) {
		
		echo "unable to upload image to db".mysqli_error();
	} else{

	$success = '<div class="alert alert-success" id="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Image added succesfully!</strong> 
                         </div>';
    /*echo $success;*/

		}

  	}
}
?>

<form action="add_image.php" method="post" role ="" enctype="multipart/form-data">
	<div class="form-group col-md-4 offset-3">
	<?php echo $err;?>
	<?php echo $success;?>
	 <legend>Upload image</legend>
	  <label for="img"> Choose image</label>
	    <input type="file" name="img" class="form-control">
	  <label for="description">Description</label>
	    <input type="text" name="title" class="form-control" placeholder="Enter text">
	 <button type="submit" name="submit" value="submit" id ="button" class="form-control">
	   <span class="glyphicon glyphicon-send"> Add image </span>	
	</button>
</div>
</form>

<?php include("includes/footer.php");?>

