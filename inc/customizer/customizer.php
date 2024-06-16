<?php
/**
 * Implement theme options in the Customizer
 *
 * @package LiLO
 */

// Load Sanitize Functions.
require( get_template_directory() . '/inc/customizer/sanitize-functions.php' );

// Load Custom Controls.
require( get_template_directory() . '/inc/customizer/controls/category-dropdown-control.php' );
require( get_template_directory() . '/inc/customizer/controls/headline-control.php' );

// Load Customizer Sections.
require( get_template_directory() . '/inc/customizer/sections/website-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/colors-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/layout-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/featured-posts-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/blog-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/post-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/footer-settings.php' );

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 * @param object $wp_customize / Customizer Object.
 */
function lilo_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'lilo_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'lilo' ),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title   = esc_html__( 'Background', 'lilo' );
}
add_action( 'customize_register', 'lilo_customize_register_options' );


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function lilo_customize_preview_js() {
	wp_enqueue_script( 'lilo-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20201114', true );
}
add_action( 'customize_preview_init', 'lilo_customize_preview_js' );


/**
 * Embed JS for Customizer Controls.
 */
function lilo_customizer_controls_js() {
	wp_enqueue_script( 'lilo-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '20201116', true );
}
add_action( 'customize_controls_enqueue_scripts', 'lilo_customizer_controls_js' );


/**
 * Embed CSS styles Customizer Controls.
 */
function lilo_customizer_controls_css() {
	wp_enqueue_style( 'lilo-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '20201119' );
}
add_action( 'customize_controls_print_styles', 'lilo_customizer_controls_css' );

/**
 * Add inline CSS based on customizer settings
 */
function lilo_customizer_css() {
    $selected_color_scheme = get_theme_mod('theme_color_scheme', 'lilo');

    switch ($selected_color_scheme) {
        case 'lhl':
            $primary_color_one = '#408000';
            $primary_color_two = '#333333';
            $primary_color_three = '#ffffff';
            $secondary_color_one = '#808080';
            $secondary_color_two = '#cccccc';
            $accent_color = '#408000';
            break;
        case 'manu':
            $primary_color_one = '#3771c8';
            $primary_color_two = '#060E1A';
            $primary_color_three = '#ffffff';
            $secondary_color_one = '#808080';
            $secondary_color_two = '#cccccc';
            $accent_color = '#3771c8';
            break;
        default:
            $primary_color_one = '#cc3333';
            $primary_color_two = '#333333';
            $primary_color_three = '#ffffff';
            $secondary_color_one = '#808080';
            $secondary_color_two = '#cccccc';
            $accent_color = '#cc3333';
    }

    echo "<style>:root {
        --primary-color-one: {$primary_color_one};
        --primary-color-two: {$primary_color_two};
        --primary-color-three: {$primary_color_three};
        --secondary-color-one: {$secondary_color_one};
        --secondary-color-two: {$secondary_color_two};
        --accent-color: {$accent_color};
    }</style>";
}
add_action('wp_head', 'lilo_customizer_css');