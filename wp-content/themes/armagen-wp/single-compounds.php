<?php
/**
 * Template for displaying a single compound
 *
 * @package ArmaGen
 */

get_header( 'small' ); ?>


<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'content', 'compounds' ); ?>

<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>