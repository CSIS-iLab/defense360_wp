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
function defense360_shortcode_interactive( $atts ) {
		// Attributes
		$atts = shortcode_atts(
				array(
						'id' => '', // ID of Interactive Post
						'width' => '', // Width of Interactive
						'height' => '', // Height of Interactive,
						'sharing' => false, // Include share component,
				),
				$atts,
				'interactive'
		);

		$interactive_url = get_post_meta( $atts['id'], '_interactive_url', true );
		$width = get_post_meta( $atts['id'], '_interactive_width', true );
		$height = get_post_meta( $atts['id'], '_interactive_height', true );
		$iframe_resize_disabled = get_post_meta( $atts['id'], '_interactive_iframeResizeDisabled', true );
		$iframe_twitter_pic_url = get_post_meta( $atts['id'], '_interactive_twitter_pic_url', true );
		$interactive_img_url = get_post_meta( $atts['id'], '_interactive_img_url', true );
		$title = get_the_title($atts['id']);
		$URL = get_permalink();
		$interactive_post_url = get_permalink( $atts['id'] );

		// Fallback Image
		$fallbackImgDisabled = get_post_meta( $atts['id'], '_interactive_fallback_img_disabled', true );

		if( $fallbackImgDisabled ) {
				$fallback_img = null;
		} elseif ( '' !== $interactive_img_url ) {
				$fallback_img = '<img src="' . esc_attr( $interactive_img_url ) . '" alt="' . $title . '" title="' . $title . '" />';
		} else {
				$fallback_img = get_the_post_thumbnail($atts['id'], 'full');
		}

		if($atts['sharing'] === true || $atts['sharing'] == 'true') {
				$sharing = defense360_social_share($title, $URL, $interactive_post_url, $iframe_twitter_pic_url);
		}

		return defense360_interactive_display_iframe($interactive_url, $width, $height, $fallback_img, $iframe_resize_disabled).$sharing;
}
add_shortcode( 'interactive', 'defense360_shortcode_interactive' );

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

/**
 * Adds inline social sharing component to podcasts, stats, and interactives embedded in posts via shortcode
 * @param  string $title Title to be used by social media
 * @param  string $post_url   URL to be used by social media
 * @param  string $interactive_post_url URL to the data repo post.
 * @return string        HTML of share button
 */
function defense360_social_share($title = "", $post_url = "", $interactive_post_url = "", $twitter_pic_url = null) {
	$shareArgs = array(
		'linkname' => $title . ' ' . $twitter_pic_url,
		'linkurl' => $post_url
	);
	echo $URL;
	$output = '<div class="sharing-inline">';
	$output .= '<div class="col-xs-12 col-md-6 sharing-inline-share"><span class="meta-label">Share</span>';
	ob_start();
    ADDTOANY_SHARE_SAVE_KIT($shareArgs);
    $output .= ob_get_contents();
    ob_end_clean();
    $output .= '</div><div class="col-xs-12 col-md-6 sharing-inline-view">View in the <a href="' . esc_url( $interactive_post_url ) . '">Data Repository</a></div>';
    $output .= '</div>';
    return $output;
}
