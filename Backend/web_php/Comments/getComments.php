<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
$user_id = $_SESSION['user_id'];

$share_id = $_SESSION['share_to_comment'];

require_once '../../includes/db.php'; // The mysql database connection script

$arr = array(); $count = 0;
$number = new stdClass();
$profilepic = new stdClass();
$logeduser = new stdClass();

	$query1 = "SELECT * FROM share_comments WHERE share_id = '$share_id'";
	$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
	if($result1->num_rows > 0) {
		while($row1 = $result1->fetch_array()) {
			$commenter_id = $row1['user_id'];
			$count++;
			$number->number = $count;
			
			//getting user real name using his user_id
			$getuser="SELECT user_id, name, profile FROM users WHERE user_id = '$commenter_id' ";
			$resultuser = $mysqli->query($getuser) or die($mysqli->error.__LINE__);
			$rowuser = $resultuser->fetch_array();
			
			$picname = $rowuser['profile'];
			$logeduser->loged = $user_id;
				
			if($picname  == ""){$im = "/none/sample.jpg";}
			else{$im = "/".$commenter_id."/Profile/".$picname;}
			$profilepic->profilepic = $im;
			
			$arr[] = array_merge((array)$profilepic, (array)$row1, (array)$logeduser, (array)$number, (array)$rowuser);
		}	
	}
	
# JSON-encode the response
echo $json_response = json_encode($arr);

?>