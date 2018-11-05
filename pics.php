<?php include("admin/content/includes/connection.php");?>
<?php include("admin/content/includes/functions.php");?>
<?php include("header_front.php");?>
<link rel="stylesheet" href="admin/content/css/admin.css" type="text/css" media="all"/>

<?php 
list_images();

?>
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
	<img src="admin/content./img/<?php echo $image['name']?>"></a><br>
	<a href="download_image.php"><button type="download" id="button" class="btn btn-primary"><span class="glyphicon glyphicon-download">Download</span> </button></a>
	</p>
 	<?php
 	}
 	?>
 						 	
 	</div>

</div>

<?php include("admin/content/includes/footer.php");?>