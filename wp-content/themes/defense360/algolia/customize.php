<?php
/**
 * Algolia Search
 */

add_filter( 'algolia_post_guest-author_shared_attributes', 'guestAuthor_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_guest-author_shared_attributes', 'guestAuthor_attributes', 10, 2 );

/**
 * @param array   $attributes
 * @param WP_Post $post
 *
 * @return array
 */
function guestAuthor_attributes( array $attributes, WP_Post $post ) {

    if ( 'guest-author' !== $post->post_type ) {
        return $attributes;
    }

    $siteURL = get_site_url();

    $attributes['author_url'] = $siteURL."/author/".$post->post_name;

    // Always return the value we are filtering.
    return $attributes;
}
