
<?php
/**
 * Displays the featured image
 *
 * @package CSIS iLab
 * @subpackage @package ReconAsia
 * @since 1.0.0
 */

$is_singular = is_single();

if ( has_post_thumbnail() ) {
?>

	<figure class="featured-media">

	<?php	
			if ( !$is_singular || $is_front_page ) {
				echo '<a href="' . esc_url ( get_permalink() ) . '">';
			}

			// the_post_thumbnail();
      the_post_thumbnail( 'medium_large' );
			if ( !$is_singular || $is_front_page ) {
				echo '</a>';
			}

}
	?>	
	</figure><!-- .featured-media -->
