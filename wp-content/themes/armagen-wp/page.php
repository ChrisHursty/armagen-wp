<?php
/**
 * The default template for displaying pages
 *
 * @package ArmaGen
 */

get_header( 'small' ); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content clearfix">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'armagen' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'armagen' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

            <?php if ( comments_open() ) {
            	comments_template( '', true );
			} ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>