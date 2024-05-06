<?php
/**
 * LiLO functions and definitions
 *
 * @package LiLO
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lilo_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'lilo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Set default Post Thumbnail size.
	set_post_thumbnail_size( 1800, 9999 );

	// Add custom image sizes.
	add_image_size( 'lilo-featured-content', 1800, 600, true );
	add_image_size( 'lilo-ultra-wide', 1800, 600, true );
	add_image_size( 'lilo-landscape', 1840, 1035, true );
	add_image_size( 'lilo-classic', 1800, 1350, true );
	add_image_size( 'lilo-square', 900, 900, true );
	add_image_size( 'lilo-portrait', 900, 1200, true );

	// Register Navigation Menus.
	register_nav_menus( array(
		'primary'       => esc_html__( 'Main Navigation', 'lilo' ),
		'social-header' => esc_html__( 'Social Icons (Header)', 'lilo' ),
	) );

	// Switch default core markup for galleries and captions to output valid HTML5.
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', apply_filters( 'lilo_custom_logo_args', array(
		'height'      => 60,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'lilo_custom_header_args', array(
		'header-text' => false,
		'width'       => 2680,
		'height'      => 600,
		'flex-width'  => true,
		'flex-height' => true,
	) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lilo_custom_background_args', array(
		'default-color' => 'ededef',
	) ) );

	// Add Theme Support for Selective Refresh in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for responsive embed blocks.
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'lilo_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lilo_content_width() {

	// Default content width.
	$content_width = 900;

	// Set global variable for content width.
	$GLOBALS['content_width'] = apply_filters( 'lilo_content_width', $content_width );
}
add_action( 'after_setup_theme', 'lilo_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function lilo_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'lilo-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	if ( ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) ) && ! lilo_is_amp() ) {
		wp_enqueue_script( 'lilo-navigation', get_theme_file_uri( '/assets/js/navigation.min.js' ), array(), '20220204', true );
		$lilo_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'lilo' ),
			'collapse' => esc_html__( 'Collapse child menu', 'lilo' ),
			'icon'     => lilo_get_svg( 'expand' ),
		);
		wp_localize_script( 'lilo-navigation', 'liloScreenReaderText', $lilo_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	if ( ! lilo_is_amp() ) {
		wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.6' );
	}

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lilo_scripts' );


/**
* Enqueue theme fonts.
*/
function lilo_theme_fonts() {
	$fonts_url = lilo_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		wp_enqueue_style( 'lilo-theme-fonts', wptt_get_webfont_url( $fonts_url ), array(), '20201110' );
	}
}
add_action( 'wp_enqueue_scripts', 'lilo_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'lilo_theme_fonts', 1 );


/**
 * Retrieve webfont URL to load fonts locally.
 */
function lilo_get_fonts_url() {
	$font_families = array(
		'Ubuntu:400,400italic,700,700italic',
		'Francois One:400,400italic,700,700italic',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'lilo_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lilo_widgets_init() {

	// Register Blog Sidebar widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lilo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html_x( 'Appears on blog pages and single posts.', 'widget area description', 'lilo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register Header widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'lilo' ),
		'id'            => 'header',
		'description'   => esc_html__( 'Appears on header area. You can add a search or an ad widget here.', 'lilo' ),
		'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="header-widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Copyright widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'lilo' ),
		'id'            => 'footer-copyright',
		'description'   => esc_html_x( 'Appears in the bottom footer line.', 'widget area description', 'lilo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'lilo_widgets_init', 30 );


/**
 * Make custom image sizes available in Gutenberg.
 */
function lilo_add_image_size_names( $sizes ) {
	return array_merge( $sizes, array(
		'post-thumbnail'      => esc_html__( 'Post Thumbnail', 'lilo' ),
		'lilo-ultra-wide' => esc_html__( 'LiLO Ultra Wide (3:1)', 'lilo' ),
		'lilo-landscape'  => esc_html__( 'LiLO Landscape (16:9)', 'lilo' ),
		'lilo-classic'    => esc_html__( 'LiLO Classic (4:3)', 'lilo' ),
		'lilo-square'     => esc_html__( 'LiLO Square (1:1)', 'lilo' ),
		'lilo-portrait'   => esc_html__( 'LiLO Portrait (3:4)', 'lilo' ),
	) );
}
add_filter( 'image_size_names_choose', 'lilo_add_image_size_names' );

/**
 * Add search form to main navigation
 */
function lilo_add_search_form_to_menu($items, $args) {
    if ($args->theme_location == 'primary') {
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
add_filter('wp_nav_menu_items', 'lilo_add_search_form_to_menu', 10, 2);

/**
 * Remove categories on home feed
 */
function lilo_exclude_specific_categories_home($query) {
    if ($query->is_home() && $query->is_main_query()) {
        // set IDs of the categories to remove
        // current is "Anfragen (301)", "Kreistag Abstimmungen (508)"
        $query->set('cat', '-301,-508');
    }
}
add_action('pre_get_posts', 'lilo_exclude_specific_categories_home');

/**
 * String for anchor without unwanted characters, but allows umlauts and ß 
 */
function lilo_custom_anchor_slug($title) {
    $slug = remove_accents($title);
    $slug = preg_replace('/[^a-zA-Z0-9-_ÄäÖöÜüß ]/', '', $slug); // Removes unwanted characters, but allows umlauts and ß
    $slug = str_replace(' ', '-', $slug);
    $slug = strtolower($slug);
    return $slug;
}

/**
 * Add anchor to any headline
 */
function lilo_anchor_content_h1_h6 ($content) {
    $pattern = "~<h(1|2|3|4|5|6)[^>]*>(.*?)</h(1|2|3|4|5|6)>~";
    $content = preg_replace_callback($pattern, function ($matches) {
    $tag = $matches[1]; // Tag level (h1, h2, etc.)
    $string = $matches[0]; // Complete string (<h3 class="wp-block-heading" id="jana-schwab">Jana Schwab</h3>)
    $title = $matches[2]; // Title (Jana Schwab)
    $slug = lilo_custom_anchor_slug($title);
		
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
add_filter('the_content', 'lilo_anchor_content_h1_h6');

/**
 * Add LiLO (Liste Lebenswerte Ortenau) PayPal donate button
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
 * Add LHL (Liste Haslach Lebenswert) PayPal donate button
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

/**
 * Include Files
 */
// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include support functions.
require get_template_directory() . '/inc/addons.php';
