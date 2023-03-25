<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$sortby = "file_name";
$order = "ASC";

include("inc_pagination_head.php");

$url_query_strings_sb = http_build_query(array_merge($_GET,array('sortby' => $sortby, 'order' => $order)));

$query = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM files
	WHERE file_name LIKE '%$search%'
	ORDER BY $sortby $order
	LIMIT $record_from, $record_to"); 

$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));

?>

<h1>Files</h1>

<hr>

<form>
	<div class="form-row">
		<div class="input-group col-md-10 mb-3">
			<input type="text" class="form-control col-md-5" name="search" value="<?php echo $search; ?>" placeholder="Search...">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary">Search</button>
			</div>
		</div>
		<div class="col-md-2 mb-3">
			 <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addFileModal">Upload File</button>
		</div>
	</div>
</form>

<div class="table-responsive">

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=file_name&order=<?php echo $order; ?>">Name</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=file_uploaded_at&order=<?php echo $order; ?>">Upload Date</a></th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
			
			$file_id = $row['file_id'];
			$name = $row['file_name'];
			$uploaded_at = $row['file_uploaded_at'];

			?>
			
			<tr>	
				<td><?php echo $name; ?></td>
				<td><?php echo $uploaded_at; ?></td>
			 	<td>
          <div class="dropdown dropleft text-center">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/upload/<?php echo $name; ?>">Download</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="post.php?delete_file=<?php echo $file_id; ?>" class="btn btn-outline-danger">Delete</a>
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

<div class="modal" id="addFileModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select File</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <form action="post.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-body bg-white">    
          
          <div class="form-group">
            <input type="file" class="form-control-file" name="file">
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_file" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

include("inc_pagination_footer.php");
include("footer.php");
