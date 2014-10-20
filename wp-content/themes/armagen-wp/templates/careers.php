<?php
/**
 * Template Name: Careers page
 * Description: List of ArmaGen positions
 *
 * @package ArmaGen
 * @since ArmaGen 1.0
 */

get_header( 'small' ); ?>


	<div id="primary">
        <div id="content" role="main">

			
			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="center" style="padding-top:2.5em;">
					<?php the_content(); ?>
				</div>
			<?php
			endwhile;
			wp_reset_query();
			?>


			<section id="careers" class="clearfix">
				<ul>
				<?php query_posts(array(
					'post_type'=>'careers',
					'posts_per_page' => 99,
					'paged'=>$paged,
					'orderby'   => 'menu_order',
					'order'     => 'ASC'
				)); ?>
				<?php while (have_posts()) : the_post(); ?>
					<li class="block-wrap clearfix section-collapsed" id="post-<?php the_ID(); ?>">
						<div class="block-entry short-summary">
							<article class="">
								<div class="details">
									<h3><?php the_title(); ?></h3>
									<div class="arrow">&rsaquo;</div>
								</div>
							</article>
						</div>
						<div class="job">
							<div class="position-details">
								<?php the_field('position_details'); ?>
							</div>
							<div class="apply-form">
								<?php the_content(); ?>
							</div>
						</div>
						
					</li>
				<?php
					endwhile;
					wp_reset_query();
				?>
				</ul>
			</section>

		</div>
  	</div>
	
	

<?php get_footer(); ?>