<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$sortby = "doc_title";
$order = "ASC";

include("inc_pagination_head.php");

$url_query_strings_sb = http_build_query(array_merge($_GET,array('sortby' => $sortby, 'order' => $order)));

$query = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM docs
	LEFT JOIN categories ON category_id = doc_category_id
	WHERE doc_title LIKE '%$search%' OR category_name LIKE '%$search%'
	ORDER BY $sortby $order
	LIMIT $record_from, $record_to"
); 

$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));

?>

<h1>Docs</h1>

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
			<a href="add_doc.php" class="btn btn-primary btn-block">New Doc</a>
		</div>
	</div>
</form>

<div class="table-responsive">

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=doc_title&order=<?php echo $order; ?>">Title</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=doc_created_at&order=<?php echo $order; ?>">Created</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=doc_updated_at&order=<?php echo $order; ?>">Updated</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=category_name&order=<?php echo $order; ?>">Category</a></th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
			
			$doc_id = intval($row['doc_id']);
			$title = htmlentities($row['doc_title']);
			$url_title = htmlentities($row['doc_url_title']);
			$created_at = htmlentities($row['doc_created_at']);
			$updated_at = htmlentities($row['doc_updated_at']);
			$category_id = intval($row['category_id']);
			$category_name = htmlentities($row['category_name']);
		
			?>
			
			<tr>	
				<td>
			 		<a href="edit_doc.php?doc_id=<?php echo $doc_id; ?>">
			 			<?php echo $title; ?>
			 		</a>
			 		<br>
			 		<small class="text-secondary mt-1"><?php echo $url_title ?></small>
			 	</td>
				<td><?php echo $created_at; ?></td>
				<td><?php echo $updated_at; ?></td>
				<td><?php echo $category_name; ?></td>
			 	<td>
          <div class="dropdown dropleft text-center">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="edit_doc.php?doc_id=<?php echo $doc_id; ?>">Edit</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="post.php?delete_doc=<?php echo $doc_id; ?>" class="btn btn-outline-danger">Delete</a>
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
