<?php 
session_start();
$response = array();
require_once '../../includes/db.php'; // The mysql database connection script

if (isset($_POST['usrname']) && isset($_POST['pass'])) {
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$email = $_POST['email'];
$usrname = $_POST['usrname'];
$pass = $_POST['pass'];

$query="SELECT name FROM users WHERE name = '$usrname'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if($result->num_rows > 0) {
	 $response['message'] = 'Username is taken';
     $response['success'] = 0;
     # JSON-encode the response           
     echo json_encode($response);
}else{
	
$query1="INSERT INTO `users`(`name`, `password`, `fname`, `sname`, `email`) VALUES ('$usrname', '$pass', '$fname', '$sname', '$email')";
$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);

$result1 = $mysqli->affected_rows;
$response['success'] = 0;

$query2="SELECT user_id FROM users WHERE name = '$usrname'";
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
if($result2->num_rows > 0) {
	while($row = $result2->fetch_array()) {
	$_SESSION['user_id'] = $row['user_id'];
	
		$path = "../../ImageUploads/".$row['user_id']."/Profile/";
		$path2 = "../../ImageUploads/".$row['user_id']."/Shares/";
		mkdir($path, 0, true);
		mkdir($path2, 0, true);
		
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