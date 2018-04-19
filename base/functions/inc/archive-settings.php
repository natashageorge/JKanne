<?php
function get_archive_page_object(){
  if(is_archive()):

    // Get The Archive parameters
    $args = array (
      'post_type'              => array( 'archive_settings' ),
      'meta_query'             => array(
        array(
          'key'       => 'posttyparkiv',
          'value' => sprintf(':"%s";', get_post_type()),
                'compare' => 'LIKE'
        ),
      ),
    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
        // do something

        return $query->post;
      }
    }

    // Restore original Post Data
    wp_reset_postdata();
  endif;

  return false;
}

add_action( 'init', 'create_archive_settings',20,0 );
function create_archive_settings() {
  register_post_type( 'archive_settings',
    array(
      'labels' => array(
        'name' => __( 'Archive Settings','jkanne-flexible' ),
        'singular_name' => __( 'Archive Setting','jkanne-flexible' )
      ),
      'public' => true,
      'has_archive' => false,
      'publicly_queryable'  => false,
      'supports'    => array('title','editor')
    )
  );

  register_taxonomy( 'archive_category_setting', array( 'archive_settings' ),array('label' => __( 'Archive category','jkanne-flexible' ),'hierarchical'      => true) );

  if( function_exists('acf_add_local_field_group') ):

    $choices = array();

    foreach ( get_post_types( '','objects' ) as $post_type ) {
      if($post_type->has_archive)
      {
        $choices[$post_type->name] = $post_type->label;
      }
    }

  acf_add_local_field_group(array (
    'key' => 'group_57fe25a4bdb18',
    'title' => 'Arkivinställningar',
    'fields' => array (
      array (
        'key' => 'field_57fe25b16d961',
        'label' => 'Posttyparkiv',
        'name' => 'posttyparkiv',
        'type' => 'checkbox',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => $choices,
        'default_value' => array (
        ),
        'layout' => 'vertical',
        'toggle' => 0,
        'return_format' => 'value',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'archive_settings',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));

  endif;

}

function custom_adminbar_menu( $meta = TRUE ) {
    global $wp_admin_bar;
    $archive_object = get_archive_page_object();
    if($archive_object):

      $wp_admin_bar->add_menu( array(
                      'id' => "edit-archive-link",
                      'title' => __("Edit Archive","jkanne-flexible"),
                      'href' => admin_url() . "post.php?post=" . $archive_object->ID . "&action=edit" ));
    
    endif;
}
add_action( 'admin_bar_menu', 'custom_adminbar_menu', 999 );