<?php
/**
 * @package ArmaGen
 */

/**
 * Helper function to get options set by the Options Framework plugin
 */
if ( !function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {

	$optionsframework_settings = get_option( 'optionsframework' );

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}

	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
endif;

/**
 * Adds a body class to indicate sidebar position
 */
function armagen_body_class_options( $classes ) {

	// Layout options
	$classes[] = of_get_option( 'layout','layout-2cr' );

	// Clear the menu if selected
	if ( of_get_option( 'menu_position', false ) == 'clear' ) {
		$classes[] = 'clear-menu';
	}

	return $classes;
}
add_filter( 'body_class', 'armagen_body_class_options' );

/**
 * Favicon Option
 */
function portfolio_favicon() {
	$favicon = of_get_option( 'custom_favicon', false );
	if ( $favicon ) {
        echo '<link rel="shortcut icon" href="' . esc_url( $favicon ) . '"/>'."\n";
    }
}
add_action( 'wp_head', 'portfolio_favicon' );

/**
 * Menu Position Option
 */
function portfolio_head_css() {

		$output = '';

		if ( of_get_option( 'header_color' ) != "#000000") {
			$output .= "#branding {background:" . of_get_option('header_color') . "}\n";
		}

		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
}

add_action( 'wp_head', 'portfolio_head_css' );

/**
 * Removes image and gallery post formats from is_home if option is set
 */
function armagen_exclude_post_formats( $query ) {
	if (
		! of_get_option( 'display_image_gallery_post_formats', true ) &&
		$query->is_main_query() &&
		$query->is_home()
	) {
		$tax_query = array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-image',
					'post-format-gallery'
				),
				'operator' => 'NOT IN',
			)
		);
		$query->set( 'tax_query', $tax_query );
	}
}
add_action( 'pre_get_posts', 'armagen_exclude_post_formats' );

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */

if ( function_exists( 'optionsframework_init' ) ) {
	add_action( 'customize_register', 'armagen_customize_register' );
}

function armagen_customize_register( $wp_customize ) {

	$options = optionsframework_options();

	/* Title & Tagline */

	$wp_customize->add_setting( 'armagen[logo]', array(
		'type' => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label' => $options['logo']['name'],
		'section' => 'title_tagline',
		'settings' => 'armagen[logo]'
	) ) );

	/* Layout */

	$wp_customize->add_section( 'armagen_layout', array(
		'title' => __( 'Layout', 'armagen' ),
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'armagen[layout]', array(
		'default' => 'layout-2cr',
		'type' => 'option'
	) );

	$wp_customize->add_control( 'armagen_layout', array(
		'label' => $options['layout']['name'],
		'section' => 'armagen_layout',
		'settings' => 'armagen[layout]',
		'type' => 'radio',
		'choices' => array(
			'layout-2cr' => __( 'Sidebar Right', 'armagen' ),
			'layout-2cl' => __( 'Sidebar Left', 'armagen' ),
			'layout-1col' => __( 'Single Column', 'armagen' )
		)
	) );

	$wp_customize->add_setting( 'armagen[menu_position]', array(
		'default' => 'right',
		'type' => 'option'
	) );

	$wp_customize->add_control( 'armagen_menu_position', array(
		'label' => $options['menu_position']['name'],
		'section' => 'nav',
		'settings' => 'armagen[menu_position]',
		'type' => 'radio',
		'choices' => $options['menu_position']['options']
	) );

	/* Header Styles */

	$wp_customize->add_section( 'armagen_header_styles', array(
		'title' => __( 'Header Style', 'armagen' ),
		'priority' => 105,
	) );

	$wp_customize->add_setting( 'armagen[header_color]', array(
		'default' => '#000000',
		'type' => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
		'label' => __( 'Background Color', 'armagen' ),
		'section' => 'armagen_header_styles',
		'settings' => 'armagen[header_color]'
	) ) );

	/* PostMessage Support */
	$wp_customize->get_setting( 'armagen[header_color]' )->transport = 'postMessage';
}

/**
 * Register asynchronous customizer support for core controls.
 */
function armagen_async_suport_core( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'armagen_async_suport_core' );

/**
 * Enqueue script enabling asynchronous customizer support.
 */
function armagen_customize_preview_js() {
	wp_enqueue_script( 'armagen_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140221', true );
}
add_action( 'customize_preview_init', 'armagen_customize_preview_js' );