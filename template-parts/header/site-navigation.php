<?php
/**
 * Main Navigation
 *
 * @version 1.1
 * @package LiLO
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<div id="main-navigation-wrap" class="primary-navigation-wrap">

		<?php do_action( 'lilo_header_search' ); ?>

		<button class="primary-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false" <?php lilo_amp_menu_toggle(); ?>>
			<?php
			echo lilo_get_svg( 'menu' );
			echo lilo_get_svg( 'close' );
			?>
			<span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'lilo' ); ?></span>
		</button>

		<div class="primary-navigation">

			<nav id="site-navigation" class="main-navigation" <?php lilo_amp_menu_is_toggled(); ?> role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'lilo' ); ?>">

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
					)
				);
				?>
			</nav><!-- #site-navigation -->

		</div><!-- .primary-navigation -->

	</div>

<?php endif; ?>

<?php do_action( 'lilo_after_navigation' ); ?>
