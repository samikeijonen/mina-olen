<?php if ( pings_open() && !comments_open() ) : ?>

	<p class="comments-closed pings-open">
		<?php
			/* Translators: The %s is for trackback link. */
			printf( __( 'Comments are closed, but <a href="%s">trackbacks</a> and pingbacks are open.', 'mina-olen' ),
				esc_url( get_trackback_url() )
			);
		?>
	</p><!-- .comments-closed .pings-open -->

<?php elseif ( !comments_open() ) : ?>

	<p class="comments-closed">
		<?php _e( 'Comments are closed.', 'mina-olen' ); ?>
	</p><!-- .comments-closed -->

<?php endif; ?>