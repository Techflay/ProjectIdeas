<?php 
session_start();
$user_id = $_SESSION['user_id'];

require_once '../includes/db.php'; // The mysql database connection script
								 
$shareID = $_SESSION['commentShare'];

$arr = array(); $count = 0;
$number = new stdClass();
$comments = array();
$query = "SELECT * FROM user_share WHERE share_id = '$shareID'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
	while($row = $result->fetch_array()) {
		$arr[] = $row;
		
		$query1 = "SELECT * FROM share_comments WHERE share_id = '$shareID'";
		$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
		if($result1->num_rows > 0) {
			while($row1 = $result1->fetch_array()) {
				$comments[] = $row1;
		$count++;
			}	
		}
	}
}
$number->number = $count;
$arr[] = array_merge((array)$comments, (array)$number);
# JSON-encode the response
echo $shareID;//$json_response = json_encode($arr);

?>