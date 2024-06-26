<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @version 1.0
 * @package LiLO
 */

?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>

	</div><!-- #content -->

	<?php do_action( 'lilo_before_footer' ); ?>

	<div class="footer-wrap">

		<?php do_action( 'lilo_footer_widgets' ); ?>

		<footer id="colophon" class="site-footer">

			<?php do_action( 'lilo_footer_menu' ); ?>
			<?php get_template_part( 'template-parts/footer/footer', 'copyright' ); ?>
			<a href="#top" id="scroll-to-top" style="display: none;">&#9650;</a>

		</footer><!-- #colophon -->

	</div>

	<?php do_action( 'lilo_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>