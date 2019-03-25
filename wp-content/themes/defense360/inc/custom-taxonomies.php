<?php
/**
 * Register custom taxonomies for the Defense360 theme.
 * Custom Taxonomies: Content Type, Series
 */

// Register Custom Taxonomy: Content Type
function d360_contentType() {

	$labels = array(
		'name'                       => _x( 'Content Types', 'Taxonomy General Name', 'defense360' ),
		'singular_name'              => _x( 'Content Type', 'Taxonomy Singular Name', 'defense360' ),
		'menu_name'                  => __( 'Content Types', 'defense360' ),
		'all_items'                  => __( 'All Content Types', 'defense360' ),
		'parent_item'                => __( 'Parent Content Type', 'defense360' ),
		'parent_item_colon'          => __( 'Parent Content Type:', 'defense360' ),
		'new_item_name'              => __( 'New Content Type', 'defense360' ),
		'add_new_item'               => __( 'Add New Content Type', 'defense360' ),
		'edit_item'                  => __( 'Edit Content Type', 'defense360' ),
		'update_item'                => __( 'Update Content Type', 'defense360' ),
		'view_item'                  => __( 'View Content Type', 'defense360' ),
		'separate_items_with_commas' => __( 'Separate content types with commas', 'defense360' ),
		'add_or_remove_items'        => __( 'Add or remove content types', 'defense360' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'defense360' ),
		'popular_items'              => __( 'Popular Content Types', 'defense360' ),
		'search_items'               => __( 'Search Content Types', 'defense360' ),
		'not_found'                  => __( 'Not Found', 'defense360' ),
		'no_terms'                   => __( 'No content types', 'defense360' ),
		'items_list'                 => __( 'Content Types list', 'defense360' ),
		'items_list_navigation'      => __( 'Content Types list navigation', 'defense360' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'					 => true,
		'show_in_rest'    => true

	);
	register_taxonomy( 'content-type', array( 'post' ), $args );

}
add_action( 'init', 'd360_contentType', 0 );

// Allow "content-type" in permalink structure
add_filter('post_link', 'contentType_permalink', 10, 3);
add_filter('post_type_link', 'contentType_permalink', 10, 3);

function contentType_permalink($permalink, $post_id, $leavename) {
    if (strpos($permalink, '%content-type%') === FALSE) return $permalink;

        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'content-type');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'analysis';

    return str_replace('%content-type%', $taxonomy_slug, $permalink);
}

// Register Custom Taxonomy: Series
function d360_series() {

	$labels = array(
		'name'                       => _x( 'Series', 'Taxonomy General Name', 'defense360' ),
		'singular_name'              => _x( 'Series', 'Taxonomy Singular Name', 'defense360' ),
		'menu_name'                  => __( 'Series', 'defense360' ),
		'all_items'                  => __( 'All Series', 'defense360' ),
		'parent_item'                => __( 'Parent Series', 'defense360' ),
		'parent_item_colon'          => __( 'Parent Series:', 'defense360' ),
		'new_item_name'              => __( 'New Series', 'defense360' ),
		'add_new_item'               => __( 'Add New Series', 'defense360' ),
		'edit_item'                  => __( 'Edit Series', 'defense360' ),
		'update_item'                => __( 'Update Series', 'defense360' ),
		'view_item'                  => __( 'View Series', 'defense360' ),
		'separate_items_with_commas' => __( 'Separate series with commas', 'defense360' ),
		'add_or_remove_items'        => __( 'Add or remove series', 'defense360' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'defense360' ),
		'popular_items'              => __( 'Popular Series', 'defense360' ),
		'search_items'               => __( 'Search Series', 'defense360' ),
		'not_found'                  => __( 'Not Found', 'defense360' ),
		'no_terms'                   => __( 'No series', 'defense360' ),
		'items_list'                 => __( 'Series list', 'defense360' ),
		'items_list_navigation'      => __( 'Series list navigation', 'defense360' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'    => true
	);
	register_taxonomy( 'series', array( 'post' ), $args );

}
add_action( 'init', 'd360_series', 0 );

// Custom Meta Fields for the Taxonomies
include('custom-taxonomy-meta.php');
