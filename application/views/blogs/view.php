<?php
/*echo '<h1>'.$menu_name.'</h1>';
echo '<pre>'.print_r($blog_posts).'</pre>';

echo var_dump($blog_posts);
foreach ($blog_posts as $blog_post){
	echo '<h3>'.$blog_post['post_name'].'</h3>';
	echo '<p>'.$blog_post['content'].'</p>';
	echo $blog_post['menu_name'];
}
echo anchor('home','Back to Home','class=\'btn btn-warning\'');*/


?>



		<div class="content-body">
			<div class="container">
				<div class="row">
					<main class="col-md-9">
					<div class="page-meta">
						<span class="page-title"><?php echo var_dump($curr_url); ?></span>
					</div>
					<?php 
					$i = 1;
					foreach ($blog_posts as $blog_post): ?>
						<article class="post post-<?php echo $i++;?>">
							<header class="entry-header">
								<h1 class="entry-title">
									<?php echo anchor('blogs/'.$blog_post['cat_slug'].'/'.$blog_post['post_slug'],$blog_post['post_name'],'');?>
								</h1>
								<div class="entry-meta">
									<span class="post-category"><?php echo anchor('blogs/'.$blog_post['cat_slug'],$menu_name,'');?></span>
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?php echo date($blog_post['created']);?>"><?php echo date('D, F j,Y @ h:ia',mysql_to_unix($blog_post['created']));?></time></a></span>
			
									<span class="post-author"><a href="#">Albert Einstein</a></span>
			
									<span class="comments-link"><a href="#">4 Comments</a></span>
								</div>
							</header>
							<div class="entry-content clearfix">
								<p><?php echo $blog_post['content'];?></p>
								<div class="read-more cl-effect-14">
								<?php echo anchor('blogs/'.$blog_post['cat_slug'].'/'.$blog_post['post_slug'],'Continue reading <span class="meta-nav">→</span>','class="more-link"');?>
								</div>
							</div>
						</article>
						<?php endforeach; ?>
						
					</main>
					
					