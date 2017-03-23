<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
$user_id = $_SESSION['user_id'];

$friend_id = $_SESSION['friend_to_chat'];

require_once '../../includes/db.php'; // The mysql database connection script

$arr = array();
$profilepic = new stdClass();

$query = "SELECT user_id, name, fname, sname, profile FROM users WHERE user_id = '$friend_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
	while($row = $result->fetch_array()) {
		$picname = $row['profile'];
		
		if($picname  == ""){$im = "/none/sample.jpg";}
		else{$im = "/".$friend_id."/Profile/".$picname;}
		$profilepic->profilepic = $im;
		
		$arr[] = array_merge((array)$profilepic, (array)$row);
	}
}
# JSON-encode the response
echo $json_response = json_encode($arr);

?>