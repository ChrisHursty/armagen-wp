<?php
/**
 * ArmaGen functions and definitions
 *
 * @package ArmaGen
 * @author Second Melody <mike.graham@secondmelody.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980;
}

if ( ! function_exists( 'armagen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function armagen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'armagen', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style
	add_editor_style();

	// This theme uses wp_nav_menu() in one location
	register_nav_menus( array(
	  'primary'    => __( 'Primary Menu', 'armagen' ),
      'secondary'  => __( 'Secondary Menu', 'armagen' ),
      'footer'     => __( 'Footer Navigation', 'armagen' )
		) );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add support for a variety of post formats ( will be added in next version )
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'quote', 'link' ) );

	// Add support for featured images
	add_theme_support( 'post-thumbnails' );

	// Enable support for HTML5 markup
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'gallery',
	) );

	// Add images sizes for the various thumbnails
	add_image_size( 'thumbnail', 300, 9999, false );
	add_image_size( 'large', 980, 9999, false );
	add_image_size( 'fullwidth', 9999, 9999, false );
  add_image_size( 'medium_header', 9999, 252, false );

}
endif; // armagen_setup
add_action( 'after_setup_theme', 'armagen_setup' );




/**
 * Enqueue scripts and styles.
 */
// add IE conditional html5 shim
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

function armagen_scripts() {

	wp_enqueue_style( 'armagen-style', get_stylesheet_uri(), '', '2.3.0' );
	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', 'jquery', '1.0');
	wp_enqueue_script( 'themejs', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'customjs', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), false, true );
  wp_enqueue_style( 'second-styles', get_stylesheet_directory_uri() . '/second-styles.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    	wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'armagen_scripts' );



/**
 * Adds modal window to homepage compounds
 */
function modal_enqueue_script() {
  if ( is_front_page() || is_page('our-pipeline') ) {
    wp_register_script( 'magnific-custom', get_template_directory_uri() . '/plugins/magnific-popup/jquery.magnific-custom.js', 'jquery', '', TRUE);
	//wp_register_script( 'magnific-zoom', get_template_directory_uri() . '/plugins/magnific-popup/jquery.magnific-zoom.js', 'jquery', '', TRUE);
	//wp_register_script( 'magnific-zoom', get_template_directory_uri() . '/plugins/magnific-popup/jquery.magnific-zoom.js', 'jquery', '', TRUE);
	wp_enqueue_script( 'magnific-custom' );
	//wp_enqueue_script( 'magnific-inline' );
	//wp_enqueue_script( 'magnific-zoom' );
  }
}
add_action( 'wp_enqueue_scripts', 'modal_enqueue_script' );
function modal_enqueue_style() {
  if ( is_front_page() || is_page('our-pipeline') ) {
    wp_register_style( 'magnificcss', get_template_directory_uri() . '/plugins/magnific-popup/magnific.css');
	wp_enqueue_style( 'magnificcss' );
  }
}
add_action( 'wp_enqueue_scripts', 'modal_enqueue_style' );



/**
 * Loads webfonts from Google
 */
function armagen_fonts() {
	wp_register_style( 'armagen_open_sans', '//fonts.googleapis.com/css?family=Open+Sans:300,600,700', '', null, 'screen' );
	wp_register_style( 'armagen_merriweather', '//fonts.googleapis.com/css?family=Merriweather:400,300italic,400italic,700italic', '', null, 'screen' );
	wp_enqueue_style( 'armagen_open_sans' );
	wp_enqueue_style( 'armagen_merriweather' );
	wp_enqueue_style( 'armagen_icon_font', get_template_directory_uri() . '/fonts/custom/armagen-custom.css', array(), '1.0.0' );
}

add_action( 'wp_enqueue_scripts', 'armagen_fonts', 10 );


/**
 * Registers widget areas
 */
function armagen_widgets_init() {

	register_sidebar( array (
		'name'            => __( 'Sidebar', 'armagen' ),
		'id'              => 'sidebar',
		'before_widget'   => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'    => "</li>",
		'before_title'    => '<h3 class="widget-title">',
		'after_title'     => '</h3>',
	) );

    register_sidebar( array (
    'name'            => __( 'Right Sidebar', 'armagen' ),
    'id'              => 'right-sidebar',
    'description'     => 'Sidebar will show only when there is content added to it.',
    'before_widget'   => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget'    => "</li>",
    'before_title'    => '<h4 class="widget-title">',
    'after_title'     => '</h4>',
  ) );
}
add_action( 'init', 'armagen_widgets_init' );



/*-----------------------------------------------------------------------------------*/
/*	Add Custom Post Types
/*-----------------------------------------------------------------------------------*/
/**
 * News
*/
add_action( 'init', 'create_post_type_news' );
function create_post_type_news() {
register_post_type( 'News',
    array(
      'labels'             => array(
      'name'               => __( 'News' ),
      'singular_name'      => __( 'News' ),		
    	'add_new'            => _x( 'Add News Item', 'News' ),
    	'add_new_item'       => __( 'Add News Item' ),
    	'edit_item'          => __( 'Edit News' ),
    	'new_item'           => __( 'New News Item' ),
    	'view_item'          => __( 'View News' ),
    	'search_items'       => __( 'Search News' ),
    	'not_found'          => __( 'No News found' ),
    	'not_found_in_trash' => __( 'No News found in Trash' ),
    	'parent_item_colon'  => ''
    ),
    'public'    => true,
    'supports'  => array('title','editor','excerpt' ),
    'query_var' => true,
    'rewrite'   => array( 
        'slug' => 'news'
        ),
    )
  );
}
/**
 * Compounds
*/
add_action( 'init', 'create_post_type_compounds' );
function create_post_type_compounds() {
register_post_type( 'Compounds',
    array(
    'labels'             => array(
    'name'               => __( 'Compounds' ),
    'singular_name'      => __( 'Compounds' ),		
		'add_new'            => _x( 'Add Compound', 'Compound' ),
		'add_new_item'       => __( 'Add Compound' ),
		'edit_item'          => __( 'Edit Compound' ),
		'new_item'           => __( 'New Compound' ),
		'view_item'          => __( 'View Compound' ),
		'search_items'       => __( 'Search Compounds' ),
		'not_found'          => __( 'No Compounds found' ),
		'not_found_in_trash' => __( 'No Compounds found in Trash' ),
		'parent_item_colon'  => ''
    ),
    'public'    => true,
    'supports'  => array('title','editor','thumbnail' ),
    'query_var' => true,
    'rewrite'   => array( 
        'slug' => 'compounds'
        ),
    )
  );
}
// Add taxonomy to Compounds
add_action( 'init', 'create_disease' );
function create_disease() {
	$topic_labels = array(
		'name' => __( 'Disease' ),
		'singular_name' => __( 'Disease' ),
		'search_items' =>  __( 'Search Diseases' ),
		'all_items' => __( 'All Diseases' ),
		'parent_item' => __( 'Parent Disease' ),
		'parent_item_colon' => __( 'Parent Disease:' ),
		'edit_item' => __( 'Edit Disease' ),
		'update_item' => __( 'Update Disease' ),
		'add_new_item' => __( 'Add New Disease' ),
		'new_item_name' => __( 'New Disease Name' ),
		'choose_from_most_used'	=> __( 'Choose from the most used Diseases' )
	);
	register_taxonomy('disease_cat','compounds',array(
		'hierarchical' => true,
		'labels' => $disease_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'disease' ),
	));
}


/**
 * Timeline
*/
add_action( 'init', 'create_post_type_timeline' );
function create_post_type_timeline() {
register_post_type( 'Timeline',
    array(
    'labels'             => array(
    'name'               => __( 'Timeline' ),
    'singular_name'      => __( 'Timeline' ),    
    'add_new'            => _x( 'Add Timeline Entry', 'Timeline' ),
    'add_new_item'       => __( 'Add Timeline Entry' ),
    'edit_item'          => __( 'Edit Timeline Entry' ),
    'new_item'           => __( 'New Timeline' ),
    'view_item'          => __( 'View Timeline' ),
    'search_items'       => __( 'Search Timelines' ),
    'not_found'          => __( 'No Timelines found' ),
    'not_found_in_trash' => __( 'No Timelines found in Trash' ),
    'parent_item_colon'  => ''
    ),
    'public'    => true,
    'supports'  => array('title','editor','thumbnail' ),
    'query_var' => true,
    'rewrite'   => array( 
        'slug' => 'timeline'
        ),
    )
  );
}

/**
 * Management Team
 */
add_action( 'init', 'create_post_management' );
function create_post_management() {
register_post_type( 'Management',
    array(
      'labels' => array(
        'name' => __( 'Management Team' ),
        'singular_name' => __( 'Management' ),		
		'add_new' => _x( 'Add New', 'Management' ),
		'add_new_item' => __( 'Add New Management' ),
		'edit_item' => __( 'Edit Management' ),
		'new_item' => __( 'New Management' ),
		'view_item' => __( 'View Management' ),
		'search_items' => __( 'Search Management' ),
		'not_found' =>  __( 'No Management found' ),
		'not_found_in_trash' => __( 'No Management found in Trash' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail' ),
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'management' ),
    )
  );
}

/**
 * Board of Directors
 */
add_action( 'init', 'create_post_directors' );
function create_post_directors() {
register_post_type( 'Directors',
    array(
      'labels' => array(
        'name' => __( 'Board of Directors' ),
        'singular_name' => __( 'Director' ),		
		'add_new' => _x( 'Add New', 'Director' ),
		'add_new_item' => __( 'Add New Director' ),
		'edit_item' => __( 'Edit Director' ),
		'new_item' => __( 'New Director' ),
		'view_item' => __( 'View Directors' ),
		'search_items' => __( 'Search Directors' ),
		'not_found' =>  __( 'No Director found' ),
		'not_found_in_trash' => __( 'No Director found in Trash' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail' ),
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'directors' ),
    )
  );
}


/**
 * Careers
*/
add_action( 'init', 'create_post_type_careers' );
function create_post_type_careers() {
register_post_type( 'Careers',
    array(
    'labels'             => array(
    'name'               => __( 'Careers' ),
    'singular_name'      => __( 'Careers' ),    
    'add_new'            => _x( 'Add Position', 'Careers' ),
    'add_new_item'       => __( 'Add Position' ),
    'edit_item'          => __( 'Edit Position' ),
    'new_item'           => __( 'New Position' ),
    'view_item'          => __( 'View Position' ),
    'search_items'       => __( 'Search Positions' ),
    'not_found'          => __( 'No Position found' ),
    'not_found_in_trash' => __( 'No Position found in Trash' ),
    'parent_item_colon'  => ''
    ),
    'public'    => true,
    'supports'  => array('title','editor','thumbnail' ),
    'query_var' => true,
    'rewrite'   => array( 
        'slug' => 'careers'
        ),
    )
  );
}




/*-----------------------------------------------------------------------------------*/
/*	Editing the backend admin menu
/*-----------------------------------------------------------------------------------*/
// Remove links from menu
function edit_admin_menus() {  
  remove_menu_page('edit.php'); // Remove Posts 
	remove_menu_page('link-manager.php'); // Remove Links
}  
add_action( 'admin_menu', 'edit_admin_menus' ); 

// Define Order of Menu
function custom_menu_order($menu_ord) {  
  if (!$menu_ord) return true; 
  return array(  
    'index.php', // Dashboard  
    'separator1', // First separator  
	
	'edit.php?post_type=page', // Pages 
    'upload.php', // Media  
    'edit-comments.php', // Comments 
  );  
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order  
add_filter('menu_order', 'custom_menu_order');  


/*-----------------------------------------------------------------------------------*/
/*	Adds the media attachement ID to the Media Library listing
/*-----------------------------------------------------------------------------------*/
function column_id($columns) {
    $columns['colID'] = __('ID');
    return $columns;
}
add_filter( 'manage_media_columns', 'column_id' );
function column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'column_id_row', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/*	Remove excess from wp_head
/*-----------------------------------------------------------------------------------*/
function roots_head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  add_filter('use_default_gallery_style', '__return_null');
}
add_action('init', 'roots_head_cleanup');


/*------------------------------------------------*/
/*---------[CUSTOM HOME PAGE STYLES]--------------*/
/*------------------------------------------------*/


 //Loads the custom home-page.php styles, when needed.
function homepage_scripts() {
    if ( is_front_page() ) {
        wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/front-page.css' );
    }
}

add_action('wp_enqueue_scripts', 'homepage_scripts');


function custom_excerpt_length( $length ) {
  return 8;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * Add Owl Carousel to homepage
 */
function owl_enqueue_script() {
  if ( is_front_page() ) {
    wp_register_script( 'owlslider', get_template_directory_uri() . '/plugins/owl-carousel/owl.carousel.min.js', 'jquery', '', TRUE);
  wp_enqueue_script( 'owlslider' );
  }
}
add_action( 'wp_enqueue_scripts', 'owl_enqueue_script' );
function owl_enqueue_style() {
  if ( is_front_page() ) {
    wp_register_style( 'owlslidercss', get_template_directory_uri() . '/plugins/owl-carousel/owl.carousel.css');
  wp_enqueue_style( 'owlslidercss' );
  }
}
add_action( 'wp_enqueue_scripts', 'owl_enqueue_style' );
