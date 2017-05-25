<?php
/**
 * Custom shortcodes for the theme
 *
 * @package defense360
 */

/**
 * Shortcode for displaying enclosed content at the full width of the browser
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_fullWidth( $atts , $content = null ) {
	return "<div class='fullWidthFeatureContent'>".$content."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );