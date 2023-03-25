<?php
	
include("../config.php");

if(isset($_POST['login'])) {
  
	session_start();

    $email = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['email'])));
    $password = trim($_POST['password']);

    $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_email = '$email' AND user_access > 0");
    $row = mysqli_fetch_array($sql);
    if(password_verify($password, $row['user_password'])) {
        $_SESSION['logged'] = TRUE;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_email'] = $row['user_email'];
        $_SESSION['user_access'] = $row['user_access'];
        header("Location: index.php");
    }else{
    	$_SESSION['response'] = "Incorrect username or password.";
    	header("Location: login.php");
    }
}

if(isset($_POST['forgot_password'])){
  
	$email = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['email'])));

	$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_email = '$email'");

	if(mysqli_num_rows($sql) == 1){
		$row = mysqli_fetch_array($sql);

		$user_id = $row['user_id'];
		
		function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	    	$randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
		}

		$token = generateRandomString();
		
		$url = "https://" . $_SERVER['HTTP_HOST'] . "/" . basename(__DIR__);

		mysqli_query($mysqli,"UPDATE users SET user_token = '$token', user_token_date = UNIX_TIMESTAMP() + 1800 WHERE user_id = $user_id");

		mail("$email","Password Reset Request","$url/reset_password.php?user_id=$user_id&token=$token");
		  
		$_SESSION['response'] = "We just sent a password reset link to your email!";

		header("Location: login.php");

	}
}

if(isset($_POST['reset_password'])){
  
	$user_id = intval($_POST['user_id']);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	mysqli_query($mysqli,"UPDATE users SET user_password = '$password', user_token = NULL WHERE user_id = $user_id");

	$_SESSION['response'] = "Password has been reset please login with you new password.";
		  
	header("Location: login.php");

}
