<?php
/**
 * Custom buttons for TinyMCE
 *
 * @package defense360
 */
add_action( 'after_setup_theme', 'defense360_theme_setup' );
if ( ! function_exists( 'defense360_theme_setup' ) ) {
	/**
	 * Initialize custom buttons for TinyMCE.
	 */
	function defense360_theme_setup() {
		add_action( 'init', 'defense360_buttons' );
	}
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'defense360_buttons' ) ) {
	/**
	 * Render buttons.
	 */
	function defense360_buttons() {
		add_filter( 'mce_external_plugins', 'defense360_add_buttons' );
		add_filter( 'mce_buttons', 'defense360_register_buttons' );
	}
}
if ( ! function_exists( 'defense360_add_buttons' ) ) {
	/**
	 * Include the JS file with the button information.
	 *
	 * @param Array $plugin_array Plugin array to update.
	 */
	function defense360_add_buttons( $plugin_array ) {
		$plugin_array['defense360'] = get_template_directory_uri() . '/js/tinymce.js';
		return $plugin_array;
	}
}
if ( ! function_exists( 'defense360_register_buttons' ) ) {
	/**
	 * Add custom buttons to buttons array
	 *
	 * @param  Array $buttons Array of buttons to appear in editor.
	 * @return Array          Updated buttons array.
	 */
	function defense360_register_buttons( $buttons ) {
        array_push( $buttons, 'fullWidth', 'highlightedContent' );
        return $buttons;
	}
}