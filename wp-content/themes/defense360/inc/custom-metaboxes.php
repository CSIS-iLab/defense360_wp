<?php
/*
 * Create custom meta box for redirect name
 */

/**
 * Adds a meta box to the post editing screen
 */
function defense360_custom_meta() {
    add_meta_box( 'defense360_meta', __( 'Post Links To Redirect Name', 'defense360-textdomain' ), 'defense360_meta_callback', 'post' );
}
add_action( 'add_meta_boxes', 'defense360_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function defense360_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'defense360_nonce' );
    $defense360_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="defense360-redirectPageName" class="defense360-row-title"><?php _e( 'Redirect Site Name', 'defense360-textdomain' )?></label>
        <input type="text" name="defense360-redirectPageName" id="defense360-redirectPageName" value="<?php if ( isset ( $defense360_stored_meta['defense360-redirectPageName'] ) ) echo $defense360_stored_meta['defense360-redirectPageName'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function defense360_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'defense360_nonce' ] ) && wp_verify_nonce( $_POST[ 'defense360_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'defense360-redirectPageName' ] ) ) {
        update_post_meta( $post_id, 'defense360-redirectPageName', sanitize_text_field( $_POST[ 'defense360-redirectPageName' ] ) );
    }
 
}
add_action( 'save_post', 'defense360_meta_save' );