<?php get_header(); // Loads the header.php template. ?>

	<div <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) { ?>

			<?php while ( have_posts() ) { ?>

				<?php the_post(); // Loads the post data. ?>

				<article <?php hybrid_attr( 'post' ); ?>>
				
					<div class="entry-media">
						<?php if ( has_excerpt() ) {
							$src = wp_get_attachment_image_src( get_the_ID(), 'full' );
							echo do_shortcode( sprintf( '[caption align="aligncenter" width="%1$s"]%3$s %2$s[/caption]', esc_attr( $src[1] ), get_the_excerpt(), wp_get_attachment_image( get_the_ID(), 'full', false ) ) );
						} else {
							echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) );
						} ?>
					</div><!-- .entry-media -->

					<header class="entry-header">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'mina-olen' ), 'after' => '</p>' ) ); ?>
					</div><!-- .entry-content -->

				</article><!-- .hentry -->

			<?php } // End while loop. ?>

		<?php } // End if check. ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>