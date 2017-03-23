<?php 
session_start();
$response = array();
require_once '../../includes/db.php'; // The mysql database connection script

if (isset($_POST['name']) && isset($_POST['password'])) {	
	$name = $_POST['name'];
	$password = $_POST['password'];
	
$query="SELECT name FROM users WHERE name = '$name' AND password = '$password'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if($result->num_rows == 0) {
	 $response['message'] = 'Username or Password is wrong.';
     $response['success'] = 0;
     # JSON-encode the response           
     echo json_encode($response);
}else{
$query2="SELECT user_id FROM users WHERE name = '$name'";
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
if($result2->num_rows > 0) {
	while($row = $result2->fetch_array()) {
	$_SESSION['user_id'] = $row['user_id'];
	
	}
}
	$response['message'] = 'Success';
     $response['success'] = 1;
     # JSON-encode the response           
     echo json_encode($response);
}
}else{
	 $response['message'] = 'Not sent Username';
     $response['success'] = 0;
     # JSON-encode the response           
     echo json_encode($response);
}
?>
