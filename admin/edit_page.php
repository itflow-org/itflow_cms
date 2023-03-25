<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

if(isset($_GET['page_id'])){
	
	$page_id = intval($_GET['page_id']);
	
	$query = mysqli_query($mysqli,"SELECT * FROM pages WHERE page_id = $page_id");
	
	$row = mysqli_fetch_array($query);
	
	$title = htmlentities($row['page_title']);
	$content = htmlentities($row['page_content']);

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="pages.php">Pages</a></li>
		<li class="breadcrumb-item active"><?php echo $title; ?></li>
	</ol>
</nav>

<?php include("inc_alert.php"); ?>

<form action="post.php" method="post">
	<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
	<div class="form-group">
		<input type="text" class="form-control form-control-lg" name="title" placeholder="Title" value="<?php echo $title; ?>">
	</div>
	<div class="form-group">
		<textarea class="form-control" id="summernote" name="content"><?php echo $content; ?></textarea>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="edit_page">Save</button>
</form>

<?php 
	
}

include("footer.php");

?>