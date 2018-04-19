<?php
/*
*
* WP Admin Custom Function
*
*/

// Custom Admin footer
function custom_footer_admin () {
    echo '<span id="footer-thankyou">' . __('Built with love by', 'jkanne-flexible') . '<a href="https://www.jkanne.com/" target="_blank"> Jkanne.com</a></span>';
}
add_filter('admin_footer_text', 'custom_footer_admin');

// Custom Fields For Dashboard Redmine Widget
add_action('admin_init', 'jkanne_general_section');
function jkanne_general_section() {
    add_settings_section(
        'jkanne_settings_section',
        __('Jkanne Options', 'jkanne-flexible'),
        'jkanne_section_options_callback',
        'general'
    );

    add_settings_field(
        'jkanne_redmine_kay',
        __('Redmine Key', 'jkanne-flexible'),
        'jkanne_textbox_callback',
        'general',
        'jkanne_settings_section',
        array(
            'jkanne_redmine_kay'
        )
    );

    add_settings_field(
        'jkanne_redmine_folder',
        __('Redmine Folder Name', 'jkanne-flexible'),
        'jkanne_textbox_callback',
        'general',
        'jkanne_settings_section',
        array(
            'jkanne_redmine_folder'
        )
    );

    add_settings_field(
        'jkanne_rss',
        __('Jkanne RSS', 'jkanne-flexible'),
        'jkanne_textbox_callback',
        'general',
        'jkanne_settings_section',
        array(
            'jkanne_rss'
        )
    );

    register_setting('general','jkanne_redmine_kay', 'esc_attr');
    register_setting('general','jkanne_redmine_folder', 'esc_attr');
    register_setting('general','jkanne_rss', 'esc_attr');
}

function jkanne_section_options_callback() { // Section Callback
    echo '<p>' . __('Set options for Jkanne RSS and redmine dashboard widgets', 'jkanne-flexible') . '</p>';
}

function jkanne_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

// Rmove admin bar items
add_action( 'wp_before_admin_bar_render', function(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
});

// Hide admin menu pages
add_action( 'admin_menu', function(){
	remove_menu_page( 'edit-comments.php' );
    if ( ! current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'tools.php' );
        remove_submenu_page( 'themes.php', 'customize.php' );
    }
});

function acf_collapser_js() {

    $uri = get_template_directory_uri();

    if( class_exists( 'acf' ) ) {

        wp_enqueue_script(
            'acf_collapser_admin_js',
            esc_url( "{$uri}/base/js/acf_collapser_admin.js" ),
            array( 'jquery' )
        );

        wp_localize_script( 'acf_collapser_admin_js', 'acf_collapser_admin', array(
            'collapseRows' => esc_html__( 'Collapse All Rows', 'jkanne-flexible' ),
            'expandRows' => esc_html__( 'Expand All Rows', 'jkanne-flexible' ),
            'expandCollapseRows' => esc_html__( 'Expand/Collapse All Rows', 'jkanne-flexible' ),
        ) );

    }

}

add_action( 'admin_enqueue_scripts', 'acf_collapser_js', 11 );