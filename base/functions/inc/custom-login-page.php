<?php
/*
Custom Login Page
*/

function jkanne_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/base/stylesheets/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'jkanne_login_stylesheet' );

function jkanne_login_logo_url() {
    return 'http://jkanne.com';
}
add_filter( 'login_headerurl', 'jkanne_login_logo_url' );

function jkanne_login_logo_url_title() {
    return 'jkanne - Hemtj&nst; i Södertälje';
}
add_filter( 'login_headertitle', 'jkanne_login_logo_url_title' );

function jkanne_login_footer() { ?>
    <div class="login-footer">
        <a href="https://www.facebook.com/jkanneab/" target="_blank" title="<?php _e('Follow jkanne AB on facebook','jkanne-flexible'); ?>"><span class="dashicons dashicons-facebook-alt"></span></a>
        <a href="mailto:info@jkanne.com" title="<?php _e('Send mail to support JKanne AB','jkanne-flexible'); ?>"><span class="dashicons dashicons-email-alt"></span></a>
        <a href="https://codex.wordpress.org/First_Steps_With_WordPress" title="<?php _e('Getting started with WordPress!','jkanne-flexible'); ?>" target="_blank"><span class="dashicons dashicons-media-document"></span></a>
    </div>
<?php
}
add_action('login_footer', 'jkanne_login_footer');
