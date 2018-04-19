<?php

// WooCommerce
add_theme_support( 'woocommerce' );

// Language support
load_theme_textdomain('jkanne', get_template_directory() . '/languages');

// Load dependencies
require_once(get_template_directory() . '/base/functions/inc/custom-functions.php');
require_once(get_template_directory() . '/base/functions/inc/theme-setup.php');
require_once(get_template_directory() . '/base/functions/inc/wysiwyg.php');
require_once(get_template_directory() . '/base/functions/inc/gravity-form.php');
require_once(get_template_directory() . '/base/functions/inc/customize.php');
require_once(get_template_directory() . '/base/functions/inc/dashboard.php');
require_once(get_template_directory() . '/base/functions/inc/admin.php');
require_once(get_template_directory() . '/base/functions/inc/custom-login-page.php');
require_once(get_template_directory() . '/base/functions/inc/widgets/sidebars.php');
require_once(get_template_directory() . '/base/functions/inc/global-components.php');


// Scripts and styles
function jkanne_base_scripts() {
    // JS
    //wp_enqueue_script('jquery');
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery/jquery-3.2.1.js', array(), '3.2.1' );

    //wp_enqueue_script( 'main', get_template_directory_uri() . '/base/js/main.js', array("jquery"), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'jkanne_base_scripts',1 );
