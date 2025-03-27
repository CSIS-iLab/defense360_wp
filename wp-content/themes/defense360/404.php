<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package defense360
 */

get_header(); 

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<img src="/wp-content/themes/defense360/assets/img/404-icon.svg" alt="404 Page Not Found" title="404 Page Not Found" />
				</header><!-- .page-header -->

				<div class="page-content">
					<p class="error-explanation"><?php _e( 'We\'re unable to locate the page you requested.<br />The page may have moved or may no longer be available.', 'defense360' ); ?></p>
					<p class="error-contactUs"><?php _e('Try visiting the <a href="'.get_site_url().'">Homepage</a> or <a href="mailto:'.get_theme_mod('contact-email').'?subject=Defense360%20broken%20link">Contact Us</a> to report this broken link.', 'defense360'); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
