<?php

if(!empty($_SESSION['response'])) {

?>
	<div class='alert alert-info'>
		<?php echo htmlentities($_SESSION['response']); ?>
		<button class='close' data-dismiss='alert'>
			<span>&times;</span>
		</button>
	</div>
	
	<?php unset($_SESSION['response']);
}else{
	unset($_SESSION['response']);
}
