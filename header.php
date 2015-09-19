<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]> <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]> <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head <?php hybrid_attr( 'head' ); ?>>

<?php wp_head(); // wp_head hook. Hybdid Core adds wp_title and viewport automatically. And some other stuff from library/functions/head.php. ?>

</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container" <?php if( get_theme_mod( 'layout_boxed' ) ) echo 'class="mina-olen-boxed"'; ?>>
	
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mina-olen' ); ?></a>
	
		<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
	
		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template.
		
		/* When to show header at all. */
		$mina_olen_show_masthead = apply_filters( 'mina_olen_show_masthead', true );
		
		if( $mina_olen_show_masthead ) : // Check do we show header. ?>
		
			<header <?php hybrid_attr( 'header' ); ?>>

				<div class="wrap">
			
				<?php if ( display_header_text() ) { // If user chooses to display header text. ?>

					<div id="branding">
						<?php if ( get_theme_mod( 'logo_upload') ) { // Use logo if is set. Else use bloginfo name. ?>	
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url() ); ?>" rel="home">
									<img class="mina-olen-logo" src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
								</a>
							</h1>
						<?php } else { ?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url() ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
						<?php } ?>
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div><!-- #branding -->
				
				<?php }
			
					/* Callout text and link in singular pages. */
					mina_olen_callout_output();
					
					do_action( 'mina_olen_header_close' );
					
				?>
				
				</div><!-- .wrap -->

			</header><!-- #header -->
			
		<?php endif; // End check for header. ?>
		
		<?php do_action( 'mina_olen_after_header' ); ?>

		<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) {
			 
			breadcrumb_trail( array( 'container' => 'nav', 'separator' => __( '&#47;', 'mina-olen' ), 'show_on_front' => false, 'show_browse' => false, 'before' => '<div class="wrap">', 'after' => '</div>' ) );
			
		} ?>
		
		<div id="main">
		
			<div class="wrap">