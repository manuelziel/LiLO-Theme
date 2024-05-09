<?php
/**
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard.
 *
 * @version 1.1
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
		esc_html__( 'LiLO-Setup', 'lilo' ),
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
	
	// Current excluded category IDs
    $current_exclude_ids = get_option('lilo_category_exclude_ids', '');
    $current_exclude_ids_array = explode(',', $current_exclude_ids);

	// Check if the add_category_exclude_id POST request is set
	if (isset($_POST['add_category_exclude_id']) && isset($_POST['lilo_category_exclude_ids'])) {
    	$new_id = sanitize_text_field($_POST['lilo_category_exclude_ids']);
    	$current_exclude_ids_array[] = $new_id;

    	// Update the option in the database
    	update_option('lilo_category_exclude_ids', implode(',', $current_exclude_ids_array));
    	echo '<div class="updated"><p>Category (' . $new_id . ') exclusion settings updated.</p></div>';
	}
	
	// Check if the remove_category_exclude_id POST request is set
	if (isset($_POST['remove_category_exclude_id'])) {
		$cat_to_remove = intval($_POST['lilo_category_exclude_ids']);

        // Check if the category to be removed is in the current exclusion IDs
        if (in_array($cat_to_remove, $current_exclude_ids_array)) {
            // Remove the category from the exclusion IDs
            $current_exclude_ids_array = array_diff($current_exclude_ids_array, array($cat_to_remove));
            
			// Update the option in the database
            update_option('lilo_category_exclude_ids', implode(',', $current_exclude_ids_array));
            echo '<div class="updated"><p>Category (' . $cat_to_remove . ') removed from exclusion settings.</p></div>';
        } else {
			echo '<div class="updated"><p>Category (' . $cat_to_remove . ') NOT removed from exclusion settings.</p></div>';
		}
	}
	?>

	<div class="wrap theme-info-wrap">
		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'lilo' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ); ?></h1>
		<div class="theme-description"><?php echo $theme->display( 'Description' ); ?></div>
		<hr>
		
		<h2><?php esc_html_e( 'Category Exclusion Settings on Home Feed', 'lilo' ); ?></h2>
		You can find the ID when you open the category-editor. The ID is in the URL! <br>
		https://liste-lebenswerte-ortenau.de/wp-admin/term.php?taxonomy=category&tag_<strong>ID=301</strong>&post_type=post...
		<br>
		<br>
        <form method="post" action="">
            <label for="lilo_category_exclude_ids"><?php esc_html_e( 'Enter category IDs to exclude', 'lilo' ); ?></label><br>
            <input type="number" name="lilo_category_exclude_ids" id="lilo_category_exclude_ids" value="" min="0" step="1">
            <input type="submit" class="button-primary" name="add_category_exclude_id" value="<?php esc_attr_e( 'Add ID', 'lilo' ); ?>">
            <input type="submit" class="button-primary" name="remove_category_exclude_id" value="<?php esc_attr_e( 'Remove ID', 'lilo' ); ?>">       
        </form>

		<script>
		function validateForm() {
    		var input = document.getElementById('lilo_category_exclude_ids').value;
    		if (isNaN(input)) {
        		alert("Please enter a valid number.");
        		return false;
    		}
    		return true;
		}
		</script>

        <br>

        <?php esc_html_e( 'Current Excluded Categories:', 'lilo' ); ?>
        <ul>
            <?php foreach ($current_exclude_ids_array as $exclude_id) : ?>
            <?php $category = get_term_by('id', $exclude_id, 'category'); ?>
            <?php if ($category) : ?>
                <li>
                    <strong><?php echo esc_html($category->name); ?></strong> (ID: <?php echo esc_html($exclude_id); ?>)
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
		<hr>
		
		<h2><?php esc_html_e( 'GitHub Repository', 'lilo' ); ?></h2>
		<div>
			Visit GitHub to download the current Theme or show the Code.
			<br> 
			<br>
			<button onclick="window.open('https://github.com/manuelziel/LiLO-Theme', '_blank')">Visit GitHub</button>
			<br>
			<br>
		</div>
		<hr>
		
		<h2><?php esc_html_e( 'Usages', 'lilo' ); ?></h2>
		<div>
			<!-- Instructions for using the theme -->
			Pictures in full resolution and left-oriented and right-oriented are automatically resized to 350px. All other sizes remain as set up.
			<br>
			<br>
			Anchor:
			<br>
			Use (https://liste-lebenswerte-ortenau.de/example-site-or-article/<strong>#example-headline</strong>)
			Unwanted characters are ÄäÖöÜüß and converted to ae oe ue ss, umlauts and ß are not allowed.
			<br>
			<br>
			Button Paypal:
			<br>
			Use [lilo_paypal_donate_button] as shortcode for LiLO.
			<br>
			Use [lhl_paypal_donate_button] as shortcode for LHL.
		</div>
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