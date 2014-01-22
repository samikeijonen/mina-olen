<?php if ( is_active_sidebar( 'secondary' ) ) { ?>

	<aside id="sidebar-secondary" <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>

		<?php dynamic_sidebar( 'secondary' ); ?>

	</aside><!-- #sidebar-secondary .aside -->

<?php } ?>