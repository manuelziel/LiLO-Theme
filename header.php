<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @version 1.2
 * @package LiLO
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

	<?php do_action( 'lilo_before_site' ); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lilo' ); ?></a>

		<?php do_action( 'lilo_before_header' ); ?>

		<header id="masthead" class="site-header" role="banner">

			<div class="header-main">

				<?php lilo_site_logo(); ?>

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<?php get_template_part( 'template-parts/header/header', 'content' ); ?>

			</div><!-- .header-main -->

			<?php get_template_part( 'template-parts/header/site', 'navigation' ); ?>

		</header><!-- #masthead -->

		<?php lilo_header_image(); ?>

		<?php do_action( 'lilo_after_header' ); ?>

		<div id="content" class="site-content">

			<main id="main" class="site-main" role="main">

				<?php do_action( 'lilo_before_content' ); ?>
