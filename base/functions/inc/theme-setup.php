<?php
/* Theme setup - nav_menus, support thumbnails, sidebars */
function theme_setup() {
    load_theme_textdomain( 'jkanne', get_template_directory() );

    // Navigation menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'jkanne-flexible' ),
    ));

    // Theme support
    add_theme_support( 'post-thumbnails' );
    add_theme_support( "title-tag" );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_editor_style();

    // Filters
    add_filter('the_generator', '__return_false');

    // Remove
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

}

add_action( 'after_setup_theme', 'theme_setup' );
