<?php
	
	session_start();

  if(isset($_SESSION['logged'])){

  	$session_user_id = $_SESSION['user_id'];

	$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = $session_user_id");
	$row = mysqli_fetch_array($sql);
	$session_user_email = $row['user_email'];
	$session_user_name = $row['user_name'];
	$session_user_access = $row['user_access'];
	$session_user_ip = strip_tags(mysqli_real_escape_string($mysqli,$_SERVER['HTTP_X_FORWARDED_FOR']));
	$session_user_agent = strip_tags(mysqli_real_escape_string($mysqli,$_SERVER['HTTP_USER_AGENT']));
	}

?>