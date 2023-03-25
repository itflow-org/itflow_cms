<?php

include("../config.php");
include("check_login.php");
include("header.php");	
include("nav.php");

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="docs.php">Docs</a></li>
		<li class="breadcrumb-item active">New</li>
	</ol>
</nav>

<form action="post.php" method="post">
	<div class="form-group">
		<input type="text" class="form-control form-control-lg" placeholder="Title" name="title" required autofocus>
	</div>
	<div class="form-group">
		<textarea class="form-control" id="summernote" name="content"></textarea>
	</div>
	<div class="form-group">
		<select class="form-control form-control-lg" name="category" required>
			<option value="">Select a Category</option>
			<?php
      
      $sql = mysqli_query($mysqli,"SELECT * FROM categories ORDER BY category_name ASC");

      while($row = mysqli_fetch_array($sql)){
        $category_id = intval($row['category_id']);
        $category_name = htmlentities($row['category_name']);
	    
	    ?>
	    
	    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
	    
	    <?php
	  	
	  	}

	  	?>

	  </select>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="add_doc">Create</button>
</form>

<?php 

include("footer.php");

?>