<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

if(isset($_GET['user_id'])){
	
	$user_id = intval($_GET['user_id']);
	
	$query = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = $user_id");
	
	$row = mysqli_fetch_array($query);
	
	$name = htmlentities($row['user_name']);
	$email = htmlentities($row['user_email']);
	$access = intval($row['user_access']);

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="users.php">Users</a></li>
		<li class="breadcrumb-item active"><?php echo $name; ?></li>
	</ol>
</nav>

<?php include("inc_alert.php"); ?>

<form action="post.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
	</div>
	
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password" placeholder="Leave blank for no change">
	</div>

	<div class="form-group">
		<label>Access</label>
		<select class="form-control" name="access">
			<option value="1" <?php if($access == 1){ echo "selected"; } ?>>User</option>
			<option value="9" <?php if($access == 9){ echo "selected"; } ?>>Admin</option>
		</select>
	</div>

	<button type="submit" class="btn btn-primary btn-block" name="edit_user">Save</button>
</form>

<?php 
	
}

include("footer.php");

?>