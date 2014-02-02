<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
		
			<?php echo get_avatar( get_post_meta( get_the_ID(), '_gravatar_email', true ), 150 ); ?>
		
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
			
			<?php hybrid_post_terms( array( 'taxonomy' => 'testimonial-category', 'before' => '<div class="entry-byline">', 'after' => '</div>' ) ); ?>
	
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'mina-olen' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->
	
	<?php else : // If not viewing a single post. ?>
	
		<div class="wrapper-inner">

			<header class="entry-header">
				
				<?php echo get_avatar( get_post_meta( get_the_ID(), '_gravatar_email', true ), 150 ); ?>
				
				<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
				
				<?php hybrid_post_terms( array( 'taxonomy' => 'testimonial-category', 'before' => '<div class="entry-byline">', 'after' => '</div>' ) ); ?>
			
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'mina-olen' ) . '</span>', 'after' => '</p>' ) ); ?>
			</div><!-- .entry-content -->
			
		</div><!-- .wrapper-inner -->

	<?php endif; // End single post check. ?>
	
	<?php
		
	/* Get testimonial byline and url. */
	$mina_olen_byline = esc_attr( get_post_meta( get_the_ID(), '_byline', true ) );
	$mina_olen_url = esc_url( get_post_meta( get_the_ID(), '_url', true ) );
							
	if( !empty( $mina_olen_byline ) ) : // Start testimonial check ?>
		<div class="entry-footer">
		<?php if( !empty( $mina_olen_url ) ) : ?>
				<a href="<?php echo $mina_olen_url; ?>" title="<?php echo $mina_olen_byline; ?>"><?php echo $mina_olen_byline; ?></a>
			<?php else :
				echo $mina_olen_byline;
			endif; ?>
		</div><!-- .entry-footer -->
	<?php endif; // End testimonial check ?>

</article><!-- .entry -->