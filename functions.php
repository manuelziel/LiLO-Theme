<?php
/**
 * LiLO child theme of Dynamico Theme
 * 
 * @version 1.2.0
 * @package LiLO
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
 * string for anchor without unwanted characters, but allows umlauts and ß 
 */
function dt_custom_anchor_slug($title) {
    $slug = remove_accents($title);
    $slug = preg_replace('/[^a-zA-Z0-9-_ÄäÖöÜüß ]/', '', $slug); // Removes unwanted characters, but allows umlauts and ß
    $slug = str_replace(' ', '-', $slug);
    $slug = strtolower($slug);
    return $slug;
}

/**
 * add anker to any headline
 */
function dt_anchor_content_h1_h6 ($content) {
    $pattern = "~<h(1|2|3|4|5|6)[^>]*>(.*?)</h(1|2|3|4|5|6)>~";
    $content = preg_replace_callback($pattern, function ($matches) {
    $tag = $matches[1]; // Tag level (h1, h2, etc.)
    $string = $matches[0]; // Complete string (<h3 class="wp-block-heading" id="jana-schwab">Jana Schwab</h3>)
    $title = $matches[2]; // Title (Jana Schwab)
    $slug = dt_custom_anchor_slug($title);
		
		if (strpos($string, 'class=') !== false) {
			$string = preg_replace('/(class=")/i', "id=\"$slug\" $1", $string);
		} 
        //else {
		//$string .= " id=\"$slug\"";
		//}

    return "{$string}";
}, $content);

return $content;
}
add_filter('the_content', 'dt_anchor_content_h1_h6');

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
