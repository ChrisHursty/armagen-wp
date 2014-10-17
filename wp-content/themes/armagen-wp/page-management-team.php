<?php
/**
 * Template Name: Management Team Page
 * @package ArmaGen
 */
get_header( 'small' ); ?>

    <div id="primary">
        <div id="content" role="main">

            <section id="managementteam" class="clearfix">
                <ul class="management-ul">
                <?php query_posts(array(
                    'post_type'      => 'Management Team Member',
                    'posts_per_page' => 99,
                    'paged'          => $paged,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                )); ?>
                <?php while (have_posts()) : the_post(); ?>
                    <li class="clearfix" id="">
                        <div class="">
                            <h3><?php the_title(); ?></h3>
                            <h4><?php the_field('management_title'); ?></h4>
                            <?php
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 200, 200 ), true, '' );
                            ?>
                            <p><?php the_field('management_about'); ?></p>
                        </div>                        
                    </li>
                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </ul>
            </section>

        </div><!-- #content -->
    </div><!-- #primary -->
<?php is_active_sidebar( 'right-sidebar' ); ?>
<?php get_footer(); ?>