<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : // Check for paged comments. ?>

	<nav class="comments-nav" role="navigation" aria-labelledby="comments-nav-title">
	
		<h3 id="comments-nav-title" class="screen-reader-text"><?php _e( 'Comments Navigation', 'mina-olen' ); ?></h3>
		
		<?php previous_comments_link( _x( 'Previous', 'comments navigation', 'mina-olen' ) );
		
		/* Translators: Comments page numbers. 1 is current page and 2 is total pages. */ ?>
		<span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'mina-olen' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span>
		
		<?php next_comments_link( _x( 'Next', 'comments navigation', 'mina-olen' ) ); ?>
	
	</nav><!-- .comments-nav -->

<?php endif; // End check for paged comments. ?>