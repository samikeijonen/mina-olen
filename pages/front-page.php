<?php

/**
 * Template Name: Front Page
 *
 * Show pages info. You can set it under Appearance >> Customize.
 *
 * @package Mina olen
 * @subpackage Template
 * @since 1.0.0
 */

get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>
	
	<?php $k = 1;
	
	while ( $k < apply_filters( 'mina_olen_how_many_pages', 7 ) ) : // Begins the loop through found posts from customize settings. 
	
		$mina_olen_page_content = absint( get_theme_mod( 'front_page_' . $k ) );
	
		if ( 0 != $mina_olen_page_content || !empty( $mina_olen_page_content ) ) : // Check if page is selected. ?>
	
			<article <?php hybrid_attr( 'post' ); ?>>
			
				<div class="wrapper-inner">
				
					<header class="entry-header">
						
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'post_id' => $mina_olen_page_content, 'size' => 'mina-olen-thumbnail' ) ); ?>
						
						<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink( $mina_olen_page_content ) ); ?>"><?php echo get_the_title( $mina_olen_page_content ); ?></a></h2>
					
					</header><!-- .entry-header -->

					<div class="entry-summary">
						
						<?php /* If user wants to show full content, use it. Else use excerpt or generated one. */
						
						if( get_theme_mod( 'content_front' ) ) {
							echo apply_filters( 'the_content', ( get_post_field( 'post_content', $mina_olen_page_content ) ) );
						} else if ( has_excerpt( $mina_olen_page_content ) ) {
							echo wpautop( get_post_field( 'post_excerpt', $mina_olen_page_content ) ); ?>
							<p><span class="mina-olen-read-more"><a class="more-link" href="<?php echo esc_url( get_permalink( $mina_olen_page_content ) ); ?>"><?php _e( 'Read more', 'mina-olen' ); ?></a></span></p>	
						<?php } else {
							echo apply_filters( 'the_content', ( wp_trim_words( get_post_field( 'post_content', $mina_olen_page_content ) ) ) ); ?>
							<p><span class="mina-olen-read-more"><a class="more-link" href="<?php echo esc_url( get_permalink( $mina_olen_page_content ) ); ?>"><?php _e( 'Read more', 'mina-olen' ); ?></a></span></p>
						<?php } ?>
						
					</div><!-- .entry-summary -->
				
				</div><!-- .wrapper-inner -->
					
			</article><!-- .entry -->
			
		<?php /* Is there even or odd number of pages selected. Might need this for styling. */
	
		if( 0 == ( $k % 2 ) ) {
			$mina_olen_class_even_or_odd = 'even';
		} else {
			$mina_olen_class_even_or_odd = 'odd';
		}
		
		?>
		
		<?php endif; //End if page is selected. ?>
				
		<?php $k++; // Add one before loop ends. 
	
	endwhile; // End found posts loop.
	
	/* Loop selected post types. */
	
	$mina_olen_loop_post_types = array();
	
	if( get_theme_mod( 'show_latest_posts' ) ) {
		$mina_olen_loop_post_types['post'] = get_theme_mod( 'latest_posts_label' ) ? esc_html( get_theme_mod( 'latest_posts_label' ) ) : esc_html__( 'Articles', 'mina-olen' );
	}
	if( get_theme_mod( 'show_latest_downloads' ) ) {
		$mina_olen_loop_post_types['download'] = get_theme_mod( 'latest_downloads_label' ) ? esc_html( get_theme_mod( 'latest_downloads_label' ) ) : esc_html__( 'Downloads', 'mina-olen' );
	}
	if( get_theme_mod( 'show_latest_portfolios' ) ) {
		$mina_olen_loop_post_types['portfolio_item'] = get_theme_mod( 'latest_portfolio_label' ) ? esc_html( get_theme_mod( 'latest_portfolio_label' ) ) : esc_html__( 'Portfolios', 'mina-olen' );
	}
	if( get_theme_mod( 'show_latest_testimonials' ) ) {
		$mina_olen_loop_post_types['testimonial'] = get_theme_mod( 'latest_testimonial_label' ) ? esc_html( get_theme_mod( 'latest_testimonial_label' ) ) : esc_html__( 'Testimonials', 'mina-olen' );
	}
	
	/* Filter selected post types. */
	$mina_olen_loop_post_types = apply_filters( 'mina_olen_front_page_loop_post_types', $mina_olen_loop_post_types );
	
	/* Show latest post types which are selected in the loop. */
	
	foreach ( $mina_olen_loop_post_types as $key => $value ) :
	
		/* Set custom query to show latest posts. */
		
		if ( 'testimonial' == $key || 'portfolio_item' == $key ) :
			$mina_olen_post_args = apply_filters( 'mina_olen_front_page_latest_' . $key . '_arguments', array(
				'post_type'           => esc_attr( $key ),
				'posts_per_page'      => 3,
				'orderby'             => 'rand'
			) );
		else :
			$mina_olen_post_args = apply_filters( 'mina_olen_front_page_latest_' . $key . '_arguments', array(
				'post_type'           => esc_attr( $key ),
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => 1
			) );	
		endif; // End check for custom query.
			
		$mina_olen_posts = new WP_Query( $mina_olen_post_args ); ?>
			
		<section id="<?php echo esc_attr( 'mina-olen-latest-' . $key . 's' ); ?>" class="entry mina-olen-latest-all <?php echo $mina_olen_class_even_or_odd; ?>">
		
			<div class="wrap-margin">
		
				<h1 id="mina-olen-latest-title-<?php echo esc_attr( $key ); ?>" class="mina-olen-latest-title mina-olen-latest-<?php echo esc_attr( $key ); ?>">
					<?php /* Translators: %1$s is for Articles, Portfolios, Downloads and Testimonial. Leave it like this. */
					printf( __( '%1$s', 'mina-olen' ), esc_attr( $value ) ); ?>
				</h1>
				
				<?php if ( $mina_olen_posts->have_posts() ) : ?>

					<?php while ( $mina_olen_posts->have_posts() ) : $mina_olen_posts->the_post(); ?>

						<article <?php hybrid_attr( 'post' ); ?>>
				
							<div class="wrapper-inner">
				
								<header class="entry-header">
									<?php if ( 'testimonial' == $key ) {
										echo get_avatar( get_post_meta( get_the_ID(), '_gravatar_email', true ), 150 );
									} else {
										if ( current_theme_supports( 'get-the-image' ) ) get_the_image(); 
									} ?>
								</header><!-- .entry-header -->

								<div class="entry-summary">
									<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
									<?php the_excerpt(); ?>
									<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'mina-olen' ) . '</span>', 'after' => '</p>' ) ); ?>
								</div><!-- .entry-summary -->
						
								<?php if ( 'testimonial' == $key ) {
						
									$mina_olen_byline = esc_attr( get_post_meta( get_the_ID(), '_byline', true ) );
									$mina_olen_url = esc_url( get_post_meta( get_the_ID(), '_url', true ) );
							
									if( !empty( $mina_olen_byline ) ) { ?>
										<div class="entry-footer">
											<?php if( !empty( $mina_olen_url ) ) { ?>
												<a href="<?php echo $mina_olen_url; ?>" title="<?php echo $mina_olen_byline; ?>"><?php echo $mina_olen_byline; ?></a>
											<?php } else {
												echo $mina_olen_byline;
											} ?>
										</div><!-- .entry-footer -->
									<?php }
						
								} ?>

							</div><!-- .wrapper-inner -->
				
						</article><!-- .entry -->
				
					<?php endwhile; ?>

				<?php endif; wp_reset_postdata(); // reset query ?>
			
			</div><!-- .wrap-margin -->
		
		</section><!-- .entry -->
		
	<?php endforeach; // End foreach loop. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>