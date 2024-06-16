<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package LiLO
 */

/**
* Get a single theme option
*
* @return mixed
*/
function lilo_get_option( $option_name = '' ) {

	// Get all Theme Options from Database.
	$theme_options = lilo_theme_options();

	// Return single option.
	if ( isset( $theme_options[ $option_name ] ) ) {
		return $theme_options[ $option_name ];
	}

	return false;
}


/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function lilo_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'lilo_theme_options', array() ), lilo_default_options() );

	// Return theme options.
	return apply_filters( 'lilo_theme_options', $theme_options );
}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function lilo_default_options() {

	$default_options = array(
		'retina_logo'            => false,
		'site_title'             => false,
		'site_description'       => false,
		'theme_layout'           => 'wide',
		'sidebar_position'       => 'right-sidebar',
		'blog_layout'            => 'vertical-list',
		'blog_image'             => 'lilo-ultra-wide',
		'blog_content'           => 'excerpt',
		'excerpt_length'         => 25,
		'excerpt_more_text'      => '[...]',
		'read_more_link'         => esc_html__( 'Read more', 'lilo' ),
		'meta_date'              => true,
		'meta_author'            => false,
		'meta_comments'          => false,
		'meta_categories'        => true,
		'single_meta_date'       => true,
		'single_meta_author'     => false,
		'single_meta_comments'   => true,
		'single_meta_categories' => true,
		'post_layout'            => 'above-title',
		'post_image'             => 'lilo-ultra-wide',
		'meta_tags'              => true,
		'post_navigation'        => true,
		'post_image_archives'    => true,
		'post_image_single'      => true,
		'featured_posts'         => false,
		'featured_category'      => 0,
		'featured_layout'        => 1,
		'footer_text'            => '',
		'credit_link'            => false,
	);

	return apply_filters( 'lilo_default_options', $default_options );
}
