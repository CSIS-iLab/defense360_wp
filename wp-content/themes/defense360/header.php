<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defense360
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'defense360' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="content-wrapper row">
			<div class="site-branding col-xs-12 col-md-6">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/wp-content/themes/defense360/img/defense360-logo.svg" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo" /></a>
			</div><!-- .site-branding -->
			<div class="header-ttIndex col-xs-12 col-md-6">
				Global Go to Think Tank Index
			</div>
		</div><!-- .content-wrapper -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="content-wrapper">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'defense360' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			</div><!-- .content-wrapper -->
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="content-wrapper">
