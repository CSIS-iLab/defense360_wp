<?php
/** 
 * Defines allowed blocks to be used in theme.
 * 
 * Source: https://rudrastyh.com/gutenberg/remove-default-blocks.html#block_slugs
*/

add_filter( 'allowed_block_types', 'defense360_allowed_block_types');
 
function defense360_allowed_block_types( $allowed_blocks) {
 
	return array(
		'core/image',
		'core/paragraph',
        'core/heading',
        'core/list',
        'core/quote',
        // We may include either regular quotes or pull quotes.
        // 'core/pullquote',
        'core/shortcode',
        'core/gallery',
        'core/freeform',

    );
}
?>