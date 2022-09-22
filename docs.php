<?php 

if(isset($_GET['doc'])){ $page_title = "Docs - ". strip_tags($_GET['doc']); }else{ $page_title = "Docs"; }

include("admin/functions.php");
include("config.php");
include("header.php"); 

?>

<?php if($config_module_docs_enabled == 1){ ?>

<div class="row">
	<div class="col-md-3 bg-light p-3" style="height: 1000px;">
		<h3>Docs</h3>
		<hr>
		<nav class="nav nav-pills flex-column">

		<?php

			$sql_categories = mysqli_query($mysqli,"SELECT * FROM categories");
			while($row = mysqli_fetch_array($sql_categories)){
				$category_name = $row['category_name'];
				$category_id = $row['category_id'];

				$sql_docs = mysqli_query($mysqli,"SELECT * FROM docs WHERE doc_category_id = $category_id");
				if(mysqli_num_rows($sql_docs) > 0){
					echo "<h6 class='mt-2'><strong>$category_name</strong></h6>";
					while($row = mysqli_fetch_array($sql_docs)){
					
						$doc_id = $row['doc_id'];
						$title = $row['doc_title'];
						$url_title = $row['doc_url_title'];

				?>
						<a class="nav-link <?php if($url_title == $_GET['doc']){ echo "active"; } ?>" href="?doc=<?php echo $url_title; ?>"><?php echo $title; ?></a>

			<?php
					}
				}
			}
			?>

		</nav>
	
	</div>

	<div class="col-md-9 p-3">
		<?php
			if(isset($_GET['doc'])){
		
				$doc = SeoUrl($_GET['doc']);
				
				$query = mysqli_query($mysqli,"SELECT * FROM docs LEFT JOIN categories ON doc_category_id = category_id WHERE doc_url_title = '$doc'");
				
				$row = mysqli_fetch_array($query);
				
				$doc_id = $row['doc_id'];
				$title = $row['doc_title'];
				$category_name = $row['category_name'];
				$content = $row['doc_content'];
				$created_at = $row['doc_created_at'];
				$updated_at = $row['doc_updated_at'];

		?>
				<h3><?php echo "$category_name - $title"; ?></h3>
				<small class="text-secondary">Created: <?php echo $created_at; ?> <?php if(!empty($updated_at)){ ?> || Updated: <?php echo $updated_at; } ?></small> 
				<hr>
				<?php echo $content; ?>
		<?php
			}else{
			  $query = mysqli_query($mysqli,"SELECT * FROM docs ORDER BY doc_id ASC LIMIT 1");
			  
			  $row = mysqli_fetch_array($query);
			  
			  $title = $row['doc_title'];
				$content = $row['doc_content'];
				$created_at = $row['doc_created_at'];
				$updated_at = $row['doc_updated_at'];

			  ?>
				<h3><?php echo $title; ?></h3>
				<small class="text-secondary">Created: <?php echo $created_at; ?> <?php if(!empty($updated_at)){ ?> || Updated: <?php echo $updated_at; } ?></small> 
				<hr>
				<?php echo $content; ?>
			<?php
			}

		?>

	</div>
</div>

<?php }else{ ?>

404 Error (Module Not Enabled)

<?php } ?>

<?php include("footer.php"); ?>
