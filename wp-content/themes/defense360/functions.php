<?php
/**
 * defense360 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package defense360
 */

if ( ! function_exists( 'defense360_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function defense360_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on defense360, use a find and replace
	 * to change 'defense360' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'defense360', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Theme Menus
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'defense360' ),
		'categories-menu' => esc_html__( 'Secondary', 'defense360' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'defense360_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Modify Staff Editor role permissions
	//// get the the role object

	$staff_editor = get_role('staff_editor');
	//// add $cap capability to this role object
	$staff_editor->add_cap('manage_options');
}
endif;
add_action( 'after_setup_theme', 'defense360_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function defense360_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'defense360_content_width', 640 );
}
add_action( 'after_setup_theme', 'defense360_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function defense360_scripts() {
	wp_enqueue_style( 'defense360-style', get_stylesheet_uri() );

	wp_enqueue_script( 'defense360-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'defense360-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	wp_enqueue_script( 'defense360-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.min.js', array(), '20151215', true );

	wp_enqueue_script( 'defense360-hide-header-mobile', get_template_directory_uri() . '/assets/js/hide-header-mobile.min.js', array(), '20151215', true );

	wp_enqueue_script( 'defense360-archive-mobile', get_template_directory_uri() . '/assets/js/archive-mobile.min.js', array(), '20151215', true );

	if ( is_single() ) {
		wp_enqueue_script( 'defense360-iframe-resize', get_template_directory_uri() . '/assets/js/iframeResizer.min.js', array(), '20170615', true );

		wp_add_inline_script( 'defense360-iframe-resize', 'jQuery(".js-iframeResizeEnabled").iFrameResize({log:false});' );

		wp_enqueue_script('aerospace-clipboard', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js', array(), '20171129', true );
		
		wp_add_inline_script('aerospace-clipboard', "var clipboard = new Clipboard('#btn-copy');
				clipboard.on('success', function(e) {
						var d = document.getElementById('btn-copy');
						d.className += ' tooltipped';
				});
		");
	}

}
add_action( 'wp_enqueue_scripts', 'defense360_scripts' );

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom walker for main navigation
 */
require get_template_directory() . '/inc/nav-main-walker.php';

/**
 * Register custom taxonomies
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Deletes the series_category_query transient if a series post is updated. This is for the home page.
 */

function series_save_post( $post_id, $post ) {

	// If this is an auto save routine don't do anyting
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	if ( $post->post_type == 'post' && is_object_in_term( $post_id, 'series') ) {
		delete_transient( 'series_category_query' );
	}

}
add_action( 'save_post', 'series_save_post', 10, 2 );

/**
 * Register custom short codes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Register custom TinyMCE buttons
 */
require get_template_directory() . '/inc/custom-tinymce-buttons.php';

/**
 * Register custom metaboxes
 */
require get_template_directory() . '/inc/custom-metaboxes.php';

/**
 * Update Algolia Functionality
 */
require get_template_directory() . '/algolia/customize.php';

/**
 * Custom page titles for Guest Authors with WordPress SEO
 * Returns "[author name]&#39;s articles on [site name]"
 *
 */
add_filter('wpseo_title', 'my_co_author_wseo_title');
function my_co_author_wseo_title( $title ) {

	// Only filter title output for author pages
	if ( is_author() && function_exists( 'get_coauthors' ) ) {
		$qo = get_queried_object();
		$author_name = $qo->display_name;
		return $author_name . '&#39;s articles on ' . get_bloginfo('name');
	}
	return $title;

}
