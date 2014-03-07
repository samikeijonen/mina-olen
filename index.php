<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>
	
	<?php if ( !is_front_page() && !is_singular() && !is_404() ) : // If viewing a multi-post page ?>
		
		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
		
	<?php endif; // End check for multi-post page. ?>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<?php hybrid_get_content_template(); // Loads the content-* template. ?>
			
			<?php 
			if( is_singular( apply_filters( 'mina_olen_singular_webshare', array( 'post' ) ) ) ) :
				if ( function_exists( 'webshare' ) ) :
					webshare(); // Sharing icons.
				endif; // End webshare check.
			endif; // End singular page check.
			?>

			<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>

				<?php comments_template( '', true ); // Loads the comments.php template. ?>

			<?php endif; // End check for single post. ?>

		<?php endwhile; // End found posts loop. ?>

	<?php else : // If no posts were found. ?>

		<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

	<?php endif; // End check for posts. ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>