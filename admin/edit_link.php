<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php"); 

if(isset($_GET['link_id'])){
	
	$link_id = intval($_GET['link_id']);
	
	$query = mysqli_query($mysqli,"SELECT * FROM links WHERE link_id = $link_id");
	
	$row = mysqli_fetch_array($query);
	
	$name = htmlentities($row['link_name']);
	$icon = htmlentities($row['link_icon']);
	$url = htmlentities($row['link_url']);
	$order = intval($row['link_order']);

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="links.php">Links</a></li>
		<li class="breadcrumb-item active"><?php echo $name; ?></li>
	</ol>
</nav>

<?php 

	if(isset($_SESSION['response'])){
		echo htmlentities($_SESSION['response']);
		$_SESSION['response'] = '';
	}

?>

<form action="post.php" method="post">
	<input type="hidden" name="link_id" value="<?php echo $link_id; ?>">
	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
	</div>

	<div class="form-group">
		<label>Icon</label>
		<input type="text" class="form-control" name="icon" value="<?php echo $icon; ?>">
	</div>

	<div class="form-group">
		<label>URL</label>
		<input type="text" class="form-control" name="url" value="<?php echo $url; ?>">
	</div>

	<div class="form-group">
		<label>Order</label>
		<input type="number" class="form-control" name="order" value="<?php echo $order; ?>">
	</div>

	<button type="submit" class="btn btn-primary btn-block" name="edit_link">Save</button>
</form>

<?php 
	
}

include("footer.php");

?>