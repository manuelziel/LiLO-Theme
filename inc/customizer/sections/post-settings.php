<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package LiLO
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function lilo_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'lilo_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'lilo' ),
		'priority' => 40,
		'panel'    => 'lilo_options_panel',
	) );

	// Get Default Settings.
	$default = lilo_default_options();

	// Add Post Details Headline.
	$wp_customize->add_control( new LiLO_Customize_Header_Control(
		$wp_customize, 'lilo_theme_options[post_details_blog]', array(
			'label'    => esc_html__( 'Post Details on blog and archives', 'lilo' ),
			'section'  => 'lilo_section_post',
			'settings' => array(),
			'priority' => 10,
		)
	) );

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'lilo_theme_options[meta_date]', array(
		'default'           => $default['meta_date'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display date', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 20,
	) );

	// Add Setting and Control for showing post author.
	$wp_customize->add_setting( 'lilo_theme_options[meta_author]', array(
		'default'           => $default['meta_author'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display author', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 30,
	) );

	// Add Setting and Control for showing post comments.
	$wp_customize->add_setting( 'lilo_theme_options[meta_comments]', array(
		'default'           => $default['meta_comments'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[meta_comments]', array(
		'label'    => esc_html__( 'Display comments', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[meta_comments]',
		'type'     => 'checkbox',
		'priority' => 40,
	) );

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'lilo_theme_options[meta_categories]', array(
		'default'           => $default['meta_categories'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[meta_categories]', array(
		'label'    => esc_html__( 'Display categories', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[meta_categories]',
		'type'     => 'checkbox',
		'priority' => 50,
	) );

	// Add Post Details Headline.
	$wp_customize->add_control( new LiLO_Customize_Header_Control(
		$wp_customize, 'lilo_theme_options[post_details_single]', array(
			'label'    => esc_html__( 'Post Details on single posts', 'lilo' ),
			'section'  => 'lilo_section_post',
			'settings' => array(),
			'priority' => 60,
		)
	) );

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'lilo_theme_options[single_meta_date]', array(
		'default'           => $default['single_meta_date'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[single_meta_date]', array(
		'label'    => esc_html__( 'Display date', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[single_meta_date]',
		'type'     => 'checkbox',
		'priority' => 70,
	) );

	// Add Setting and Control for showing post author.
	$wp_customize->add_setting( 'lilo_theme_options[single_meta_author]', array(
		'default'           => $default['single_meta_author'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[single_meta_author]', array(
		'label'    => esc_html__( 'Display author', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[single_meta_author]',
		'type'     => 'checkbox',
		'priority' => 80,
	) );

	// Add Setting and Control for showing post comments.
	$wp_customize->add_setting( 'lilo_theme_options[single_meta_comments]', array(
		'default'           => $default['single_meta_comments'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[single_meta_comments]', array(
		'label'    => esc_html__( 'Display comments', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[single_meta_comments]',
		'type'     => 'checkbox',
		'priority' => 90,
	) );

	// Add Settings and Controls for post layout.
	$wp_customize->add_setting( 'lilo_theme_options[post_layout]', array(
		'default'           => $default['post_layout'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[post_layout]', array(
		'label'    => esc_html__( 'Single Post Layout', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[post_layout]',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => array(
			'above-title' => esc_html__( 'Featured image above title', 'lilo' ),
			'below-title' => esc_html__( 'Featured image below title', 'lilo' ),
			'no-image'    => esc_html__( 'Hide Image', 'lilo' ),
		),
	) );

	// Add Settings and Controls for blog image.
	$wp_customize->add_setting( 'lilo_theme_options[post_image]', array(
		'default'           => $default['post_image'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[post_image]', array(
		'label'    => esc_html__( 'Single Post Image', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[post_image]',
		'type'     => 'select',
		'priority' => 110,
		'choices'  => array(
			'lilo-ultra-wide' => esc_html__( 'Ultra Wide (3:1)', 'lilo' ),
			'lilo-landscape'  => esc_html__( 'Landscape (16:9)', 'lilo' ),
			'lilo-classic'    => esc_html__( 'Classic (4:3)', 'lilo' ),
			'post-thumbnail'      => esc_html__( 'Flexible Height', 'lilo' ),
		),
	) );

	// Add Partial for Blog Layout and Excerpt Length.
	$wp_customize->selective_refresh->add_partial( 'lilo_single_post_partial', array(
		'selector'         => '.single-post .site-main',
		'settings'         => array(
			'lilo_theme_options[post_layout]',
			'lilo_theme_options[post_image]',
		),
		'render_callback'  => 'lilo_customize_partial_single_post',
		'fallback_refresh' => false,
	) );

	// Add Single Post Headline.
	$wp_customize->add_control( new LiLO_Customize_Header_Control(
		$wp_customize, 'lilo_theme_options[single_post]', array(
			'label'    => esc_html__( 'Single Post Footer', 'lilo' ),
			'section'  => 'lilo_section_post',
			'settings' => array(),
			'priority' => 120,
		)
	) );

	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'lilo_theme_options[meta_tags]', array(
		'default'           => $default['meta_tags'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display tags', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 140,
	) );

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'lilo_theme_options[single_meta_categories]', array(
		'default'           => $default['single_meta_categories'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[single_meta_categories]', array(
		'label'    => esc_html__( 'Display categories', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[single_meta_categories]',
		'type'     => 'checkbox',
		'priority' => 150,
	) );

	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'lilo_theme_options[post_navigation]', array(
		'default'           => $default['post_navigation'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lilo_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'lilo' ),
		'section'  => 'lilo_section_post',
		'settings' => 'lilo_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 160,
	) );
}
add_action( 'customize_register', 'lilo_customize_register_post_settings' );


/**
 * Render single posts partial
 */
function lilo_customize_partial_single_post() {
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/post/content', esc_html( lilo_get_option( 'post_layout' ) ) );

		lilo_post_navigation();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
}
