<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

if(isset($_GET['page'])){
  $page = intval($_GET['page']);
  $record_from = (($page)-1)*10;
  $record_to =  10;
}else{
  $record_from = 0;
  $record_to = 10;
  $page = 1;
}

if(isset($_GET['search'])){
  $search = mysqli_real_escape_string($mysqli,$_GET['search']);
}else{
  $search = "";
}

if(isset($_GET['sortby'])){
  $sortby = mysqli_real_escape_string($mysqli,$_GET['sortby']);
}else{
  $sortby = "link_name";
}

if(isset($_GET['order'])){
	if($_GET['order'] == 'ASC'){
		$order = "DESC";
	}else{
		$order = "ASC";
	}
}else{
	$order = "DESC";
}

$url_query_strings_sb = http_build_query(array_merge($_GET,array('sortby' => $sortby, 'order' => $order)));

$query = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM links
	WHERE link_name LIKE '%$search%'
	ORDER BY $sortby $order
	LIMIT $record_from, $record_to"); 

$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));

?>

<h1>Links</h1>

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
			<a href="add_link.php" class="btn btn-primary btn-block">New Link</a>
		</div>
	</div>
</form>

<div class="table-responsive">

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=link_name&order=<?php echo $order; ?>">Name</a></th>
				<th>Icon</th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=link_order&order=<?php echo $order; ?>">Order</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=link_url_at&order=<?php echo $order; ?>">URL</a></th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
			
			$link_id = intval($row['link_id']);
			$name = htmlentities($row['link_name']);
			$icon = htmlentities($row['link_icon']);
			$url = htmlentities($row['link_url']);
			$order = intval($row['link_order']);
		
			?>
			
			<tr>	
				<td>
			 		<a href="edit_link.php?link_id=<?php echo $link_id; ?>">
			 			<?php echo $name; ?>
			 		</a>
			 	</td>
			 	<td><?php if(!empty($icon)) { echo "<i class='$icon fa-fw fa-2x'></i>"; } ?></td>
			 	<td><?php echo $order; ?></td>
				<td><?php echo $url; ?></td>
			 	<td>
          <div class="dropdown dropleft text-center">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="edit_link.php?link_id=<?php echo $link_id; ?>">Edit</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="post.php?delete_link=<?php echo $link_id; ?>" class="btn btn-outline-danger">Delete</a>
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

$total_found_rows = $num_rows[0];
$total_pages = ceil($total_found_rows / 10);

if($total_found_rows > 10){
	$i=0;

?>
	<?php echo "<small class='float-left text-secondary mt-2'>Showing $record_from to $record_to of $total_found_rows</small>"; ?>

	<ul class="pagination justify-content-end">

	<?php
		
		if($total_pages <= 100){
			$pages_split = 10;
		}
		if(($total_pages <= 1000) AND ($total_pages > 100)){
			$pages_split = 100;
		}
		if(($total_pages <= 10000) AND ($total_pages > 1000)){
			$pages_split = 1000;
		}
		if($page > 1){
			$prev_class = "";
		}else{
			$prev_class = "disabled";
		}
		if($page <> $total_pages) {
			$next_class = "";
		}else{
			$next_class = "disabled";
		}
	    $url_query_strings = http_build_query(array_merge($_GET,array('page' => $i)));
	    $prev_page = $page - 1;
	    $next_page  = $page + 1;
		
		if($page > 1){
			echo "<li class='page-item $prev_class'><a class='page-link' href='?$url_query_strings&page=$prev_page'>Prev</a></li>";
		}
	
		while($i < $total_pages){
	    	$i++;
			if(($i == 1) OR (($page <= 3) AND ($i <= 6)) OR (($i >  $total_pages - 6) AND ($page > $total_pages - 3 )) OR (is_int($i / $pages_split)) OR (($page > 3) AND ($i >= $page - 2) AND ($i <= $page + 3)) OR ($i == $total_pages)){
		        if($page == $i ) {
		        	$page_class = "active"; 
		        }else{ 
		        	$page_class = "";
		    	}
		    	echo "<li class='page-item $page_class'><a class='page-link' href='?$url_query_strings&page=$i'>$i</a></li>";
			}
		}

		if($page <> $total_pages){
			echo "<li class='page_item $next_class'><a class='page-link' href='?$url_query_strings&page=$next_page'>Next</a></li>";
		}

	?>

	</ul>

<?php

}
          
if($total_found_rows == 0){
	echo "<h2 class='text-secondary text-center mt-4'>No Records Found</h2>";
}

?>

<?php 

include("footer.php");

?>