<?php
/**
 * Template for displaying a news article
 *
 * @package ArmaGen
 */

get_header( 'small' ); ?>


<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'news' ); ?>

<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>