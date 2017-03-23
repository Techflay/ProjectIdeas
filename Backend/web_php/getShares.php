<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
$user_id = $_SESSION['user_id'];

require_once '../includes/db.php'; // The mysql database connection script

$query1 = "SELECT * FROM `friendship_master` WHERE `follower_id` = '$user_id'";
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
//$array = array("");
$posts_from = "";
if($result1->num_rows > 0) {
	while($row1 = $result1->fetch_array()) {
	//array_push($array, $row1['follow_id']);
	$posts_from .= " OR `user_id` = '".$row1['follow_id']."' ";
}
}
//array_push($array, $user_id);


$arr = array(); $arrfav = array();
$userdetails = array();

$logeduser = new stdClass();
$favcount = new stdClass();
$favbyuser = new stdClass();
$commcount = new stdClass();
$Pfavcount = new stdClass();
$Pfavbyuser = new stdClass();
$image = new stdClass();
$profilepic = new stdClass();

$query="SELECT share_id, user_id, share_text, share_feeling, share_time FROM user_share WHERE `user_id` = '$user_id' ".$posts_from." ORDER BY share_id DESC LIMIT 0, 100";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
	while($row = $result->fetch_array()) {
		//if(array_search($row['user_id'],$array) == TRUE ){
			$sharer_id = $row['user_id'];
			$share_id = $row['share_id'];
			
			//getting user real name using his user_id
			$getuser="SELECT user_id, name, fname, sname, profile FROM users WHERE user_id = '$sharer_id' ";
			$resultuser = $mysqli->query($getuser) or die($mysqli->error.__LINE__);
			$rowuser = $resultuser->fetch_array();
			
			$picname = $rowuser['profile'];
			
			//getting number of comments in this post
			$queryC = "SELECT * FROM `share_comments` WHERE share_id = '$share_id'";
			$resultC = $mysqli->query($queryC) or die($mysqli->error.__LINE__);
			$countC = 0;
			while($rowC = $resultC->fetch_array()){$countC++;}
			
			//getting number of likes in this post
			$queryF = "SELECT * FROM `share_favourites` WHERE share_id = '$share_id'";
			$resultF = $mysqli->query($queryF) or die($mysqli->error.__LINE__);
			$countF = 0;
			while($rowF = $resultF->fetch_array()){$countF++;}
			
			//checking if this user has liked this post
			$queryF1 = "SELECT * FROM `share_favourites` WHERE share_id = '$share_id' AND favouriter_id = '$user_id'";
			$resultF1 = $mysqli->query($queryF1) or die($mysqli->error.__LINE__);
			$countF1 = 0;
			while($rowF1 = $resultF1->fetch_array()){$countF1++;}
			
			//getting number of likes in this photo
			$queryP = "SELECT * FROM `photo_favourites` WHERE share_id = '$share_id'";
			$resultP = $mysqli->query($queryP) or die($mysqli->error.__LINE__);
			$countP = 0;
			while($rowP = $resultP->fetch_array()){$countP++;}
			
			//checking if this user has liked this photo
			$queryP1 = "SELECT * FROM `photo_favourites` WHERE share_id = '$share_id' AND favouriter_id = '$user_id'";
			$resultP1 = $mysqli->query($queryP1) or die($mysqli->error.__LINE__);
			$countP1 = 0;
			while($rowP1 = $resultP1->fetch_array()){$countP1++;}
			
				$logeduser->loged = $user_id;
				$favcount->favC = $countF;
				$favbyuser->favbyusr = $countF1;
				$commcount->commC = $countC;
				$Pfavcount->PfavC = $countP;
				$Pfavbyuser->Pfavbyusr = $countP1;
				
				//$im = file_get_contents("3.jpg");
				//$image->image = base64_encode($im);
				
				if($picname  == ""){$im = "/none/sample.jpg";}
				else{$im = "/".$sharer_id."/Profile/".$picname;}
				$profilepic->profilepic = $im;
				
			$arr[] = array_merge((array)$profilepic, (array)$logeduser, (array)$rowuser, (array)$commcount, (array)$favcount, (array)$favbyuser,(array)$Pfavcount, (array)$Pfavbyuser, $row);
		
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>