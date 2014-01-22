<?php if ( is_active_sidebar( 'header' ) ) { ?>

	<aside id="sidebar-header" <?php hybrid_attr( 'sidebar', 'header' ); ?>>
		
		<div class="wrap">
			<div class="wrap-inside">
			
				<?php dynamic_sidebar( 'header' ); ?>
		
			</div><!-- .wrap-inside -->	
		</div><!-- .div -->

	</aside><!-- #sidebar-header .aside -->

<?php } ?>