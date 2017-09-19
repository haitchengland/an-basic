<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_recruitment_post_type') ) 
{

  // Register Car Offer Post Type
  function sh_recruitment_post_type() {
  
	  $labels = array(
		  'name'                => _x( 'Recruitment', 'Post Type General Name', 'text_domain' ),
		  'singular_name'       => _x( 'Recruitment', 'Post Type Singular Name', 'text_domain' ),
		  'menu_name'           => __( 'Recruitment', 'text_domain' ),
		  'parent_item_colon'   => __( '', 'text_domain' ),
		  'all_items'           => __( 'All Recruitment', 'text_domain' ),
		  'view_item'           => __( 'View Recruitment', 'text_domain' ),
		  'add_new_item'        => __( 'Add Recruitment', 'text_domain' ),
		  'add_new'             => __( 'Add New', 'text_domain' ),
		  'edit_item'           => __( 'Edit Recruitment', 'text_domain' ),
		  'update_item'         => __( 'Update Recruitment', 'text_domain' ),
		  'search_items'        => __( 'Search Recruitment', 'text_domain' ),
		  'not_found'           => __( 'Recruitment Not found', 'text_domain' ),
		  'not_found_in_trash'  => __( 'Recruitment Not found in Trash', 'text_domain' ),
	  );
	/* Used for custom slug (see commented line in $args) */
	$rewrite = array(
	    'slug'                => 'recruitment',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	  	'with_front'		  => false,
	);
	  $args = array(
		  'label'               => __( 'sh_recruitment', 'text_domain' ),
		  'description'         => __( 'Recruitment', 'text_domain' ),
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
		  'menu_icon'           => plugins_url('../images/recruitment-wht.png', __FILE__),
		  'can_export'          => true,
		  'has_archive'         => true,
		  'exclude_from_search' => true,
		  'publicly_queryable'  => true,
		  'rewrite'             => $rewrite,
		  'capability_type'     => 'post',
	  );
	  register_post_type( 'sh_recruitment', $args );
  
  }

  // Hook into the 'init' action
  add_action( 'init', 'sh_recruitment_post_type', 0 );

}


//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_recruitment_updated_messages') ) {
  
  function sh_recruitment_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_recruitment'] = array(
	  0 => '', 
	  1 => sprintf( __('Recruitment updated. <a href="%s">View News Article</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Recruitment updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Recruitment restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Recruitment published. <a href="%s">View Recruitment</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Recruitment saved.'),
	  8 => sprintf( __('Recruitment submitted. <a target="_blank" href="%s">Preview Recruitment</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Recruitment scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Recruitment</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Recruitment draft updated. <a target="_blank" href="%s">Preview Recruitment</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_recruitment_updated_messages' );

}


//if ( ! function_exist('sh_car_offer_contextual_help') ) {

  //CONTEXTUAL HELP
  function sh_recruitment_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_recruitment' == $screen->id ) {
	  $contextual_help = '<h2>Recruitment</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Recruitment</h2>
	  <p>This page allows you to view/modify the Recruitment details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_recruitment_contextual_help', 10, 3 );


//}



?>