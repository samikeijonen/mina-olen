<li <?php hybrid_attr( 'comment' ); ?>>

	<article>
	
		<div class="comment-wrap">

			<header class="comment-meta">
				<div class="mina-olen-comment-avatar"><?php echo get_avatar( $comment ); ?></div>
				<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite><br />
				<time <?php hybrid_attr( 'comment-published' ); ?>><?php printf( __( '%s ago', 'mina-olen' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
				<a <?php hybrid_attr( 'comment-permalink' ); ?>><?php _e( 'Permalink', 'hybrid-core' ); ?></a>
				<?php edit_comment_link(); ?>
			</header><!-- .comment-meta -->

			<div <?php hybrid_attr( 'comment-content' ); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php hybrid_comment_reply_link(); ?>
		
		</div><!-- .comment-wrap -->

	</article>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>