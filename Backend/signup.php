<?php

session_start();
$response = array();
require_once 'db.php'; // The mysql database connection script

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $query = "SELECT email FROM members WHERE email = '$email'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);

    if ($result->num_rows > 0) {
        $response['message'] = 'Email is taken';
        $response['success'] = 0;
        # JSON-encode the response  

        echo json_encode($response);
    } else {

        $query1 = "INSERT INTO `members`(`email`, `phone`, `password`) VALUES ('$email', '$phone', '$password')";
        $result1 = $mysqli->query($query1) or die($mysqli->error . __LINE__);

        $result1 = $mysqli->affected_rows;
        $response['success'] = 0;

        $query2 = "SELECT user_id FROM members WHERE email = '$email'";
        $result2 = $mysqli->query($query2) or die($mysqli->error . __LINE__);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_array()) {
                $_SESSION['user_id'] = $row['user_id'];

                $path = "Attachments/" . $row['user_id'];
                mkdir($path, 0, true);
            }
        }
        $response['message'] = 'Success';
        $response['success'] = 1;
        # JSON-encode the response           
        echo json_encode($response);
    }
} else {
    $response['message'] = 'Not sent Username';
    $response['success'] = 0;
    # JSON-encode the response           
    echo json_encode($response);
}
?>