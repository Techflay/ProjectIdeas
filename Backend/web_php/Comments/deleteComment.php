<?php 
require_once '../../includes/db.php'; // The mysql database connection script
if(isset($_GET['commentID'])){
$comment_id = $_GET['commentID'];

$query="delete from share_comments where comment_id='$comment_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$result = $mysqli->affected_rows;

echo $json_response = json_encode($result);
}
?>