<?php

include("../config.php");
include("header.php");

?>

<h1 class="text-center">Admin Login</h1>

<?php 

	if(isset($_SESSION['response'])){
		echo htmlentities($_SESSION['response']);
	}

?>

<form action="unprotected_post.php" method="post">

	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email" autofocus>
	</div>
	
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>
	
	<button type="submit" class="btn btn-primary mr-2" name="login">Login</button>
	<?php if($config_module_forgot_password_enabled = 1){ ?>
		<a href="forgot_password.php">Forgot Password</a>
	<?php } ?>

</form>

<?php 

include("footer.php");

?>