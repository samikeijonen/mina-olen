<?php if ( is_active_sidebar( 'after-download' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'after-download' ); ?>>

		<?php dynamic_sidebar( 'after-download' ); ?>

	</aside><!-- #sidebar-after-download .aside -->

<?php endif; // End widgets check. ?>