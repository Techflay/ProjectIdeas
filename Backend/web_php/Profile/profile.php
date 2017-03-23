
<?php
session_start();
	if(isset($_GET['id'])){
		$_SESSION['user_profile'] = $_GET['id'];
	}
?>