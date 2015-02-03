<?php
/**
 * This template is the fallback template if no other top-level template files can be found in the theme. 
 * This can be overwritten by context-specific templates or by a `/board/board.php` in the theme.
 */

get_header(); // Load theme's header.php template part. ?>

<?php
	/* Open wrap. */ ?>
	<main <?php hybrid_attr( 'content' ); ?>>

	<?php
		/*
		 * Action hook for the plugin to output its content. Technically, what this will 
		 * do is load one of the `content-*.php` template parts for the specific page 
		 * that is being viewed. Themes can either overwrite those template parts or 
		 * overwrite this entire template.
		 */
		do_action( 'mb_theme_compat' );
	?>

<?php
	/* Close wrap. */ ?>
	</main><!-- #content -->

<?php get_footer(); // Load theme's footer.php template part.