<?php if ( has_nav_menu( 'primary' ) ) { ?>

	<nav id="menu-primary" <?php hybrid_attr( 'menu', 'primary' ); ?>>
	
		<div class="wrap">
		
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'webdento' ); ?>"><?php _e( 'Skip to content', 'webdento' ); ?></a></div>
	
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
			
			<div class="toggle-search-form">
				<a class="toggle-search"></a>
				<?php get_search_form(); ?>
			</div><!-- .toggle-search -->
			
		</div><!-- .wrap -->
		
	<div class="bottom-line"></div>
		
	</nav><!-- #menu-primary .menu -->

<?php } ?>