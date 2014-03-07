<?php if ( has_nav_menu( 'primary' ) ) { ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>
	
		<div class="wrap">
		
			<div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'mina-olen' ); ?></a></div>
	
			<a href="#menu-primary-search" class="nav-toggle"></a>
			
			<?php

				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu_id'         => 'menu-primary-items',
						'depth'           => 2,
						'menu_class'      => 'menu-items',
						'fallback_cb'     => '',
						'items_wrap'     	=> '<div id="menu-primary-search"><ul id="%1$s" class="%2$s">%3$s</ul></div>'
					)
				);
			
			?>
			
			<?php /* Whether to show search or not. Defaults to yes. */
			
			$mina_olen_show_search = apply_filters( 'mina_olen_show_search', true );
			
			if( $mina_olen_show_search ) : // Check do we show search. ?>
				<div class="toggle-search-form">
					<a class="toggle-search"></a>
					<?php get_search_form(); ?>
				</div><!-- .toggle-search -->
			<?php endif; // End check do we show search. ?>
			
		</div><!-- .wrap -->
		
	<div class="bottom-line"></div>
		
	</nav><!-- #menu-primary .menu -->

<?php } ?>