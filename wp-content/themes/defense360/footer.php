<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defense360
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="content-wrapper">
			<div class="footer-logoContainer">
				<a href="https://www.csis.org/programs/international-security-program" target="_blank">
					<img src="/wp-content/themes/defense360/assets/img/DSD_Full_White.svg" alt="Center for Strategic and International Studies" title="Center for Strategic and International Studies" />
				</a>
			</div>
			<div class="footer-infoContainer row">
				<div class="col-xs-12 col-md-6">
					<p><?php echo get_theme_mod('footer-isp'); ?></p>
				</div>
				<div class="footer-contactInfo col-xs-12 col-md-6">
					<h3><?php _e('Connect with Us', 'defense360'); ?></h3>
					<?php if(get_theme_mod('contact-address')) {
						echo '<address>'.get_theme_mod('contact-address').'</address>';
					} ?>
					<?php if(get_theme_mod('contact-email')) {
						echo '<a href="mailto:'.get_theme_mod('contact-email').'"><i class="icon icon-mail"></i> '.get_theme_mod('contact-email').'</a><br />';
					} ?>
					<?php if(get_theme_mod('contact-twitter')) {
						echo '<a href="https://twitter.com/'.get_theme_mod('contact-twitter').'" target="_blank"><i class="icon icon-twitter"></i> @'.get_theme_mod('contact-twitter').'</a>';
					} ?>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="content-wrapper">
				&copy; <?php echo date('Y'); ?> by the Center for Strategic and International Studies. All rights reserved. | <a href="https://www.csis.org/privacy-policy" target="_blank" rel="nofollow">Privacy Policy</a>
			</div> <!-- .content-wrapper -->
		</div><!-- .footer-copyright -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>