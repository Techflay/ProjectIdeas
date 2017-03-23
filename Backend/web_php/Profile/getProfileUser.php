<?php 
session_start();
if(isset($_GET['id'])){
		$_SESSION['user_profile'] = $_GET['id'];
	}
$user_id = $_SESSION['user_id'];

$user_profile = $_SESSION['user_profile'];

require_once '../../includes/db.php'; // The mysql database connection script

$pic = new stdClass();

			//getting user real name using his user_id
			$getuser="SELECT user_id, name, fname, sname, profile, status, time FROM users WHERE user_id = '$user_profile' ";
			$resultuser = $mysqli->query($getuser) or die($mysqli->error.__LINE__);
			$rowuser = $resultuser->fetch_array();
			$picname = $rowuser['profile'];
				
				if($picname  == ""){$im = "../../ImageUploads/none/sample.jpg";}
				else{$im = "../../ImageUploads/".$user_profile."/Profile/".$picname;}
				$pic->profilepic = $im;
				
			$arr[] = array_merge((array)$pic, (array)$rowuser);
			

# JSON-encode the response
echo $json_response = json_encode($arr);
?>