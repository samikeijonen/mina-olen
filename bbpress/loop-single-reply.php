<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bbp-reply-header">

	<div class="bbp-meta">

		<?php if ( bbp_is_single_user_replies() ) : ?>

			<span class="bbp-header">
				<?php _e( 'in reply to: ', 'mina-olen' ); ?>
				<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>" title="<?php bbp_topic_title( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
			</span>

		<?php endif; ?>

		<a href="<?php bbp_reply_url(); ?>" title="<?php bbp_reply_title(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>

		<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

		<?php bbp_reply_admin_links(); ?>

		<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
		
		<div class="bbp-reply-author">

			<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

			<?php bbp_reply_author_link( array( 'sep' => '<br />', 'show_role' => true ) ); ?>
			
			<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>

			<?php if ( is_super_admin() ) : ?>

				<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

				<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

				<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

			<?php endif; ?>

			<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

		</div><!-- .bbp-reply-author -->

	</div><!-- .bbp-meta -->

</div><!-- .bbp-reply-header -->

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-content">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->

</div><!-- #post-<?php bbp_reply_id(); ?> -->
