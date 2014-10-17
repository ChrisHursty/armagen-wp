<?php
/**
 * Custom Header - Small Hero
 *
 * @package ArmaGen
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/icons/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory'); ?>/images/icons/touch.png">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if (lt IE 9) & (!IEMobile)]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie.css">
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
    <div class="colorbar"></div>
    <header id="branding" class="header clearfix" role="banner">
        <hgroup id="logo">
            <a href="<?php echo home_url(); ?>" title="ArmaGen Technologies">
                <!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
                <img src="<?php echo get_template_directory_uri(); ?>/images/armagen_logo.svg" alt="ArmaGen Technologies">
                <h1>ArmaGen Technologies</h1>
            </a>
        </hgroup>

        <nav id="navigation" class="site-navigation primary-navigation" role="navigation">
            <h1 class="menu-toggle"></h1>
                <a class="screen-reader-text skip-link" href="#content">
                    <?php _e( 'Skip to content', 'armagen' ); ?>
                </a>
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </nav>
    </header>

    <main role="main">
        <div class="small-hero">
            <div id="navigation" class="secondary-navigation" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) ); ?>
            </div>
            <div class="small-hero-title">
                <?php 
                if ( is_singular('news') ) { 
                    echo '<h2 class="small-title">News</h2>';
                } else {
                    echo '<h2 class="small-title">' . get_the_title() .'</h2>';
                }
            ?>       
            </div>
        </div>
        <!-- # hero -->

