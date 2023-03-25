<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

if(isset($_GET['blog_id'])){
	
	$blog_id = intval($_GET['blog_id']);
	
	$query = mysqli_query($mysqli,"SELECT * FROM blog WHERE blog_id = $blog_id");
	
	$row = mysqli_fetch_array($query);
	
	$title = htmlentities($row['blog_title']);
	$content = htmlentities($row['blog_content']);

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="blogs.php">Blog Posts</a></li>
		<li class="breadcrumb-item active"><?php echo $title; ?></li>
	</ol>
</nav>

<?php 

	if(isset($_SESSION['response'])){
		echo htmlentities($_SESSION['response']);
		$_SESSION['response'] = '';
	}

?>

<form action="post.php" method="post">
	<input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
	<div class="form-group">
		<input type="text" class="form-control form-control-lg" name="title" value="<?php echo $title; ?>">
	</div>
	<div class="form-group">
		<textarea class="form-control" id="summernote" name="content"><?php echo $content; ?></textarea>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="edit_blog">Save</button>
</form>

<?php 
	
}

include("footer.php");

?>