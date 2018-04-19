<?php
// All of the base theme functions
require_once(get_template_directory() . '/base/functions/base-functions.php');
// Theme specific functions
require_once(get_template_directory() . '/inc/custom-functions.php');

// Scripts and styles
function jkanne_scripts() {
    // JS
    wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/js/app.min.js', array("jquery"), '1.0.0', true );
    // Styles
    wp_enqueue_style( 'screen', get_template_directory_uri() . '/assets/css/screen.css', array(),'1.0.0', 'screen' );

}
add_action( 'wp_enqueue_scripts', 'jkanne_scripts',1 );


add_image_size( 'hero_image', 220, 180 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page('Theme Settings');

}
