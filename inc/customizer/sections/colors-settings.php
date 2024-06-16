<?php
/**
 * Color Settings
 *
 * Register Color Settings section, settings and controls for Theme Customizer
 *
 * @version 1.0
 * @package LiLO
 */

    function lilo_customize_register_colors( $wp_customize ) {

        // Add a new section for color settings under the Theme Options panel
        $wp_customize->add_section('lilo_color_scheme_section', array(
            'title' => __('Color Scheme', 'lilo'),
            'panel' => 'lilo_options_panel',
            'priority' => 20,
        ));

        // Add Color Scheme Setting
        $wp_customize->add_setting( 'theme_color_scheme', array(
            'default'           => 'lilo',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));

        // Add Color Scheme Control
        $wp_customize->add_control( 'theme_color_scheme', array(
            'label' => __('Select Color Scheme', 'lilo'),
            'section' => 'lilo_color_scheme_section',
            'type' => 'select',
            'choices' => array(
                'lilo' => __('LiLO', 'lilo'),
                'lhl' => __('LHL', 'lilo'),
                'manu' => __('Manu', 'lilo'),
            ),
        ));
    }
    add_action( 'customize_register', 'lilo_customize_register_colors' );
