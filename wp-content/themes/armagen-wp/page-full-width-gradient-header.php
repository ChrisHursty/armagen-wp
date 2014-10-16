<?php
/**
 * Template Name: Full/Gradient Header
 * @package ArmaGen
 */
get_header( 'small' ); ?>

    <div id="primary">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content clearfix">
                    <?php 
                        if(get_field('sidebar_content')) { $pagestyle='shrink'; }
                    ?>
                    <div class="<?php echo $pagestyle;?>"><?php the_content(); ?></div>
                    <?php
                        if(get_field('sidebar_content')) {
                            echo '<div class="column-right">';
                            echo '<p>';
                            echo the_field('sidebar_content');
                            echo '</p>';
                            echo '</div>';
                        }
                    ?>

                    <?php wp_link_pages( array( 
                        'before' => '<div class="page-link">' . __( 'Pages:', 'armagen' ), 
                        'after'  => '</div>' ) ); ?>
                    <?php edit_post_link( __( 'Edit', 'armagen' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->


            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>