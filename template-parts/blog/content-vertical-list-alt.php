<?php
/**
 * The template for displaying articles in the vertical list alternative blog layout
 *
 * @version 1.0
 * @package LiLO
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post-header entry-header">

		<?php the_title( sprintf( '<h2 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php lilo_entry_meta(); ?>

	</header><!-- .entry-header -->

	<?php lilo_post_image_archives(); ?>

	<?php get_template_part( 'template-parts/entry/entry', esc_html( lilo_get_option( 'blog_content' ) ) ); ?>

	<?php lilo_entry_categories(); ?>

</article>
