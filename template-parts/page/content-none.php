<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @version 1.0
 * @package LiLO
 */
?>

<main id="main" class="site-main" role="main">

	<section class="no-results not-found type-page">

		<header class="page-header entry-header">

			<h1 class="page-title entry-title"><?php esc_html_e( 'Nothing Found', 'lilo' ); ?></h1>

		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :

				printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lilo' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) );

			elseif ( is_search() ) :

				printf( '<p>%s</p>', esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lilo' ) );
				get_search_form();

			else :

				printf( '<p>%s</p>', esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lilo' ) );
				get_search_form();

			endif;
			?>

		</div><!-- .entry-content -->

	</section><!-- .no-results -->

</main><!-- #main -->
