<?php

/**
 * Template Name: Account Page
 *
 * User needs to be logged in to see content.
 *
 * @package Mina olen
 * @subpackage Template
 * @since 1.1.0
 */

get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>
	
	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

				<article <?php hybrid_attr( 'post' ); ?>>

					<header class="entry-header">
						<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
					
						<?php if ( is_user_logged_in() ) : ?>
					
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						
						<?php else : ?>

							<p>
								<?php _e( 'You must be logged in to view the content of this page.', 'mina-olen' ); ?>
							</p>
							<p>
								<?php wp_login_form(); ?>
							</p>
							<p>
								<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php _e( 'Lost password?', 'mina-olen' ); ?>"><?php _e( 'Lost password?', 'mina-olen' ); ?></a>
							</p>
							
						<?php endif; // End logged in check. ?>
						
					</div><!-- .entry-content -->

				</article><!-- .entry -->

		<?php endwhile; // End found posts loop. ?>

	<?php else : // If no posts were found. ?>

		<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>