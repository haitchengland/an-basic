<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_new_van_post_type') ) {

// Register Custom Post Type
function sh_new_van_post_type() {

	$labels = array(
		'name'                => _x( 'New Vans', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'New Van', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'New Vans', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'All New Vans', 'text_domain' ),
		'view_item'           => __( 'View New Van', 'text_domain' ),
		'add_new_item'        => __( 'Add New Van', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit New Van', 'text_domain' ),
		'update_item'         => __( 'Update New Van', 'text_domain' ),
		'search_items'        => __( 'Search New Van', 'text_domain' ),
		'not_found'           => __( 'New Van Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'New Van Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'new-vans',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'sh_new_van', 'text_domain' ),
		'description'         => __( 'New Vans', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 3,
		'menu_icon'           => plugins_url('../images/van-offer-wht.png', __FILE__),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'sh_new_van', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sh_new_van_post_type', 0 );

}


do_action( 'add_debug_info', 'Update new van messages'.__FILE__, 'ToDo:' );
//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_new_van_updated_messages') ) {
  
  function sh_new_van_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_new_van_offer'] = array(
	  0 => '', 
	  1 => sprintf( __('New Van updated. <a href="%s">View New Van</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Offer updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('New Van restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('New Van published. <a href="%s">View offer</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('New Van saved.'),
	  8 => sprintf( __('New Van submitted. <a target="_blank" href="%s">Preview New Van</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('New Van scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview New Van</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('New Van draft updated. <a target="_blank" href="%s">Preview New Van</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_new_van_updated_messages' );

}


  //CONTEXTUAL HELP
  function sh_new_van_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_new_van' == $screen->id ) {
	  $contextual_help = '<h2>New Vans</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing New Vans</h2>
	  <p>This page allows you to view/modify the New Van details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_new_van_contextual_help', 10, 3 );



?>