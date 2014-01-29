<?php

/* Set up Licence key for this theme. URL: https://easydigitaldownloads.com/docs/activating-license-keys-in-wp-plugins-and-themes */
 
/* This is the URL our updater / license checker pings. This should be the URL of the site with EDD installed. */
define( 'MINA_OLEN_SL_STORE_URL', 'http://localhost/foxnet-themes-shop' ); // use your own unique prefix to prevent conflicts

/* The name of your product. This should match the download name in EDD exactly. */
define( 'MINA_OLEN_SL_THEME_NAME', 'Mina olen' ); // use your own unique prefix to prevent conflicts
	
/* Define current version of theme. Get it from parent theme style.css. */
$mina_olen_theme = wp_get_theme( 'mina-olen' );
if ( $mina_olen_theme->exists() ) {
	define( 'MINA_OLEN_VERSION', $mina_olen_theme->Version ); // Get parent theme version
}
	
/* Setup updater. */
add_action( 'admin_init', 'mina_olen_theme_updater' );

/* Add license key menu item under Appeareance. */
add_action( 'admin_menu', 'mina_olen_theme_license_menu' );

/* Register option for the license. */
add_action( 'admin_init', 'mina_olen_theme_register_option' );

/* Activate the license. */
add_action( 'admin_init', 'mina_olen_theme_activate_license' );

/* Deactivate the license. */
add_action( 'admin_init', 'mina_olen_theme_deactivate_license' );

/**
 * Setup theme updater. @link https://gist.github.com/pippinsplugins/3ab7c0a01d5a9d8005ed
 *
 * @since  1.0.0
 */
function mina_olen_theme_updater() {

	/* If there is no valid license key status, don't let updates. */
	if( get_option( 'mina_olen_theme_license_key_status' ) != 'valid' ) {
		return;
	}

	/* Load our custom theme updater. */
	if( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'admin/EDD_SL_Theme_Updater.php' );
	}
	
	/* Get license key from database. */
	$mina_olen_license = trim( get_option( 'mina_olen_theme_license_key' ) );

	$edd_updater = new EDD_SL_Theme_Updater( array( 
		'remote_api_url' 	=> MINA_OLEN_SL_STORE_URL, 	// our store URL that is running EDD
		'version' 			=> MINA_OLEN_VERSION, 		// the current theme version we are running
		'license' 			=> $mina_olen_license, 		// the license key (used get_option above to retrieve from DB)
		'item_name' 		=> MINA_OLEN_SL_THEME_NAME,	// the name of this theme
		'author'			=> 'Sami Keijonen'	        // the author's name
		)
	);

}

/**
 * Add license key menu item under Appeareance.
 *
 * @since 1.0.0
 */
function mina_olen_theme_license_menu() {

	add_theme_page( __( 'Theme License', 'mina-olen' ), __( 'Theme License', 'mina-olen' ), 'manage_options', 'mina-olen-license', 'mina_olen_theme_license_page' );
	
}

/**
 * Setting page for license key.
 *
 * @since 1.0.0
 */
function mina_olen_theme_license_page() {
	$license 	= get_option( 'mina_olen_theme_license_key' );
	$status 	= get_option( 'mina_olen_theme_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e( 'Theme License Options', 'mina-olen' ); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields( 'mina_olen_theme_license' ); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e( 'License Key', 'mina-olen' ); ?>
						</th>
						<td>
							<input id="mina_olen_theme_license_key" name="mina_olen_theme_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
							<label class="description" for="mina_olen_theme_license_key"><?php _e( 'Enter your license key for receiving automatic upgrades', 'mina-olen' ); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e( 'Activate License', 'mina-olen' ); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<?php wp_nonce_field( 'mina_olen_nonce', 'mina_olen_nonce' ); ?>
									<input type="submit" class="button-secondary" name="mina_olen_theme_license_deactivate" value="<?php esc_attr_e( 'Deactivate License', 'mina-olen' ); ?>"/>
								<?php } else {
									wp_nonce_field( 'mina_olen_nonce', 'mina_olen_nonce' ); ?>
									<input type="submit" class="button-secondary" name="mina_olen_theme_license_activate" value="<?php esc_attr_e( 'Activate License', 'mina-olen' ); ?>"/>
								<?php } ?>
							</td>
						</tr>
						<?php if( $status !== false && $status == 'valid' ) {  ?>
							<tr valign="top">
								<th scope="row" valign="top">
									<?php _e( 'License status', 'mina-olen' ); ?>
								</th>
								<td>
									<?php mina_olen_theme_check_license(); ?>
								</td>
							</tr>
						<?php }
					} ?>
				</tbody>
			</table>	
			<?php submit_button(); ?>
		
		</form>
	<?php
}

function mina_olen_theme_register_option() {
	// creates our settings in the options table
	register_setting( 'mina_olen_theme_license', 'mina_olen_theme_license_key', 'mina_olen_theme_sanitize_license' );
}

/**
 * Gets rid of the local license status option when adding a new one.
 * @since 1.0.0
 */

function mina_olen_theme_sanitize_license( $new ) {

	$old = get_option( 'mina_olen_theme_license_key' );
	
	if( $old && $old != $new ) {
		delete_option( 'mina_olen_theme_license_key_status' ); // New license has been entered, so must reactivate.
	}
	
	return esc_attr( $new );
}

/**
 * Activate the license.
 *
 * @since 1.0.0
 */
function mina_olen_theme_activate_license() {

	if( isset( $_POST['mina_olen_theme_license_activate'] ) ) {
	
	 	if( ! check_admin_referer( 'mina_olen_nonce', 'mina_olen_nonce' ) ) {	
			return; // get out if we didn't click the Activate button
		}
		
		global $wp_version;

		$license = trim( get_option( 'mina_olen_theme_license_key' ) );
				
		$api_params = array( 
			'edd_action' => 'activate_license', 
			'license'    => $license, 
			'item_name'  => urlencode( MINA_OLEN_SL_THEME_NAME ) 
		);
		
		$response = wp_remote_get( add_query_arg( $api_params, MINA_OLEN_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'mina_olen_theme_license_key_status', $license_data->license );

	}
}

/**
 * Deactivate the license. This will decrease the site count.
 *
 * @since 1.0.0
 */

function mina_olen_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['mina_olen_theme_license_deactivate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'mina_olen_nonce', 'mina_olen_nonce' ) ) {	
			return; // get out if we didn't click the Activate button
		}

		// retrieve the license from the database
		$license = trim( get_option( 'mina_olen_theme_license_key' ) );
		
		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'deactivate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( MINA_OLEN_SL_THEME_NAME ) // the name of our product in EDD
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, MINA_OLEN_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false;
		}
		
		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' ) {
			delete_option( 'mina_olen_theme_license_key_status' );
		}

	}
}


/***********************************************
* Illustrates how to check if a license is valid
***********************************************/

function mina_olen_theme_check_license() {

	global $wp_version;

	$license = trim( get_option( 'mina_olen_theme_license_key' ) );
		
	$api_params = array( 
		'edd_action' => 'check_license', 
		'license' => $license, 
		'item_name' => urlencode( MINA_OLEN_SL_THEME_NAME ) 
	);
	
	$response = wp_remote_get( add_query_arg( $api_params, MINA_OLEN_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) { ?>
		<span style="color:green;"><?php _e( 'Active', 'mina-olen' ); ?></span><?php // License is still valid
	} else if( $license_data->license == 'expired' ) { ?>
		<span style="color:red;"><?php _e( 'Expired', 'mina-olen' ); ?></span><?php // License has expired
	} else if( $license_data->license == 'invalid' ) { ?>
		<span style="color:red;"><?php _e( 'License keys do not match', 'mina-olen' ); ?></span><?php // License keys don't match
	} else if( $license_data->license == 'inactive' ) { ?>
		<span style="color:red;"><?php _e( 'Inactive', 'mina-olen' ); ?></span><?php // License is inactive
	} else if( $license_data->license == 'disabled' ) { ?>
		<span style="color:red;"><?php _e( 'Disabled', 'mina-olen' ); ?></span><?php // License is disabled
	} else if( $license_data->license == 'site_inactive' ) { ?>
		<span style="color:red;"><?php _e( 'Site is inactive', 'mina-olen' ); ?></span><?php // Site is inactive
	} else { ?>
		<span style="color:red;"><?php _e( 'Unknown', 'mina-olen' ); ?></span><?php
	}
}

?>