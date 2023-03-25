<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php"); 
include("inc_alert.php");

?>

<h1>Settings</h1>

<hr>

<form action="post.php" method="post">
	<div class="form-group">
		<label>Site Name</label>
		<input type="text" class="form-control" name="site_name" value="<?php echo $config_site_name; ?>">
	</div>

	<div class="form-group">
		<label>Site Author</label>
		<input type="text" class="form-control" name="author" value="<?php echo $config_meta_author; ?>">
	</div>

	<div class="form-group">
		<label>Site Description</label>
		<textarea class="form-control" name="description"><?php echo $config_meta_description; ?></textarea>
	</div>

	<div class="form-group">
		<label>Theme</label>
		<input type="text" class="form-control" name="theme" value="<?php echo $config_theme; ?>">
	</div>

	<div class="form-group">
		<label>Date/Time Format</label>
		<input type="text" class="form-control" name="date_time_format" value="<?php echo $config_date_time_format; ?>">
	</div>

	<h3>Modules</h3>

	<hr>

	<div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" name="docs_enabled" value=1 <?php if($config_module_docs_enabled == 1) { echo "checked"; } ?> >
	    <label class="form-check-label">Enable Docs</label>
	</div>

	<div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" name="forum_enabled" value=1 <?php if($config_module_forum_enabled == 1) { echo "checked"; } ?> >
	    <label class="form-check-label">Enable Forum</label>
	</div>

	<div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" name="blog_enabled" value=1 <?php if($config_module_blog_enabled == 1) { echo "checked"; } ?> >
	    <label class="form-check-label">Enable Blog</label>
	</div>

	<div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" name="user_registration_enabled" value=1 <?php if($config_module_user_registration_enabled == 1) { echo "checked"; } ?> >
	    <label class="form-check-label">Enable User Registration</label>
	</div>

	<hr>

	<button type="submit" class="btn btn-primary btn-block" name="edit_settings">Save</button>
</form>

<?php 

include("footer.php");

?>