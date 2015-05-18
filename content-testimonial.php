<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
		
			<?php
				if( !empty( get_post_meta( get_the_ID(), '_gravatar_email', true ) ) ) :
					echo get_avatar( get_post_meta( get_the_ID(), '_gravatar_email', true ), 150, '', get_the_title() );
				elseif ( has_post_thumbnail() ) :
					the_post_thumbnail( 'thumbnail', array( 'class' => 'avatar', 'alt' => get_the_title() ) );
				endif;
			?>
		
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
			
			<?php hybrid_post_terms( array( 'taxonomy' => 'testimonial-category', 'before' => '<div class="entry-byline">', 'after' => '</div>' ) ); ?>
	
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->
	
	<?php else : // If not viewing a single post. ?>
	
		<div class="wrapper-inner">

			<header class="entry-header">
				
			<?php
				if( !empty( get_post_meta( get_the_ID(), '_gravatar_email', true ) ) ) :
					echo get_avatar( get_post_meta( get_the_ID(), '_gravatar_email', true ), 150, '', get_the_title() );
				elseif ( has_post_thumbnail() ) :
					the_post_thumbnail( 'thumbnail', array( 'class' => 'avatar', 'alt' => get_the_title() ) );
				endif;
			?>
				
				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
				
				<?php hybrid_post_terms( array( 'taxonomy' => 'testimonial-category', 'before' => '<div class="entry-byline">', 'after' => '</div>' ) ); ?>
			
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
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