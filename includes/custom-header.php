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
			'height'                 => 379,
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
	
	/* Header image. */
	$header_image = esc_url( get_header_image() );
	
	/* Header image height. */
	$header_height = get_custom_header()->height;
	
	/* Header image width. */
	$header_width = get_custom_header()->width;
	
	/* When to show header image. */
	$min_width = absint( apply_filters( 'mina_olen_header_bg_show', 1 ) );
	
	/* Background arguments. */
	$background_arguments = esc_attr( apply_filters( 'mina_olen_header_bg_arguments', 'no-repeat scroll top' ) );

	$style = "body.custom-header #site-title a { color: #{$hex}; }";
	$style .= "@media screen and (min-width: {$min_width}px) { body.custom-header #header { background: url({$header_image}) {$background_arguments}; background-size: {$header_width}px auto; min-height: {$header_height}px; } }";

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
		
			<div class="wrap">
			
			<?php if ( display_header_text() ) { // If user chooses to display header text. ?>

				<div id="branding">
					<h1 id="site-title">
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div><!-- #branding -->
				
			<?php } ?>
				
			</div><!-- .wrap -->

		</header><!-- #header -->

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
		
	/* Header image. */
	$header_image = esc_url( get_header_image() );
	
	/* Header image height. */
	$header_height = get_custom_header()->height;
	
	/* Header image width. */
	$header_width = get_custom_header()->width;
	
	/* When to show header image. */
	$min_width = apply_filters( 'mina_olen_header_bg_show', 1 );
	
	/* Background arguments. */
	$background_arguments = apply_filters( 'mina_olen_header_bg_arguments', 'no-repeat scroll top' );

	$style = "#site-title a { color: #{$hex}; }";
	
	if ( get_header_image() ) {
		$style .= ".custom-header #header { background: url({$header_image}) {$background_arguments}; background-size: {$header_width}px auto; min-height: {$header_height}px; }";
	}
	
	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}
