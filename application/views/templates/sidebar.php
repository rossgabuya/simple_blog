<aside class="col-md-3">
						<div class="widget widget-recent-posts">		
							<h3 class="widget-title">Recent Posts</h3>		
							<ul>
							<?php // use a foreach loop here?>
								<li>
									<a href="#">Adaptive Vs. Responsive Layouts And Optimal Text Readability</a>
								</li>
								<li>
									<a href="#">Web Design is 95% Typography</a>
								</li>
								<li>
									<a href="#">Paper by FiftyThree</a>
								</li>
							</ul>
						</div>
						<div class="widget widget-archives">		
							<h3 class="widget-title">Archives</h3>	
							2016	
							<ul>
							<?php //make some algo in Blogs controller and query in Blogs_model for this?>
								<li>
									<a href="#">November 2014</a>
								</li>
								<li>
									<a href="#">September 2014</a>
								</li>
								<li>
									<a href="#">January 2013</a>
								</li>
							</ul>
						</div>

						<div class="widget widget-category">		
							<h3 class="widget-title">Categories</h3>		
							<ul>
							<?php foreach ($blog_categories as $blog_category): ?>
								<li>
									<?php echo anchor('blogs/'.$blog_category['cat_slug'],$blog_category['menu_name'],'');?>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</div>
		