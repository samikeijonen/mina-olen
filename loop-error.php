<article <?php hybrid_attr( 'post' ); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing found', 'mina-olen' ); ?></h1>
	</header>

	<div <?php hybrid_attr( 'entry-content' ); ?>>
	
		<?php if ( is_404() ): // Check if we are on 404 page. ?>
		
			<p>
				<?php printf( __( "You tried going to %s, which doesn't exist. You can try navigate or search.", 'mina-olen' ), '<code>' . home_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?>
			</p>
		<?php get_search_form(); // Loads the searchform.php template.
			
		else: ?>
	
			<p><?php _e( 'Apologies, but no entries were found.', 'mina-olen' ); ?></p>
	
		<?php endif; // End check if we are on 404 page. ?>
	
	</div><!-- .entry-content -->

</article><!-- .entry -->