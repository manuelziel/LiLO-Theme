<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package LiLO
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function lilo_gutenberg_support() {

	// Add theme support for wide and full images.
	add_theme_support( 'align-wide' );

	// Add theme support for dimension controls.
	add_theme_support( 'custom-spacing' );

	// Add theme support for custom line heights.
	add_theme_support( 'custom-line-height' );

	// Define block color palette.
	$color_palette = apply_filters( 'lilo_color_palette', array(
		'primary_color'    => '#e84747',
		'secondary_color'  => '#cb3e3e',
		'tertiary_color'   => '#ae3535',
		'contrast_color'   => '#4747e8',
		'accent_color'     => '#47e897',
		'highlight_color'  => '#e8e847',
		'light_gray_color' => '#eeeeee',
		'gray_color'       => '#777777',
		'dark_gray_color'  => '#333333',
	) );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'lilo_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'lilo' ),
			'slug'  => 'primary',
			'color' => esc_html( $color_palette['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'lilo' ),
			'slug'  => 'secondary',
			'color' => esc_html( $color_palette['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Tertiary', 'block color', 'lilo' ),
			'slug'  => 'tertiary',
			'color' => esc_html( $color_palette['tertiary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Contrast', 'block color', 'lilo' ),
			'slug'  => 'contrast',
			'color' => esc_html( $color_palette['contrast_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'lilo' ),
			'slug'  => 'accent',
			'color' => esc_html( $color_palette['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'lilo' ),
			'slug'  => 'highlight',
			'color' => esc_html( $color_palette['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'lilo' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'lilo' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $color_palette['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'lilo' ),
			'slug'  => 'gray',
			'color' => esc_html( $color_palette['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'lilo' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $color_palette['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'lilo' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Add theme support for font sizes.
	add_theme_support( 'editor-font-sizes', apply_filters( 'lilo_editor_font_sizes_args', array(
		array(
			'name' => esc_html_x( 'Small', 'block font size', 'lilo' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => esc_html_x( 'Medium', 'block font size', 'lilo' ),
			'size' => 24,
			'slug' => 'medium',
		),
		array(
			'name' => esc_html_x( 'Large', 'block font size', 'lilo' ),
			'size' => 36,
			'slug' => 'large',
		),
		array(
			'name' => esc_html_x( 'Extra Large', 'block font size', 'lilo' ),
			'size' => 48,
			'slug' => 'extra-large',
		),
		array(
			'name' => esc_html_x( 'Huge', 'block font size', 'lilo' ),
			'size' => 64,
			'slug' => 'huge',
		),
	) ) );

	// Check if block style functions are available.
	if ( function_exists( 'register_block_style' ) ) {

		// Register Widget Title Block style.
		register_block_style( 'core/heading', array(
			'name'         => 'widget-title',
			'label'        => esc_html__( 'Widget Title', 'lilo' ),
			'style_handle' => 'lilo-stylesheet',
		) );
	}

	// Check if block pattern functions are available.
	if ( function_exists( 'register_block_pattern' ) && function_exists( 'register_block_pattern_category' ) ) {

		// Register lilo block pattern category.
		register_block_pattern_category( 'lilo', array( 'label' => esc_html__( 'LiLO', 'lilo' ) ) );

		// Register Block patterns.
		register_block_pattern( 'lilo/portfolio', array(
			'title'      => esc_html__( 'Portfolio', 'lilo' ),
			'content'    => "<!-- wp:group --><div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Project 1</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Project 2</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Project 3</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Project 4</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Project 5</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Project 6</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'lilo' ),
		) );

		register_block_pattern( 'lilo/services', array(
			'title'      => esc_html__( 'Services', 'lilo' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 1</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:spacer --><div style=\"height:100px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:media-text {\"mediaPosition\":\"right\"} --><div class=\"wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 2</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:spacer --><div style=\"height:100px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 3</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group -->",
			'categories' => array( 'lilo' ),
		) );

		register_block_pattern( 'lilo/about', array(
			'title'      => esc_html__( 'About', 'lilo' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":30} --><div class=\"wp-block-column\" style=\"flex-basis:30%\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>About us</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:separator {\"className\":\"is-style-wide\"} --><hr class=\"wp-block-separator is-style-wide\"/><!-- /wp:separator --><!-- wp:paragraph {\"fontSize\":\"large\"} --><p class=\"has-large-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --><!-- wp:separator {\"className\":\"is-style-wide\"} --><hr class=\"wp-block-separator is-style-wide\"/><!-- /wp:separator --><!-- wp:spacer {\"height\":30} --><div style=\"height:30px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:heading {\"level\":3} --><h3>Service 1</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Service 2</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Service 3</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'lilo' ),
		) );

		register_block_pattern( 'lilo/projects', array(
			'title'      => esc_html__( 'Projects', 'lilo' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":20} --><div class=\"wp-block-column\" style=\"flex-basis:20%\"><!-- wp:heading --><h2>Projects</h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 1</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 2</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'lilo' ),
		) );
	}
}
add_action( 'after_setup_theme', 'lilo_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function lilo_block_editor_assets() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Editor Styling.
	wp_enqueue_style( 'lilo-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), $theme_version, 'all' );

	// Get current screen.
	$current_screen = get_current_screen();

	// Enqueue Page Template Switcher Editor plugin.
	if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() && 'post' === $current_screen->base ) {
		wp_enqueue_script( 'lilo-page-template-switcher', get_theme_file_uri( '/assets/js/page-template-switcher.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), $theme_version );
	}
}
add_action( 'enqueue_block_editor_assets', 'lilo_block_editor_assets' );


/**
 * Add body classes in Gutenberg Editor.
 */
function lilo_block_editor_body_classes( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() && 'post' === $current_screen->base ) ) {
		return $classes;
	}

	// Set Theme Layout.
	if ( 'wide' === lilo_get_option( 'theme_layout' ) ) {
		$classes .= ' lilo-wide-theme-layout ';
	} else {
		$classes .= ' lilo-centered-theme-layout ';
	}

	// Fullwidth Page Template?
	if ( 'templates/template-fullwidth.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' lilo-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if ( 'templates/template-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-left-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-right-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' lilo-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ( 'templates/template-fullwidth-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' lilo-fullwidth-page-layout lilo-page-title-hidden ';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'lilo_block_editor_body_classes' );
