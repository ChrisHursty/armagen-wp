<?php
/**
 * Template Name: Sidebar/Image Header
 * @package ArmaGen
 */
get_header( 'medium' ); ?>

    <div id="primary">
        <div id="content" role="main">
            <div class="column-left">
                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="entry-content clearfix">
                        <?php the_content(); ?>

                        <?php wp_link_pages( array( 
                            'before' => '<div class="page-link">' . __( 'Pages:', 'armagen' ), 
                            'after'  => '</div>' ) ); ?>
                        <?php edit_post_link( __( 'Edit', 'armagen' ), '<span class="edit-link">', '</span>' ); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php endwhile; // end of the loop. ?>
            </div>
                    
                <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
                <div class="column-right">
                    <?php dynamic_sidebar( 'right-sidebar' ); ?>
                </div>
                <?php endif; ?>
        </div><!-- #content -->
        
    </div><!-- #primary -->

    
<?php get_footer(); ?>