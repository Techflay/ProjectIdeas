<?php 
session_start();
$user_id = $_SESSION['user_id'];

require_once '../includes/db.php'; // The mysql database connection script
if(isset($_GET['shareID'])){
$shareID = $_GET['shareID'];
		
$queryE = "SELECT `share_id`, `favouriter_id` FROM `share_favourites` WHERE share_id = '$shareID' AND favouriter_id = '$user_id'";
$resultE = $mysqli->query($queryE) or die($mysqli->error.__LINE__);

if($resultE->num_rows > 0) {
	$query="DELETE FROM `share_favourites` WHERE share_id = '$shareID' AND favouriter_id = '$user_id'";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$result = $mysqli->affected_rows;
echo $json_response = json_encode($result);
}else{
	$query="INSERT INTO `share_favourites`(`share_id`, `favouriter_id`) VALUES ('$shareID', '$user_id')";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$result = $mysqli->affected_rows;
echo $json_response = json_encode($result);
}
}
?>