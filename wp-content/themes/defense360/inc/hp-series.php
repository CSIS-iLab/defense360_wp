<?php
/**
 * @package WordPress
 * @subpackage Defense360
 *
 * Loops over each of the terms in the custom taxonomy "series"
 * and retrieves the first post from each.  Since this is an expensive
 * request the result is built into an array and saved as a transient.
 */

function series_category_cache() {

	/* Retrieves all the terms from the taxonomy portfolio_category
	 *  http://codex.wordpress.org/Function_Reference/get_categories
	 */
	 
	$args = array(
		'taxonomy' => 'series',
	    'hide_empty' => true,
	    'exclude' => get_theme_mod('hp_series_1')
	);

	$seriesList = get_categories( $args );
	
	$series_category_query = array();
	
	/* Pulls the first post from each of the individual series categories */

	foreach( $seriesList as $series ) {
	
		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'post',
			'series' => $series->slug,
			'no_found_rows' => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false
		);
		$the_query = new WP_Query( $args );
		
		// The Loop
		while ( $the_query->have_posts() ) : $the_query->the_post();
		
			/* All the data pulled is saved into an array which we'll save later */

			$gmt_timestamp = get_post_time('U', true);
			$formatted_date = get_the_date();

			$series_category_query[$series->slug] = array(
				'name' => $series->name,
				'term_link' =>  esc_attr( get_term_link( $series->slug, 'series' ) ),
				'timestamp' => $gmt_timestamp,
				'most_recent_date' => $formatted_date
			);
		
		endwhile;
    }
   
   	// Reset Post Data
	wp_reset_postdata();

	// Sort Series
	usort($series_category_query, function($a, $b) {
	    return $b['timestamp'] - $a['timestamp'];
	});
	
	set_transient( 'series_category_query', $series_category_query );
	
	return $series_category_query;
}