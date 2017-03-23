<?php 
session_start();

if(isset($_POST['shareID'])){
									
$_SESSION['commentShare'] = $_POST['shareID'];	

}
?>