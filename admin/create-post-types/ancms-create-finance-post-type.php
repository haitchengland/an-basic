<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_finance_post_type') ) 
{

  // Register Car Offer Post Type
  function sh_finance_post_type() {
  
	  $labels = array(
		  'name'                => _x( 'Finance Articles', 'Post Type General Name', 'text_domain' ),
		  'singular_name'       => _x( 'Finance Article', 'Post Type Singular Name', 'text_domain' ),
		  'menu_name'           => __( 'Finance Articles', 'text_domain' ),
		  'parent_item_colon'   => __( '', 'text_domain' ),
		  'all_items'           => __( 'All Finance Articles', 'text_domain' ),
		  'view_item'           => __( 'View Finance Article', 'text_domain' ),
		  'add_new_item'        => __( 'Add Finance Article', 'text_domain' ),
		  'add_new'             => __( 'Add New', 'text_domain' ),
		  'edit_item'           => __( 'Edit Finance Article', 'text_domain' ),
		  'update_item'         => __( 'Update Finance Article', 'text_domain' ),
		  'search_items'        => __( 'Search Finance Article', 'text_domain' ),
		  'not_found'           => __( 'Finance Article Not found', 'text_domain' ),
		  'not_found_in_trash'  => __( 'Finance Article Not found in Trash', 'text_domain' ),
	  );
	/* Used for custom slug (see commented line in $args) */
	$rewrite = array(
	    'slug'                => 'finance',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	  	'with_front'		  => false,
	);
	  $args = array(
		  'label'               => __( 'sh_finance', 'text_domain' ),
		  'description'         => __( 'Finance Article', 'text_domain' ),
		  'labels'              => $labels,
		  'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions','page-attributes', 'post-formats' ),
		// 'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'post-formats', ),
		  'taxonomies'          => array( 'post_tag' ),
		//  'taxonomies'          => array( 'category', 'post_tag' ),
		  'hierarchical'        => true,
		  'public'              => true,
		  'show_ui'             => true,
		  'show_in_menu'        => true,
		  'show_in_nav_menus'   => true,
		  'show_in_admin_bar'   => true,
		  'menu_position'       => 8,
		 // 'menu_icon'           => plugins_url('/images/car-offer-wht.png', __FILE__),
		  'can_export'          => true,
		  'has_archive'         => true,
		  'exclude_from_search' => false,
		  'publicly_queryable'  => true,
		  'rewrite'             => $rewrite,
		  'capability_type'     => 'post',
	  );
	  register_post_type( 'sh_finance', $args );
  
  }

  // Hook into the 'init' action
  add_action( 'init', 'sh_finance_post_type', 0 );

}


//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_finance_updated_messages') ) {
  
  function sh_finance_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_finance'] = array(
	  0 => '', 
	  1 => sprintf( __('Finance Article updated. <a href="%s">View Finance Article</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Finance Article updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Finance Article restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Finance Article published. <a href="%s">View Finance Article</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Finance Article saved.'),
	  8 => sprintf( __('Finance Article submitted. <a target="_blank" href="%s">Preview Finance Article</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Finance Article scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Finance Article</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Finance Article draft updated. <a target="_blank" href="%s">Preview Finance Article</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_finance_updated_messages' );

}


//if ( ! function_exist('sh_car_offer_contextual_help') ) {

  //CONTEXTUAL HELP
  function sh_finance_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_finance' == $screen->id ) {
	  $contextual_help = '<h2>Finance Article</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Finance Article</h2>
	  <p>This page allows you to view/modify the Finance Articles details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_finance_contextual_help', 10, 3 );


//}



?>