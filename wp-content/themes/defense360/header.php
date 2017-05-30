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
<link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'defense360' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="content-wrapper row flex-center__y">
			<div class="header-mobileContainer col-xs-2 visible-xs">
				<i class="icon icon-menu"></i>
				<span class="close-icon"></span>
			</div>
			<div class="site-branding col-xs-8 col-md-6">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/wp-content/themes/defense360/img/defense360-logo.svg" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo" /></a>
			</div><!-- .site-branding -->
			<div class="header-ttIndex hidden-xs col-md-6">
				<?php echo get_theme_mod('header-ttIndex'); ?>
			</div>
			<div class="header-searchContainer col-xs-2 visible-xs">
				<i class="icon icon-search"></i>
				<span class="close-icon"></span>
			</div>
		</div><!-- .content-wrapper -->
		<div class="navigation-container">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="content-wrapper row flex-center__y">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu',
						'container_class' => 'menu-main-container col-xs-12 col-md-11',
						'walker' => new Nav_Main_Walker() ) ); ?>
					<div class="nav-social hidden-xs col-md-1">
						<?php if(get_theme_mod('contact-twitter')) {
							echo '<a href="https://twitter.com/'.get_theme_mod('contact-twitter').'" target="_blank"><i class="icon icon-twitter"></i></a>';
						} ?>
						<?php if(get_theme_mod('contact-email')) {
							echo '<a href="mailto:'.get_theme_mod('contact-email').'"><i class="icon icon-mail"></i></a>';
						} ?>
					</div><!-- .nav-social -->
				</div><!-- .content-wrapper -->
			</nav><!-- #site-navigation -->
			<nav class="secondary-navigation" role="navigation">
				<div class="content-wrapper row flex-center__y">
					<?php wp_nav_menu( array( 'theme_location' => 'categories-menu', 'menu_id' => 'secondary-menu',
						'container_class' => 'menu-categories-menu-container col-xs-12 col-md-11' ) ); ?>
					<div class="nav-searchIconContainer hidden-xs col-md-1">
						<i class="icon icon-search"></i>
					</div>
				</div><!-- .content-wrapper -->
			</nav><!-- .secondary-navigation -->
			<div class="nav-social visible-xs-block">
				<?php if(get_theme_mod('contact-twitter')) {
					echo '<a href="https://twitter.com/'.get_theme_mod('contact-twitter').'" target="_blank"><i class="icon icon-twitter"></i></a>';
				} ?>
				<?php if(get_theme_mod('contact-email')) {
					echo '<a href="mailto:'.get_theme_mod('contact-email').'"><i class="icon icon-mail"></i></a>';
				} ?>
			</div><!-- .nav-social -->
		</div><!-- .navigation-container -->
		<div class="header-searchFormContainer">
			<div class="header-searchForm content-wrapper row flex-center__y">
				<div class="header-searchInputContainer col-xs-12 col-md-11">
					<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
					    <label>
					        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
					        <input type="search" class="search-field"
					            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
					            value="<?php echo get_search_query() ?>" name="s"
					            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
					    </label>
					    <input type="submit" class="search-submit"
					        value="<?php echo esc_attr_x( '&#xe804;', 'submit button' ) ?>" />
					</form>
				</div>
				<div class="search-closeContainer hidden-xs col-md-1">
					<span class="close-icon"></span>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content">
