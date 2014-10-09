<?php
/**
 * Template for displaying a single post
 *
 * @package ArmaGen
 */

get_header( 'small' ); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'armagen' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->


				</article><!-- #post-<?php the_ID(); ?> -->


			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>