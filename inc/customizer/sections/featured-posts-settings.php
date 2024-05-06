<?php
/**
 * Featured Content Settings
 *
 * Register Featured Posts section, settings and controls for Theme Customizer
 *
 * @package LiLO
 */

/**
 * Adds featured settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function lilo_customize_register_featured_settings( $wp_customize ) {

	// Add Featured Posts Section.
	$wp_customize->add_section( 'lilo_section_featured', array(
		'title'    => esc_html__( 'Featured Posts', 'lilo' ),
		'priority' => 20,
		'panel'    => 'lilo_options_panel',
	) );

	// Get Default Settings.
	$default = lilo_default_options();

	// Add settings and controls for Featured Posts.
	$wp_customize->add_control( new LiLO_Customize_Header_Control(
		$wp_customize, 'lilo_theme_options[featured_posts_title]', array(
			'label'    => esc_html__( 'Display Featured Posts', 'lilo' ),
			'section'  => 'lilo_section_featured',
			'settings' => array(),
			'priority' => 10,
		)
	) );

	$wp_customize->add_setting( 'lilo_theme_options[featured_posts]', array(
		'default'           => $default['featured_posts'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[featured_posts]', array(
		'label'    => esc_html__( 'Show Featured Posts on blog page', 'lilo' ),
		'section'  => 'lilo_section_featured',
		'settings' => 'lilo_theme_options[featured_posts]',
		'type'     => 'checkbox',
		'priority' => 20,
	) );

	// Add Setting and Control for Featured Posts Category.
	$wp_customize->add_setting( 'lilo_theme_options[featured_category]', array(
		'default'           => $default['featured_category'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new LiLO_Customize_Category_Dropdown_Control(
		$wp_customize, 'lilo_theme_options[featured_category]', array(
			'label'    => esc_html__( 'Featured Posts Category', 'lilo' ),
			'section'  => 'lilo_section_featured',
			'settings' => 'lilo_theme_options[featured_category]',
			'priority' => 30,
		)
	) );

	// Add Settings and Controls for blog image.
	$wp_customize->add_setting( 'lilo_theme_options[featured_layout]', array(
		'default'           => $default['featured_layout'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[featured_layout]', array(
		'label'    => esc_html__( 'Featured Posts Layout', 'lilo' ),
		'section'  => 'lilo_section_featured',
		'settings' => 'lilo_theme_options[featured_layout]',
		'type'     => 'select',
		'priority' => 40,
		'choices'  => array(
			1 => esc_html__( 'One Post', 'lilo' ),
			4 => esc_html__( 'Four Posts', 'lilo' ),
		),
	) );

	// Add Partial for Featured Post Settings.
	$wp_customize->selective_refresh->add_partial( 'lilo_featured_posts_partial', array(
		'selector'         => '.site #featured-posts',
		'settings'         => array(
			'lilo_theme_options[featured_posts]',
			'lilo_theme_options[featured_category]',
			'lilo_theme_options[featured_layout]',
		),
		'render_callback'  => 'lilo_customize_partial_featured_posts',
		'fallback_refresh' => false,
	) );
}
add_action( 'customize_register', 'lilo_customize_register_featured_settings' );


/**
 * Render the featured posts for the selective refresh partial.
 */
function lilo_customize_partial_featured_posts() {
	if ( true === lilo_get_option( 'featured_posts' ) ) :
		get_template_part( 'template-parts/featured/featured-posts' );
	endif;
}
