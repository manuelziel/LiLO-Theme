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
* add LiLO (Liste Lebenswerte Ortenau) PayPal donate button
*/
function lilo_paypal_donate_button_shortcode() {
    $svg_path = get_stylesheet_directory() . '/assets/icons/PayPal.svg';
    $svg_content = file_get_contents($svg_path);
    $paypal_url = "https://www.paypal.com/donate?hosted_button_id=YGGWY5UGLTBBS";

    return '<div class="wp-block-button has-custom-width wp-block-button__width-150 paypal-donate-button">' .
           '<a href="' . $paypal_url . '" target="_blank" class="wp-block-button__link wp-element-button">' .
           $svg_content .
           '</a></div>';
}
add_shortcode('lilo_paypal_donate_button', 'lilo_paypal_donate_button_shortcode');

/**
* add LHL (Liste Haslach Lebenswert) PayPal donate button
*/
function lhl_paypal_donate_button_shortcode() {
    $svg_path = get_stylesheet_directory() . '/assets/icons/PayPal.svg';
    $svg_content = file_get_contents($svg_path);
    $paypal_url = "https://www.paypal.com/donate?hosted_button_id=NR8Z5BV6L7U6C";

    return '<div class="wp-block-button has-custom-width wp-block-button__width-150 paypal-donate-button">' .
           '<a href="' . $paypal_url . '" target="_blank" class="wp-block-button__link wp-element-button">' .
           $svg_content .
           '</a></div>';
}
add_shortcode('lhl_paypal_donate_button', 'lhl_paypal_donate_button_shortcode');
