<?php

session_start();
require_once __DIR__ . '/db/db_connect.php';

$db = new DB_CONNECT();
$user_id = "2"; //$_SESSION['$user_id'];

if (isset($_POST['title']) && isset($_POST['proposal'])) {
    $title = $_POST['title'];
    $proposal = $_POST['proposal'];
    if (!empty($title) && !empty($proposal)) {

        if (!empty($_FILES['attachment']) && $_FILES['attachment']['size'] > 0) {
            $name = $_FILES['attachment']['name'];
            $path = "Attachments/";
            $tmp = $_FILES['attachment']['tmp_name'];
            if (move_uploaded_file($tmp, $path . $name)) {
                $queryresult = mysqli_query($db->connect(), "INSERT INTO `project_ideas`(`user_id`, `title` ,`proposal`,`proposal_attachement`) VALUES('$user_id','$title','$proposal', '$name')");
                if ($queryresult) {
                    $response['message'] = $error;
                    $response['success'] = 0;
                    echo json_encode($response);
                } else {
                    $response['message'] = "Error in Query result";
                    $response['success'] = 0;
                    echo json_encode($response);
                }
            } else {
                $error = "error 1<br>";
            }
        } else {
            $queryresult = mysqli_query($db->connect(), "INSERT INTO `project_ideas`(`user_id`, `title` ,`proposal`,`proposal_attachement`) VALUES('$user_id','$title','$proposal', '')");
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
    } else {
        $response['message'] = "You must provide title and proposal body, empty";
        $response['success'] = 0;
        echo json_encode($response);
    }
} else {
    $response['message'] = "You must provide title and proposal body, not set";
    $response['success'] = 0;
    echo json_encode($response);
}
?>