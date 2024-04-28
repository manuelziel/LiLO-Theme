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
 * add search form to main navigation
 */
function add_search_form_to_menu($items, $args) {
    if ($args->theme_location == 'primary') { // Ersetzen Sie 'primary' durch die tatsächliche Menüposition, die Sie verwenden
        $search_form = '<li class="menu-item search-menu-item">' .
                       '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">' .
                       '<label>' .
                       '<span class="screen-reader-text">Search for:</span>' .
                       '<input type="search" class="search-field" placeholder="Suche" value="" name="s" />' .
                       '</label>' .
                       '<button type="submit" class="search-submit" aria-label="Suche">' .
                       '<span class="search-icon">' .
                       '<svg class="icon icon-search" aria-hidden="true" role="img" viewBox="0 0 16 16">' .
                       '<path fill="white" fill-rule="evenodd" clip-rule="evenodd" d="M11.164 10.133L16 14.97 14.969 16l-4.836-4.836a6.225 6.225 0 01-3.875 1.352 6.24 6.24 0 01-4.427-1.832A6.272 6.272 0 010 6.258 6.24 6.24 0 011.831 1.83 6.272 6.272 0 016.258 0c1.67 0 3.235.658 4.426 1.831a6.272 6.272 0 011.832 4.427c0 1.422-.48 2.773-1.352 3.875zM6.258 1.458c-1.28 0-2.49.498-3.396 1.404-1.866 1.867-1.866 4.925 0 6.791a4.774 4.774 0 003.396 1.405c1.28 0 2.489-.498 3.395-1.405 1.867-1.866 1.867-4.924 0-6.79a4.774 4.774 0 00-3.395-1.405z"></path>' .
                       '</svg>' .
                       '</span>' .
                       '</button>' .
                       '</form>' .
                       '</li>';
        $items .= $search_form;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form_to_menu', 10, 2);

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
           '</a>';
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
           '</a>';
}
add_shortcode('lhl_paypal_donate_button', 'lhl_paypal_donate_button_shortcode');
