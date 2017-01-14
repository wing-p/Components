<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

add_action( 'genesis_setup','child_theme_setup', 15 );
//set up child theme
function child_theme_setup() {
	define( 'CHILD_THEME_NAME', 'Hashtag' );
	define( 'CHILD_THEME_URL', 'http://www.hashtag.com' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );	
	} 

//enable HTML5 
add_theme_support( 'html5');
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'genesis-footer-widgets', 1 ); 

//Load custom.css
add_action( 'wp_enqueue_scripts', 'custom_load_custom_style_sheet' );
function custom_load_custom_style_sheet() {
	wp_enqueue_style( 'custom-stylesheet', CHILD_URL . '/custom.css', array(), PARENT_THEME_VERSION );
	}	

//customise genesis wrap 
add_theme_support( 'genesis-structural-wraps', array( 'header', 'entry-content', 'site-inner', 'footer-widgets', 'footer' ) );
