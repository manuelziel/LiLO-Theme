<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package LiLO
 */

if ( ! function_exists( 'lilo_site_logo' ) ) :
	/**
	 * Displays the site logo in the header area
	 */
	function lilo_site_logo() {

		if ( has_custom_logo() ) : ?>

			<div class="site-logo">
				<?php the_custom_logo(); ?>
			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function lilo_site_title() {

		if ( is_home() ) :
			?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function lilo_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) :
			?>

			<p class="site-description"><?php echo $description; ?></p>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function lilo_header_image() {
		if ( has_header_image() ) :
			?>

			<div id="headimg" class="header-image default-header-image">

				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_archive_header' ) ) :
	/**
	 * Displays the header title on archive pages.
	 */
	function lilo_archive_header() {
		?>

		<header class="archive-header entry-header">

			<?php the_archive_title( '<h1 class="archive-title entry-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

		</header><!-- .archive-header -->

		<?php
	}
endif;


if ( ! function_exists( 'lilo_search_header' ) ) :
	/**
	 * Displays the header title on search results.
	 */
	function lilo_search_header() {
		?>

		<header class="search-header entry-header">

			<h1 class="search-title entry-title">
				<?php
				// translators: Search Results title.
				printf( esc_html__( 'Search Results for: %s', 'lilo' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>

		</header><!-- .search-header -->

		<?php
	}
endif;


if ( ! function_exists( 'lilo_post_image_archives' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 */
	function lilo_post_image_archives() {
		$image_size = lilo_get_option( 'blog_image' );

		// Display Post Thumbnail if activated.
		if ( has_post_thumbnail() && 'hide-image' !== $image_size ) :
			?>

			<figure class="post-image post-image-archives">
				<a class="wp-post-image-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( $image_size ); ?>
				</a>
				<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
					<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
				<?php endif; ?>
			</figure>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_post_image_single' ) ) :
	/**
	 * Displays the featured image on single posts.
	 */
	function lilo_post_image_single() {

		// Display Post Thumbnail if activated.
		if ( has_post_thumbnail() ) :
			?>

			<figure class="post-image post-image-single">
				<?php the_post_thumbnail( lilo_get_option( 'post_image' ) ); ?>

				<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
					<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
				<?php endif; ?>
			</figure><!-- .post-image -->

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_post_image_page' ) ) :
	/**
	 * Displays the featured image on static pages
	 */
	function lilo_post_image_page() {
		if ( has_post_thumbnail() ) :
			?>

			<figure class="post-image post-image-single">
				<?php the_post_thumbnail(); ?>

				<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
					<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
				<?php endif; ?>
			</figure><!-- .post-image -->

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_post_image_featured_content' ) ) :
	/**
	 * Displays the featured image in the featured content section.
	 */
	function lilo_post_image_featured_content() {
		if ( has_post_thumbnail() ) :
			?>

			<figure class="post-image post-image-featured-content">
				<a class="wp-post-image-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'lilo-featured-content' ); ?>
				</a>
			</figure>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_entry_meta' ) ) :
	/**
	 * Displays the date and author of a post
	 */
	function lilo_entry_meta() {

		$postmeta  = lilo_entry_date();
		$postmeta .= lilo_entry_author();
		$postmeta .= lilo_entry_comments();

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'lilo_entry_date' ) ) :
	/**
	 * Returns the post date
	 */
	function lilo_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		return '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;


if ( ! function_exists( 'lilo_entry_author' ) ) :
	/**
	 * Returns the post author
	 */
	function lilo_entry_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			// translators: post author link.
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'lilo' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		return '<span class="posted-by"> ' . $author_string . '</span>';
	}
endif;


if ( ! function_exists( 'lilo_entry_comments' ) ) :
	/**
	 * Displays the post comments
	 */
	function lilo_entry_comments() {

		// Check if comments are open or we have at least one comment.
		if ( ! ( comments_open() || get_comments_number() ) ) {
			return;
		}

		// Start Output Buffering.
		ob_start();

		// Display Comments.
		comments_popup_link(
			esc_html__( 'No comments', 'lilo' ),
			esc_html__( '1 comment', 'lilo' ),
			esc_html__( '% comments', 'lilo' )
		);
		$comments = ob_get_contents();

		// End Output Buffering.
		ob_end_clean();

		return '<span class="entry-comments"> ' . $comments . '</span>';
	}
endif;


if ( ! function_exists( 'lilo_entry_categories' ) ) :
	/**
	 * Displays the post categories
	 */
	function lilo_entry_categories() {

		// Return early if post has no category.
		if ( ! has_category() ) {
			return;
		}

		$categories = get_the_category_list( '' );

		echo '<div class="entry-categories"> ' . $categories . '</div>';
	}
endif;


if ( ! function_exists( 'lilo_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function lilo_entry_tags() {
		// Get tags.
		$tag_list = get_the_tag_list( sprintf( '<span class="entry-tags-label">%s </span>', esc_html__( 'Tagged with', 'lilo' ) ), ', ' );

		// Display tags.
		if ( $tag_list ) :
			echo '<div class="entry-tags">' . $tag_list . '</div>';
		endif;
	}
endif;


if ( ! function_exists( 'lilo_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function lilo_more_link() {

		// Get Read More Text.
		$read_more = lilo_get_option( 'read_more_link' );

		if ( '' !== $read_more || is_customize_preview() ) :
			?>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php echo esc_html( $read_more ); ?></a>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'lilo_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function lilo_post_navigation() {

		if ( true === lilo_get_option( 'post_navigation' ) || is_customize_preview() ) :

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text">' . esc_html_x( 'Previous Post', 'post navigation', 'lilo' ) . '</span><h3 class="entry-title">%title</h3>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'lilo' ) . '</span><h3 class="entry-title">%title</h3>',
			) );

		endif;
	}
endif;


/**
* Display Featured Posts section
*/
function lilo_featured_posts() {

	// Display post slider only if activated.
	if ( true === lilo_get_option( 'featured_posts' ) ) :

		echo '<div id="featured-posts" class="featured-posts-wrap">';
		get_template_part( 'template-parts/featured/featured-posts' );
		echo '</div>';

	elseif ( is_customize_preview() ) :
		echo '<div id="featured-posts" class="featured-posts-wrap"></div>';
	endif;
}


if ( ! function_exists( 'lilo_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function lilo_pagination() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo;<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'lilo' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'lilo' ) . '</span>&raquo;',
		) );

	}
endif;