<?php
/**
 * One-click updater for the Mina Olen Theme
 *
 * @package EDD Theme Updater
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	array(
		'remote_api_url' => 'http://foxland.fi',       // Site where EDD is hosted
		'item_name'      => 'Mina olen',               // Name of theme
		'theme_slug'     => 'mina_olen_theme',         // Theme slug
		'version'        => MINA_OLEN_VERSION,         // The current version of this theme
		'author'         => 'Sami Keijonen'            // The author of this theme
	)

);