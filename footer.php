		</main><!-- /.container -->
		<footer class="footer border-top" id="sticky-footer">
		  <div class="container">
		    <span class="text-muted"><?php echo $config_site_name; ?> <?php echo date('Y'); ?></span>
		    <span>
		    	<?php if(!empty($config_social_github)){ ?><a href="<?php echo $config_social_github; ?>" target="_blank"><i class="fab fa-fw fa-github text-dark"></i></a><?php } ?>
		    	<?php if(!empty($config_social_twitter)){ ?><a href="<?php echo $config_social_twitter; ?>" target="_blank"><i class="fab fa-fw fa-twitter text-dark"></i></a><?php } ?>
		    	<?php if(!empty($config_social_reddit)){ ?><a href="<?php echo $config_social_reddit; ?>" target="_blank"><i class="fab fa-fw fa-reddit text-dark"></i></a><?php } ?>
		    </span>
		    <span class="float-right"><?php echo $config_footer_right; ?></span>
		  </div>
		</footer>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
	<script src="/plugins/summernote/summernote-bs4.min.js"></script>
	<script>
		$(document).ready(function() {
		  $('#summernote').summernote({
		  	height: 150,
		  });
		});
	</script>
    <script>

		//Prevents resubmit on forms
		if(window.history.replaceState){
		  window.history.replaceState(null, null, window.location.href);
		}

		//Slide alert up after 2 secs
		$("#alert").fadeTo(2000, 500).slideUp(500, function(){
			
		});

	</script>
    
  </body>
</html>