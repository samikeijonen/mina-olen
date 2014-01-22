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
 * @package    Webdento
 * @subpackage Functions
 * @version    1.0.0
 * @since      1.0.0
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright  Copyright (c) 2013, Sami Keijonen
 * @link       http://foxnet.fi
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Load custom header and background functions outside normal setup function so that child theme can override them more easily. */
require_once( trailingslashit( get_template_directory() ) . 'includes/custom-header.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/custom-background.php' );


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

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
	
	/* Include theme customize. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/theme-customize.php' );
	
	/* Include EDD functions. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/edd-functions.php' );

	/* Load scripts. */
	add_theme_support( 
		'hybrid-core-scripts', 
		array( 'comment-reply' ) 
	);

	/* Load styles. */
	add_theme_support( 
		'hybrid-core-styles', 
		array( 'parent', 'style' )
	);

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Enable theme layouts (need to add stylesheet support). */
	add_theme_support( 
		'theme-layouts', 
		array( 
			'1c'   => __( 'One Column', 'mina-olen' ),
			'2c-l' => __( 'Two Columns: Content - Sidebar', 'mina-olen' ),
			'2c-r' => __( 'Two Columns: Sidebar - Content', 'mina-olen' )
		), 
		array( 'default' => '2c-l', 'customizer' => true ) 
	);

	/* Support pagination instead of prev/next links. */
	add_theme_support( 'loop-pagination' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Use breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );
	
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

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 2560 );
	
	/* Add respond.js and  html5shiv.js for unsupported browsers. */
	add_action( 'wp_head', 'mina_olen_respond_html5shiv' );
	
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
	
	/* Change [...] to ... Read more. */
	add_filter( 'excerpt_more', 'mina_olen_excerpt_more' );
	
	/* Adds custom attributes to the primary menu. */
	add_filter( 'hybrid_attr_menu', 'mina_olen_primary_menu_class', 10, 2 );

}

/**
 * Function for help to unsupported browsers understand mediaqueries and html5.
 * @link: https://github.com/scottjehl/Respond
 * @link: http://code.google.com/p/html5shiv/
 * @since 1.0.0
 */
function mina_olen_respond_html5shiv() {
	?>
	
	<!-- Enables media queries and html5 in some unsupported browsers. -->
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/respond/respond.min.js"></script>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/html5shiv/html5shiv.js"></script>
	<![endif]-->
	
	<?php
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
		'name'          => __( 'Header  Widget', 'mina-olen' ),
		'description'   => __( 'Header Widget Area', 'mina-olen' )
	);
	$sidebar_primary_args = array(
		'id'            => 'primary',
		'name'          => __( 'Primary  Widget', 'mina-olen' ),
		'description'   => __( 'Primary Widget Area', 'mina-olen' )
	);
	$sidebar_subsidiary_args = array(
		'id'            => 'subsidiary',
		'name'          => __( 'Subsidiary  Widget', 'mina-olen' ),
		'description'   => __( 'Subsidiary Widget Area', 'mina-olen' )
	);
	
	hybrid_register_sidebar( $sidebar_header_args );
	hybrid_register_sidebar( $sidebar_primary_args );
	hybrid_register_sidebar( $sidebar_subsidiary_args );

}

/**
 * Enqueue styles and scripts
 *
 * @since 1.0
 */
function mina_olen_enqueue_scripts() {

	/* Enqueue responsive nav. */
	//wp_enqueue_script( 'mina-olen-responsive-nav', trailingslashit( get_template_directory_uri() ) . 'js/responsive-nav/responsive-nav.min.js', array(), '20131122', false );
	
	
	/* Enqueue Fitvids. */
	wp_enqueue_script( 'mina-olen-fitvids', trailingslashit( get_template_directory_uri() ) . 'js/fitvids/fitvids.js', array( 'jquery' ), '20140116', false );

	/* Enqueue Headroom. */
	wp_enqueue_script( 'mina-olen-headroom', trailingslashit( get_template_directory_uri() ) . 'js/headroom/headroom.js', array( 'jquery' ), '20131222', false );
	
	/* Enqueue responsive multi toggle nav. */
	wp_enqueue_script( 'mina-olen-settings', trailingslashit( get_template_directory_uri() ) . 'js/settings/setting.js', array( 'jquery', 'mina-olen-fitvids', 'mina-olen-headroom' ), '20131129', true );
	
	/* Enqueue Fitvids settings. */
	//wp_enqueue_script( 'mina-olen-fitvids-settings', trailingslashit( get_template_directory_uri() ) . 'js/fitvids/settings.js', array( 'jquery', 'mina-olen-fitvids' ), '20131122', true );
		
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since  1.0.0
 */
function mina_olen_disable_sidebars( $sidebars_widgets ) {
	global $wp_customize;

	$customize = ( is_object( $wp_customize ) && $wp_customize->is_preview() ) ? true : false;

	if ( !is_admin() && !$customize && '1c' == get_theme_mod( 'theme_layout', '1c' ) ) {
	
		$sidebars_widgets['primary'] = false;
		$sidebars_widgets['secondary'] = false;
		
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
	elseif ( is_attachment() && wp_attachment_is_image() && 'default' == get_post_layout( get_queried_object_id() ) ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	elseif ( is_post_type_archive( 'portfolio_item' ) || is_post_type_archive( 'download' ) ) {
		add_filter( 'theme_mod_theme_layout', 'mina_olen_theme_layout_one_column' );
	}
	elseif ( is_tax( 'portfolio' ) || is_tax( 'download_tag' ) || is_tax( 'download_category' ) ) {
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
 * Change [...] to ... Read more.
 * @since 1.0.0
 */
function mina_olen_excerpt_more() {

	return '...<p><span class="mina-olen-read-more"><a class="more-link" href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">' . __( 'Read more', 'mina-olen' ) . '</a></span></p>';

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
		return '<span class="mina-olen-project-url"><a class="kalervo-portfolio-item-link" href="' . esc_url( $mina_olen_portfolio_url ) . '" title="' . the_title( '','', false ) . '">' . __( 'Visit site', 'mina-olen' ) . '</a></span>';
	}
	
}

?>