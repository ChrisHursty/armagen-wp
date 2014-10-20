<?php
/**
 * Template Name: Management Team
 * Description: ArmaGen Management Team members
 *
 * @package ArmaGen
 * @since ArmaGen 1.0
 */

get_header( 'small' ); ?>

	<div id="primary">
        <div id="content" role="main">

			<section id="team" class="clearfix">
				<ul>
				<?php query_posts(array(
					'post_type'		 =>'management',
					'posts_per_page' => 99,
					'paged'			 =>$paged,
					'orderby'   	 => 'menu_order',
					'order'     	 => 'ASC'
				)); ?>
				<?php while (have_posts()) : the_post(); ?>
					<li class="block-wrap clearfix section-collapsed" id="post-<?php the_ID(); ?>">
						<div class="block-entry short-details">
							<article class="">
								<div class="headshot"><?php the_post_thumbnail(); ?></div>
								<div class="details">
									<h3><?php the_title(); ?></h3>
									<div class="arrow">&rsaquo;</div>
									<h5><?php the_field('management_position'); ?></h5>
								</div>
							</article>
						</div>
						<div class="bio">
							<div class="bio-details">
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