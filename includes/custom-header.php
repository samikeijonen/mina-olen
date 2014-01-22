<?php

/* Call late so child themes can override. */
add_action( 'after_setup_theme', 'mina_olen_custom_header_setup', 15 );

/**
 * Adds support for the WordPress 'custom-header' theme feature and registers custom headers.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function mina_olen_custom_header_setup() {

	/* Adds support for WordPress' "custom-header" feature. */
	add_theme_support( 
		'custom-header', 
		array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 1920,
			'height'                 => 350,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => 'c84d29',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => 'mina_olen_custom_header_wp_head',
			'admin-head-callback'    => 'mina_olen_custom_header_admin_head',
			'admin-preview-callback' => 'mina_olen_custom_header_admin_preview',
		)
	);

	/* Load the stylesheet for the custom header screen. */
	//add_action( 'admin_enqueue_scripts', 'mina_olen_enqueue_admin_custom_header_styles', 5 );
}

/**
 * Enqueues the styles for the "Appearance > Custom Header" screen in the admin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function mina_olen_enqueue_admin_custom_header_styles( $hook_suffix ) {

	if ( 'appearance_page_custom-header' === $hook_suffix ) {
		wp_enqueue_style( 'stargazer-fonts' );
		wp_enqueue_style( 'stargazer-admin-custom-header' );

		if ( is_child_theme() ) {
			$dir = trailingslashit( get_stylesheet_directory() );
			$uri = trailingslashit( get_stylesheet_directory_uri() );

			if ( file_exists( $dir . 'css/admin-custom-header.css' ) )
				wp_enqueue_style( get_stylesheet() . '-admin-custom-header', "{$uri}css/admin-custom-header.css" );
		}
	}
	
}

/**
 * Callback function for outputting the custom header CSS to `wp_head`.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function mina_olen_custom_header_wp_head() {

	if ( !get_header_image() )
		return;

	$hex = get_header_textcolor();

	if ( empty( $hex ) )
		return;
	
	// Header image
	$header_image = esc_url( get_header_image() );
	
	// Header image height
	$header_height = get_custom_header()->height;
	
	// Header image width
	$header_width = get_custom_header()->width;
	
	// When to show header image
	$min_width = apply_filters( 'mina_olen_header_bg_show', 1 );

	$style = "body.custom-header #site-title a { color: #{$hex}; }";
	$style .= "@media screen and (min-width: {$min_width}px) { body.custom-header #header { background: url({$header_image}) no-repeat scroll top; background-size: {$header_width}px auto; min-height: {$header_height}px; } }";

	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}

/**
 * Callback for the admin preview output on the "Appearance > Custom Header" screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function mina_olen_custom_header_admin_preview() { ?>

		<div <?php hybrid_attr( 'body' ); // Fake <body> class. ?>>

			<header <?php hybrid_attr( 'header' ); ?>>

				<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

					<div id="branding">
						<?php hybrid_site_title(); ?>
						<?php hybrid_site_description(); ?>
					</div><!-- #branding -->

				<?php endif; // End check for header text. ?>

			</header><!-- #header -->

			<?php if ( get_header_image() && !display_header_text() ) : // If there's a header image but no header text. ?>

				<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>

			<?php elseif ( get_header_image() ) : // If there's a header image. ?>

				<img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />

			<?php endif; // End check for header image. ?>

		</div><!-- Fake </body> close. -->

<?php }

/**
 * Callback function for outputting the custom header CSS to `admin_head` on "Appearance > Custom Header".  See 
 * the `css/admin-custom-header.css` file for all the style rules specific to this screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function mina_olen_custom_header_admin_head() {

	$hex = get_header_textcolor();

	if ( empty( $hex ) )
		return;

	$style = "#site-title a { color: #{$hex}; }";

	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}
