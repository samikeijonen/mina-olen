				<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
			
			</div><!-- .wrap -->

		</div><!-- #main -->
		
		<?php	
		/* When to show footer at all. */
		$mina_olen_show_footer = apply_filters( 'mina_olen_show_footer', true );
		
		if( $mina_olen_show_footer ) : // Check do we show footer. ?>

			<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
		
			<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

			<footer <?php hybrid_attr( 'footer' ); ?>>

				<div class="wrap">
				
					<?php if ( get_theme_mod( 'mina_olen_footer' ) ) { ?>
						<div class="footer-content">
							<?php echo get_theme_mod( 'mina_olen_footer' ); ?>
						</div><!-- .footer-content -->
					<?php } ?>
				
					<?php get_template_part( 'menu', 'social' ); // Loads the menu-social.php template. ?>
				
					<div id="back-to-top">
						<a href="#container" class="back-to-top"><span class="screen-reader-text"><?php _e( 'Back to top', 'mina-olen' ); ?></span></a>
					</div>

				</div><!-- .wrap -->

			</footer><!-- #footer -->
		
		<?php endif; // End check for footer. ?>

	</div><!-- #container -->

	<?php wp_footer(); // wp_footer ?>

</body>
</html>