<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists('sh_new_car_post_type') ) {

// Register Custom Post Type
function sh_new_car_post_type() {

	$labels = array(
		'name'                => _x( 'New Cars', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'New Car', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'New Cars', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'All New Cars', 'text_domain' ),
		'view_item'           => __( 'View New Car', 'text_domain' ),
		'add_new_item'        => __( 'Add New Car', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit New Car', 'text_domain' ),
		'update_item'         => __( 'Update New Car', 'text_domain' ),
		'search_items'        => __( 'Search New Car', 'text_domain' ),
		'not_found'           => __( 'New Car Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'New Car Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'new-cars',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'sh_new_car', 'text_domain' ),
		'description'         => __( 'New Cars', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 2,
		'menu_icon'           => plugins_url('../images/car-offer-wht.png', __FILE__),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'sh_new_car', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sh_new_car_post_type', 0 );

}

//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_new_car_updated_messages') ) {
  
  function sh_new_car_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_new_car'] = array(
	  0 => '', 
	  1 => sprintf( __('New Car updated. <a href="%s">View New Car</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Offer updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('New Car restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('New Car published. <a href="%s">View offer</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('New Car saved.'),
	  8 => sprintf( __('New Car submitted. <a target="_blank" href="%s">Preview New Car</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('New Car scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview New Car</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('New Car draft updated. <a target="_blank" href="%s">Preview New Car</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_new_car_updated_messages' );

}


do_action( 'add_debug_info', 'Update new car help'.__FILE__, 'ToDo:' );
//if ( ! function_exist('sh_car_offer_contextual_help') ) {

  //CONTEXTUAL HELP
  function sh_new_car_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_new_car' == $screen->id ) {
	  $contextual_help = '<h2>New Cars</h2>
	  <p></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing New Cars</h2>
	  <p>This page allows you to view/modify the New Car details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_new_car_contextual_help', 10, 3 );


//}

?>