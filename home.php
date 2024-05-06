<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @version 1.0
 * @package LiLO
 */

get_header();

if ( have_posts() ) :

	do_action( 'lilo_before_featured_content' );
	lilo_featured_posts();

	do_action( 'lilo_before_blog' );
	?>

	<div id="post-wrapper" class="post-wrapper">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/blog/content', esc_html( lilo_get_option( 'blog_layout' ) ) );

	endwhile;
	?>

	</div>

	<?php
	lilo_pagination();

else :

	get_template_part( 'template-parts/page/content', 'none' );

endif;

get_footer();
