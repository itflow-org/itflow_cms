<?php

include("../config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$sortby = "user_name";
$order = "ASC";

include("inc_pagination_head.php");

$url_query_strings_sb = http_build_query(array_merge($_GET,array('sortby' => $sortby, 'order' => $order)));

$query = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM users
	LEFT JOIN events ON user_id = event_user_id
	WHERE user_name LIKE '%$search%' OR user_email LIKE '%$search%' OR event_ip LIKE '%$search%'
	ORDER BY $sortby $order
	LIMIT $record_from, $record_to"); 

$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));

?>


<h1>Users</h1>

<hr>

<form>
	<div class="form-row">
		<div class="input-group col-md-10 mb-3">
			<input type="text" class="form-control col-md-5" name="search" value="<?php echo stripslashes(htmlentities($search)); ?>" placeholder="Search...">
			<div class="input-group-append">
				<button class="btn btn-dark"><i class="fas fa-fw fa-search"></i></button>
			</div>
		</div>
		<div class="col-md-2 mb-3">
			<a href="add_user.php" class="btn btn-primary btn-block">New User</a>
		</div>
	</div>
</form>

<div class="table-responsive">

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=user_name&order=<?php echo $order; ?>">User</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=user_email&order=<?php echo $order; ?>">Email</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=event_ip&order=<?php echo $order; ?>">IP</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=event_user_agent&order=<?php echo $order; ?>">User Agent</a></th>
				<th><a class="text-secondary" href="?<?php echo $url_query_strings_sb; ?>&sortby=user_access&order=<?php echo $order; ?>">Access</a></th>
				<th>Last Active</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
				
				$user_id = intval($row['user_id']);
				$email = htmlentities($row['user_email']);
				$username = htmlentities($row['user_name']);
                $user_access = intval($row['user_access']);
                $ip = htmlentities($row['event_ip']);
                $user_agent = htmlentities($row['event_user_agent']);
                $event_timestamp = htmlentities($row['event_timestamp']);
				
				?>
			
			<tr>	
				<td><a href="edit_user.php?user_id=<?php echo $user_id; ?>"><?php echo $username; ?></a></td>
				<td><?php echo $email; ?></td>
				<td><?php echo $ip; ?></td>
				<td><small><?php echo $user_agent; ?></small></td>
				<td><?php echo $user_access; ?></td>
				<td><?php echo $event_timestamp; ?></td>
			 	<td>
                    <div class="dropdown dropleft text-center">
                        <button class="btn btn-secondary btn-sm" type="button" data-toggle="dropdown">
                            <i class="fas fa-fw fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu">
                            <?php if($user_access == 0){ ?><a class="dropdown-item" href="post.php?approve_user=<?php echo $user_id; ?>">Approve</a><?php } ?>
                            <a class="dropdown-item" href="edit_user.php?user_id=<?php echo $user_id; ?>">Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="post.php?delete_user=<?php echo $user_id; ?>" class="btn btn-outline-danger">Delete</a>
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
