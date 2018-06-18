<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package defense360
 */

if ( ! function_exists( 'defense360_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * Updated to account for co-authors plugin. - JS
 */

function defense360_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'defense360' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . ' &mdash; </span>';

 	if ( function_exists( 'coauthors_posts_links' ) ) {
 		defense360_coauthors_urls(', ',', ');
 	}
 	else {
 		the_author();
 	}

 	if( class_exists('CWS_PageLinksTo') ) {
 		// Get Redirect Name & Link
	    $redirectName = get_post_meta( get_the_ID(), 'defense360-redirectPageName', true );
	    $redirectURL = get_post_meta( get_the_ID(), '_links_to', true );

	    // Checks and displays the retrieved value
	    if( !empty($redirectName) && !empty($redirectURL) ) {
	    	$redirectTarget = get_post_meta( get_the_ID(), '_links_to_target', true );
	    	echo "<span class='posted-redirectInfo'>, via <a href='".$redirectURL."' target='".$redirectTarget."'><em>".$redirectName."</em></a></span>";
	    }
 	}
}
endif;

if ( ! function_exists( 'defense360_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function defense360_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'defense360' ) );
		if ( $categories_list && defense360_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'defense360' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'defense360' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'defense360' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'defense360_entry_contentType' ) ) :
/**
 * Prints HTML with meta information for the content type and categories.
 */
function defense360_entry_contentType() {
	// Hide content type and categories for pages
	if ( in_array(get_post_type(), array( 'post' ) ) ) {
		print "<div class='post-contentCategoriesContainer'>";
		// Get the post's content type
		$taxonomy = 'content-type';
		$terms = get_the_terms(get_the_ID(), $taxonomy);
		if (! empty($terms)) {
			print "<span class='post-contentType'>";
			foreach ($terms as $term) {
				$url = get_term_link($term->slug, $taxonomy);
				print "<a href='$url'>{$term->name}</a>";
			}
			print " / </span>";
		}

		defense360_entry_categories();
		print "</div>";
	}
}
endif;

if ( ! function_exists( 'defense360_entry_categories' ) ) :
/**
 * Prints HTML with categories.
 */
function defense360_entry_categories() {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'defense360' ) );
	if ( $categories_list && defense360_categorized_blog() ) {
		printf( '<span class="post-categories">' . esc_html__( '%1$s', 'defense360' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}
}
endif;



if ( ! function_exists( 'defense360_entry_series' ) ) :
/**
 * Prints HTML with series information
 */
function defense360_entry_series() {
	// Hide content type and categories for pages
	if ( 'post' === get_post_type() ) {
		// Get the post's content type
		$taxonomy = 'series';
		$terms = get_the_terms(get_the_ID(), $taxonomy);
		if (! empty($terms)) {
			reset($terms);
			$last = end($terms);
			print "<h3 class='post-series'>";
			foreach ($terms as $term) {
				$url = get_term_link($term->slug, $taxonomy);
				if($term === $last) {
					print "<a href='$url'>{$term->name} Series</a>";
				}
				else {
					print "<a href='$url'>{$term->name} Series</a>, ";
				}
			}
			print "</h3>";
		}
	}
}
endif;

if ( ! function_exists( 'defense360_entry_tags' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function defense360_entry_tags($content) {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'defense360' ) );
		if ( $tags_list && is_single() && !is_home() ) {
			$output = sprintf( '<span class="tags-links">' . esc_html__( 'TAGS: %1$s', 'defense360' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			$content .= $output;
		}
	}

	return $content;
}

add_filter('the_content', 'defense360_entry_tags', 19);

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function defense360_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'defense360_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'defense360_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so defense360_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so defense360_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in defense360_categorized_blog.
 */
function defense360_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'defense360_categories' );
}
add_action( 'edit_category', 'defense360_category_transient_flusher' );
add_action( 'save_post',     'defense360_category_transient_flusher' );

/**
 * Display coauthors. Link to their websites if they have them, otherwise link to their post archive.
 */

if ( function_exists( 'coauthors_posts_links' ) ) {
	function defense360_coauthors_urls( $between = null, $betweenLast = null, $before = null, $after = null, $echo = true ) {
		return coauthors__echo('defense360_coauthors_urls_single', 'callback', array(
			'between' => $between,
			'betweenLast' => $betweenLast,
			'before' => $before,
			'after' => $after,
		), null, $echo );
	}

	function defense360_coauthors_urls_single( $author ) {
		if ( get_the_author_meta( 'website' ) ) {
			return sprintf( '<a href="%s" title="%s" rel="external" target="_blank">%s</a>',
				get_the_author_meta( 'website' ),
				esc_attr( sprintf( __( 'Visit %s&#8217;s website' ), get_the_author() ) ),
				get_the_author()
			);
		} else {
			return sprintf( '<a href="%s" title="%s">%s</a>',
				get_author_posts_url($author->ID, $author->user_nicename),
				esc_attr( sprintf( __( 'View all of %s&#8217;s posts' ), get_the_author() ) ),
				get_the_author()
			);
		}
	}
}

if (! function_exists('defense360_last_updated') ) :
	/**
	 * Prints HTML with last updated information.
	 */
	function defense360_last_updated()
	{
		$time_string = '<span class="meta-label">Last Updated</span> <a href="' . esc_url( get_permalink() ) . '"><time class="entry-date updated" datetime="%1$s">%2$s</time></a>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		echo '<div class="posted-on">' . $time_string . '</div>'; // WPCS: XSS OK.
	}
endif;
