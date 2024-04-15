<?php
/**
* child theme styles
*/
function child_theme_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );

/**
* remove categories on home feed
*/
function exclude_specific_categories_home($query) {
    if ($query->is_home() && $query->is_main_query()) {
        // set IDs of the categories to remove
        // current is "Anfragen (301)", "Kreistag Abstimmungen (508)"
        $query->set('cat', '-301,-508');
    }
}
add_action('pre_get_posts', 'exclude_specific_categories_home');

/**
* add PayPal donate button
*/
function paypal_svg_button_shortcode() {
    $svg_content = file_get_contents(get_stylesheet_directory() . '/assets/icons/PayPal.svg');
    return '<div class="wp-block-button has-custom-width wp-block-button__width-150 paypal-svg-button"><a class="wp-block-button__link wp-element-button">' . $svg_content . '</a></div>';
}
add_shortcode('paypal_donate_button', 'paypal_svg_button_shortcode');
