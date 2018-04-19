<?php
function theme_custom_logo_setup() {
    $args = array(
    'flex-width' => true,
    'flex-height' => true
    );
    add_theme_support( 'custom-logo', $args );
}
add_action( 'after_setup_theme', 'theme_custom_logo_setup' );add_filter('get_custom_logo','change_logo_class');

function change_logo_class($html){
    $html = str_replace('class="custom-logo-link"', 'class="navbar-brand"', $html);
    return $html;
}

function get_theme_logo() {
    if(has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . get_site_url() . '" class="navbar-brand">' . get_bloginfo("name") . '</a>';
    }
}