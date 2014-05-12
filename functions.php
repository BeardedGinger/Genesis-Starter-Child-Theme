<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'TODO' );
define( 'CHILD_THEME_URL', 'http://www.joshmallard.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_scripts' );
/**
 * Enqueue scripts and fonts
 *
 * @since 1.0.0
 */
function enqueue_child_theme_scripts() {
	
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700', array(), CHILD_THEME_VERSION );
	
	wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );
