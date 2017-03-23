<?php 
session_start();
$user_id = $_SESSION['user_id'];

$share_id = $_SESSION['share_to_comment'];

require_once '../../includes/db.php'; // The mysql database connection script

$arr = array();
$profilepic = new stdClass();

$query = "SELECT * FROM user_share WHERE share_id = '$share_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
	while($row = $result->fetch_array()) {
		$sharer_id = $row['user_id'];
			
		//getting user real name using his user_id
		$getuser="SELECT user_id, name, fname, sname, profile FROM users WHERE user_id = '$sharer_id' ";
		$resultuser = $mysqli->query($getuser) or die($mysqli->error.__LINE__);
		$rowuser = $resultuser->fetch_array();
		
		$picname = $rowuser['profile'];
		
		if($picname  == ""){$im = "/none/sample.jpg";}
		else{$im = "/".$sharer_id."/Profile/".$picname;}
		$profilepic->profilepic = $im;
		
		$arr[] = array_merge((array)$profilepic, (array)$row, (array)$rowuser);
	}
}
# JSON-encode the response
echo $json_response = json_encode($arr);

?>