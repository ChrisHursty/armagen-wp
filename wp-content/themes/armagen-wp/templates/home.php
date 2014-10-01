<?php 
/* 
Template Name: Homepage Template 
*/ 
get_header(); ?>



<main role="main">
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    
    
    
    <?php 
	$post_image_id = get_post_thumbnail_id($post_to_use->ID);
	if ($post_image_id) { 
		$hero = wp_get_attachment_image_src( $post_image_id, 'fullwidth', false);
		if ($hero) (string)$hero = $hero[0];
	}
	?>
    
    <section class="hero" style="background-image:url(<?php echo ($hero); ?>);">
    	<div class="hero-title">
            <h2><?php the_field('hero_title'); ?></h2>
            <a class="button" href="<?php the_field('hero_link'); ?>" target="_blank" title="<?php the_field('hero_link_text'); ?>"><?php the_field('hero_link_text'); ?></a>
        </div>
    </section>
    <!-- # hero -->
    
    
    
    
    
    <section id="news" class="news-home">
    	<div class="clearfix">
            <ul class="eqWrap">
            	<li><h3>Recent News</h3></li>
                <?php query_posts(array(
                    'post_type' => 'news',
					'posts_per_page' => 2,
					'orderby' => 'date',
					'order' => 'DESC'
                )); ?>
                <?php while (have_posts()) : the_post(); ?>
                <li id="post-<?php the_ID(); ?>">
                    <p class="date small caps"><?php the_field('pub_date'); ?></p>
                    <p><a class="news" href="<?php  the_field('external_link');//the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
                </li>
                <?php
                    endwhile;
                    wp_reset_query();
                ?>
            </ul>
        </div>
    </section>
    <!-- # news -->
    
    
    
    
    
    <section id="about" class="about-home clearfix">
    	<div class="about-text">
            <h3><?php the_field('about_home_title'); ?></h3>
            <?php the_field('about_home_text'); ?>
        </div>
        <div class="about-tag"><h2><?php the_field('about_home_tagline'); ?></h2></div>
    </section>
    <!-- # about -->
    
    
    
    
    
    <section id="compounds" class="compounds-home">
    	<div class="clearfix">
            <ul>
                <?php query_posts(array(
                    'numberposts' => -1,
					'post_type' => 'compounds',
					'paged' => $paged,
					'orderby' => 'menu_order',
					'order' => 'ASC'
                )); ?>
                <?php while (have_posts()) : the_post(); ?>
                <li class="<?php the_field('color_assignment'); ?>" id="post-<?php the_ID(); ?>">
                    <h3><?php the_title(); ?></h3>
                    <?php the_field('status'); ?>
                    <a class="button modal-link" href="#<?php the_field('modal_id'); ?>" title="Learn More">Learn More</a>
                </li>
                <div id="<?php the_field('modal_id'); ?>" class="compound-modal mfp-hide <?php the_field('color_assignment'); ?>"><?php the_field('home_modal'); ?></div>
                <?php
                    endwhile;
                    wp_reset_query();
                ?>
            </ul>
        </div>
    </section>
    <!-- # compunds -->
    
    
    
    
    
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
    <!-- # technology -->
    
    
    
    
	<?php if( get_field('mission_home_bg') ): ?>
    <section id="mission" class="mission-home" style="background-image:url(<?php the_field('mission_home_bg'); ?>);">
    	<div class="left">
            <h3><?php the_field('mission_home_title'); ?></h3>
            <?php the_field('mission_home_text'); ?>
        </div>
    </section>
    <?php endif; ?>
    <!-- # mission -->
    
    
    
</article>

<?php endwhile; ?>

<?php else: ?>
<?php endif; ?>
</main>


<?php get_footer(); ?>
