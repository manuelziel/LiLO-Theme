<?php
/**
 * Theme Setup
 *
 * Adds a simple Theme Setup page to the Appearance section of the WordPress Dashboard.
 *
 * @version 1.3
 * @package LiLO
 */

/**
 * Add Theme Setup page to admin menu
 */
function lilo_theme_setup_menu_link() {

	// Get theme details.
	$theme = wp_get_theme();

	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'lilo' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ),
		esc_html__( 'LiLO-Setup', 'lilo' ),
		'edit_theme_options',
		'lilo',
		'lilo_theme_setup_page'
	);
}
add_action( 'admin_menu', 'lilo_theme_setup_menu_link' );

/**
 * Read the contents of a file.
 *
 * @param string $filename
 * @return string
 */
function lilo_read_file($filename) {
	$file_path = get_template_directory() . '/' . $filename;

	if ( is_readable( $file_path ) ) {
		return file_get_contents( $file_path );
	}

	return __( 'File file not found or unreadable.', 'lilo');
}

/**
* Display Theme Setup page
*/
function lilo_theme_setup_page() {
	if (!current_user_can('edit_theme_options')) {
    	wp_die(__('You do not have sufficient permissions to access this page.'));
    }

	$theme = wp_get_theme();
	$styleguide_content = nl2br( esc_html( lilo_read_file('styleguide.txt') ) );
	$readme_content = nl2br( esc_html( lilo_read_file('readme.txt') ) );
	
	// Current excluded category IDs
    $current_exclude_category_ids = get_option('lilo_category_exclude_ids', '');
    $current_exclude_category_ids_array = explode(',', $current_exclude_category_ids);

	// Check if the add_category_exclude_id POST request is set
	if (isset($_POST['add_category_exclude_id']) && isset($_POST['lilo_category_exclude_ids'])) {
    	$new_id = sanitize_text_field($_POST['lilo_category_exclude_ids']);
    	$current_exclude_category_ids_array[] = $new_id;

    	// Update the option in the database
    	update_option('lilo_category_exclude_ids', implode(',', $current_exclude_category_ids_array));
    	echo '<div class="updated"><p>Category (' . $new_id . ') exclusion settings updated.</p></div>';
	}
	
	// Check if the remove_category_exclude_id POST request is set
	if (isset($_POST['remove_category_exclude_id'])) {
		$cat_to_remove = intval($_POST['lilo_category_exclude_ids']);

    	// Check if the category to be removed is in the current exclusion IDs
    	if (in_array($cat_to_remove, $current_exclude_category_ids_array)) {
           	// Remove the category from the exclusion IDs
           	$current_exclude_category_ids_array = array_diff($current_exclude_category_ids_array, array($cat_to_remove));
            
			// Update the option in the database
       		update_option('lilo_category_exclude_ids', implode(',', $current_exclude_category_ids_array));
       	   	echo '<div class="updated"><p>Category (' . $cat_to_remove . ') removed from exclusion settings.</p></div>';
    	} else {
			echo '<div class="updated"><p>Category (' . $cat_to_remove . ') NOT removed from exclusion settings.</p></div>';
		}
	}
	
	// Current excluded post/pages IDs
	$current_exclude_post_page_ids = get_option('lilo_post_page_exclude_ids', '');
	$current_exclude_post_page_ids_array = explode(',', $current_exclude_post_page_ids);

	// Check if the add_post_page_exclude_id POST request is set
	if (isset($_POST['add_post_page_exclude_id']) && isset($_POST['lilo_post_page_exclude_ids'])) {
    	$new_id = sanitize_text_field($_POST['lilo_post_page_exclude_ids']);
    	$current_exclude_post_page_ids_array[] = $new_id;

    	// Update the option in the database
    	update_option('lilo_post_page_exclude_ids', implode(',', $current_exclude_post_page_ids_array));
    	echo '<div class="updated"><p>Post/Page ID (' . $new_id . ') exclusion settings updated.</p></div>';
	}

	// Check if the remove_post_page_exclude_id POST request is set
	if (isset($_POST['remove_post_page_exclude_id'])) {
    	$id_to_remove = intval($_POST['lilo_post_page_exclude_ids']);

    	//	Check if the ID to be removed is in the current exclusion IDs
    	if (in_array($id_to_remove, $current_exclude_post_page_ids_array)) {
    		//	Remove the ID from the exclusion IDs
    		$current_exclude_post_page_ids_array = array_diff($current_exclude_post_page_ids_array, array($id_to_remove));

    		//	Update the option in the database
    		update_option('lilo_post_page_exclude_ids', implode(',', $current_exclude_post_page_ids_array));
    		echo '<div class="updated"><p>Post/Page ID (' . $id_to_remove . ') removed from exclusion settings.</p></div>';
    	} else {
    	  	echo '<div class="updated"><p>Post/Page ID (' . $id_to_remove . ') NOT removed from exclusion settings.</p></div>';
    	}
	}
	?>

	<div class="wrap theme-setup-wrap">
		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'lilo' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ); ?></h1>
		LiLO is a custom WordPress theme specifically designed for LiLO. It is perfectly suited for blogs and magazines. LiLO is responsive, multipurpose Blogging and Magazine WordPress theme with bold colors and fonts. It comes with a featured content area, various blog layouts and extensive post settings. LiLO is the successor of the popular Dynamic News theme.
		
		<hr>

		<script>
			function validateForm(elementId) {
    			var input = document.getElementById(elementId).value;
    			if (isNaN(input)) {
        			alert("Please enter a valid number.");
        			return false;
    			}
    			return true;
			}
		</script>

		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'Category Exclusion Settings on Home Feed', 'lilo' ); ?>
			<span class="accordion-toggle"></span>
			</div>
			<div class="accordion-content">
				You can find the ID when you open the category-editor. The ID is in the URL! <br>
				https://my-website.de/wp-admin/term.php?taxonomy=category&tag_<strong>ID=301</strong>&post_type=post...
				<br><br>
        		<form method="post" action="" onsubmit="return validateForm('lilo_category_exclude_ids');">
            		<label for="lilo_category_exclude_ids"><?php esc_html_e( 'Enter category IDs to exclude', 'lilo' ); ?></label><br>
            		<input type="number" name="lilo_category_exclude_ids" id="lilo_category_exclude_ids" value="" min="0" step="1">
            		<input type="submit" class="button-primary" name="add_category_exclude_id" value="<?php esc_attr_e( 'Add ID', 'lilo' ); ?>">
            		<input type="submit" class="button-primary" name="remove_category_exclude_id" value="<?php esc_attr_e( 'Remove ID', 'lilo' ); ?>">       
        		</form>
        		<br>

       			<?php esc_html_e( 'Current Excluded Categories:', 'lilo' ); ?>
				<br>
				<br>
       			<ul class="excluded-list">
					<?php $position = 1; ?>
           			<?php foreach ($current_exclude_category_ids_array as $exclude_id) : ?>
       					<?php $category = get_term_by('id', $exclude_id, 'category'); ?>
       					<?php if ($category) : ?>
           					<li class="excluded-item">
               					POS: <?php echo $position; ?> , ID: <?php echo esc_html($exclude_id); ?> , <strong>Title: <?php echo esc_html($category->name); ?></strong>
           					</li>
							<hr>
							<?php $position++; ?>
       					<?php endif; ?>
       				<?php endforeach; ?>
       			</ul>
			</div>
		</div>

		<hr>
	
		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'Post/Page Exclusion Settings on Search', 'lilo' ); ?>
			<span class="accordion-toggle"></span>
			</div>
		<div class="accordion-content">
				You can find the ID when you open the post/page-editor. The ID is in the URL! <br>
				https://my-website.de/wp-admin/post.php?<strong>post=8708</strong>&action=edit...
				<br><br>
       			<form method="post" action="" onsubmit="return validateForm('lilo_post_page_exclude_ids');">
           			<label for="lilo_post_page_exclude_ids"><?php esc_html_e( 'Enter post/page IDs to exclude', 'lilo' ); ?></label><br>
           			<input type="number" name="lilo_post_page_exclude_ids" id="lilo_post_page_exclude_ids" value="" min="0" step="1">
           			<input type="submit" class="button-primary" name="add_post_page_exclude_id" value="<?php esc_attr_e( 'Add ID', 'lilo' ); ?>">
           			<input type="submit" class="button-primary" name="remove_post_page_exclude_id" value="<?php esc_attr_e( 'Remove ID', 'lilo' ); ?>">       
       			</form>
       			<br>

				<?php esc_html_e( 'Current Excluded Posts:', 'lilo' ); ?>
				<br>
				<br>
				<ul class="excluded-list">
   					<?php $position = 1; ?>
   					<?php foreach ($current_exclude_post_page_ids_array as $exclude_id) : ?>
       					<?php $post = get_post($exclude_id); ?>
   						<?php if ($post) : ?>
           					<li class="excluded-item">
               					POS: <?php echo $position; ?> , ID: <?php echo esc_html($exclude_id); ?> , <strong>Title: <?php echo esc_html($post->post_title); ?></strong>
           					</li>
           					<hr>
           					<?php $position++; ?>
       					<?php endif; ?>
   					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<hr>

		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'Colors', 'lilo' ); ?>
			<span class="accordion-toggle"></span>
			</div>
			<div class="accordion-content">
				To change the color scheme of the theme, go to the Customizer -> Theme Options -> Color Scheme and select the desired color scheme.
				<br>
				<br>
       			<a href="<?php echo admin_url('customize.php?autofocus[section]=lilo_color_scheme_section'); ?>" class="button">
           		<?php esc_html_e( 'Open Customizer', 'lilo' ); ?>
       			</a>
				<br>
       			<br>
			</div>
		</div>

		<hr>

		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'GitHub Repository', 'lilo' ); ?>
			<span class="accordion-toggle"></span>
			</div>
			<div class="accordion-content">
				<div>
					Visit GitHub to download the current Theme or show the Code.
					<br> 
					<br>
					<button onclick="window.open('https://github.com/manuelziel/LiLO-Theme', '_blank')">Visit GitHub</button>
					<br>
					<br>
				</div>
			</div>
		</div>

		<hr>

		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'Usages', 'lilo' ); ?>
			<span class="accordion-toggle"></span>
			</div>
			<div class="accordion-content">
				<div>
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
			</div>
		</div>

		<hr>

		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'Styleguide', 'lilo' ); ?>
			<span class="accordion-toggle"></span>
			</div>
			<div class="accordion-content">
				<?php echo $styleguide_content; ?>
			</div>
		</div>

		<hr>
	
		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'Readme', 'lilo' ); ?>
				<span class="accordion-toggle"></span>
			</div>
			<div class="accordion-content">
				<?php echo $readme_content; ?>
			</div>
		</div>

		<hr>

		<div class="wp-block-custom-accordion accordion">
			<div class="accordion-header" aria-expanded="false">
			<?php esc_html_e( 'PHP Info', 'lilo' ); ?>
				<span class="accordion-toggle"></span>
			</div>
		<div class="accordion-content">
			<?php 
       		echo 'Current memory usage: ' . round(memory_get_usage() / 1048576, 2) . ' megabytes<br>'; 
			echo 'Peak memory usage: ' . round(memory_get_peak_usage() / 1048576, 2) . ' megabytes<br>';
       		echo 'Current PHP version: ' . phpversion() . '<br><br>';

	
			echo 'Last error: <br>';
			print_r(error_get_last());
			?>
		</div>
	</div>
</div>
<?php
}

/**
 * Enqueues CSS for Theme Setup page
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function lilo_theme_setup_page_assets( $hook ) {

	$scriptPath = '/assets/js/accordion.js';
	$cssPath = '/assets/css/theme-setup.css';

	// Load styles and scripts only on theme setup page.
	if ( 'appearance_page_lilo' != $hook ) {
		return;
	}

	// Embed theme setup css style.
	wp_enqueue_style( 'lilo-theme-setup-css', get_template_directory_uri() . $cssPath );

	// Enqueue the accordion JS script.
    wp_enqueue_script(
        'accordion-admin',
        get_template_directory_uri() . $scriptPath,
        array(),
        filemtime(get_template_directory() . $scriptPath),
        false
    );

	// Localize the accordion script with the screen reader text.
	wp_localize_script('accordion-admin', 'liloScreenReaderText', array(
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><symbol viewBox="0 0 16 16" id="expand"><title>expand</title><polygon points="8,12.7 1.3,6 2.7,4.6 8,9.9 13.3,4.6 14.7,6 "/></symbol><use href="#expand" /></svg>',
    ));

}
add_action( 'admin_enqueue_scripts', 'lilo_theme_setup_page_assets' );