<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$sortby = "category_name";
$order = "ASC";

include("inc_pagination_head.php");

$url_query_strings_sb = http_build_query(array_merge($_GET,array('sortby' => $sortby, 'order' => $order)));

$query = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM categories
	WHERE category_name LIKE '%$search%'
	ORDER BY $sortby $order
	LIMIT $record_from, $record_to"); 

$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));

?>

<h1>Categories</h1>

<hr>

<form>
	<div class="form-row">
		<div class="input-group col-md-10 mb-3">
			<input type="text" class="form-control col-md-5" name="search" value="<?php echo stripslashes(htmlentities($search)); ?>" placeholder="Search...">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary">Search</button>
			</div>
		</div>
		<div class="col-md-2 mb-3">
			<a href="add_category.php" class="btn btn-primary btn-block">New Category</a>
		</div>
	</div>
</form>

<div class="table-responsive">

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=category_name&order=<?php echo $order; ?>">Name</a></th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
			
			$category_id = intval($row['category_id']);
			$name = htmlentities($row['category_name']);
		
			?>
			
			<tr>	
				<td>
			 		<a href="edit_category.php?category_id=<?php echo $category_id; ?>">
			 			<?php echo $name; ?>
			 		</a>
			 	</td>
			 	<td>
          <div class="dropdown dropleft text-center">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="edit_category.php?category_id=<?php echo $category_id; ?>">Edit</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="post.php?delete_category=<?php echo $category_id; ?>" class="btn btn-outline-danger">Delete</a>
            </div>
          </div>
        </td>
			</tr>
			
			<?php 
			
			} 

			?>
		
		</tbody>
	</table>

</div>

<?php

include("inc_pagination_footer.php");
include("footer.php");

?>