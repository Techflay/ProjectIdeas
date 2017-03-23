<?php

session_start();
$response = array();
require_once 'db.php'; // The mysql database connection script

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT email FROM members WHERE email = '$email' AND password = '$password'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);

    if ($result->num_rows == 0) {
        $response['message'] = 'Email or Password is wrong.';
        $response['success'] = 0;
        # JSON-encode the response           
        echo json_encode($response);
    } else {
        $query2 = "SELECT user_id FROM members WHERE email = '$email'";
        $result2 = $mysqli->query($query2) or die($mysqli->error . __LINE__);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_array()) {
                $_SESSION['user_id'] = $row['user_id'];
            }
        }
        $response['message'] = 'Success';
        $response['success'] = 1;
        # JSON-encode the response           
        echo json_encode($response);
    }
} else {
    $response['message'] = 'Not sent Email';
    $response['success'] = 0;
    # JSON-encode the response           
    echo json_encode($response);
}
?>
