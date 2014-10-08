<?php
/**
 * Custom Home Page
 */

 get_header(); ?>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php 
        $post_image_id = get_post_thumbnail_id($post_to_use->ID);
        if ($post_image_id) { 
            $hero = wp_get_attachment_image_src( $post_image_id, 'fullwidth', false);
            if ($hero) (string)$hero = $hero[0];
        }
        ?>

        <section id="" class="news-home">
            <div class="clearfix">
                <div class="one-third">
                    <h3 class="sub-title">Recent News</h3>
                    <ul class="">
                        <?php query_posts(array(
                            'post_type'      => 'news',
                            'posts_per_page' => 2,
                            'orderby'        => 'date',
                            'order'          => 'DESC'
                            )
                        ); ?>
                        <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <a class="news" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_date('m-Y-d', '<h4>', '</h4>'); ?></a>
                            <p><?php the_excerpt('custom_excerpt_length'); ?></p>
                            <a class="button">Learn More</a>
                        </li>
                        <?php
                            endwhile;
                            wp_reset_query();
                        ?>
                    </ul>
                </div>
                <div class="one-third">
                    <h3 class="sub-title"><?php the_field('custom_content_title_middle'); ?></h3>
                    <p>
                        <?php the_field('custom_content_text_middle'); ?>
                    </p>
                    <a class="button"><?php the_field('custom_content_button_text_middle'); ?></a>
                </div>
                <div class="one-third">
                    <h3 class="sub-title"><?php the_field('custom_content_title_right'); ?></h3>
                    <p>
                        <?php the_field('custom_content_text_right'); ?>
                    </p>
                    <a class="button"><?php the_field('custom_content_button_text_right'); ?></a>
                </div>
            </div> <!-- /.clearfix -->
        </section>
        <!-- # news -->
        <section id="technology" class="technology-home">
            <div class="tech-wrap clearfix">
                <div class="right">
                    <?php 
                    $techwrapimg = get_field('tech_home_img');
                    if( !empty($techwrapimg) ): ?>
                        <img src="<?php echo $techwrapimg['url']; ?>" alt="<?php echo $techwrapimg['alt']; ?>" />
                    <?php endif; ?>
                </div>
                <div class="left">
                    <h3><?php the_field('tech_home_title'); ?></h3>
                    <div class="bbb">
                    <?php 
                    $techimage = get_field('bbb_img');
                    if( !empty($techimage) ): 
                        // vars
                        $url = $techimage['url'];
                        $title = $techimage['title'];
                        $alt = $techimage['alt'];
                        $caption = $techimage['caption'];
                        // thumbnail
                        $size = 'thumbnail';
                        $thumb = $techimage['sizes'][ $size ];
                        if( $caption ): ?>
                        <?php endif; ?>
                        <a href="<?php echo $url; ?>" class="image-link" title="<?php echo $caption; ?>"><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" /></a>
                    <?php endif; ?>
                    </div>
                    <?php the_field('tech_home_text'); ?>
                </div>
            </div>
        </section>

        <!-- mission -->
        <?php if( get_field('mission_home_bg') ): ?>
            <section id="mission" class="mission-home" style="background-image:url(<?php the_field('mission_home_bg'); ?>);">
                <div class="left">
                    <h3><?php the_field('mission_home_title'); ?></h3>
                    <?php the_field('mission_home_text'); ?>
                </div>
            </section>
        <?php endif; ?>
        <!-- # mission -->
    
    </section>
    <!-- # technology -->

    <?php endwhile; ?>

    <?php else: ?>
    <?php endif; ?>
    </article>
</main>


<?php get_footer(); ?>