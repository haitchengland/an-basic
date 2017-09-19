<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_motability_post_type') ) {

// Register Custom Post Type
function sh_motability_post_type() {

	$labels = array(
		'name'                => _x( 'Motability Pages', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Motability Page', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Motability Pages', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'All Motability Pages', 'text_domain' ),
		'view_item'           => __( 'View Motability Page', 'text_domain' ),
		'add_new_item'        => __( 'Add Motability Page', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Motability Page', 'text_domain' ),
		'update_item'         => __( 'Update Motability Page', 'text_domain' ),
		'search_items'        => __( 'Search Motability Page', 'text_domain' ),
		'not_found'           => __( 'Motability Page Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Motability Page Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'motability',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'sh_motability', 'text_domain' ),
		'description'         => __( 'Motability Pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => plugins_url('../images/motability-offer-wht.png', __FILE__),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'sh_motability', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sh_motability_post_type', 0 );

}


if ( ! function_exists('sh_motability_updated_messages') ) {
  
  function sh_motability_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_motability'] = array(
	  0 => '', 
	  1 => sprintf( __('Motability page updated. <a href="%s">View motability page</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Motability page updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Motability Page restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Motability page published. <a href="%s">View Motability Page</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Motability page saved.'),
	  8 => sprintf( __('Motability page submitted. <a target="_blank" href="%s">Preview Motability Page</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Motability page scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Motability Page</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Motability page draft updated. <a target="_blank" href="%s">Preview Motability Page</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_motability_updated_messages' );

}

  //CONTEXTUAL HELP
  function sh_motability_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_motability' == $screen->id ) {
	  $contextual_help = '<h2>Motability Pages</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Motability Pages</h2>
	  <p>This page allows you to view/modify the motability pages. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_motability_contextual_help', 10, 3 );


//}

?>