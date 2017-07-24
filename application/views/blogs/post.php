

<div class="content-body">
			<div class="container">
				<div class="row">
					<main class="col-md-9">
					<div class="page-meta">
						<span class="page-title"><?php echo var_dump($curr_url); ?></span>
					</div>
					<?php foreach ($blog_post_contents as $blog_post_content):?>
						<article class="post post-1">
							<header class="entry-header">
								<h1 class="entry-title"><?php echo anchor('blogs/'.$blog_post_content['cat_slug'].'/'.$blog_post_content['post_slug'],$blog_post_content['post_name'],'');?></h1>
								<div class="entry-meta">
									<span class="post-category"><?php echo anchor('blogs/'.$blog_post_content['cat_slug'],$menu_name,'');?></span>
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?php echo date($blog_post_content['created_at']);?>"><?php echo date('D, F j,Y @ h:ia',mysql_to_unix($blog_post_content['created_at']));?></time></a></span>
			
									<span class="post-author"><a href="#">Albert Einstein</a></span>
			
									<span class="comments-link"><a href="#">4 Comments</a></span>
								</div>
							</header>
							<div class="entry-content clearfix">
								<p><?php echo $blog_post_content['content'];?></p>
							</div>
						</article>
					<?php endforeach;?>
					</main>
					
	