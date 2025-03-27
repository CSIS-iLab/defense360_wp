<?php
/**
 * @package  Defense360
 * Add feature image to series taxonomy
 */
// source: http://wordpress.stackexchange.com/questions/211703/need-a-simple-but-complete-example-of-adding-metabox-to-taxonomy
// code authored by jgraup - http://wordpress.stackexchange.com/users/84219/jgraup

// REGISTER SCRIPTS
function __defense360_term_meta_scripts()  {
    //
    wp_enqueue_media();
    // add theme scripts
    wp_enqueue_script( 'defense360-custom-taxonomy', get_template_directory_uri() . '/assets/js/custom-taxonomy-meta.min.js', array( 'jquery' ), '', true );


}
add_action( 'admin_enqueue_scripts', '__defense360_term_meta_scripts' );

// REGISTER TERM META

add_action( 'init', '___register_series_feature_image' );

function ___register_series_feature_image() {

    register_meta( 'term', 'series_feature_image', '___sanitize_series_feature_image' );
}

// SANITIZE DATA

function ___sanitize_series_feature_image ( $value ) {
    return sanitize_text_field ($value);
}

// GETTER (will be sanitized)

function ___get_series_feature_image( $term_id ) {
  $value = get_term_meta( $term_id, 'series_feature_image', true );
  $value = ___sanitize_series_feature_image( $value );
  return $value;
}

// ADD FIELD TO CATEGORY TERM PAGE

add_action( 'series_add_form_fields', '___add_form_field_series_feature_image' );

function ___add_form_field_series_feature_image() { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'series_feature_image_nonce' ); ?>
    <div class="form-field series-feature-image-wrap">
        <label for="series-feature-image"><?php _e( 'Feature Image', 'text_domain' ); ?></label>
        <input type="hidden" name="series_feature_image" id="series-feature-image" value="" class="series-feature-image-field" />
        <div class='series_feature_image_container'></div>
        <input type="button" id="meta-image-button" class="button choose-meta-image-button" value="<?php _e( 'Choose or Upload an Image', 'text_domain' )?>" />
    </div>
<?php }


// ADD FIELD TO CATEGORY EDIT PAGE

add_action( 'series_edit_form_fields', '___edit_form_field_series_feature_image' );

function ___edit_form_field_series_feature_image( $term ) {

    $value  = ___get_series_feature_image( $term->term_id );

    if ( ! $value )
        $value = ""; ?>

    <tr class="form-field series-feature-image-wrap">
        <th scope="row"><label for="series-feature-image"><?php _e( 'Feature Image', 'text_domain' ); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'series_feature_image_nonce' ); ?>
            <input type="hidden" name="series_feature_image" id="series-feature-image" value="<?php echo esc_attr( $value ); ?>" class="series-feature-image-field"  />
            <div class='series_feature_image_container'>
            <?php
                if($value) {
                    echo "<img src='".$value."' style='width:200px;height:auto;' class='choose-meta-image-button' title='Change Image' /><br />";
                    echo '<input type="button" id="remove-meta-image-button" class="button" value="Remove Image" />';
                }
            ?>
            </div>
            <input type="button" id="meta-image-button" class="button choose-meta-image-button" value="<?php _e( 'Choose or Upload an Image', 'text_domain' )?>" />
        </td>
    </tr>

<?php }


// SAVE TERM META (on term edit & create)

add_action( 'edit_series',   '___save_series_feature_image' );
add_action( 'create_series', '___save_series_feature_image' );

function ___save_series_feature_image( $term_id ) {

    // verify the nonce --- remove if you don't care
    if ( ! isset( $_POST['series_feature_image_nonce'] ) || ! wp_verify_nonce( $_POST['series_feature_image_nonce'], basename( __FILE__ ) ) )
        return;

    $old_value  = ___get_series_feature_image( $term_id );
    $new_value = isset( $_POST['series_feature_image'] ) ? ___sanitize_series_feature_image ( $_POST['series_feature_image'] ) : '';


    if ( $old_value && '' === $new_value )
        delete_term_meta( $term_id, 'series_feature_image' );

    else if ( $old_value !== $new_value )
        update_term_meta( $term_id, 'series_feature_image', $new_value );
}

// MODIFY COLUMNS (add our meta to the list)

add_filter( 'manage_edit-series_columns', '___edit_term_columns', 10, 3 );

function ___edit_term_columns( $columns ) {

    $columns['series_feature_image'] = __( 'Feature Image', 'text_domain' );

    return $columns;
}

// RENDER COLUMNS (render the meta data on a column)

add_filter( 'manage_series_custom_column', '___manage_term_custom_column', 10, 3 );

function ___manage_term_custom_column( $out, $column, $term_id ) {

    if ( 'series_feature_image' === $column ) {

        $value  = ___get_series_feature_image( $term_id );

        if ( ! $value ) {
            $out = "";
        }
        else {
            $out = sprintf( '<img class="series-feature-image-block" style="width:100%%;height:auto;" src="%s" />', esc_attr( $value ) );
        }
    }

    return $out;
}