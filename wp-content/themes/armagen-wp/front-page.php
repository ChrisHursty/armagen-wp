<?php
/**
 * Custom Home Page
 */

 get_header(); ?>

<main role="main">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <div class="home-hero">
            <div id="navigation" class="secondary-navigation" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) ); ?>
            </div>
        </div>
            
            
            


    <?php endwhile; ?>

    <?php else: ?>
    <?php endif; ?>
</main>


<?php get_footer(); ?>