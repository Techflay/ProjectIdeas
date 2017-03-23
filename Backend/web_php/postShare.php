<?php 
session_start();
$user_id = $_SESSION['user_id'];
$response = array();

require_once '../includes/db.php'; // The mysql database connection script
if(isset($_POST['share'])){
$share_text = $_POST['share'];
$share_pic = "";
$share_feeling = $_POST['sharefeeling'];
if(!empty($_FILES['image'])&& $_FILES['image']['size']>0){
		$to ='/uploads';
		
		$photo= $_FILES['image']['name'];
		
		$size = $_FILES['image']['size'];
		
		$type = $_FILES['image']['type'];
		
		$tmp = $_FILES['image']['tmp_name'];
		
		if(count($_FILES) > 0) {
		
		if (move_uploaded_file($tmp,$to.$photo)) {				
			$share_pic = $photo;			
		}
		}
}
	//$share_feeling = $_GET['feeling'];	
$query="INSERT INTO user_share(user_id, share_text, share_pic, share_feeling, share_priority)  VALUES ('$user_id', '$share_text', '$share_pic', '$share_feeling', '')";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$result = $mysqli->affected_rows;

//echo $json_response = json_encode($result);
$response['message'] = 'Sent Successfully';
     $response['success'] = 1;
     # JSON-encode the response           
     echo json_encode($response);
}else{
	
	 $response['message'] = 'share is not set ';
     $response['success'] = 0;
     # JSON-encode the response           
     echo json_encode($response);
}
?>