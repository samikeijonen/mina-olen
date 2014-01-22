<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<header class="entry-header">
		
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
			
			<div class="entry-byline">
					<?php hybrid_post_terms( array( 'taxonomy' => 'testimonial-category' ) ); ?>
			</div><!-- .entry-byline -->
				
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'mina-olen' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->
		
	<?php } else { ?>
	
		<div class="wrapper-inner">

			<header class="entry-header">
				
				<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'size' => 'mina-olen-thumbnail' ) ); ?>
				
				<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
				
				<div class="entry-byline">
					<?php hybrid_post_terms( array( 'taxonomy' => 'testimonial-category' ) ); ?>
				</div><!-- .entry-byline -->
				
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
				<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'mina-olen' ) . '</span>', 'after' => '</p>' ) ); ?>
			</div><!-- .entry-summary -->
			
		</div><!-- .wrapper-inner -->

	<?php } ?>

</article><!-- .entry -->