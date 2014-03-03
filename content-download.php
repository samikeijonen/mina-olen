<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
		
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
			
			<div class="entry-byline">
					<?php hybrid_post_terms( array( 'taxonomy' => 'download_category' ) ); ?>
			</div><!-- .entry-byline -->
				
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->
		
	<?php else : // If not viewing a single post. ?>
	
		<div class="wrapper-inner">

			<header class="entry-header">
				
				<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'size' => 'mina-olen-thumbnail' ) ); ?>
				
				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
				
				<div class="entry-byline">
					<?php hybrid_post_terms( array( 'taxonomy' => 'download_category' ) ); ?>
				</div><!-- .entry-byline -->
				
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
				<?php wp_link_pages(); ?>
				<?php if ( function_exists( 'mina_olen_download_price' ) ) {
					echo mina_olen_download_price();
				} ?>
			</div><!-- .entry-summary -->
			
		</div><!-- .wrapper-inner -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->