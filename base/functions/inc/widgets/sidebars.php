<?php
function sidebar_initialize(){
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'jkanne-flexible' ),
        'id'            => 'sidebar',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}

add_action( 'widgets_init', 'sidebar_initialize' );
