<?php 
require_once '../includes/db.php'; // The mysql database connection script
if(isset($_GET['shareID'])){
$share_id = $_GET['shareID'];

$query="delete from share_comments where share_id='$share_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$query="delete from photo_favourites where share_id='$share_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$query="delete from share_favourites where share_id='$share_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$query="delete from user_share where share_id='$share_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$result = $mysqli->affected_rows;

echo $json_response = json_encode($result);
}
?>