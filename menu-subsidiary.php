<?php if ( has_nav_menu( 'subsidiary' ) ) { ?>

	<nav <?php hybrid_attr( 'menu', 'subsidiary' ); ?>>
	
		<div class="wrap">
		
			<div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'mina-olen' ); ?></a></div>
			
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