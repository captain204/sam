<?php include("admin/content/includes/connection.php");?>
<?php include("admin/content/includes/functions.php");?>
<?php include("header_front.php");?>
<link rel="stylesheet" href="admin/content/css/admin.css" type="text/css" media="all"/>
<?php
view_videos();
?>
<div class="photo">
	<h3 id="myvideos"> My videos </h3>

<?php
foreach ($GLOBALS['video'] as $videos) {
?>
<p id="vid">
<a href="view_videos.php?id=<?php echo $videos['id']?>"><?php echo $videos['title']?></a><br>
<a href="view_videos.php?id=<?php echo $videos['id']?>">
<video width="320" height="240" controls> 
<source src="admin/content./videos/<?php echo $videos['name']?>" type ="video/mp4"></video></a><br>
<a href="download_video.php"><button type="submit" id="button" class="btn btn-primary"><span class="glyphicon glyphicon-download">Download</span> </button></a>
</p>
<?php
}
?>

</div>
<?php include("admin/content/includes/footer.php");?>
