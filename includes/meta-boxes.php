<?php

/* Add metabox for extra info on page header section. */

add_action( 'add_meta_boxes', 'mina_olen_create_meta_boxes' );

/**
 * Add custom meta box for 'page' post type.
 *
 * @since 1.0.0
 * @return void
 */

 function mina_olen_create_meta_boxes() {

	add_meta_box( 'mina_olen_metabox', esc_html__( 'Header extra info', 'mina-olen' ), 'mina_olen_meta_box_display', 'page', 'normal', 'high' );

}

/**
 * Displays the extra meta box.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $post
 * @param  array   $metabox
 * @return void
 */
function mina_olen_meta_box_display( $post, $metabox ) {

	wp_nonce_field( basename( __FILE__ ), 'mina-olen-metabox-nonce' ); ?>

	<p>
		<label for="mina-olen-callout-text"><?php _e( 'Callout text', 'mina-olen' ); ?></label>
		<br />
		<input type="text" name="mina-olen-callout-text" id="mina-olen-callout-text" value="<?php echo esc_attr( get_post_meta( $post->ID, '_mina_olen_callout_text', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	
	<p>
		<label for="mina-olen-callout-url"><?php _e( 'Callout URL', 'mina-olen' ); ?></label>
		<br />
		<input type="text" name="mina-olen-callout-url" id="mina-olen-callout-url" value="<?php echo esc_attr( get_post_meta( $post->ID, '_mina_olen_callout_url', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	
	<p>
		<label for="mina-olen-callout-url-text"><?php _e( 'Callout URL text', 'mina-olen' ); ?></label>
		<br />
		<input type="text" name="mina-olen-callout-url-text" id="mina-olen-callout-url-text" value="<?php echo esc_attr( get_post_meta( $post->ID, '_mina_olen_callout_url_text', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	

	<?php
	
}

/**
 * Saves the metadata for the portfolio item info meta box.
 *
 * @since  1.0.0
 * @access public
 * @param  int     $post_id
 * @param  object  $post
 * @return void
 */
function mina_olen_save_meta_boxes( $post_id, $post ) {

	/* Check nonce. */
	if ( !isset( $_POST['mina-olen-metabox-nonce'] ) || !wp_verify_nonce( $_POST['mina-olen-metabox-nonce'], basename( __FILE__ ) ) ) {
		return;
	}
	
	/* Check autosave. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$meta = array(
		'_mina_olen_callout_text' => sanitize_text_field( $_POST['mina-olen-callout-text'] ),
		'_mina_olen_callout_url' => esc_url( $_POST['mina-olen-callout-url'] ),
		'_mina_olen_callout_url_text' => sanitize_text_field ( $_POST['mina-olen-callout-url-text'] )
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'edit_post', $post_id ) && '' == $new_meta_value && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'edit_post', $post_id ) && $new_meta_value && '' == $meta_value ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post', $post_id ) && $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}
		
	}
	
}

add_action( 'save_post', 'mina_olen_save_meta_boxes', 10, 2 );

?>