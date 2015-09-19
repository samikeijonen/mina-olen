<?php if ( is_singular( apply_filters( 'mina_olen_singular_loop_nav', array( 'post', 'portfolio_item' ) ) ) ) : ?>

	<div class="loop-nav">
		<?php previous_post_link( '%link', '<span class="previous screen-reader-text">' . __( 'Previous', 'mina-olen' ) . '</span>' ); ?>
		<?php next_post_link( '%link', '<span class="next screen-reader-text">' . __( 'Next', 'mina-olen' ) . '</span>' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php
		the_posts_pagination( array(
			'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'mina-olen' ) . ' </span>',
			'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'mina-olen' ) . ' </span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'mina-olen' ) . ' </span>',
		) );
	?>

<?php endif; ?>