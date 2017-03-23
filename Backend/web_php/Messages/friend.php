<?php 
session_start();
if(isset($_GET['userID'])){
$_SESSION['friend_to_chat'] = $_GET['userID'];
}