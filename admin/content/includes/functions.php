<?php 
function user_exist($input){
$connection = mysqli_connect('localhost', 'root', '', 'sam');
$sql ="SELECT * FROM users WHERE email ='$input'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result)>0) {
 	$err = "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <strong>User already exist</strong> Try again with another username!..
            </div>";
 	echo$err.'<br>';
  	}
  } 

function list_images(){
	$GLOBALS['images'] = array();
	$connection = mysqli_connect('localhost', 'root', '', 'sam');
	$sql ="SELECT * FROM images ORDER BY id DESC";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_assoc($result)){
		  $GLOBALS['images'][]= $row;
	}
}

function view_videos(){
	$GLOBALS['videos'] = array();
	$connection = mysqli_connect('localhost', 'root', '', 'sam');
	$sql ="SELECT * FROM video ORDER BY id DESC";
	$result = mysqli_query($connection, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$GLOBALS['video'][] = $row;
	}
}



?>
