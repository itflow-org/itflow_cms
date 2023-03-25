<?php

include("../config.php");
include("header.php");	

session_start();

?>

<h1 class="text-center">Forgot Password</h1>

<?php include("inc_alert.php"); ?>

<form action="unprotected_post.php" method="post">
	
	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email" autofocus>
	</div>
	
	<button type="submit" class="btn btn-primary" name="forgot_password">Send</button>
	<a href="login.php" class="text-secondary float-right">Back to login</a>

</form>

<?php 

include("footer.php");

?>