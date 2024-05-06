<?php
/**
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard.
 *
 * @package LiLO
 */

/**
 * Add Theme Info page to admin menu
 */
function lilo_theme_info_menu_link() {

	// Get theme details.
	$theme = wp_get_theme();

	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'lilo' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ),
		esc_html__( 'LiLO Readme', 'lilo' ),
		'edit_theme_options',
		'lilo',
		'lilo_theme_info_page'
	);

}
add_action( 'admin_menu', 'lilo_theme_info_menu_link' );

/**
 * Read the contents of the readme.txt file.
 *
 * @return string
 */
function lilo_read_readme_file() {
	$readme_path = get_template_directory() . '/readme.txt';

	// Check if the file exist and is readable.
	if ( is_readable( $readme_path ) ) {
		return file_get_contents( $readme_path );
	}

	// Return a message if the file is missing or unreadable.
	return __( 'Readme file not found or unreadable.', 'lilo');
}

/**
 * Display Theme Info page
 */
function lilo_theme_info_page() {

	// Get theme details.
	$theme = wp_get_theme();

	// Get the content of the readme.txt file.
	$readme_content = nl2br( esc_html( lilo_read_readme_file() ) );
	?>

	<div class="wrap theme-info-wrap">
		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'lilo' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ); ?></h1>
		<div class="theme-description"><?php echo $theme->display( 'Description' ); ?></div>
		<hr>

		<h2><?php esc_html_e( 'Readme', 'lilo' ); ?></h2>
		<div class="readme-content">
			<?php echo $readme_content; ?>
		</div>
	</div>
	<?php
}

/**
 * Enqueues CSS for Theme Info page
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function lilo_theme_info_page_css( $hook ) {

	// Load styles and scripts only on theme info page.
	if ( 'appearance_page_lilo' != $hook ) {
		return;
	}

	// Embed theme info css style.
	wp_enqueue_style( 'lilo-theme-info-css', get_template_directory_uri() . '/assets/css/theme-info.css' );

}
add_action( 'admin_enqueue_scripts', 'lilo_theme_info_page_css' );