
<footer id="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright">&copy; 2014 ThemeWagon.com</p>
					</div>
				</div>
			</div>
		</footer>

		<!-- Mobile Menu -->
		<div class="overlay overlay-hugeinc">
			<button type="button" class="overlay-close"><span class="ion-ios-close-empty"></span></button>
			<nav>
				<ul>
					<?php if($is_admin == true){?>
						<li><a href="#">Add Category</a></li>
						<li><a href="#">Create Post</a></li>
						<li><a href="#">Trash</a></li>
						<li><a href="#">Settings</a></li>
						<li><a href="#">Logout</a></li>
					
  					<?php }else{?>
    								
						<li><?php echo anchor('home','Home','');?></li>
						<li><?php echo anchor('blog','Blog','');?></li>
						<li><?php echo anchor('about','About','');?></li>
						<li><?php echo anchor('contact','Contact','');?></li>
					<?php } ?>
				</ul>
			</nav>
		</div>

		<script src="<?php echo site_url('media/js/script.js');?>"></script>

	</body>
</html>
