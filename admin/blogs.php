<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$sortby = "blog_date";
$order = "DESC";

include("inc_pagination_head.php");

$url_query_strings_sb = http_build_query(array_merge($_GET,array('sortby' => $sortby, 'order' => $order)));

$query = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM blog, users
	WHERE blog_by = user_id
	AND (blog_title LIKE '%$search%')
	ORDER BY $sortby $order
	LIMIT $record_from, $record_to"); 

$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));

?>

<h1>Blog Posts</h1>

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
			<a href="add_blog.php" class="btn btn-primary btn-block">New Post</a>
		</div>
	</div>
</form>

<div class="table-responsive">

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=blog_title&order=<?php echo $order; ?>">Title</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=blog_date&order=<?php echo $order; ?>">Date</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=user_name&order=<?php echo $order; ?>">Creater</a></th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
			
			$blog_id = intval($row['blog_id']);
			$title = htmlentities($row['blog_title']);
			$date = htmlentities($row['blog_date']);
			$name = htmlentities($row['user_name']);

			?>
			
			<tr>	
				<td>
			 		<a href="edit_blog.php?blog_id=<?php echo $blog_id; ?>">
			 			<?php echo $title; ?>
			 		</a>
			 	</td>
				<td><?php echo $date; ?></td>
				<td><?php echo $name; ?></td>
			 	<td>
          <div class="dropdown dropleft text-center">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="edit_blog.php?blog_id=<?php echo $blog_id; ?>">Edit</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="post.php?delete_blog=<?php echo $blog_id; ?>" class="btn btn-outline-danger">Delete</a>
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
