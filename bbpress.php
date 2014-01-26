<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<article <?php hybrid_attr( 'post' ); ?>>

			<?php if ( is_singular( get_post_type() ) ) { ?>

				<header class="entry-header">
					<h1 class="entry-title"><?php single_post_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
		
			<?php } else { ?>

				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

			<?php } ?>

		</article><!-- .entry -->

		<?php endwhile; // End found posts loop. ?>

	<?php else : // If no posts were found. ?>

		<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>