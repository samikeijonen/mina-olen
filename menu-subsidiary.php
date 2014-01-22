<?php if ( has_nav_menu( 'subsidiary' ) ) { ?>

	<nav id="menu-subsidiary" <?php hybrid_attr( 'menu', 'subsidiary' ); ?>>
	
		<div class="wrap">
		
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'youngart' ); ?>"><?php _e( 'Skip to content', 'youngart' ); ?></a></div>
			
			<?php

				wp_nav_menu(
					array(
						'theme_location'  => 'subsidiary',
						'menu_id'         => 'menu-subsidiary-items',
						'depth'           => 1,
						'menu_class'      => 'menu-items',
						'fallback_cb'     => ''
					)
				);
	
			?>

		</div><!-- .wrap -->
		
	</nav><!-- #menu-subsidiary .menu -->

<?php } ?>