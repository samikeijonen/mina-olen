<div class="entry-byline">

	<?php if( false != get_post_format() ) : // If current post have post format. ?>
		<?php hybrid_post_format_link(); ?>
	<?php endif; // End post format check. ?>

	<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
	<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
	
	<?php if( has_post_format( 'link' ) ) : // If current post have link post format. ?>
		<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php _e( 'Permalink', 'stargazer' ); ?></a>
	<?php endif; // End link post format check. ?>
	
	<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
	<?php edit_post_link(); ?>

</div><!-- .entry-byline -->