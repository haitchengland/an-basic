<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_team_post_type') ) 
{

  // Register Car Offer Post Type
  function sh_team_post_type() {
  
	  $labels = array(
		  'name'                => _x( 'Our Team', 'Post Type General Name', 'text_domain' ),
		  'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'text_domain' ),
		  'menu_name'           => __( 'Our Team', 'text_domain' ),
		  'parent_item_colon'   => __( '', 'text_domain' ),
		  'all_items'           => __( 'All Team Members', 'text_domain' ),
		  'view_item'           => __( 'View Team Member', 'text_domain' ),
		  'add_new_item'        => __( 'Add Team Member', 'text_domain' ),
		  'add_new'             => __( 'Add New', 'text_domain' ),
		  'edit_item'           => __( 'Edit Team Member', 'text_domain' ),
		  'update_item'         => __( 'Update Team Member', 'text_domain' ),
		  'search_items'        => __( 'Search Team Member', 'text_domain' ),
		  'not_found'           => __( 'Team Member Not found', 'text_domain' ),
		  'not_found_in_trash'  => __( 'Team Member Not found in Trash', 'text_domain' ),
	  );
	/* Used for custom slug (see commented line in $args) */
	$rewrite = array(
	    'slug'                => 'our-team',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	  	'with_front'		  => false,
	);
	  $args = array(
		  'label'               => __( 'sh_team', 'text_domain' ),
		  'description'         => __( 'Team Members', 'text_domain' ),
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
		  'menu_position'       => 9,
		  'menu_icon'           => 'dashicons-admin-users',
		  'can_export'          => true,
		  'has_archive'         => true,
		  'exclude_from_search' => true,
		  'publicly_queryable'  => true,
		  'rewrite'             => $rewrite,
		  'capability_type'     => 'post',
	  );
	  register_post_type( 'sh_team', $args );
  
  }

  // Hook into the 'init' action
  add_action( 'init', 'sh_team_post_type', 0 );

}


//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_team_updated_messages') ) {
  
  function sh_team_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_team'] = array(
	  0 => '', 
	  1 => sprintf( __('Team Member updated. <a href="%s">View News Article</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Team Member updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Team Member restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Team Member published. <a href="%s">View Team Member</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Team Member saved.'),
	  8 => sprintf( __('Team Member submitted. <a target="_blank" href="%s">Preview Team Member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Team Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team Member</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Team Member draft updated. <a target="_blank" href="%s">Preview Team Member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_team_updated_messages' );

}


//if ( ! function_exist('sh_car_offer_contextual_help') ) {

  //CONTEXTUAL HELP
  function sh_team_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_team' == $screen->id ) {
	  $contextual_help = '<h2>Our Team</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Team Member</h2>
	  <p>This page allows you to view/modify the Team Members details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_team_contextual_help', 10, 3 );


//}



?>