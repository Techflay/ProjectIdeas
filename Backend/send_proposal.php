<?php

session_start();
$response = array();
require_once 'db.php'; // The mysql database connection script
$user_id = $_SESSION['user_id'];
if (isset($_POST['title']) && isset($_POST['proposal'])) {
    $title = $_POST['title'];
    $proposal = $_POST['proposal'];
    $attachment = $_POST['attachment'];

    $imgData = NULL;
    if (!empty($_FILES['attachment']) && $_FILES['attachment']['size'] > 0) {
        $ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        $size = $_FILES['attachment']['size'];
        if ($ext == "JPG" || $ext == "jpg" || $ext == "JPEG" || $ext == "jpeg" || $ext == "PNG" || $ext == "png" || $ext == "GIF" || $ext == "gif") {
            if ($size <= 3184400) {
                if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
                    $imgData = addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
                    
                    mysql_query("INSERT INTO `user_share`(`user_id`, `share_text`, `share_pic`, `share_priority`) VALUES ( '$user_id', '$share_text', '$imgData', 'public')") or die(mysql_error());

                    mysql_query("UPDATE `show_shares` SET `min`= '0',`max`= '10' WHERE `user_id` = '$user_id'");
                    $_SESSION['invalid_pic'] = "";
                    header('location:../Home');
                }
            } else {
                $_SESSION['invalid_pic'] = "<center><font color='red'>Only MAX 3MB allowed</font></center>";
                header('location:../Home');
            }
        } else {
            $_SESSION['invalid_pic'] = "<center><font color='red'>Only GIF, JPEG, JPG or PNG allowed</font></center>";
            header('location:../Home');
        }
    } else {
        mysql_query("INSERT INTO `user_share`(`user_id`, `share_text`, `share_pic`, `share_priority`) VALUES ( '$user_id', '$share_text', '$imgData', 'public')") or die(mysql_error());

        mysql_query("UPDATE `show_shares` SET `min`= '0',`max`= '10' WHERE `user_id` = '$user_id'");
        $_SESSION['invalid_pic'] = "";
        unset($_SESSION['edit_share_id']);
        header('location:../Home');
    }
} else {
    $response['message'] = 'Not sent Propsal';
    $response['success'] = 0;
    # JSON-encode the response           
    echo json_encode($response);
}
?>
