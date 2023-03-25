<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php"); 

if(isset($_GET['category_id'])){
	
	$category_id = intval($_GET['category_id']);
	
	$query = mysqli_query($mysqli,"SELECT * FROM categories WHERE category_id = $category_id");
	
	$row = mysqli_fetch_array($query);
	
	$name = htmlentities($row['category_name']);

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
		<li class="breadcrumb-item active"><?php echo $name; ?></li>
	</ol>
</nav>

<?php include("inc_alert.php"); ?>

<form action="post.php" method="post">
	<input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
	</div>

	<button type="submit" class="btn btn-primary btn-block" name="edit_category">Save</button>
</form>

<?php 
	
}

include("footer.php");

?>