<?php 
session_start();
$user_id = $_SESSION['user_id'];
$share_id = $_SESSION['share_to_comment'];

$response = array();

require_once '../../includes/db.php'; // The mysql database connection script
if(isset($_POST['comment'])){
$comment_text = $_POST['comment'];

$query="INSERT INTO share_comments(user_id, `share_id`, `comment`)  VALUES ('$user_id', '$share_id', '$comment_text')";
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