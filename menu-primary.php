<?php if ( has_nav_menu( 'primary' ) ) { ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>
	
		<div class="wrap">
	
			<a href="#menu-primary-search" class="nav-toggle">
			<span class="screen-reader-text">
				<?php
					/* Translators: %s is the nav menu name. This is the nav menu title shown to screen readers. */
					printf( _x( '%s Menu', 'nav menu title', 'mina-olen' ), hybrid_get_menu_location_name( 'primary' ) ); 
				?>
			</span>
			</a>
			
			<?php
			
			/* Check when to use EDD menu. */
			if( has_nav_menu( 'edd' ) && ( ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() ) || ( function_exists( 'edd_is_success_page' ) && edd_is_success_page() ) || ( function_exists( 'edd_is_failed_transaction_page' ) && edd_is_failed_transaction_page() ) ) ) {
				$theme_location = 'edd';
			} else {
				$theme_location = 'primary';
			}

				wp_nav_menu(
					array(
						'theme_location'  => $theme_location,
						'menu_id'         => 'menu-primary-items',
						'depth'           => 2,
						'menu_class'      => 'menu-items',
						'fallback_cb'     => '',
						'items_wrap'      => '<div id="menu-primary-search"><ul id="%1$s" class="%2$s">%3$s</ul></div>'
					)
				);
			
			?>
			
			<?php /* Whether to show search or not. Defaults to yes. */
			
			$mina_olen_show_search = apply_filters( 'mina_olen_show_search', true );
			
			if( $mina_olen_show_search ) : // Check do we show search. ?>
				<div class="toggle-search-form">
					<a class="toggle-search"><span class="screen-reader-text"><?php _e( 'Search', 'mina-olen' ); ?></span></a>
					<?php get_search_form(); ?>
				</div><!-- .toggle-search -->
			<?php endif; // End check do we show search. ?>
			
		</div><!-- .wrap -->
		
	<div class="bottom-line"></div>
		
	</nav><!-- #menu-primary .menu -->

<?php } ?>