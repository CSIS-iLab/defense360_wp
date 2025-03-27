<?php
/**
 * defense360 Theme Customizer
 *
 * @package defense360
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function defense360_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Create Custom Sections
	$wp_customize->add_section( 'defense360-theme-settings' , array(
	    'title'      => __( 'Theme Settings', 'defense360' ),
	    'priority'   => 30,
	) );
	$wp_customize->add_section( 'defense360-hp-features' , array(
	    'title'      => __( 'Home Page: Features', 'defense360' ),
	    'priority'   => 30,
	) );
	$wp_customize->add_section( 'defense360-hp-series' , array(
	    'title'      => __( 'Home Page: Series', 'defense360' ),
	    'priority'   => 30,
	) );

	// # Recent Articles
	$wp_customize->add_setting( 'hp-recent-posts-num' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'hp-recent-posts-num', 
		array(
			'label'    => __( '# of Recent Posts to Show', 'defense360' ),
			'section'  => 'defense360-theme-settings',
			'settings' => 'hp-recent-posts-num',
			'type'     => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 5,
				'step' => 1
			)
		)
	);

	// Think Tank Description
	$wp_customize->add_setting( 'header-ttIndex' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'header-ttIndex', 
		array(
			'label'    => __( 'Think Tank Ranking', 'defense360' ),
			'section'  => 'defense360-theme-settings',
			'settings' => 'header-ttIndex',
			'type'     => 'textarea'
		)
	);

	// ISP Description
	$wp_customize->add_setting( 'footer-isp' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'footer-isp', 
		array(
			'label'    => __( 'ISP Description', 'defense360' ),
			'section'  => 'defense360-theme-settings',
			'settings' => 'footer-isp',
			'type'     => 'textarea'
		)
	);

	// Contact: Email
	$wp_customize->add_setting( 'contact-address' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-address', 
		array(
			'label'    => __( 'Contact: Address', 'defense360' ),
			'section'  => 'defense360-theme-settings',
			'settings' => 'contact-address',
			'type'     => 'textarea'
		)
	);

	// Contact: Email
	$wp_customize->add_setting( 'contact-email' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-email', 
		array(
			'label'    => __( 'Contact: Email', 'defense360' ),
			'section'  => 'defense360-theme-settings',
			'settings' => 'contact-email',
			'type'     => 'email'
		)
	);

	// Contact: Twitter
	$wp_customize->add_setting( 'contact-twitter' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-twitter', 
		array(
			'label'    => __( 'Contact: Twitter Handle', 'defense360' ),
			'section'  => 'defense360-theme-settings',
			'settings' => 'contact-twitter',
			'type'     => 'text'
		)
	);

	/*----------  Home Page: Features  ----------*/
    $featuredPosts_list = array();
	$args = array('post_type' => 'post', 'numberposts' => '-1');
	$featuredPosts = get_posts( $args ); 
	foreach($featuredPosts as $featuredPost) {
	    $featuredPosts_list[$featuredPost->ID] = $featuredPost->post_title;
	}

    // Feature 1
    $wp_customize->add_setting( 'hp_feature_1', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_feature_1', array('label'    => esc_html__( 'Feature #1', 'defense360' ), 'type'     => 'select', 'section'  => 'defense360-hp-features', 'priority' => 4, 'choices'  => $featuredPosts_list, ));

    // Feature 2
    $wp_customize->add_setting( 'hp_feature_2', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_feature_2', array('label'    => esc_html__( 'Feature #2', 'defense360' ), 'type'     => 'select', 'section'  => 'defense360-hp-features', 'priority' => 4, 'choices'  => $featuredPosts_list, ));

    // Feature 3
    $wp_customize->add_setting( 'hp_feature_3', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_feature_3', array('label'    => esc_html__( 'Feature #3', 'defense360' ), 'type'     => 'select', 'section'  => 'defense360-hp-features', 'priority' => 4, 'choices'  => $featuredPosts_list, ));


    /*----------  Home Page: Series  ----------*/
    $series_list = array();
    $terms = get_terms( array(
	    'taxonomy' => 'series',
	    'hide_empty' => true,
	) );
	foreach($terms as $term) {
		$series_list[$term->term_id] = $term->name;
	}

	// # Recent Articles
	$wp_customize->add_setting( 'hp-series-num' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'hp-series-num', 
		array(
			'label'    => __( '# of Additional Series to Show', 'defense360' ),
			'section'  => 'defense360-hp-series',
			'settings' => 'hp-series-num',
			'type'     => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 6,
				'step' => 1
			)
		)
	);

	// Featured Series
	$wp_customize->add_setting( 'hp_series_1', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_series_1', array('label'    => esc_html__( 'Featured Series', 'defense360' ), 'type'     => 'select', 'section'  => 'defense360-hp-series', 'priority' => 4, 'choices'  => $series_list, ));

}
add_action( 'customize_register', 'defense360_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function defense360_customize_preview_js() {
	wp_enqueue_script( 'defense360_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'defense360_customize_preview_js' );

/**
 * Remove links to unnecessary parts of the theme customizer
 */

function wpse_225164_remove_core_sections( $wp_customize ) {
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'background_image' );
}

add_action( 'customize_register', 'wpse_225164_remove_core_sections' );

/**
 * Add links to customizer sections to appearance menu
 */

add_action( 'admin_menu', 'wpse_custom_submenu_page' );
function wpse_custom_submenu_page() {
	add_submenu_page(
	    'themes.php',
	        __( 'HP: Features', 'defense360' ),
	        __( 'HP: Features', 'defense360' ),
	        'manage_options',
	        '/customize.php?autofocus[section]=defense360-hp-features'
	    );
	add_submenu_page(
	    'themes.php',
	        __( 'HP: Series', 'defense360' ),
	        __( 'HP: Series', 'defense360' ),
	        'manage_options',
	        '/customize.php?autofocus[section]=defense360-hp-series'
	    );
}

/**
 * Remove unnecessary links to Header & Background in the Appearance Menu
 */
add_action('admin_menu', 'remove_unnecessary_wordpress_menus', 999);

function remove_unnecessary_wordpress_menus(){
    global $submenu;
    foreach($submenu['themes.php'] as $menu_index => $theme_menu){
        if($theme_menu[0] == 'Header' || $theme_menu[0] == 'Background')
        unset($submenu['themes.php'][$menu_index]);
    }
}