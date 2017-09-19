<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' 	=> 'Charters Settings',
			'menu_title'	=> 'Charters Settings',
			'menu_slug' 	=> 'charters-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false,
			'icon_url' => '',

		));

		acf_add_options_page(array(
			'page_title' 	=> 'AutoNerd Settings',
			'menu_title'	=> 'AutoNerd Settings',
			'menu_slug' 	=> 'ancms-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false,
			'icon_url' => '',
			//'post_id' => 'options',
			'autoload' => true,

		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Home Page Settings',
			'menu_title'	=> 'Home Page Settings',
			'parent_slug'	=> 'ancms-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Notes To Self',
			'menu_title'	=> 'Notes To Self',
			'parent_slug'	=> 'ancms-settings'
		));


		acf_add_options_sub_page(array(
			'page_title' 	=> 'Add Branche Details',
			'menu_title'	=> 'Branch Details',
			'parent_slug'	=> 'charters-general-settings',
		));

		//acf_add_options_sub_page(array(
		//	'page_title' 	=> 'Sub Page Settings',
		//	'menu_title'	=> 'Sub Page Settings',
		//	'parent_slug'	=> 'charters-general-settings',
		//));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Misc Settings',
			'menu_title'	=> 'Misc Settings',
			'parent_slug'	=> 'charters-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Used Car Filter',
			'menu_title'	=> 'Used Car Filter',
			'parent_slug'	=> 'charters-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Call to Actions',
			'menu_title'	=> 'Call to Actions',
			'parent_slug'	=> 'charters-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Contact Us Page',
			'menu_title'	=> 'Contact Us Page',
			'parent_slug'	=> 'charters-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> '404 Pages',
			'menu_title'	=> '404 Pages',
			'parent_slug'	=> 'charters-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Shortcodes',
			'menu_title'	=> 'Shortcodes',
			'parent_slug'	=> 'charters-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'New Car Settings',
			'menu_title'	=> 'New Car Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_new_car',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Brochure Settings',
			'menu_title'	=> 'Brochure Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_new_car',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'New Van Settings',
			'menu_title'	=> 'New Van Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_new_van',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Business Settings',
			'menu_title'	=> 'Business Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_business',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Motability Settings',
			'menu_title'	=> 'Motability Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_motability',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Aftersales Settings',
			'menu_title'	=> 'Aftersales Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_aftersale',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Offer Settings',
			'menu_title'	=> 'Offer Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_new_offer',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Finance Settings',
			'menu_title'	=> 'Finance Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_finance',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'About Us Settings',
			'menu_title'	=> 'About Us Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_about',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'News Settings',
			'menu_title'	=> 'News Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_news',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Testimonials Settings',
			'menu_title'	=> 'Testimonials Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_testimonial',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Recruitment Settings',
			'menu_title'	=> 'Recruitment Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_recruitment',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Our Team Settings',
			'menu_title'	=> 'Our Team Settings',
			'parent_slug'	=> 'edit.php?post_type=sh_team',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Used Car Settings',
			'menu_title'	=> 'Used Car Settings',
			'parent_slug'	=> 'edit.php?post_type=product',
		));

	/*	acf_add_options_page(array(
			'page_title' 	=> 'Testing New Car Settings',
			'menu_title'	=> 'Testing New Car Settings',
			'menu_slug' 	=> 'charters-new-car-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	*/
	}

// remove 'Posts' menu from admin
function remove_menus () {
global $menu;
  $restricted = array(__('Posts'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
  }
}
add_action('admin_menu', 'remove_menus');

/*

 Original Menu Array
(
    [0] => index.php
    [1] => edit.php?post_type=sh_new_car
    [2] => separator1
    [3] => edit.php?post_type=sh_new_offer
    [4] => edit.php?post_type=sh_new_van
    [5] => edit.php?post_type=sh_business
    [6] => edit.php?post_type=sh_aftersale
    [7] => upload.php
    [8] => edit.php?post_type=sh_motability
    [9] => edit.php?post_type=sh_news
    [10] => edit.php?post_type=sh_about
    [11] => edit.php?post_type=sh_finance
    [12] => edit.php?post_type=sh_testimonial
    [13] => edit.php?post_type=sh_team
    [14] => edit.php?post_type=page
    [15] => edit-comments.php
    [16] => edit.php?post_type=product
    [17] => edit.php?post_type=cookielawinfo
    [18] => edit.php?post_type=wpseo_locations
    [19] => edit.php?post_type=slide
    [20] => edit.php?post_type=portfolio
    [21] => iphorm_forms
    [22] => woothemes
    [23] => woocommerce
    [24] => separator2
    [25] => themes.php
    [26] => plugins.php
    [27] => users.php
    [28] => tools.php
    [29] => vc-general
    [30] => options-general.php
    [31] => edit.php?post_type=acf-field-group
    [32] => charters-general-settings
    [33] => separator-last
    [34] => wpseo_dashboard
    [35] => separator-woocommerce
    [36] => layerslider
    [37] => vcht-console
    [38] => pmxi-admin-home
    [39] => wp-mcm
    [40] => wp-to-buffer
    [41] => onesignal-push
)

use code to print menu array
//print_r( $menu_ord);
 */

// Rearrange the admin menu
  function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;

    $menu = array('index.php',  // Dashboard
      'charters-general-settings',
      'ancms-settings',
      'edit.php?post_type=sh_new_car',

      'edit.php?post_type=sh_new_van',
      'edit.php?post_type=product',
      //'edit.php?post_type=sh_new_van_offer',
      'edit.php?post_type=sh_business',
      //'edit.php?post_type=sh_business_offer',
      'edit.php?post_type=sh_motability',
      //'edit.php?post_type=sh_motability_offer',
      'edit.php?post_type=sh_aftersale',
      //'edit.php?post_type=sh_aftersale_offer',
      'edit.php?post_type=sh_new_offer',
      'edit.php?post_type=sh_finance',
      'edit.php?post_type=sh_about',
      'edit.php?post_type=sh_news',
      'edit.php?post_type=sh_testimonial',
      'edit.php?post_type=sh_team',
      'edit.php?post_type=sh_recruitment',
      'edit.php?post_type=page', // Pages
      'separator1', // First separator  
      'edit.php?post_type=acf-field-group',    
      'edit.php', // Posts
      'upload.php', // Media
      'link-manager.php', // Links
      //'edit-comments.php', // Comments
      'separator2', // Second separator
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
      'separator-last' // Last separator
      );
    
    //remove Values in $menu from actual menu array
    $menu_ord = array_diff($menu_ord, $menu);

    // add value in $menu back into menu at position 1 (under dashboard)
    array_splice($menu_ord, 1, 0, array($menu));

    return $menu;

  }

  add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
  add_filter('menu_order', 'custom_menu_order');





  	/*
  	Change Woocommerce menu from Products to Used Cars
  	 */
	add_action( 'admin_menu', 'ancms_rename_woocoomerce_product_menu', 999 );
	function ancms_rename_woocoomerce_product_menu() 
	{
	    global $menu;

	    // Pinpoint menu item
	    $woo = ancms_recursive_array_search_php( 'Products', $menu );

	    // Validate
	    if( !$woo )
	        return;

	    $menu[$woo][0] = 'Used Cars';
	}

	// http://www.php.net/manual/en/function.array-search.php#91365
	function ancms_recursive_array_search_php( $needle, $haystack ) 
	{
	    foreach( $haystack as $key => $value ) 
	    {
	        $current_key = $key;
	        if( 
	            $needle === $value 
	            OR ( 
	                is_array( $value )
	                && ancms_recursive_array_search_php( $needle, $value ) !== false 
	            )
	        ) 
	        {
	            return $current_key;
	        }
	    }
	    return false;
	}

	function replace_admin_menu_icons_css() {
    ?>
    <style>
        #adminmenu #menu-posts-product .menu-icon-post div.wp-menu-image:before, #adminmenu #menu-posts-product .menu-icon-product div.wp-menu-image:before {
    		font-family: dashicons !important;
    		content: "\f112";
			}
    </style>
    <?php
}

add_action( 'admin_head', 'replace_admin_menu_icons_css' );


	function disable_acf_fields() {
    ?>
    <style>
        #product_original_price_hide {
    		    pointer-events: none;
		}

		#product_original_price_hide input {
   		 background: #E8E8E8;
		}
    </style>
    <?php
}

add_action( 'admin_head', 'disable_acf_fields' );