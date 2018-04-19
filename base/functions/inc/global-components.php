<?php add_action( 'init', 'global_components' );
function global_components() {
  register_post_type( 'global_components',
    array(
      'labels' => array(
        'name' => __( 'Globals', 'jkanne-flexible' ),
        'singular_name' => __( 'Global component', 'jkanne-flexible' )
      ),
      'public' => true,
      'has_archive' => false,
      'publicly_queryable'  => false,
      'rewrite' => array('slug' => __('global-component', 'jkanne-flexible')),
      'exclude_from_search' => true,
      'menu_icon' => 'dashicons-schedule',
      'supports' => array( 'title', 'editor', 'thumbnail')
    )
  );
}
