<?php if ( is_active_sidebar( 'primary' ) ) { ?>

	<aside id="sidebar-primary" <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

		<?php dynamic_sidebar( 'primary' ); ?>

	</aside><!-- #sidebar-primary .aside -->

<?php } ?>