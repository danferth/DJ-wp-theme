<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

</section>
<div id="footer-container">
	<footer id="footer">
		<?php do_action( 'foundationpress_before_footer' ); ?>
		<?php dynamic_sidebar( 'footer-widgets' ); ?>
		<?php do_action( 'foundationpress_after_footer' ); ?>
	</footer>
	<div class="row footer_foot">
		<div class="column small-12 medium-4 large-2 tic-usa">
			<img src="<?php echo get_template_directory_uri(). '/images/TIC-logo-usa-lightened.png'; ?>" height='38' width='141'></img>
		</div>
		<div class="column small-12 medium-8 large-10 end tic-address">
			<p>&copy; <?php echo date(Y);  ?> Thomson Instrument Company • 1121 South Cleveland Street, Oceanside, California 92054 • 800-541-4792 | 760-757-8080 • 760-757-9367 (fax) • info@htslabs.com | <a href="/legal/">Legal / Trademarks</a></p>
		</div>
	</div>
</div>

<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>

<a class="exit-off-canvas"></a>
<?php endif; ?>

	<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
	</div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>

<!-- REMOVE THIS BEFOR PUSHING TO PRODUCTION -->
<!--<script>!function(){var e=document.createElement("script"),t=document.getElementsByTagName("script")[0];e.async=1,e.src="https://inlinemanual.com/embed/player.61062751fe49a1b1eec54de80f30290d.js",e.charset="UTF-8",t.parentNode.insertBefore(e,t)}();</script>-->

</body>
</html>
