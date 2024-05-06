<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package LiLO
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function lilo_customize_register_blog_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'lilo_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'lilo' ),
		'priority' => 30,
		'panel'    => 'lilo_options_panel',
	) );

	// Get Default Settings.
	$default = lilo_default_options();

	// Add Settings and Controls for blog layout.
	$wp_customize->add_setting( 'lilo_theme_options[blog_layout]', array(
		'default'           => $default['blog_layout'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[blog_layout]', array(
		'label'    => esc_html__( 'Blog Layout', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'lilo_theme_options[blog_layout]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			'horizontal-list'     => esc_html__( 'Horizontal List', 'lilo' ),
			'horizontal-list-alt' => esc_html__( 'Horizontal List (alternative)', 'lilo' ),
			'vertical-list'       => esc_html__( 'Vertical List', 'lilo' ),
			'vertical-list-alt'   => esc_html__( 'Vertical List (alternative)', 'lilo' ),
			'two-column-grid'     => esc_html__( 'Two Column Grid', 'lilo' ),
			'three-column-grid'   => esc_html__( 'Three Column Grid', 'lilo' ),
		),
	) );

	// Add Settings and Controls for blog image.
	$wp_customize->add_setting( 'lilo_theme_options[blog_image]', array(
		'default'           => $default['blog_image'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[blog_image]', array(
		'label'    => esc_html__( 'Blog Image', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'lilo_theme_options[blog_image]',
		'type'     => 'select',
		'priority' => 20,
		'choices'  => array(
			'lilo-ultra-wide' => esc_html__( 'Ultra Wide (3:1)', 'lilo' ),
			'lilo-landscape'  => esc_html__( 'Landscape (16:9)', 'lilo' ),
			'lilo-classic'    => esc_html__( 'Classic (4:3)', 'lilo' ),
			'lilo-square'     => esc_html__( 'Square (1:1)', 'lilo' ),
			'lilo-portrait'   => esc_html__( 'Portrait (3:4)', 'lilo' ),
			'post-thumbnail'      => esc_html__( 'Flexible Height', 'lilo' ),
			'hide-image'          => esc_html__( 'Hide Image', 'lilo' ),
		),
	) );

	// Add Settings and Controls for blog content.
	$wp_customize->add_setting( 'lilo_theme_options[blog_content]', array(
		'default'           => $default['blog_content'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[blog_content]', array(
		'label'    => esc_html__( 'Blog Content', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'lilo_theme_options[blog_content]',
		'type'     => 'radio',
		'priority' => 30,
		'choices'  => array(
			'full'    => esc_html__( 'Full post', 'lilo' ),
			'excerpt' => esc_html__( 'Post excerpt', 'lilo' ),
		),
	) );

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'lilo_theme_options[excerpt_length]', array(
		'default'           => $default['excerpt_length'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'lilo_theme_options[excerpt_length]', array(
		'label'    => esc_html__( 'Excerpt Length', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'lilo_theme_options[excerpt_length]',
		'type'     => 'number',
		'priority' => 40,
	) );

	// Add Setting and Control for Excerpt More Text.
	$wp_customize->add_setting( 'lilo_theme_options[excerpt_more_text]', array(
		'default'           => $default['excerpt_more_text'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'lilo_theme_options[excerpt_more_text]', array(
		'label'    => esc_html__( 'Excerpt More Text', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'lilo_theme_options[excerpt_more_text]',
		'type'     => 'text',
		'priority' => 50,
	) );

	// Add Partial for Blog Layout and Excerpt Length.
	$wp_customize->selective_refresh->add_partial( 'lilo_blog_layout_partial', array(
		'selector'         => '.site-main .post-wrapper',
		'settings'         => array(
			'lilo_theme_options[blog_layout]',
			'lilo_theme_options[blog_image]',
			'lilo_theme_options[blog_content]',
			'lilo_theme_options[excerpt_length]',
			'lilo_theme_options[excerpt_more_text]',
			'posts_per_page',
			'lilo_theme_options[featured_posts]',
			'lilo_theme_options[featured_category]',
			'lilo_theme_options[featured_layout]',
		),
		'render_callback'  => 'lilo_customize_partial_blog_layout',
		'fallback_refresh' => false,
	) );

	// Add Setting and Control for Read More Text.
	$wp_customize->add_setting( 'lilo_theme_options[read_more_link]', array(
		'default'           => $default['read_more_link'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'lilo_theme_options[read_more_link]', array(
		'label'    => esc_html__( 'Read More Link', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'lilo_theme_options[read_more_link]',
		'type'     => 'text',
		'priority' => 60,
	) );

	// Add Setting and Control for Number of posts.
	$wp_customize->add_setting( 'posts_per_page', array(
		'default'           => absint( get_option( 'posts_per_page' ) ),
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'lilo_posts_per_page_setting', array(
		'label'    => esc_html__( 'Number of Posts', 'lilo' ),
		'section'  => 'lilo_section_blog',
		'settings' => 'posts_per_page',
		'type'     => 'number',
		'priority' => 70,
	) );
}
add_action( 'customize_register', 'lilo_customize_register_blog_settings' );

/**
 * Render the blog layout for the selective refresh partial.
 */
function lilo_customize_partial_blog_layout() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/blog/content', esc_attr( lilo_get_option( 'blog_layout' ) ) );
	}
}
