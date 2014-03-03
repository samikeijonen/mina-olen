<?php if ( is_singular( apply_filters( 'mina_olen_singular_loop_nav', array( 'post', 'portfolio_item' ) ) ) ) : ?>

	<div class="loop-nav">
		<?php previous_post_link( '%link', '<span class="previous screen-reader-text">' . __( 'Previous', 'mina-olen' ) . '</span>' ); ?>
		<?php next_post_link( '%link', '<span class="next screen-reader-text">' . __( 'Next', 'mina-olen' ) . '</span>' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php loop_pagination(
		array( 
			'prev_text' => _x( '<span class="previous screen-reader-text">Previous</span>', 'posts navigation', 'mina-olen' ), 
			'next_text' => _x( '<span class="next screen-reader-text">Next</span>', 'posts navigation', 'mina-olen' )
		) 
	); ?>

<?php endif; ?>