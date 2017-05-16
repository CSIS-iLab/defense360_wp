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
	    'title'      => __( 'Theme Settings', 'mytheme' ),
	    'priority'   => 30,
	) );

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
}
add_action( 'customize_register', 'defense360_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function defense360_customize_preview_js() {
	wp_enqueue_script( 'defense360_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'defense360_customize_preview_js' );
