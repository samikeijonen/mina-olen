<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Mina olen
 * @subpackage Functions
 * @version    1.0.0
 * @since      1.0.0
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright  Copyright (c) 2013, Sami Keijonen
 * @link       http://foxnet.fi
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/**
 * The current version of the theme.
 */
define( 'MINA_OLEN_VERSION', '1.2.0' );

/**
 * The suffix to use for scripts.
 */
if ( ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ) {
	define( 'MINA_OLEN_SUFFIX', '' );
} else {
	define( 'MINA_OLEN_SUFFIX', '.min' );
}

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Load custom header and background functions outside normal setup function so that child theme can override them more easily. */
require_once( trailingslashit( get_template_directory() ) . 'includes/custom-header.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/custom-background.php' );

/* Add theme settings for license. */
if ( is_admin() ) {
	require_once( trailingslashit ( get_template_directory() ) . 'theme-updater/theme-updater.php' );
}


/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'mina_olen_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function mina_olen_theme_setup() {
	
	/* Include theme customize. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/theme-customize.php' );
	
	/* Include metabox functions. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/meta-boxes.php' );
	
	/* Include EDD functions. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/edd-functions.php' );

	/* Theme layouts. */
	add_theme_support( 'theme-layouts', array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) );
	
	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Use breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. But use Jetpack tiled gallery if user enables it. */
	if( !class_exists( 'Jetpack' ) || !Jetpack::is_module_active( 'tiled-gallery' ) ) {
		add_theme_support( 'cleaner-gallery' );
	}
	
	/* Add post stylesheet support. */
	add_theme_support( 'post-stylesheets' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);
	
	/* Whistles plugin support. */
	add_theme_support( 'whistles', array( 'styles' => true ) );
	
	/* Webshare plugin support. This means that theme handles the CSS. */
	add_theme_support( 'webshare', array( 'styles' => true ) );
	
	/* Add support for Message Board Plugin. This means that theme handles the CSS. */
	add_theme_support( 'message-board' );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 1080 );
	
	/* Add custom image sizes. */
	add_action( 'init', 'mina_olen_add_image_sizes' );
	
	/* Register nav menus. */
	add_action( 'init', 'mina_olen_register_nav_menus' );
	
	/* Register sidebars. */
	add_action( 'widgets_init', 'mina_olen_register_sidebars' );
	
	/* Enqueue styles and scripts. */
	add_action( 'wp_enqueue_scripts', 'mina_olen_enqueue_scripts' );
	
	/* Disable primary sidebar widgets when layout is one column. */
	add_filter( 'sidebars_widgets', 'mina_olen_disable_sidebars' );
	add_action( 'template_redirect', 'mina_olen_one_column' );
	
	/* Add number of header widgets to body_class. */
	add_filter( 'body_class', 'mina_olen_header_classes' );
	
	/* Add number of subsidiary and front page widgets to body_class. */
	add_filter( 'body_class', 'mina_olen_subsidiary_classes' );
	
	/* Add proper classes in body class. */
	add_filter( 'body_class', 'mina_olen_body_classes' );
	
	/* Change [...] to ... Read more. */
	add_filter( 'excerpt_more', 'mina_olen_excerpt_more' );
	
	/* Adds custom attributes to the primary menu. */
	add_filter( 'hybrid_attr_menu', 'mina_olen_primary_menu_class', 10, 2 );
	
	/* AddseEditor styles. */
	add_editor_style( mina_olen_get_editor_styles() );
	
	/* Disable bbPress breadcrumb. */
	add_filter( 'bbp_no_breadcrumb', '__return_true' );
	
	/* Add WPML flags. */
	add_filter( 'wp_nav_menu_items', 'mina_olen_add_wpml_flags', 10, 2 );

}

/**
 *  Adds custom image sizes for thumbnail images.
 * 
 * @since 1.0.0
 */
function mina_olen_add_image_sizes() {

	add_image_size( 'mina-olen-thumbnail', 350, 350, true );

}

/**
 * Registers nav menus for the theme.
 *
 * @since  1.0.0
 */
function mina_olen_register_nav_menus() {

	register_nav_menu( 'primary', esc_html__( 'Primary menu', 'mina-olen' ) );
	
	register_nav_menu( 'subsidiary', esc_html__( 'Subsidiary menu', 'mina-olen' ) );
	
	register_nav_menu( 'social', esc_html__( 'Social menu', 'mina-olen' ) );
	
	if( function_exists( 'EDD' ) ) {
		register_nav_menu( 'edd', esc_html__( 'Easy Digital Download menu', 'mina-olen' ) );
	}
	
}

/**
 * Registers sidebars for the theme.
 *
 * @since  1.0.0
 */
function mina_olen_register_sidebars() {

	/* Register sidebars. */
	$sidebar_header_args = array(
		'id'            => 'header',
		'name'          => _x( 'Header', 'sidebar', 'mina-olen' ),
		'description'   => __( 'A sidebar located in the top of the site.', 'mina-olen' )
	);
	$sidebar_primary_args = array(
		'id'            => 'primary',
		'name'          => _x( 'Primary', 'sidebar', 'mina-olen' ),
		'description'   => __( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'mina-olen' )
	);
	$sidebar_subsidiary_args = array(
		'id'            => 'subsidiary',
		'name'          => _x( 'Subsidiary', 'sidebar', 'mina-olen' ),
		'description'   => __( 'A sidebar located in the footer of the site.', 'mina-olen' )
	);
	$sidebar_after_download_args = array(
		'id'            => 'after-download',
		'name'          => _x( 'After Download', 'sidebar', 'mina-olen' ),
		'description'   => __( 'A sidebar located after singular download.', 'mina-olen' )
	);
	
	hybrid_register_sidebar( $sidebar_header_args );
	hybrid_register_sidebar( $sidebar_primary_args );
	hybrid_register_sidebar( $sidebar_subsidiary_args );
	hybrid_register_sidebar( $sidebar_after_download_args );

}

/**
 * Enqueue styles and scripts
 *
 * @since 1.0
 */
function mina_olen_enqueue_scripts() {
	
	/* Add Genericons font, used in the main stylesheet. */
	wp_enqueue_style( 'genericons', trailingslashit( get_template_directory_uri() ) . 'fonts/genericons/genericons/genericons' . MINA_OLEN_SUFFIX . '.css', array(), '3.4' );
	
	/* Enqueue Fitvids. */
	wp_enqueue_script( 'mina-olen-fitvids', trailingslashit( get_template_directory_uri() ) . 'js/fitvids/fitvids' . MINA_OLEN_SUFFIX . '.js', array( 'jquery' ), MINA_OLEN_VERSION, false );

	/* Enqueue Headroom. */
	wp_enqueue_script( 'mina-olen-headroom', trailingslashit( get_template_directory_uri() ) . 'js/headroom/headroom' . MINA_OLEN_SUFFIX . '.js', array( 'jquery' ), MINA_OLEN_VERSION, false );
	wp_enqueue_script( 'mina-olen-headroom-jquery', trailingslashit( get_template_directory_uri() ) . 'js/headroom/jQuery.headroom' . MINA_OLEN_SUFFIX . '.js', array( 'jquery' ), MINA_OLEN_VERSION, false );
	
	/* Enqueue responsive multi toggle nav. */
	wp_enqueue_script( 'mina-olen-settings', trailingslashit( get_template_directory_uri() ) . 'js/settings/setting' . MINA_OLEN_SUFFIX . '.js', array( 'jquery', 'mina-olen-fitvids', 'mina-olen-headroom', 'mina-olen-headroom-jquery' ), MINA_OLEN_VERSION, true );
	
	/* Enqueue parent theme styles if using child theme. */
	if ( is_child_theme() ) {
		wp_enqueue_style( 'mina-olen-parent-style', trailingslashit( get_template_directory_uri() ) . 'style' . MINA_OLEN_SUFFIX . '.css', array(), MINA_OLEN_VERSION );
	}
	
	/* Enqueue active theme styles. */
	wp_enqueue_style( 'mina-olen-style', get_stylesheet_uri() );
	
	/* Enqueue skip link fix. */
	wp_enqueue_script( 'mina-olen-skip-link-focus-fix', trailingslashit( get_template_directory_uri() ) . 'js/skip-link-focus-fix' . MINA_OLEN_SUFFIX . '.js', array(), MINA_OLEN_VERSION, true );
	
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since  1.0.0
 */
function mina_olen_disable_sidebars( $sidebars_widgets ) {
	global $wp_customize;

	$customize = ( is_object( $wp_customize ) && $wp_customize->is_preview() ) ? true : false;

	if ( !is_admin() && !$customize && '1c' == get_theme_mod( 'theme_layout', '2c-l' ) ) {
		$sidebars_widgets['primary'] = false;	
	}
	
	return $sidebars_widgets;
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since  1.0.0
 */
function mina_olen_one_column() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) && '1c' == get_theme_mod( 'theme_layout' ) ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	elseif ( is_attachment() && wp_attachment_is_image() ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	elseif ( is_post_type_archive( 'portfolio_item' ) || is_post_type_archive( 'download' ) ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	elseif ( is_tax( 'portfolio' ) || is_tax( 'download_tag' ) || is_tax( 'download_category' ) || is_tax( 'edd_download_info_feature' ) ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	elseif ( is_page_template( 'pages/front-page.php' ) ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since  1.0.0
 * @param  string $layout The layout of the current page.
 * @return string
 */
function mina_olen_theme_layout_one_column( $layout ) {
	return '1c';
}

/**
 * Counts widgets number in header sidebar and ads css class (.sidebar-subsidiary-$number) to body_class.
 * Used to increase / decrease widget size according to number of widgets.
 * Example: if there's one widget in subsidiary sidebar - widget width is 100%, if two widgets, 50% each...
 * @author    Sinisa Nikolic
 * @copyright Copyright (c) 2012
 * @link      http://themehybrid.com/themes/sukelius-magazine
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since     1.0.0
 */
function mina_olen_header_classes( $classes ) {
    
	if ( is_active_sidebar( 'header' ) ) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		$num = count( $the_sidebars['header'] );
		$classes[] = 'active-sidebar-header sidebar-header-' . $num;
		
    }
    
    return $classes;
	
}

/**
 * Counts widgets number in subsidiary sidebar and ads css class (.sidebar-subsidiary-$number) to body_class.
 * Used to increase / decrease widget size according to number of widgets.
 * Example: if there's one widget in subsidiary sidebar - widget width is 100%, if two widgets, 50% each...
 * @author    Sinisa Nikolic
 * @copyright Copyright (c) 2012
 * @link      http://themehybrid.com/themes/sukelius-magazine
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since     1.0.0
 */
function mina_olen_subsidiary_classes( $classes ) {
    
	if ( is_active_sidebar( 'subsidiary' ) ) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		$num = count( $the_sidebars['subsidiary'] );
		$classes[] = 'sidebar-subsidiary-' . $num;
		
    }
    
    return $classes;
	
}

/**
 * Add proper classes to body class.
 * @since     1.0.2
 * @return  array
 */
function mina_olen_body_classes( $classes ) {
	
	/* Add the '.custom-header-image' class if the user is using a custom header image. */
	if ( get_header_image() ) {
		$classes[] = 'custom-header-image';
	}
	
	/* Add the '.custom-callout' class if the user is using a callout text and link. Do not output in admin. */
	if ( !is_admin() && mina_olen_check_callout_output() ) {
		$classes[] = 'custom-callout';
	}
    
    return $classes;
	
}

/**
 * Change [...] to ... Read more.
 * @since 1.0.0
 */
function mina_olen_excerpt_more( $more ) {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( __( 'Read more %s', 'mina-olen' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
	$more = sprintf( '...<p><span class="mina-olen-read-more"><a href="%s" class="more-link">%s</a></span></p>', esc_url( get_permalink() ), $text );

	return $more;
}

/**
 * Adds a custom class to the 'primary' menu.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $attr
 * @param  string $context
 * @return array
 */
function mina_olen_primary_menu_class( $attr, $context ) {

	if ( 'primary' === $context ) {
		$attr['class'] .= ' animated';
	}

	return $attr;
}

/**
* Returns a link to the porfolio item URL if it has been set.
*
* @since  1.0.0
*/
function mina_olen_get_portfolio_item_link() {

	$mina_olen_portfolio_url = get_post_meta( get_the_ID(), 'portfolio_item_url', true );

	if ( !empty( $mina_olen_portfolio_url ) ) {
		
		/* Translators: The %s is the post title shown to screen readers. */
		$text = sprintf( __( 'Visit site %s', 'mina-olen' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
		$link = sprintf( '<span class="mina-olen-project-url"><a href="%s" class="mina-olen-portfolio-item-link">%s</a></span>', esc_url( $mina_olen_portfolio_url  ), $text );

		return $link;
	}
	
}

/**
* Callout text and link in singular pages.
*
* @since  1.0.0
*/
function mina_olen_callout_output() {

	/* Get out if on search or 404 page. */
	if( is_search() || is_404() ) {
		return;
	}
	
	/* Get post meta. */
	$mina_olen_callout_text = get_post_meta( get_the_ID(), '_mina_olen_callout_text', true );
	$mina_olen_callout_url = get_post_meta( get_the_ID(), '_mina_olen_callout_url', true );
	$mina_olen_callout_url_text = get_post_meta( get_the_ID(), '_mina_olen_callout_url_text', true );
	
	/* Check if post meta exists and echo on singular pages. This can be filtered. */
	if ( mina_olen_check_callout_output() ) { ?>

		<div id="mina-olen-callout-url"><div id="mina-olen-callout-text"><?php echo esc_attr( $mina_olen_callout_text ); ?></div>

		<?php if ( !empty( $mina_olen_callout_url ) && !empty( $mina_olen_callout_url_text ) ) { ?>
			<a class="mina-olen-callout-button" href="<?php echo esc_url( $mina_olen_callout_url ); ?>" title="<?php echo esc_attr( $mina_olen_callout_url_text ); ?>"><?php echo esc_attr( $mina_olen_callout_url_text ); ?></a></div>
		<?php }
		
	}
	
}

/**
* Check if Callout text and link are set on singular pages.
*
* @since  1.0.2
* @return boolean
*/
function mina_olen_check_callout_output() {

	/* Get post meta. */
	$mina_olen_callout_text = get_post_meta( get_the_ID(), '_mina_olen_callout_text', true );
	$mina_olen_callout_url = get_post_meta( get_the_ID(), '_mina_olen_callout_url', true );
	$mina_olen_callout_url_text = get_post_meta( get_the_ID(), '_mina_olen_callout_url_text', true );
	
	if( is_singular( apply_filters( 'mina_olen_show_metabox', array( 'page' ) ) ) && !empty( $mina_olen_callout_text ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 *
 * @author  Justin Tadlock, justintadlock.com
 * @link    http://themehybrid.com/themes/stargazer
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since   1.0.0
 * @return  array
 */
function mina_olen_get_editor_styles() {

	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. This also checks child theme's css/editor-style.css file. */
	$editor_styles[] = 'css/editor-style.css';

	/* Add the locale stylesheet. */
	$editor_styles[] = get_locale_stylesheet_uri();

	/* Return the styles. */
	return $editor_styles;
}

/**
 * Add WPML flags to menus WMPL flags.
 *
 * @since   1.0.5
 * @return  array
 */
function mina_olen_add_wpml_flags( $items, $args ) {
    
	if ( function_exists( 'icl_get_languages' ) && 'primary' == $args->theme_location && get_theme_mod( 'wpml_flags_primary' ) && has_nav_menu( 'primary' ) ) {
        $items .= mina_olen_language_selector_flags();
    }
	
	if ( function_exists( 'icl_get_languages' ) && 'subsidiary' == $args->theme_location && get_theme_mod( 'wpml_flags_subsidiary' ) && has_nav_menu( 'subsidiary' ) ) {
        $items .= mina_olen_language_selector_flags();
    }
	
    return $items;
}

/**
 * Output WMPL flags.
 *
 * @since   1.0.5
 * @return  string
 */
function mina_olen_language_selector_flags(){
	
	/* Get out if icl_get_languages do not exists. */
	if( !function_exists( 'icl_get_languages' ) ) {
		return;
	}
	
	$languages = icl_get_languages( apply_filters( 'mina_olen_wpml_flag_args', 'skip_missing=0&orderby=code' ) );
	
	$mina_olen_flags_output = '';
	if( !empty( $languages ) ) {
		foreach( $languages as $l ){
			$mina_olen_flags_output .= '<li class="menu-item mina-olen-flag-' . $l['language_code'] . '">';
			$mina_olen_flags_output .= '<a href="' . $l['url'] . '">';
			$mina_olen_flags_output .= '<img src="' . $l['country_flag_url'] . '" height="' . get_theme_mod( 'wpml_flags_height', 15 ) . '" alt="' . $l['language_code'] . '" width="' . get_theme_mod( 'wpml_flags_width', 20 ) . '" />';
			$mina_olen_flags_output .= '</a>';
			$mina_olen_flags_output .= '</li>';
		}
	}
	return $mina_olen_flags_output;
}

/**
 * Register layouts. This is the new way to do it in Hybrid Core version 3.0.0.
 *
 * @since 1.2.0
 */
function mina_olen_register_layouts() {
	
	hybrid_register_layout( '1c',   array( 'label' => esc_html__( '1 Column',                     'mina-olen' ), 'image' => '%s/images/layouts/1c.png'   ) );
	hybrid_register_layout( '2c-l', array( 'label' => esc_html__( '2 Columns: Content / Sidebar', 'mina-olen' ), 'image' => '%s/images/layouts/2c-l.png' ) );
	hybrid_register_layout( '2c-r', array( 'label' => esc_html__( '2 Columns: Sidebar / Content', 'mina-olen' ), 'image' => '%s/images/layouts/2c-r.png' ) );

}
add_action( 'hybrid_register_layouts', 'mina_olen_register_layouts' );

/**
 * For backwards compability add old classes to archive header.
 *
 * @since 1.2.0
 *
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function mina_olen_archive_header( $attr ) {

	$attr['class'] = 'archive-header loop-meta';

	return $attr;

}
add_filter( 'hybrid_attr_archive-header', 'mina_olen_archive_header' );

/**
 * For backwards compability add old classes to archive title.
 *
 * @since  1.2.0
 *
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function mina_olen_archive_title( $attr ) {

	$attr['class'] = 'archive-title loop-title';

	return $attr;
	
}
add_filter( 'hybrid_attr_archive-title', 'mina_olen_archive_title' );

/**
 * For backwards compability add old classes to archive description.
 *
 * @since  1.2.0
 *
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function mina_olen_archive_description( $attr ) {

	$attr['class'] = 'archive-description loop-description';

	return $attr;
}
add_filter( 'hybrid_attr_archive-description', 'mina_olen_archive_description' );

?>