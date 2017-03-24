<?php

require_once __DIR__ . '/db/db_connect.php';

$db = new DB_CONNECT();

if (isset($_GET['phone']) && isset($_GET['email']) && isset($_GET['password'])  && isset($_GET['email'])) {
    $phone=$_GET['phone'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $c_password = $_GET['c_password'];

    if (!empty($phone) && !empty($email) && !empty($password) && !empty($c_password)) {
        if($password == $c_password){
            //Let us select all emails from the database
             $queryemail = mysqli_query($db->connect(), "SELECT `email`  FROM `members` WHERE `email`='$email'");
             if($queryemail->num_rows >0){
                 $response['message'] =" The email is already Registered";
                 $response['success'] = 0;
                 echo json_encode($response);
                 
             }
             else{
                  //insertion takes place.
                $queryresult = mysqli_query($db->connect(), "INSERT INTO `members`(`email` ,`phone`,`password`) VALUES('$email','$phone','$password')");

                 if ($queryresult) {            
                $response['message'] = $error;
                $response['success'] = 0;
                echo json_encode($response);
            
                } else {
                    $response['message'] = "Error in Query result";
                    $response['success'] = 0;
                    echo json_encode($response);
                }
             }
            
        
        
        }
     else {
         $response['message'] = "Passwords Do not Match";
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
