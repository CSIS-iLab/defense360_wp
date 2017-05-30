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
 		coauthors_posts_links();
 	}
 	else {
 		the_author();
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
	if ( 'post' === get_post_type() ) {
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

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'defense360' ) );
		if ( $categories_list && defense360_categorized_blog() ) {
			printf( '<span class="post-categories">' . esc_html__( '%1$s', 'defense360' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		print "</div>";
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
			print "<h3 class='post-series'>";
			foreach ($terms as $term) {
				$url = get_term_link($term->slug, $taxonomy);
				print "<a href='$url'>{$term->name} Series</a>";
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
