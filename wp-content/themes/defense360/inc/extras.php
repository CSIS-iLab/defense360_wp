<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package defense360
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function defense360_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'defense360_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function defense360_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'defense360_pingback_header' );

/**
 * Change the_archive_title to use custom text before categories, tags, and other taxonomies.
 */
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

		$title = single_cat_title( '<span class="archive-titleDescription">Topic:</span> ', false );

    } elseif ( is_tag() ) {

        $title = single_tag_title( '<span class="archive-titleDescription">Tag:</span> ', false );

    } elseif ( is_author() ) {

        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

    } elseif (is_tax('content-type')) {
    	$title = str_replace('Content Type:','<span class="archive-titleDescription">Content Type:</span>',$title);
    } elseif (is_tax('series')) {
    	$title = str_replace('Series:','<span class="archive-titleDescription">Series:</span>',$title);
    }


    return $title;

});
