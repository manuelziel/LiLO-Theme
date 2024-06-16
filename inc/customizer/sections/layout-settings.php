<?php
/**
 * Layout Settings
 *
 * Register Layout Settings section, settings and controls for Theme Customizer
 *
 * @package LiLO
 */

/**
 * Adds Layout settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function lilo_customize_register_layout_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'lilo_section_layout', array(
		'title'    => esc_html__( 'Layout Settings', 'lilo' ),
		'priority' => 10,
		'panel'    => 'lilo_options_panel',
	) );

	// Get Default Settings.
	$default = lilo_default_options();

	// Add Settings and Controls for Theme Layout.
	$wp_customize->add_setting( 'lilo_theme_options[theme_layout]', array(
		'default'           => $default['theme_layout'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[theme_layout]', array(
		'label'    => esc_html__( 'Theme Layout', 'lilo' ),
		'section'  => 'lilo_section_layout',
		'settings' => 'lilo_theme_options[theme_layout]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			'centered' => esc_html__( 'Centered Layout', 'lilo' ),
			'wide'     => esc_html__( 'Wide Layout', 'lilo' ),
		),
	) );

	// Add Settings and Controls for Sidebar Position.
	$wp_customize->add_setting( 'lilo_theme_options[sidebar_position]', array(
		'default'           => 'right-sidebar',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'lilo_sanitize_select',
	) );

	$wp_customize->add_control( 'lilo_theme_options[sidebar_position]', array(
		'label'    => esc_html__( 'Sidebar Position', 'lilo' ),
		'section'  => 'lilo_section_layout',
		'settings' => 'lilo_theme_options[sidebar_position]',
		'type'     => 'radio',
		'priority' => 20,
		'choices'  => array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'lilo' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'lilo' ),
		),
	) );
}
add_action( 'customize_register', 'lilo_customize_register_layout_settings' );
