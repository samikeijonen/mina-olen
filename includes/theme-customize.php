<?php
 
/* Add settings in customizer. */
add_action( 'customize_register', 'mina_olen_customize_register_settings' );

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 * @return void
 */
function mina_olen_customize_register_settings( $wp_customize ) {

	/* === Front Page section. === */

	/* Add the front page section. */
	$wp_customize->add_section(
		'front-page',
		array(
			'title'      => esc_html__( 'Front page settings', 'mina-olen' ),
			'priority'   => 60,
			'capability' => 'edit_theme_options'
		)
	);
	
	/* Loop same setting couple of times. */
	$k = 1;
	
	while( $k < absint( apply_filters( 'mina_olen_how_many_pages', 7 ) ) ) {
	
	/* Add the 'front_page_*' setting. */
	$wp_customize->add_setting(
		'front_page_' . $k,
		array(
			'default'           => 0,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		)
	);
	
	/* Add front page control. */
	$wp_customize->add_control(
		'front-page-control-' . $k,
			array(
				/* Translators: %s stands for number. For example Select page 1. */
				'label'    => sprintf( esc_html__( 'Select page %s', 'mina-olen' ), $k ),
				'section'  => 'front-page',
				'settings' => 'front_page_' . $k,
				'type'     => 'dropdown-pages',
				'priority' => $k+100
			) 
		);
		
	$k++; // Add one before loop ends.
		
	}
	
	/* Add the show latest posts setting. */
	$wp_customize->add_setting(
		'show_latest_posts',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mina_olen_sanitize_checkbox'
		)
	);
	
	/* Add the show latest posts control. */
	$wp_customize->add_control(
		'show-latest-posts',
		array(
			'label'    => esc_html__( 'Show latest posts on front page', 'mina-olen' ),
			'section'  => 'front-page',
			'settings' => 'show_latest_posts',
			'priority' => 40,
			'type'     => 'checkbox'
		)
	);
	
	/* Add the show latest posts label setting. */
	$wp_customize->add_setting(
		'latest_posts_label',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	
	/* Add the show latest posts control. */
	$wp_customize->add_control(
		'latest_posts_label',
		array(
			'label'    => esc_html__( 'Label for latests posts', 'mina-olen' ),
			'section'  => 'front-page',
			'priority' => 45,
			'type'     => 'text'
		)
	);
	
	/* Show option for latest download if post type exist. */
	if ( post_type_exists( 'download' ) ) {
		
		/* Add the show latest downloads setting. */
		$wp_customize->add_setting(
			'show_latest_downloads',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'mina_olen_sanitize_checkbox'
			)
		);
	
		/* Add the show latest downloads control. */
		$wp_customize->add_control(
			'show-latest-downloads',
			array(
				'label'    => esc_html__( 'Show latest downloads on front page', 'mina-olen' ),
				'section'  => 'front-page',
				'settings' => 'show_latest_downloads',
				'priority' => 50,
				'type'     => 'checkbox'
			)
		);
		
		/* Add the show latest downloads label setting. */
		$wp_customize->add_setting(
			'latest_downloads_label',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
	
		/* Add the show latest downloads control. */
		$wp_customize->add_control(
			'latest_downloads_label',
			array(
				'label'    => esc_html__( 'Label for latests downloads', 'mina-olen' ),
				'section'  => 'front-page',
				'priority' => 55,
				'type'     => 'text'
			)
		);
	}
	
	/* Show option for latest portfolio if post type exist. */
	if ( post_type_exists( 'portfolio_item' ) ) {
		
		/* Add the show latest portfolios setting. */
		$wp_customize->add_setting(
			'show_latest_portfolios',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'mina_olen_sanitize_checkbox'
			)
		);
	
		/* Add the show latest portfolios control. */
		$wp_customize->add_control(
			'show-latest-portfolios',
			array(
				'label'    => esc_html__( 'Show random portfolios on front page', 'mina-olen' ),
				'section'  => 'front-page',
				'settings' => 'show_latest_portfolios',
				'priority' => 60,
				'type'     => 'checkbox'
			)
		);
		
		/* Add the show latest portfolio label setting. */
		$wp_customize->add_setting(
			'latest_portfolio_label',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
	
		/* Add the show portfolio label control. */
		$wp_customize->add_control(
			'latest_portfolio_label',
			array(
				'label'    => esc_html__( 'Label for latests portfolios', 'mina-olen' ),
				'section'  => 'front-page',
				'priority' => 65,
				'type'     => 'text'
			)
		);
	}
	
	/* Show option for testimonial if post type exist. */
	if ( post_type_exists( 'testimonial' ) ) {
		
		/* Add the show latest downloads setting. */
		$wp_customize->add_setting(
			'show_latest_testimonials',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'mina_olen_sanitize_checkbox'
			)
		);
	
		/* Add the show latest downloads control. */
		$wp_customize->add_control(
			'show-latest-testimonials',
			array(
				'label'    => esc_html__( 'Show random testimonials on front page', 'mina-olen' ),
				'section'  => 'front-page',
				'settings' => 'show_latest_testimonials',
				'priority' => 70,
				'type'     => 'checkbox'
			)
		);
		
		/* Add the show latest testimonial label setting. */
		$wp_customize->add_setting(
			'latest_testimonial_label',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
	
		/* Add the show latest testimonial control. */
		$wp_customize->add_control(
			'latest_testimonial_label',
			array(
				'label'    => esc_html__( 'Label for latests testimonials', 'mina-olen' ),
				'section'  => 'front-page',
				'priority' => 75,
				'type'     => 'text'
			)
		);
	}
	
	/* Add boxed layout setting. */
	$wp_customize->add_setting(
		'layout_boxed',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mina_olen_sanitize_checkbox'
		)
	);
	
	/* Add boxed layout control. */
	$wp_customize->add_control(
		'layout-boxed',
		array(
			'label'    => esc_html__( 'Use boxed layout in all pages.', 'mina-olen' ),
			'section'  => 'layout',
			'settings' => 'layout_boxed',
			'priority' => 60,
			'type'     => 'checkbox'
		)
	);
	
	/* Add WPML flags setting if WPML is available. */
	if( function_exists( 'icl_get_languages' ) ) {
		$wp_customize->add_setting(
			'wpml_flags_primary',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'mina_olen_sanitize_checkbox'
			)
		);
	
		/* Add WPML flags control. */
		$wp_customize->add_control(
			'wpml-flags-primary',
			array(
				'label'    => esc_html__( 'Show WPML flags in Primary menu.', 'mina-olen' ),
				'section'  => 'nav',
				'settings' => 'wpml_flags_primary',
				'priority' => 70,
				'type'     => 'checkbox'
			)
		);
		
		$wp_customize->add_setting(
			'wpml_flags_subsidiary',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'mina_olen_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'wpml-flags-subsidiary',
			array(
				'label'    => esc_html__( 'Show WPML flags in Subsidiary menu.', 'mina-olen' ),
				'section'  => 'nav',
				'settings' => 'wpml_flags_subsidiary',
				'priority' => 80,
				'type'     => 'checkbox'
			)
		);
		
		/* Flag height and width. */
		$wp_customize->add_setting(
			'wpml_flags_width',
			array(
				'default'           => 20,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'wpml-flag-width',
			array(
				'label'    => esc_html__( 'Flag width (px).', 'mina-olen' ),
				'section'  => 'nav',
				'settings' => 'wpml_flags_width',
				'priority' => 90,
				'type'     => 'text'
			)
		);
		$wp_customize->add_setting(
			'wpml_flags_height',
			array(
				'default'           => 15,
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'wpml-flag-height',
			array(
				'label'    => esc_html__( 'Flag height (px).', 'mina-olen' ),
				'section'  => 'nav',
				'settings' => 'wpml_flags_height',
				'priority' => 100,
				'type'     => 'text'
			)
		);
	}
	
	/* Add content setting. */
	$wp_customize->add_setting(
		'content_front',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mina_olen_sanitize_checkbox'
		)
	);
	
	/* Add content control. */
	$wp_customize->add_control(
		'content-front',
		array(
			'label'    => esc_html__( 'Show full content of pages in front page. Default is excerpt.', 'mina-olen' ),
			'section'  => 'front-page',
			'settings' => 'content_front',
			'priority' => 80,
			'type'     => 'checkbox'
		)
	);
	
	/* === Logo upload section. === */
	
	/* Add the logo upload section. */
	$wp_customize->add_section(
		'logo-upload',
		array(
			'title'      => esc_html__( 'Logo Upload', 'mina-olen' ),
			'priority'   => 60,
			'capability' => 'edit_theme_options'
		)
	);
	
	/* Add the 'logo' setting. */
	$wp_customize->add_setting(
		'logo_upload',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	/* Add custom logo control. */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'logo_image',
				array(
					'label'    => esc_html__( 'Upload custom logo.', 'mina-olen' ),
					'section'  => 'logo-upload',
					'settings' => 'logo_upload',
			) 
		) 
	);
	
	/* === Footer section. === */

	/* Add the footer section. */
	$wp_customize->add_section(
		'mina-olen-footer',
			array(
				'title'      => esc_html__( 'Footer text', 'mina-olen' ),
				'priority'   => 200,
				'capability' => 'edit_theme_options'
			)
		);

	/* Add the 'mina_olen_footer' setting. */
	$wp_customize->add_setting(
		'mina_olen_footer',
			array(
				'default'              => '',
				'type'                 => 'theme_mod',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'mina_olen_customize_sanitize'
			)
		);

	/* Add the textarea control for the 'mina_olen_footer' setting. */
	$wp_customize->add_control(
		'mina-olen-footer',
			array(
				'label'    => esc_html__( 'Enter footer text', 'mina-olen' ),
				'section'  => 'mina-olen-footer',
				'settings' => 'mina_olen_footer',
				'type'     => 'textarea',
			)
		);

}

/**
 * Sanitize the checkbox value.
 *
 * @since 1.0.3
 *
 * @param string $input checkbox.
 * @return string (1 or null).
 */
function mina_olen_sanitize_checkbox( $input ) {

	if ( 1 == $input ) {
		return 1;
	} else {
		return '';
	}

}

/**
 * Sanitizes the footer content on the customize screen.  Users with the 'unfiltered_html' cap can post 
 * anything. For other users, wp_filter_post_kses() is ran over the setting.
 *
 * @since 1.0.0
 */
function mina_olen_customize_sanitize( $setting, $object ) {

	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	if ( 'mina_olen_footer' == $object->id && !current_user_can( 'unfiltered_html' ) ) {
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	}

	/* Return the sanitized setting. */
	return $setting;
	
}

?>