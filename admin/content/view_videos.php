<?php include("includes/header_two.php");?>
<?php include("includes/connection.php");?>
<?Php include("includes/functions.php");?>
<?php
	view_videos();
?>
<a href="admin.php"><button type="submit" id="button" class="btn btn-primary">
<span></span>Back</button></a>
<div class="photo">
	<h3 id="myvideos"> My videos </h3>

<?php
foreach ($GLOBALS['video'] as $videos) {
?>
<p id="vid">
<a href="view_videos.php?id=<?php echo $videos['id']?>"><?php echo $videos['title']?></a><br>
<a href="view_videos.php?id=<?php echo $videos['id']?>">
<video width="320" height="240" controls> 
<source src="./videos/<?php echo $videos['name']?>" type ="video/mp4"></video></a><br>
<a href="edit_video.php"><button type="submit" id="button" class="btn btn-primary"><span class="glyphicon ">Edit</span> </button></a>
	<a href="delete_videos.php?id=<?php echo $videos['id']?>"><button type="submit" id="button" class="btn btn-primary"><span class="glyphicon "></span>Delete</button></a>

</p>
<?php
}
?>

</div>

<?php include("includes/footer.php");?>