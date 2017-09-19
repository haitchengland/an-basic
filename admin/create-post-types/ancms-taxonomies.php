<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Custom Taxonomies

function sh_taxonomies_makes_models() {
  $labels = array(
    'name'              => _x( 'Vehicle Makes and Models', 'taxonomy general name' ),
    'singular_name'     => _x( 'Vehicle Make and Model', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Vehicle Makes and Models' ),
    'all_items'         => __( 'All Vehicle Makes and Models' ),
    'parent_item'       => __( 'Parent Make' ),
    'parent_item_colon' => __( 'Parent Make:' ),
    'edit_item'         => __( 'Edit Vehicle Make and Model' ), 
    'update_item'       => __( 'Update Vehicle Make and Model' ),
    'add_new_item'      => __( 'Add New Vehicle Make and Model' ),
    'new_item_name'     => __( 'New Vehicle Make and Model' ),
    'menu_name'         => __( 'Vehicle Makes and Models' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
	'show_ui' => true,
	'show_admin_column' => true,
	'sort' => true,
  );
  
  // Register to several custom post types (last entrie is where the taxonimy can be edited) 
    register_taxonomy( 'vehical_makes_and_models', array('page','product','sh_new_car','sh_new_offer','sh_new_van','sh_business','sh_motability','sh_aftersale','sh_news','sh_finance','sh_testimonial','sh_about'), $args );
  //  register_taxonomy( 'vehical_models', 'sh_new_car', $args );
  // register_taxonomy( 'product_category', 'product', $args );
}

add_action( 'init', 'sh_taxonomies_makes_models', 0 );


function sh_taxonomies_trim() {
  $labels = array(
    'name'              => _x( 'Vehicle Trims', 'taxonomy general name' ),
    'singular_name'     => _x( 'Vehicle Trim', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Vehicle Trims' ),
    'all_items'         => __( 'All Vehicle Trims' ),
    'parent_item'       => __( 'Parent Model' ),
    'parent_item_colon' => __( 'Parent Model:' ),
    'edit_item'         => __( 'Edit Vehicle Trim' ), 
    'update_item'       => __( 'Update Vehicle Trim' ),
    'add_new_item'      => __( 'Add New Vehicle Trim' ),
    'new_item_name'     => __( 'New Vehicle Trim' ),
    'menu_name'         => __( 'Vehicle Trim' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'has_archive'  => false,
  'show_ui' => true,
  'show_admin_column' => true,
  'sort' => true,
  );
  
  // Register to several custom post types (last entrie is where the taxonimy can be edited) 
    register_taxonomy( 'vehicle-trims', array('sh_new_offer'), $args );
  //  register_taxonomy( 'vehical_models', 'sh_new_car', $args );
  // register_taxonomy( 'product_category', 'product', $args );
}

add_action( 'init', 'sh_taxonomies_trim', 0 );


function sh_taxonomies_offer_categories() {
  $labels = array(
    'name'              => _x( 'Offer Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Offer Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Offer Categories' ),
    'all_items'         => __( 'All Offer Categories' ),
    'parent_item'       => __( 'Parent Offer Category' ),
    'parent_item_colon' => __( 'Parent Offer Category:' ),
    'edit_item'         => __( 'Edit Offer Category' ),
    'update_item'       => __( 'Update Offer Category' ),
    'add_new_item'      => __( 'Add New Offer Category' ),
    'new_item_name'     => __( 'New Offer Category' ),
    'menu_name'         => __( 'Offer Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'has_archive'         => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'sort' => true,
    'rewrite' =>  array(
     'slug' => 'offers',
     'with_front' => true
    )
  );
  
  // Register to several custom post types (last entrie is where the taxonimy can be edited) 
    register_taxonomy( 'new_offer_categories', array('sh_new_offer'), $args );
  //  register_taxonomy( 'vehical_models', 'sh_new_car', $args );
  // register_taxonomy( 'product_category', 'product', $args );
 
}

add_action( 'init', 'sh_taxonomies_offer_categories', 0 );

/*
 * Replace Taxonomy slug with Post Type slug in url
 * Version: 1.1
 */
function generate_taxonomy_rewrite_rules( $wp_rewrite ) {
  $rules = array();
  $post_types = get_post_types( array( 'name' => 'sh_new_offer', 'public' => true, '_builtin' => false ), 'objects' );
  $taxonomies = get_taxonomies( array( 'name' => 'new_offer_Categories', 'public' => true, '_builtin' => false ), 'objects' );

  foreach ( $post_types as $post_type ) {
    $post_type_name = $post_type->name; // 'sh_new_offer'
    $post_type_slug = $post_type->rewrite['slug']; // 'offers'

    foreach ( $taxonomies as $taxonomy ) {
      if ( $taxonomy->object_type[0] == $post_type_name ) {
        $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
        foreach ( $terms as $term ) {
          $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
        }
      }
    }
  }
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');


function sh_taxonomies_offer_types() {
  $labels = array(
    'name'              => _x( 'Offer Types', 'taxonomy general name' ),
    'singular_name'     => _x( 'Offer Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Offer Types' ),
    'all_items'         => __( 'All Offer Types' ),
    'parent_item'       => __( 'Parent Offer Type' ),
    'parent_item_colon' => __( 'Parent Offer Type:' ),
    'edit_item'         => __( 'Edit Offer Type' ),
    'update_item'       => __( 'Update Offer Type' ),
    'add_new_item'      => __( 'Add New Offer Type' ),
    'new_item_name'     => __( 'New Offer Type' ),
    'menu_name'         => __( 'Offer Types' ),
    );
    
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'has_archive'  => false,
  'show_ui' => true,
  'show_admin_column' => true,
  'sort' => true,
  );
  
  // Register to several custom post types (last entrie is where the taxonimy can be edited) 
    register_taxonomy( 'new_offer_types', array('sh_new_offer'), $args );
  //  register_taxonomy( 'vehical_models', 'sh_new_car', $args );
  // register_taxonomy( 'product_category', 'product', $args );
 
}

add_action( 'init', 'sh_taxonomies_offer_types', 0 );



?>