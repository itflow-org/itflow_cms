<?php

	session_start();
	
	if(!isset($_SESSION['user_id'])){
	    header("Location: ../logout.php");
	    die;
	}

	if($_SESSION['user_access'] == 1){
	    header("Location: ../logout.php");
	    die;
	}

	$session_user_id = $_SESSION['user_id'];
	$session_user_access = $_SESSION['user_access'];

	$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = $session_user_id");
	$row = mysqli_fetch_array($sql);
	
	$session_user_email = $row['user_email'];
	$session_username = $row['user_name'];
	
	$session_user_ip = strip_tags(mysqli_real_escape_string($mysqli,$_SERVER['HTTP_X_FORWARDED_FOR']));
	$session_user_agent = strip_tags(mysqli_real_escape_string($mysqli,$_SERVER['HTTP_USER_AGENT']));

?>
