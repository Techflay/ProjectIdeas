<?php

require_once __DIR__ . '/db/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['email']) && isset($_GET['password'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];

    if (!empty($email) && !empty($password)) {
        $queryresult = mysqli_query($db->connect(), "SELECT * FROM `members` WHERE `email`='$email' AND `password`='$password'");

        if ($queryresult) {
            $rows = mysqli_num_rows($queryresult);

            if ($rows == 0) {
                $error = 'Invalid login credentials ';
                $response['message'] = $error;
                $response['success'] = 0;
                echo json_encode($response);
            } else if ($rows == 1) {

                //$susername=  mysql_result($queryresult,0,'username');
                $myArray = mysqli_fetch_array($queryresult);

                $response['success'] = 1;
                $response['message'] = "Successfully Logged in !";
                echo json_encode($response);
                //header("location:../index.php");
            }
        } else {
            $response['message'] = "Error in Query result";
            $response['success'] = 0;
            echo json_encode($response);
        }
    } else {
        $response['message'] = "Somefields empty";
        $response['success'] = 0;
        echo json_encode($response);
    }
} else {
    $response['message'] = "Somefields not set";
    $response['success'] = 0;
    echo json_encode($response);
}
?>
