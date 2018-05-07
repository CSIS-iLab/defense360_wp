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
	// Attributes
	$atts = shortcode_atts(
		array(
			'width' => '' // Max Width of the container
		),
		$atts,
		'fullWidth'
	);
	if($atts['width']) {
		$mod_content = '<div class="fullWidthInner" style="max-width:'.$atts['width'].';">'.do_shortcode($content).'</div>';
	}
	else {
		$mod_content = do_shortcode($content);
	}
	return "<div class='fullWidthFeatureContent'>".$mod_content."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );

/**
 * Shortcode for highlighting the contained text
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Highlighted content
 */
function shortcode_highlightedContent( $atts , $content = null ) {
	return "<div class='highlightedContent'>".$content."</div>";
}
add_shortcode( 'highlightedContent', 'shortcode_highlightedContent' );

/**
 * Shortcode for displaying embedded interactive
 * @param  array $atts    Modifying arguments
 * @return string          Embedded interactive
 */
function defense360_shortcode_data( $atts ) {
		// Attributes
		$atts = shortcode_atts(
				array(
						'id' => '', // ID of Interactive Post
						'width' => '', // Width of Interactive
						'height' => '', // Height of Interactive,
						'sharing' => true, // Include share component,
						'align' => null // Whether to align the iframe to either the left or right.
				),
				$atts,
				'data'
		);

		$data_url = get_post_meta( $atts['id'], '_data_url', true );
		$width = get_post_meta( $atts['id'], '_data_width', true );
		$height = get_post_meta( $atts['id'], '_data_height', true );
		$iframe_resize_disabled = get_post_meta( $atts['id'], '_data_iframeResizeDisabled', true );
		$iframe_twitter_pic_url = get_post_meta( $atts['id'], '_data_twitter_pic_url', true );
		$data_img_url = get_post_meta( $atts['id'], '_data_img_url', true );
		$title = get_the_title($atts['id']);
		$URL = get_permalink();
		$data_post_url = get_permalink( $atts['id'] );

		// Fallback Image
		$fallbackImgDisabled = get_post_meta( $atts['id'], '_data_fallback_img_disabled', true );

		if( $fallbackImgDisabled ) {
				$fallback_img = null;
		} elseif ( '' !== $data_img_url ) {
				$fallback_img = '<img src="' . esc_attr( $data_img_url ) . '" alt="' . $title . '" title="' . $title . '" />';
		} else {
				$fallback_img = get_the_post_thumbnail($atts['id'], 'full');
		}

		if($atts['sharing'] === true || $atts['sharing'] == 'true') {
				$sharing = defense360_social_share($title, $URL, $data_post_url, $iframe_twitter_pic_url);
		}
		if ( $atts['align'] ) {
				$align = "align" . $atts['align'];
		} else {
				$align = null;
		}
		return defense360_data_display_iframe($data_url, $width, $height, $fallback_img, $iframe_resize_disabled, $align).$sharing;
}
add_shortcode( 'data', 'defense360_shortcode_data' );

add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function tgm_io_shortcode_empty_paragraph_fix( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}
