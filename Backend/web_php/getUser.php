<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
$user_id = $_SESSION['user_id'];

require_once '../includes/db.php'; // The mysql database connection script

$pic = new stdClass();

			//getting user real name using his user_id
			$getuser="SELECT user_id, name, fname, sname, profile FROM users WHERE user_id = '$user_id' ";
			$resultuser = $mysqli->query($getuser) or die($mysqli->error.__LINE__);
			$rowuser = $resultuser->fetch_array();
			$picname = $rowuser['profile'];
				
				if($picname  == ""){$im = "none/sample.jpg";}
				else{$im = "/".$user_id."/Profile/".$picname;}
				$pic->profilepic = $im;
				
			$arr[] = array_merge((array)$pic, (array)$rowuser);
			

# JSON-encode the response
echo $json_response = json_encode($arr);
?>