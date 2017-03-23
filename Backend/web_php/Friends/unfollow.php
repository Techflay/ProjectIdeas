<?php
session_start();
$user_id = $_SESSION['user_id'];


if(isset($_GET['unfollowID'])){
$unfollow_id = $_GET['unfollowID'];
}
require_once '../../includes/db.php'; // The mysql database connection script
	
$query="DELETE FROM `friendship_master` WHERE  `follower_id` ='$user_id' AND `follow_id` ='$unfollow_id'";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$result = $mysqli->affected_rows;

echo $json_response = json_encode($result);
?>