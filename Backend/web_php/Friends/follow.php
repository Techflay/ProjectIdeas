<?php
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_GET['followID'])){
$follow_id = $_GET['followID'];
}
require_once '../../includes/db.php'; // The mysql database connection script
	
$query="INSERT INTO `friendship_master`(`follower_id`, `follow_id`) VALUES ('$user_id', '$follow_id')";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$result = $mysqli->affected_rows;

echo $json_response = json_encode($result);
?>