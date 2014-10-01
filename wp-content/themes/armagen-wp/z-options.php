<?php
/**
 * This file only gets loaded if the Options Framework plugin is installed
 *
 * A unique identifier is defined to store the options in the database
 * and reference them from the theme.  By default it uses 'armagen'.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package ArmaGen
 */

function optionsframework_option_name() {

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'armagen';
	update_option('optionsframework', $optionsframework_settings);

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 * @returns array $options
 */

function optionsframework_options() {

	// If using image radio buttons, define a directory path
	$imagepath =  esc_url( get_template_directory_uri() . '/images/' );

	// Options array
	$options = array();

	/* General Settings */

	$options[] = array(
		"name" => __( 'General Settings', 'armagen' ),
		"type" => "heading"
	);

	$options['logo'] = array(
		"name" => __( 'Custom Logo', 'armagen' ),
		"desc" => __( 'Upload a logo for your theme if you would like to use one.','armagen' ),
		"id" => "logo",
		"type" => "upload");

	$options[] = array(
		"name" => __( 'Custom Favicon', 'armagen' ),
		"desc" => __( 'Upload a 16px x 16px png/gif image to represent your website.' , 'armagen' ),
		"id" => "custom_favicon",
		"type" => "upload"
	);

	if ( class_exists( 'Portfolio_Post_Type' ) ) {

		$options[] = array(
			"name" => __( 'Display Images on Portfolio / Image Posts', 'armagen' ),
			"desc" => __( 'Display featured images automatically on posts.', 'armagen' ),
			"id" => "portfolio_images",
			"std" => "1",
			"type" => "checkbox"
		);

	} else {

		$options[] = array(
			"name" => __( 'Display Images Automatically on Image Post Formats', 'armagen' ),
			"desc" => __( 'Display featured images automatically on posts.', 'armagen' ),
			"id" => "portfolio_images",
			"std" => "1",
			"type" => "checkbox"
		);

	}

	if ( class_exists( 'Portfolio_Post_Type' ) ) {

		$options[] = array(
			"name" => __( 'Display Portfolio / Image / Galleries Full Width', 'armagen' ),
			"desc" => __( 'Display all image based archives full width.', 'armagen' ),
			"id" => "portfolio_sidebar",
			"std" => "0",
			"type" => "checkbox"
		);

	} else {

		$options[] = array(
			"name" => __( 'Display Image and Gallery Post Format Archives Full Width', 'armagen' ),
			"desc" => __( 'Display all image/gallery archives full width.', 'armagen' ),
			"id" => "portfolio_sidebar",
			"std" => "0",
			"type" => "checkbox"
		);

	}

	$options[] = array(
		"name" => __( 'Display Image and Gallery Formats on Posts Page', 'armagen' ),
		"desc" => __( 'Display all post formats on posts page.', 'armagen' ),
		"id" => "display_image_gallery_post_formats",
		"std" => "1",
		"type" => "checkbox"
	);

	$options['archive_titles'] = array(
		'name' => __( 'Archive Titles', 'armagen' ),
		'desc' => __( 'Display archive titles and descriptions.', 'armagen' ),
		'id' => 'archive_titles',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Posts Per Page', 'armagen' ),
		'desc' => sprintf( '<p>%s</p>',
			sprintf(
				__( 'Posts per page can be set in the <a href="%s">reading options</a>.', 'armagen' ),
				admin_url( 'options-reading.php', false )
				)
			),
		'type' => 'info'
	);

	/* Style and Layout */

	$options[] = array(
		"name" => __( 'Style and Layout','armagen' ),
		"type" => "heading");

	$options['layout'] = array(
		'name' => __( 'Main Layout','armagen' ),
		'desc' => __( 'Select main content and sidebar alignment.','armagen' ),
		'id' => 'layout',
		'std' => 'layout-2cr',
		'type' => 'images',
		'options' => array(
			'layout-2cr' => $imagepath . '2cr.png',
			'layout-2cl' => $imagepath . '2cl.png',
			'layout-1col' => $imagepath . '1cl.png')
		);

	$options[] = array(
		"name" => __( 'Header Color','armagen' ),
		"id" => "header_color",
		"std" => "#000000",
		"type" => "color"
	);

	$options['menu_position'] = array(
		"name" => __( 'Menu Position', 'armagen' ),
		"desc" => __( 'Select where the main menu should go in the header.  Long menus should go underneath.','armagen' ),
		"id" => "menu_position",
		"std" => "right",
		"type" => "radio",
		"options" => array(
			"right" => __( 'Right of logo.', 'armagen' ),
			"clear" => __( 'Underneath logo', 'armagen' )
		)
	);

	/* Footer Settings */

	$options[] = array(
		"name" => __( 'Footer Settings', 'armagen' ),
		"type" => "heading"
	);

	$options[] = array(
		"name" => __( 'Custom Footer Text', 'armagen' ),
		"desc" => __( 'Custom text that will appear in the footer of your theme.','armagen' ),
		"id" => "footer_text",
		"type" => "textarea"
	);

	/* More Information */

	$options[] = array(
		"name" => __( 'More', 'armagen' ),
		"type" => "heading"
	);

	$options[] = array(
		'name' => __( 'Theme Support', 'armagen' ),
		'desc' => sprintf(
				'<p>%s</p>',
				sprintf(
					__( 'If you need help with ArmaGen, check if your question has been answered in the <a href="%s">theme FAQ</a>.', 'armagen' ),
					esc_url( 'http://wptheming.com/armagen' )
				)
			),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Additional Options in Portfolio+', 'armagen' ),
		'desc' => sprintf(
				'<p>%s</p><p>%s</p><ul><li>%s</li><li>%s</li><li>%s</li><li>%s</li><li>%s</li><li>%s</li></ul><p>%s</p>',
				sprintf(
					__( 'If you like this theme and would like to support further development, consider purchasing <a href="%s">Portfolio+</a>.', 'armagen' ),
					esc_url( 'http://wptheming.com/portfolio-plus' )
				),
				__( 'You will also get these additional features:', 'armagen' ),
				__( 'Text Color Options', 'armagen' ),
				__( 'Background Stye Options', 'armagen' ),
				__( 'Additional Page Templates', 'armagen' ),
				__( 'Option to Hide Post Dates', 'armagen' ),
				__( 'Full Width Option for Individual Posts', 'armagen' ),
				__( 'Ability to Hide Images on Individual Posts', 'armagen' ),
				__( 'Infinite Scroll', 'armagen' ),
				__( 'Priority Support', 'armagen' ),
				sprintf(
					__( '<a href="%s">Read More</a>', 'armagen' ),
					esc_url( 'http://wptheming.com/portfolio-plus' )
				)
			),
		'type' => 'info'
	);

	/* Utility Options (Not Displayed) */

	$options[] = array(
		"name" => __( 'Upgrade', 'armagen' ),
		"id" => "upgrade",
		"std" => '0',
		"class" => "hidden",
		"type" => "text" );

	$options[] = array(
		"name" => __( 'Version', 'armagen' ),
		"id" => "version",
		"std" => '1.9',
		"class" => "hidden",
		"type" => "text"
	);

	return $options;
}

/**
 * Additional content to display after the options panel
 */
function armagen_panel_info() { ?>
    <p style="color: #777;">
    <?php printf(
    	__( 'Theme <a href="%s">documentation</a>.  For additional options, see <a href="%s">Portfolio+</a>.', 'armagen' ),
    	esc_url( 'http://wptheming.com/armagen' ),
    	esc_url( 'http://wptheming.com/portfolio-plus' )
    );
    ?>
    </p>
<?php }

add_action( 'optionsframework_after', 'armagen_panel_info', 100 );