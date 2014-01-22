<?php

/* Add own button style to EDD Plugin (Settings >> Style). */
add_filter( 'edd_button_colors', 'mina_olen_add_button_color' );

/**
 * Add button style to EDD Plugin.
 * 
 * @since 0.1.0
 */
function mina_olen_add_button_color( $button_style  ) {
	
	if ( function_exists( 'edd_get_button_colors' ) ) {
		$button_style['mina-olen-theme-color'] = array( 
			'label' => __( 'Mina olen Theme Color', 'mina-olen' ),
			'hex'   => ''
		);
	}

	return $button_style;
	
}

/**
 * Get the Price of download.
 *
 * @since 1.0.0
*/
function mina_olen_download_price() { ?>

	<div itemprop="price" class="mina-olen-price">
		<?php if ( edd_has_variable_prices( get_the_ID() ) ) _e( 'From:', 'mina-olen' ); ?> <?php edd_price( get_the_ID() ); ?>
	</div>
	
	<?php

}
?>