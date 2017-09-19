<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_business_post_type') ) {

// Register Custom Post Type
function sh_business_post_type() {

	$labels = array(
		'name'                => _x( 'Business Pages', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Business Page', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Business Pages', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'All Business Pages', 'text_domain' ),
		'view_item'           => __( 'View Business Page', 'text_domain' ),
		'add_new_item'        => __( 'Add Business Page', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Business Page', 'text_domain' ),
		'update_item'         => __( 'Update Business Page', 'text_domain' ),
		'search_items'        => __( 'Search Business Page', 'text_domain' ),
		'not_found'           => __( 'Business Page Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Business Page Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'business',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'sh_business', 'text_domain' ),
		'description'         => __( 'Business Pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 4,
		'menu_icon'           => plugins_url('../images/business-offer-wht.png', __FILE__),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'sh_business', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sh_business_post_type', 0 );

}


if ( ! function_exists('sh_business_updated_messages') ) {
  
  function sh_business_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_business'] = array(
	  0 => '', 
	  1 => sprintf( __('Business page updated. <a href="%s">View Business Page</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Business page updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Business Page restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Business page published. <a href="%s">View Business Page</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Business page saved.'),
	  8 => sprintf( __('Business page submitted. <a target="_blank" href="%s">Preview Business Page</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Business page scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Business Page</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Business page draft updated. <a target="_blank" href="%s">Preview Business Page</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_business_updated_messages' );

}

  //CONTEXTUAL HELP
  function sh_business_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_business' == $screen->id ) {
	  $contextual_help = '<h2>Business Pages</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Business Pages</h2>
	  <p>This page allows you to view/modify the business pages. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_business_contextual_help', 10, 3 );


//}

?>