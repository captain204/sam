<?php include("includes/header_two.php");?>
<?php include("includes/connection.php");?>
<?Php include("includes/functions.php");?>
<?php
list_images()

?>
<a href="admin.php"><button type="submit" id="button" class="btn btn-primary">
<span></span>Back</button></a>
	<div class="photo">
	<h3 id="myphotos">My Photos</h3>
	
 			
 	<?php 
 	foreach ($GLOBALS['images'] as $image) {
 		?>
 	<p id="pics">
 	<style type="text/css"> </style>
 	<a href="view_images.php?id=<?php echo $image['id'];?>">
 	<?php echo $image['title']; ?></a><br>
 	<a href="view_images.php?id=<?php echo $image['id']?>">
	<img src="./img/<?php echo $image['name']?>"></a><br>
	<a href="edit_image.php"><button type="submit" id="button" class="btn btn-primary"><span class="glyphicon ">Edit</span> </button></a>
	<a href="delete_image.php?id=<?php echo $image['id']?>"><button type="submit" id="button" class="btn btn-primary"><span class="glyphicon "></span>Delete</button></a>
	</p>
 	<?php
 	}
 	?>
 						 	
 	</div>
<?php include("includes/footer.php");?>