<?php
/**
 * Footer Copyright
 *
 * @version 1.0
 * @package LiLO
 */

// Check if there is footer content available.
if ( is_active_sidebar( 'footer' )) :
	?>
	<div id="footer-line" class="site-info">
		<?php dynamic_sidebar( 'footer' ); ?>
		<div class="footer-copyright-flex-container">
    		<div class="footer-copyright-left">
        		Copyright © LiLO | Made with ♥ in Ortenau
    		</div>
    		<div class="footer-copyright-right">
        		<a href="<?php echo home_url('/impressum/'); ?>" aria-label="Impressum lesen">Impressum</a> |
        		<a href="<?php echo home_url('/datenschutzerklaerung/'); ?>" aria-label="Datenschutzerklärung lesen">Datenschutz</a>
    		</div>
		</div>
	</div>
	<?php
endif;