<?php
/**
 * The template for displaying single posts with the featured image above the title
 *
 * @version 1.0
 * @package LiLO
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lilo_post_image_single(); ?>

	<header class="post-header entry-header">

		<?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>

		<?php lilo_entry_meta(); ?>

	</header><!-- .entry-header -->

	<?php get_template_part( 'template-parts/entry/entry', 'single' ); ?>

	<?php do_action( 'lilo_after_posts' ); ?>
	<?php do_action( 'lilo_author_bio' ); ?>

	<?php lilo_entry_tags(); ?>
	<?php lilo_entry_categories(); ?>

</article>
