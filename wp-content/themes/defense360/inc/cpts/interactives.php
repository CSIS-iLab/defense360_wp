<?php
/**
 * Custom Post Types: interactives
 *
 * @package defense360
 */
/**
 * Register custom post type: interactives
 */
function defense360_cpt_interactives() {
	$labels = array(
		'name'                  => _x( 'Interactives', 'Post Type General Name', 'defense360' ),
		'singular_name'         => _x( 'Interactives', 'Post Type Singular Name', 'defense360' ),
		'menu_name'             => __( 'Interactives', 'defense360' ),
		'name_admin_bar'        => __( 'Interactives', 'defense360' ),
		'archives'              => __( 'Interactive Archives', 'defense360' ),
		'attributes'            => __( 'Interactive Attributes', 'defense360' ),
		'parent_item_colon'     => __( 'Parent Interactive', 'defense360' ),
		'all_items'             => __( 'All Interactives', 'defense360' ),
		'add_new_item'          => __( 'Add New Interactive', 'defense360' ),
		'add_new'               => __( 'Add Interactive', 'defense360' ),
		'new_item'              => __( 'New Interactive', 'defense360' ),
		'edit_item'             => __( 'Edit Interactive', 'defense360' ),
		'update_item'           => __( 'Update Interactive', 'defense360' ),
		'view_item'             => __( 'View Interactive', 'defense360' ),
		'view_items'            => __( 'View Interactives', 'defense360' ),
		'search_items'          => __( 'Search Interactive', 'defense360' ),
		'not_found'             => __( 'Not found', 'defense360' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'defense360' ),
		'featured_image'        => __( 'Featured Image', 'defense360' ),
		'set_featured_image'    => __( 'Set featured image', 'defense360' ),
		'remove_featured_image' => __( 'Remove featured image', 'defense360' ),
		'use_featured_image'    => __( 'Use as featured image', 'defense360' ),
		'insert_into_item'      => __( 'Insert into Interactive', 'defense360' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Interactive', 'defense360' ),
		'items_list'            => __( 'Interactives list', 'defense360' ),
		'items_list_navigation' => __( 'Interactives list navigation', 'defense360' ),
		'filter_items_list'     => __( 'Filter Interactives list', 'defense360' ),
	);
	$args = array(
		'label'                 => __( 'Interactive', 'defense360' ),
		'description'           => __( 'Explore D360’s interactives analytics tools to gain a better understanding of U.S. force structure, acquisitions, and the defense budget.', 'defense360' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-chart-area',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'interactives', $args );
}
add_action( 'init', 'defense360_cpt_interactives', 0 );
/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function interactive_add_meta_boxes( $post ) {
	add_meta_box( 'interactive_meta_box', __( 'interactive Information', 'defense360' ), 'interactive_build_meta_box', 'interactives', 'normal', 'high' );
}
add_action( 'add_meta_boxes_interactives', 'interactive_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function interactive_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'interactive_meta_box_nonce' );
	// Retrieve current value of fields.
	$current_sources = get_post_meta( $post->ID, '_post_sources', true );
	$current_url = get_post_meta( $post->ID, '_interactive_url', true );
	$current_width = get_post_meta( $post->ID, '_interactive_width', true );
	$current_full_width = get_post_meta( $post->ID, '_interactive_full_width', true );
	$current_height = get_post_meta( $post->ID, '_interactive_height', true );
	$current_iframe_resize_disabled = get_post_meta( $post->ID, '_interactive_iframe_resize_disabled', true );
	$current_fallback_img_disabled = get_post_meta( $post->ID, '_interactive_fallback_img_disabled', true );
	$current_title = get_post_meta( $post->ID, '_interactive_title', true );
	$current_img_url = get_post_meta( $post->ID, '_interactive_img_url', true );
	$current_content_placement = get_post_meta( $post->ID, '_interactive_content_placement', true );
	$current_twitter_pic_url = get_post_meta( $post->ID, '_interactive_twitter_pic_url', true );
	if ( ! $current_content_placement ) {
		$current_content_placement = 'above';
	}
	?>
	<div class='inside'>

		<h3><?php esc_html_e( 'Content Placement', 'defense360' ); ?></h3>
		<p>
			<input type="radio" name="content_placement" value="above" <?php checked( $current_content_placement, 'above' ); ?> /> Above <br>
			<input type="radio" name="content_placement" value="below" <?php checked( $current_content_placement, 'below' ); ?> /> Below
		</p>

		<h3><?php esc_html_e( 'Interactive Title', 'defense360' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="title" value="<?php echo esc_attr( $current_title ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Interactive URL', 'defense360' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="url" value="<?php echo esc_url( $current_url ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Interactive Width (% of Content)', 'defense360' ); ?></h3>
		<p>
			<input type="number" min="0" max="100" class="small-text" name="width" value="<?php echo esc_attr( $current_width ); ?>" />%
		</p>
		<p class="howto">If left blank, defaults to 100%</p>

		<h3><?php esc_html_e( 'Interactive Width (% of Screen)', 'defense360' ); ?></h3>
		<p>
			<input type="number" min="0" max="100" class="small-text" name="full_width" value="<?php echo esc_attr( $current_full_width ); ?>" />%
		</p>
		<p class="howto">Only fill out if the interactive needs to be wider than the content area.</p>

		<h3><?php esc_html_e( 'Interactive Height', 'defense360' ); ?></h3>
		<p>
			<input type="text" class="medium-text" name="height" value="<?php echo esc_attr( $current_height ); ?>" />
		</p>
		<p class="howto">If left blank, interactive will be automatically sized to fit its content. You must specify units (%, px, etc.)</p>
		<p>
			<input type="checkbox" name="iframe_resize_disabled" value="1" <?php checked( $current_iframe_resize_disabled, '1' ); ?> /> iFrame Resize Disabled
		</p>

		<h3><?php esc_html_e( 'Interactive Image URL', 'defense360' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="img_url" value="<?php echo esc_url( $current_img_url ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Interactive Fallback Image', 'defense360' ); ?></h3>
		<p>
			<input type="checkbox" name="fallback_img_disabled" value="1" <?php checked( $current_fallback_img_disabled, '1' ); ?> /> Fallback Image Disabled
		</p>

		<h3><?php esc_html_e( 'Sources', 'defense360' ); ?></h3>
		<p>
			<?php
				wp_editor(
					$current_sources,
					'post_sources',
					array(
						'media_buttons' => false,
						'textarea_name' => 'sources',
						'teeny' => false,
						'tinymce' => array(
							'menubar' => false,
							'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,unlink',
							'toolbar2' => false,
						),
					)
				);
			?>
		</p>

		<h3><?php esc_html_e( 'Twitter Pic URL', 'defense360' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="twitter_pic_url" value="<?php echo esc_url( $current_twitter_pic_url ); ?>" />
		</p>
	</div>
<?php
}
/**
 * Store custom field meta box interactives
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function interactive_save_meta_box_data( $post_id ){
	// Verify meta box nonce.
	if ( ! isset( $_POST['interactive_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['interactive_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
		return;
	}
	// Return if autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// URL
	if ( isset( $_REQUEST['url'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_interactive_url', esc_url_raw( wp_unslash( $_POST['url'] ) ) ); // Input var okay.
	}
	// Width
	if ( isset( $_REQUEST['width'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_interactive_width', sanitize_text_field( wp_unslash( $_POST['width'] ) ) ); // Input var okay.
	}
	// Full Width
	if ( isset( $_REQUEST['full_width'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_interactive_full_width', sanitize_text_field( wp_unslash( $_POST['full_width'] ) ) ); // Input var okay.
	}
	// Height
	if ( isset( $_REQUEST['height'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_interactive_height', sanitize_text_field( wp_unslash( $_POST['height'] ) ) ); // Input var okay.
	}
	// Disable iFrame Resizing
	if ( isset( $_REQUEST['iframe_resize_disabled'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_interactive_iframe_resize_disabled', intval( wp_unslash( $_POST['iframe_resize_disabled'] ) ) ); // Input var okay.
	} else {
		update_post_meta( $post_id, '_interactive_iframe_resize_disabled', '' ); // Input var okay.
	}
	// Disable Fallback Image
	if ( isset( $_REQUEST['fallback_img_disabled'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_interactive_fallback_img_disabled', intval( wp_unslash( $_POST['fallback_img_disabled'] ) ) ); // Input var okay.
	} else {
		update_post_meta( $post_id, '_interactive_fallback_img_disabled', '' );
	}
	// Title
	if ( isset( $_REQUEST['title'] ) ) {
		update_post_meta( $post_id, '_interactive_title', sanitize_text_field( $_POST['title'] ) );
	}
	// Image URL
	if ( isset( $_REQUEST['img_url'] ) ) {
		update_post_meta( $post_id, '_interactive_img_url', esc_url( $_POST['img_url'] ) );
	}
	// Content Placement
	if ( isset( $_REQUEST['content_placement'] ) ) {
		update_post_meta( $post_id, '_interactive_content_placement', sanitize_text_field( $_POST['content_placement'] ) );
	}
	// Twitter Pic
	if ( isset( $_REQUEST['twitter_pic_url'] ) ) {
		update_post_meta( $post_id, '_interactive_twitter_pic_url', esc_url( $_POST['twitter_pic_url'] ) );
	}
	// Sources.
	if ( isset( $_REQUEST['sources'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_post_sources', wp_kses_post( wp_unslash( $_POST['sources'] ) ) ); // Input var okay.
	}
}
add_action( 'save_post_interactives', 'interactive_save_meta_box_data' );
/*----------  Display iFrame  ----------*/
/**
 * Displays the specified interactives in an iframe
 *
 * @param  String  $interactives_url       URL to the interactives.
 * @param  String  $width                Width of the iframe, can be in px or %.
 * @param  String  $height               Height of the iframe, can be in px or %.
 * @param  String  $fallback_img          Featured image thumbnail img tag string.
 * @param  boolean $iframe_resize_disabled Indicate if iframe should automatically resize based on content height.
 * @param string $align Alignment of the iframe
 * @return String                        HTML of the iframe.
 */
function defense360_interactive_display_iframe( $interactive_url, $width, $height, $fallback_img = null, $iframe_resize_disabled = false, $align = null ) {
	if ( empty( $width ) ) {
		$width = '100%';
	}
	if ( $height ) {
		$height_value = 'height="' . $height . '"';
	}
	if ( $fallback_img ) {
		$fallback_img = '<div class="interactive-fallbackImg">' . $fallback_img . '<p>For best experience, please view on a desktop computer.</p></div>';
	}
	if ( ! $iframe_resize_disabled ) {
		$enabled_class = ' js-iframeResizeEnabled';
	}
	return $fallback_img . '<iframe class="interactive-iframe' . $enabled_class . ' ' . $align . '" width="' . $width . '" ' . $height_value . ' scrolling="no" frameborder="no" src="' . $interactive_url . '"></iframe>';
}
/*----------  Display Generate Shortcode Button  ----------*/
/**
 * Add shortcode column to post listing
 *
 * @param  array $columns Array of columns to display.
 * @return array          Updated array of columns to display.
 */
function defense360_interactives_columns( $columns ) {
	$columns['shortcode'] = 'Shortcode';
	return $columns;
}
add_filter( 'manage_edit-interactives_columns', 'defense360_interactives_columns' );
/**
 * Generate shortcode when clicking on shortcode column.
 *
 * @param  string $colname Column name.
 * @param  int    $cptid   Column ID number.
 */
function defense360_interactives_column( $colname, $cptid ) {
	$shortcode_html = "[interactive id=\'" . $cptid . "\']";
	if ( 'shortcode' === $colname ) {
		echo '<a href="#" class="button button-small" onclick="prompt(\'Shortcode to include featured interactive in posts and pages:\', \'' . esc_html( $shortcode_html ) . '\'); return false;">Get Embed Code</a>';
	}
}
add_action( 'manage_interactives_posts_custom_column', 'defense360_interactives_column', 10, 2 );
