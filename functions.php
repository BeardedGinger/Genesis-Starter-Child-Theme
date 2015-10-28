<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'TODO' );
define( 'CHILD_THEME_URL', 'http://www.limecuda.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_scripts' );
/**
 * Enqueue scripts and fonts
 *
 * Loads full scripts in local development when WP_DEBUG is turned on.
 *
 * Run 'grunt uglify' to update minified scripts as well as create conditional page scripts.
 * Before pushing to server, run 'grunt uglify' to update uglified version
 *
 * @since 1.0.0
 */
function enqueue_child_theme_scripts() {

	if( WP_DEBUG ) {
		wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ) );
		wp_enqueue_script( 'mobile-nav', get_stylesheet_directory_uri() . '/assets/js/mobile-nav.js', array( 'jquery' ) );
	} else {
		if( is_home() ) {
			wp_enqueue_script( 'home-scripts', get_stylesheet_directory_uri() . '/js/plugins.home.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
		} else {
			wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'enqueue_needed_fonts' );
add_action( 'wp_enqueue_scripts', 'enqueue_needed_fonts' );
/**
 * Enqueue the needed fonts on the front-end as well as the back for editor style support
 */
function enqueue_needed_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Force BFA local fallback
add_filter( 'bfa_force_fallback', '__return_true' );

//* Add front-end styles to backend editor
add_editor_style();

//* Allow shortcodes to be used in sidebar widgets
add_filter('widget_text', 'do_shortcode');

// Enable PHP in widgets
add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}

add_filter( 'genesis_footer_creds_text', 'limecuda_footer_creds_text' );
/**
 * Filter the default credits to include LimeCuda branding and info.
 *
 * @since 1.0.0
 */
function limecuda_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href="'. get_bloginfo( 'url' ) .'">' . get_bloginfo( 'name' ) . '</a> &middot; Website Development by <a href="http://limecuda.com" target="_blank" title="Strategic Website Development">LimeCuda</a>';
	echo '</p></div>';
}