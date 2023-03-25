<?php

include("../config.php");
include("check_login.php");
include("header.php");	
include("nav.php");

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="links.php">Links</a></li>
		<li class="breadcrumb-item active">New</li>
	</ol>
</nav>

<form action="post.php" method="post">
	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" placeholder="Name" required autofocus>
	</div>

	<div class="form-group">
		<label>Icon</label>
		<input type="text" class="form-control" name="icon" placeholder="Icon eg fab fa-google">
	</div>

	<div class="form-group">
		<label>URL</label>
		<input type="text" class="form-control" name="url" placeholder="URL with https://" required>
	</div>

	<div class="form-group">
		<label>Order</label>
		<input type="number" class="form-control" name="order" placeholder="Order number">
	</div>
	
	<button type="submit" class="btn btn-primary btn-block" name="add_link">Create</button>
</form>

<?php 

include("footer.php");

?>