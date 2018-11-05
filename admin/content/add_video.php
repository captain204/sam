<?php include("includes/header.php");?>
<?php include("includes/connection.php");?>
<?php include("includes/functions.php");?>

<?php 
	if (isset($_POST['submit'])) {
		
		$files = $_FILES["vid"];
		$video_name =$_FILES['vid']['name'];
		$vid_temp_location = $_FILES["vid"]['tmp_name'];
		$move_vid = move_uploaded_file($vid_temp_location, "./videos/$video_name");

		$title =trim(htmlspecialchars(strtolower($_POST['title']))); 
		if (empty($title)) {
			$err  = "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <strong>One or more fields empty! </strong>All fields must be completed
            </div>";
            echo $err;
		} else{

		$sql ="INSERT into video VALUES('', '$video_name', '$title', '')";
		$result =  mysqli_query($connection, $sql);
		$success = '<div class="alert alert-success" id="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Video added succesfully!</strong> 
                         </div>';
		echo $success;
		}
	}

?>
<form action="" method="post" role="" enctype="multipart/form-data">
 <div class="form-group col-md-4 offset-3">
 	<legend>Add video </legend>
 	 <label> Upload video </label>
 	 	<input type="file" name ="vid" class="form-control">
 	 <label>Description</label>
 		 <input type="text" name="title" class="form-control" placeholder="Enter text">
 	 <button type="submit" name="submit" value="submit" id ="button" class="form-control">
 	  <span class="glyphicon glyphicon-send"> Add video</span>
 	 </button>	
 </div>
</form>
<?php include("includes/footer.php");?>