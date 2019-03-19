<?php
/** 
 * Defines allowed blocks to be used in theme.
 * 
 * Source: https://rudrastyh.com/gutenberg/remove-default-blocks.html#block_slugs
*/

add_filter( 'allowed_block_types', 'defense360_allowed_block_types');
 
function defense360_allowed_block_types( $allowed_blocks) {
 
	return array(
        'core/embed',
        'core/freeform',
        'core/gallery',
        'core/heading',
        'core/html',
        'core/image',
        'core/list',
        'core/paragraph',
        'core/quote', // We may include either regular quotes or pull quotes 'core/pullquote'
        'core/shortcode',
        'core/table',
        'core/video',
        'core-embed/twitter',
        'core-embed/youtube',
        'core-embed/facebook',
        'core-embed/soundcloud',
        'core-embed/flickr',
        'core-embed/vimeo',
        'jetpack/slideshow',
        'jetpack/tiled-gallery',
        'jetpack/carousel'

    );
}

