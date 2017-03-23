<?php 
session_start();
if(isset($_GET['shareID'])){
$_SESSION['share_to_comment'] = $_GET['shareID'];
}