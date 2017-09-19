<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//permalink problem posible fix http://wordpress.stackexchange.com/questions/65770/multiple-parameters-in-a-custom-post-type-url-rewrite/65773#65773

if ( ! function_exists('sh_new_offers_post_type') ) 
{

  // Register Car Offer Post Type
  function sh_new_offers_post_type() {
  
	  $labels = array(
		  'name'                => _x( 'New Offers', 'Post Type General Name', 'text_domain' ),
		  'singular_name'       => _x( 'New Offer', 'Post Type Singular Name', 'text_domain' ),
		  'menu_name'           => __( 'New Offers', 'text_domain' ),
		  'parent_item_colon'   => __( '', 'text_domain' ),
		  'all_items'           => __( 'New Offers', 'text_domain' ),
		  'view_item'           => __( 'View New Offers', 'text_domain' ),
		  'add_new_item'        => __( 'Add New Offer', 'text_domain' ),
		  'add_new'             => __( 'Add New', 'text_domain' ),
		  'edit_item'           => __( 'Edit New Offer', 'text_domain' ),
		  'update_item'         => __( 'Update New Offer', 'text_domain' ),
		  'search_items'        => __( 'Search New Offer', 'text_domain' ),
		  'not_found'           => __( 'Offer Not found', 'text_domain' ),
		  'not_found_in_trash'  => __( 'Offer Not found in Trash', 'text_domain' ),
	  );
	/* Used for custom slug (see commented line in $args) */
	$rewrite = array(
	    //'slug'                => 'vehicle-offers',
	    'slug'                => 'offers',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	  	//'with_front'		  => false,
	);
	  $args = array(
		  'label'               => __( 'sh_new_offer', 'text_domain' ),
		  'description'         => __( 'New Offers', 'text_domain' ),
		  'labels'              => $labels,
		  'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		// 'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'post-formats', ),
		//  'taxonomies'          => array( 'category', 'post_tag' ),
		  'hierarchical'        => false,
		  'public'              => true,
		  'show_ui'             => true,
		 // 'show_in_menu'        => 'edit.php?post_type=sh_new_car',
		  'show_in_menu'        => true,
		  'show_in_nav_menus'   => true,
		  'show_in_admin_bar'   => true,
		  'menu_position'       => 2,
		  'menu_icon'           => plugins_url('../images/offer-wht.png', __FILE__),
		  'can_export'          => true,
		  'has_archive'         => true,
		  'exclude_from_search' => false,
		  'publicly_queryable'  => true,
		  'rewrite'             => $rewrite,
		  'capability_type'     => 'post',
	  );
	  register_post_type( 'sh_new_offer', $args );
  	//flush_rewrite_rules( false );
  }

  // Hook into the 'init' action
  add_action( 'init', 'sh_new_offers_post_type', 0 );

}


//CUSTOM INTERACTION MESSAGES
if ( ! function_exists('sh_new_offer_updated_messages') ) {
  
  function sh_new_offer_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['sh_new_offer'] = array(
	  0 => '', 
	  1 => sprintf( __('Offer updated. <a href="%s">View Car Offer</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Car Offer updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Car offer restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Car offer published. <a href="%s">View offer</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Car offer Saved.'),
	  8 => sprintf( __('Car offer submitted. <a target="_blank" href="%s">Preview car offer</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Car offer scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview car offer</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Car offer draft updated. <a target="_blank" href="%s">Preview car offer</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'sh_new_offer_updated_messages' );

}


//if ( ! function_exist('sh_offer_contextual_help') ) {

  //CONTEXTUAL HELP
  function sh_offer_contextual_help( $contextual_help, $screen_id, $screen ) { 

	if ( 'sh_new_offer' == $screen->id ) {
	  $contextual_help = '<h2>New Car Offers</h2>
	  <p>New Car Offers will list all current offers on any new cars. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
	  <p>You can view/edit the details of each car offer by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple offers.</p>
	  <p>Use pre-defined import to easily upload all you current offers <a href="http://www.charterstest.com/dev-citroen/wp-admin/admin.php?page=pmxi-admin-manage">here</a></p>';
	} elseif ( 'edit-product' == $screen->id ) {
	  $contextual_help = '<h2>Editing Car Offers</h2>
	  <p>This page allows you to view/modify the offer details. Please make sure to fill out the available boxes with the appropriate details.</p>';
	}
	return $contextual_help;

  }
  
  add_action( 'contextual_help', 'sh_offer_contextual_help', 10, 3 );


//}



?>