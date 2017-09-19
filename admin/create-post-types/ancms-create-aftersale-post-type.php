<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_aftersale_post_type') ) {

// Register Custom Post Type
function sh_aftersale_post_type() {

	$labels = array(
		'name'                => _x( 'Aftersales', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Aftersale', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Aftersales', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'All Aftersales', 'text_domain' ),
		'view_item'           => __( 'View Aftersale', 'text_domain' ),
		'add_new_item'        => __( 'Add Aftersale', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Aftersale', 'text_domain' ),
		'update_item'         => __( 'Update Aftersale', 'text_domain' ),
		'search_items'        => __( 'Search Aftersale', 'text_domain' ),
		'not_found'           => __( 'Aftersale Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Aftersale Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'aftersales',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'sh_aftersale', 'text_domain' ),
		'description'         => __( 'Aftersales', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => plugins_url('../images/aftersale-offer-wht.png', __FILE__),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'sh_aftersale', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sh_aftersale_post_type', 0 );

}


if ( ! function_exists('sh_aftersale_updated_messages') ) {
  
  function sh_aftersale_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_aftersale'] = array(
	  0 => '', 
	  1 => sprintf( __('Aftersale updated. <a href="%s">View Aftersale</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Offer updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Aftersale restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Aftersale published. <a href="%s">View Aftersale</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Aftersale saved.'),
	  8 => sprintf( __('Aftersale submitted. <a target="_blank" href="%s">Preview aftersale</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Aftersale scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview aftersale</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Aftersale draft updated. <a target="_blank" href="%s">Preview aftersale</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_aftersale_updated_messages' );

}

  //CONTEXTUAL HELP
  function sh_aftersale_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_aftersale' == $screen->id ) {
	  $contextual_help = '<h2>Aftersales</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Aftersale</h2>
	  <p>This page allows you to view/modify the aftersale details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_aftersale_contextual_help', 10, 3 );


//}

?>