<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package defense360
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function defense360_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'defense360_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'defense360_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function defense360_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/*
 * Removes the default Jetpack related posts plugin so we can call it with a shortcode instead
 */

function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );

/**
 * Return Related Posts in custom layout witha  shortcode
 */
function jetpackme_custom_related( $atts ) {
    $relatedPosts = '';
 
    if ( class_exists( 'Jetpack_RelatedPosts' ) && method_exists( 'Jetpack_RelatedPosts', 'init_raw' ) ) {
        $related = Jetpack_RelatedPosts::init_raw()
            ->set_query_name( 'jetpackme-shortcode' ) // Optional, name can be anything
            ->get_for_post_id(
                get_the_ID(),
                array( 'size' => 3 )
            );
 
        if ( $related ) {
            wp_reset_postdata();
            foreach ( $related as $result) {
                global $post;
                $result = get_post($result['id']);
                $post = $result;

                setup_postdata($post);

                
                $relatedPosts .= get_template_part( 'template-parts/relatedPosts-content', get_post_format() );

            }
        }
    }
 
    return "<div class='post-relatedPost'>".$relatedPosts."</div>";
}
// Create a [jprel] shortcode
add_shortcode( 'jprel', 'jetpackme_custom_related' );