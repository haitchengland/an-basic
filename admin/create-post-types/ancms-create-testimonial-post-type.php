<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_testimonial_post_type') ) 
{

  // Register Car Offer Post Type
  function sh_testimonial_post_type() {
  
	  $labels = array(
		  'name'                => _x( 'Testimonial', 'Post Type General Name', 'text_domain' ),
		  'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
		  'menu_name'           => __( 'Testimonials', 'text_domain' ),
		  'parent_item_colon'   => __( '', 'text_domain' ),
		  'all_items'           => __( 'All Testimonials', 'text_domain' ),
		  'view_item'           => __( 'View Testimonial', 'text_domain' ),
		  'add_new_item'        => __( 'Add Testimonial', 'text_domain' ),
		  'add_new'             => __( 'Add New', 'text_domain' ),
		  'edit_item'           => __( 'Edit Testimonial', 'text_domain' ),
		  'update_item'         => __( 'Update Testimonial', 'text_domain' ),
		  'search_items'        => __( 'Search Testimonial', 'text_domain' ),
		  'not_found'           => __( 'Testimonial Not found', 'text_domain' ),
		  'not_found_in_trash'  => __( 'Testimonial Not found in Trash', 'text_domain' ),
	  );
	/* Used for custom slug (see commented line in $args) */
	$rewrite = array(
	    'slug'                => 'testimonials',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	  	'with_front'		  => false,
	);
	  $args = array(
		  'label'               => __( 'sh_testimonial', 'text_domain' ),
		  'description'         => __( 'Testimonials', 'text_domain' ),
		  'labels'              => $labels,
		  'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		// 'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'post-formats', ),
		  'taxonomies'          => array( 'post_tag' ),
		//  'taxonomies'          => array( 'category', 'post_tag' ),
		  'hierarchical'        => false,
		  'public'              => true,
		  'show_ui'             => true,
		  'show_in_menu'        => true,
		  'show_in_nav_menus'   => true,
		  'show_in_admin_bar'   => true,
		  'menu_position'       => 9,
		  'menu_icon'           => plugins_url('../images/testimonial-wht.png', __FILE__),
		  'can_export'          => true,
		  'has_archive'         => true,
		  'exclude_from_search' => true,
		  'publicly_queryable'  => true,
		  'rewrite'             => $rewrite,
		  'capability_type'     => 'post',
	  );
	  register_post_type( 'sh_testimonial', $args );
  
  }

  // Hook into the 'init' action
  add_action( 'init', 'sh_testimonial_post_type', 0 );

}


//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_testimonial_updated_messages') ) {
  
  function sh_testimonial_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_testimonial'] = array(
	  0 => '', 
	  1 => sprintf( __('Testimonial updated. <a href="%s">View News Article</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Testimonial updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Testimonial published. <a href="%s">View Testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Testimonial saved.'),
	  8 => sprintf( __('Testimonial submitted. <a target="_blank" href="%s">Preview Testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Testimonial</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Testimonial draft updated. <a target="_blank" href="%s">Preview Testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_testimonial_updated_messages' );

}


//if ( ! function_exist('sh_car_offer_contextual_help') ) {

  //CONTEXTUAL HELP
  function sh_testimonial_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_testimonial' == $screen->id ) {
	  $contextual_help = '<h2>Testimonials</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Testimonial</h2>
	  <p>This page allows you to view/modify the Testimonials details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_testimonial_contextual_help', 10, 3 );


//}



?>