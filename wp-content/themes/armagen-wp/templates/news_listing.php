<?php 
/* 
Template Name: News index 
*/ 
get_header( 'small' ); ?>


	<div id="primary">
        <div id="content" role="main">


		<ul class="news-item">
		<?php query_posts(array(
			'post_type'=>'news',
			'posts_per_page' => 99,
			'paged'=>$paged,
			'orderby'   => 'menu_order',
			'order'     => 'ASC'
		)); ?>
		<?php while (have_posts()) : the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a>
				<?php the_excerpt(); ?>
				
				<div>
					<strong><span class="small caps"><?php the_field('pub_date'); ?></span></strong>  |  <a href="<?php the_permalink() ?>" title="Read more">Read more</a>
					<?php
					if(get_field('pdf_download')) {
						echo ' | ';
						echo '<a href="' . get_field('pdf_download') . '" target="_blank" title="Download the PDF"><span aria-hidden="true" class="icon-icon-doc"></span>&nbsp;Download the PDF</a>';
					}
					?>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
		
		
    	</div>
  	</div>
    
<?php get_footer(); ?>