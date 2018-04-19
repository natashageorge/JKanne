<?php

// Get terms extension
function get_terms_dropdown($taxonomies, $args,$name,$val){
    $myterms = get_terms($taxonomies, $args);
    $output ="<select name=\"" . $name . "\">";
    foreach($myterms as $term){
        $term_slug=$term->slug;
        $term_name =$term->name;
        $output .="<option " . ($val == $term->slug ? "selected":"") . " value='".$term->slug."'>".$term_name."</option>";
    }
    $output .="</select>";
    return $output;
}

// Get terms filter. Works great for creating filters on an archive page
function get_terms_filter($taxonomy, $args,$class,$url = ""){
    $myterms = get_terms($taxonomy, $args);
    $output ="<ul class=\""  . $class . "\">";
    $output .="<li><a href=\"?\">" . __("Alla","kavermellin") . "</a></li>";    
    foreach($myterms as $term){
        $term_slug=$term->slug;
        $term_name =$term->name;
        $output .="<li><a href=\"" . (!empty($url) ? $url . "?" : "?") . http_build_query(array_merge($_GET,array($taxonomy => $term->slug))) . "\">" .$term_name."</a></li>";
    }
    $output .="</ul>";
    return $output;
}


// Setting excerpt length
function custom_excerpt_length ( $length ) {
    global $post;
    if ($post->post_type == 'post') {
        return 20;
    }
    else {
        return 55;
    }
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function acf_load_post_type_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();

    $args = array(
       'name' => 'property'
    );

    $post_types = get_post_types( array(), 'objects' );

    $choices = array();

    foreach ( $post_types  as $post_type ) {
        $choices[] = $post_type->name;
    }


    
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice ] = $choice;
            
        }
        
    }
    

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=post_type', 'acf_load_post_type_field_choices');