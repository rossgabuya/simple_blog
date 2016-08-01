
		<div class="content-body">
			<div class="container">
				<div class="row">
					<main class="col-md-12">
					<!--<div class="page-meta">
						<span class="page-title"><?php echo var_dump($curr_url); ?></span>
					</div>-->
						<?php 
					$i = 1;
					foreach ($all_blog_posts as $all_blog_post): ?>
						<article class="post post-<?php echo $i++;?>">
							<header class="entry-header">
								<h1 class="entry-title">
									<?php echo anchor('blogs/'.$all_blog_post['cat_slug'].'/'.$all_blog_post['post_slug'],$all_blog_post['post_name'],'');?>
								</h1>
								<div class="entry-meta">
									<span class="post-category">
									<?php echo anchor('blogs/'.$all_blog_post['cat_slug'],$all_blog_post['menu_name'],'');?>
									</span>
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?php echo date($all_blog_post['created']);?>"><?php echo date('D, F j,Y @ h:ia',mysql_to_unix($all_blog_post['created']));?></time></a></span>
			
									<span class="post-author"><a href="#">Roselle Gabuya</a></span>
			
									<span class="comments-link"><a href="#"><?php echo $i?> Comments</a></span>
								</div>
							</header>
							<div class="entry-content clearfix">
								<p><?php 
								$position = 500;
								$content = $all_blog_post['content'];
								$post = substr($content,$position,1);

								if($post != " "){
									while($post != " "){
										$i = 1;
										$position = $position + $i;
										$content = $all_blog_post['content'];
										$post = substr($content,$position,1);

									}
								}

								$post = substr($content,0,$position);
								echo $post;
								echo "...";
								
								?>

								</p>
								<div class="read-more cl-effect-14">
									<?php echo anchor('blogs/'.$all_blog_post['cat_slug'].'/'.$all_blog_post['post_slug'],'Continue reading <span class="meta-nav">→</span>','class="more-link"');?>
								</div>
							</div>
						</article>
						<?php endforeach; ?>

					</main>
				</div>
			</div>
		</div>
		