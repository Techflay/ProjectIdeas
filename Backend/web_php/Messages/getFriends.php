<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
$user_id = $_SESSION['user_id'];

require_once '../../includes/db.php'; // The mysql database connection script

$arr = array();
$profilepic = new stdClass();

$query = "SELECT * FROM `friendship_master` WHERE `follow_id` = '$user_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
	while($row = $result->fetch_array()) {
		$follow_id = $row['follower_id'];
		//check if you follow them;
		$query2 = "SELECT * FROM `friendship_master` WHERE `follow_id` = '$follow_id' AND `follower_id` = '$user_id' ";
		$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
		while($rowF = $result2->fetch_array()){
			//get names
			$query1 = "SELECT user_id, name, fname, sname, profile  FROM `users` WHERE `user_id` = '$follow_id' ";
			$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
			if($result1->num_rows > 0) {
				while($row1 = $result1->fetch_array()) {
				$picname = $row1['profile'];
				
				if($picname  == ""){$im = "/none/sample.jpg";}
				else{$im = "/".$follow_id."/Profile/".$picname;}
				$profilepic->profilepic = $im;
			
				$arr[] = array_merge((array)$profilepic,  $row1);
			}
					
			}
		}
		
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>