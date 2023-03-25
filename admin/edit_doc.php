<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php"); 

if(isset($_GET['doc_id'])){
	
	$doc_id = intval($_GET['doc_id']);
	
	$query = mysqli_query($mysqli,"SELECT * FROM docs WHERE doc_id = $doc_id");
	
	$row = mysqli_fetch_array($query);
	
	$title = htmlentities($row['doc_title']);
	$content = htmlentities($row['doc_content']);
	$category_id = intval($row['doc_category_id']);

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="docs.php">Docs</a></li>
		<li class="breadcrumb-item active"><?php echo $title; ?></li>
	</ol>
</nav>

<?php include("inc_alert.php"); ?>

<form action="post.php" method="post">
	<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
	<div class="form-group">
		<input type="text" class="form-control form-control-lg" name="title" value="<?php echo $title; ?>">
	</div>
	<div class="form-group">
		<textarea class="form-control" id="summernote" name="content"><?php echo $content; ?></textarea>
	</div>
	<div class="form-group">	
		<select class="form-control form-control-lg" name="category" required>
			<option value="">Select a Category</option>
			<?php
      
      $sql_select = mysqli_query($mysqli,"SELECT * FROM categories ORDER BY category_name ASC");

      while($row = mysqli_fetch_array($sql_select)){
        $category_id_select = intval($row['category_id']);
        $category_name_select = htmlentities($row['category_name']);
	    
	    ?>
	    
	    <option <?php if($category_id == $category_id_select){ echo "selected"; } ?> value="<?php echo $category_id_select; ?>"><?php echo $category_name_select; ?></option>
	    
	    <?php
	  	
	  	}

	  	?>

	  </select>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="edit_doc">Save</button>
</form>

<?php 
	
}

include("footer.php");

?>