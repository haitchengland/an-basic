<?php
/**
 * CONF Plugin Name.
 *
 * @package   ANCMS
 * @author    Helen England <haitch.england@gmail.com>
 * @copyright 2016 Helen England
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 *
 * @wordpress-plugin
 * Plugin Name: AutoNerd Basic.
 * Plugin URI: http://www.screechinghalt.com
 * Description: Autonerd Base setup configuration, including custome post types, custom taxonomies and global ACF settings
 * Version: 1.0.0
 * Author: Helen England
 * Author URI: http://www.screechinghalt.com
 * License: GPL-2.0+
 * License URI: http://www.gun.org/Licenses/gpl-2.0.txt
 * Copyright: 2016 Helen England
 */

if ( ! defined( 'WPINC' ) ) { die; }

include_once( 'ancms-settings.php' );
include_once( 'templates/theme-settings.php' );
include_once( get_stylesheet_directory() . '/ancms/ancms-settings.php' );
include_once( 'includes/helper-functions.php' );

include_once( 'includes/class-test.php' );

if ( ANCMS_CPT_NEW_CAR ) { include_once( 'admin/create-post-types/ancms-create-new-car-post-type.php' ); }
if ( ANCMS_CPT_NEW_VAN ) { include_once( 'admin/create-post-types/ancms-create-van-post-type.php' ); }
if ( ANCMS_CPT_OFFER ) { include_once( 'admin/create-post-types/ancms-create-offer-post-type.php' ); }
if ( ANCMS_CPT_BUSINESS ) { include_once( 'admin/create-post-types/ancms-create-business-post-type.php' ); }
if ( ANCMS_CPT_AFTERSALES ) { include_once( 'admin/create-post-types/ancms-create-aftersale-post-type.php' ); }
if ( ANCMS_CPT_MOBABILITY ) { include_once( 'admin/create-post-types/ancms-create-motability-post-type.php' ); }
if ( ANCMS_CPT_NEWS ) { include_once( 'admin/create-post-types/ancms-create-news-post-type.php' ); }
if ( ANCMS_CPT_ABOUT ) { include_once( 'admin/create-post-types/ancms-create-about-us-post-type.php' ); }
if ( ANCMS_CPT_FINANCE ) { include_once( 'admin/create-post-types/ancms-create-finance-post-type.php' ); }
if ( ANCMS_CPT_TESTIMONIALS ) { include_once( 'admin/create-post-types/ancms-create-testimonial-post-type.php' ); }
if ( ANCMS_CPT_TEAM ) { include_once( 'admin/create-post-types/ancms-create-team-post-type.php' ); }
if ( ANCMS_CPT_RECRUITMENT ) { include_once( 'admin/create-post-types/ancms-create-recruitment-post-type.php' ); }

include_once( 'admin/create-post-types/ancms-taxonomies.php' );

if ( is_admin() ) {
	include_once( 'admin/menu/ancms-menu.php' );	
	include_once( 'plugins/imports/shcms-wp-import-scripts.php' );
	//include_once( 'plugins/offer-filter/function_offer_filter.php' );
}

if ( ! is_admin() ) {
	if ( ANCMS_USED_CAR_FILTER ) { include_once( 'plugins/used-car-filter/shcms-used-car-filter.php' ); }
	if ( ANCMS_OFFER_FILTER ) { include_once( 'plugins/offer-filter/function_offer_filter.php' ); }
	if ( ANCMS_FINANCE_CALC ) { include_once( 'plugins/finance-calc/shcms-finance-calc.php' ); }
}

include_once( 'templates/template-helper.php' );


// add js file general.js for make and model drop down in admin
add_action( 'admin_enqueue_scripts', function () {
	if ( is_admin() ) {
		wp_enqueue_script( 'ancms-general', plugin_dir_url( __FILE__ ) . 'admin/js/general.js', array( 'jquery' ) );
	}
});



add_filter('acf/settings/load_json', function( $paths ) {
	$paths = array( ANCMS_PLUGIN_PATH . 'admin/acf-json' );
	if ( is_child_theme() ) {
		$paths = array(
			get_stylesheet_directory() . '/admin/acf-json',
			get_template_directory() . '/admin/acf-json',
		);
	}
	return $paths;
});

add_filter('acf/settings/save_json', function( $paths ) {
	//$path = get_template_directory() . '/admin/acf-json';
    $paths = ANCMS_PLUGIN_PATH . 'admin/acf-json';
    if ( is_child_theme() ) {
        $paths = array(
            get_stylesheet_directory() . '/admin/acf-json',
            get_template_directory() . '/admin/acf-json',
        );
    }
	return $paths;
});

/**
 * Add style to seamless box
 * @return [type] [description]
 */
function ancms_override_acf_styles() { ?>
    <style>
    .acf-postbox.seamless {
        border: 1px solid #e5e5e5;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.04);
        box-shadow: 0 1px 1px rgba(0,0,0,0.04);
        background: #fff;
    }


    .acf-postbox.seamless > .inside {
        margin: 10px !important;
    }
    </style>
<?php
}
add_action( 'acf/input/admin_head', 'ancms_override_acf_styles');

/**
 * A way of outputting html from a WYSIWIG editor to a message field at the top of an options page, good for instructions
 * need to use field key
 * @param  [type] $field [description]
 * @return [type]        [description]
 */
function ancms_load_notes_to_self( $field ) {
   $field['message'] = get_field('ancms_notes_to_self' , 'options');

    return $field;
}
add_filter('acf/load_field/key=field_59b849a94ba8a', 'ancms_load_notes_to_self');





/**
 * Add a disabled field to all types, it doesnt work with all types includeing image upload button
 * @param  [type] $field [description]
 * @return [type]        [description]
 */
function ancms_acf_add_disabled_field($field) {
    acf_render_field_setting( $field, array(
      'label'      => __('Disabled?','acf'),
      'instructions'  => '',
      'type'          => 'true_false',
      'name'      => 'disabled',
      'layout'  =>  'horizontal',
      'ui'            => 1,
      'default_value' => 0,
    ), true);
}
add_action('acf/render_field_settings', 'ancms_acf_add_disabled_field');


/**
 * Returns ACF data for footer jumps
 * @return array multidimentional array holding ACF footer data
 */
function ancms_get_header_data() {
    delete_transient( 'ancms_header_data' );
    if ( false === ( $header = get_transient( 'ancms_header_data' ) ) ) {
        $header = array_merge(get_field('ancms_header_styles', 'options') , get_field('ancms_header_content', 'options'));
        set_transient( 'ancms_header_data', $header,  DAYINSECONDS);
    } 

    //$header = get_field('ancms_header_styles', 'options');
    //echo '<pre>sdfsdfsdf';
    //print_r(get_field('ancms_header_styles', 'options'));
    //echo '</pre>';

    return $header; 
}



function ancms_clear_main_transients() {
    $screen = get_current_screen();
    if (strpos($screen->id, "ancms-settings") == true) {
        delete_transient( 'ancms_header_data' );
    }
}
add_action('acf/save_post', 'ancms_clear_main_transients', 20);






// add make and model taxonomy to attachments
function shcms_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'vehical_makes_and_models', 'attachment' );
}
add_action( 'init' , 'shcms_add_tags_to_attachments' );






function log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            echo '<pre>';
            print_r($message);
            echo '</pre>';
        } else {
            echo '<pre>';
            print_r($message);
            echo '</pre>';
        }
    }
}

function log_back($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            echo '<!-- <pre>';
            print_r($message);
            echo '</pre> -->';
        } else {
            echo '<!-- <pre>';
            print_r($message);
            echo '</pre> -->';
        }
    }
}
//use
//log_me(array('This is a message' => 'for debugging purposes'));
//log_me('This is a message for debugging purposes');



// drastically speed up the load times of the post edit page by removing WP custom fields meta box
add_filter('acf/settings/remove_wp_meta_box', '__return_true');


/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */

function awesome_acf_responsive_image($image_id,$image_size,$max_width){

    // check the image ID is not blank
    if($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url( $image_id, $image_size );

        // set the srcset with various image sizes
        $image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

        // generate the markup for the responsive image
        echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';

    }
}
// The image ID (I’m getting this from an ACF image field which returns an ID)
// The image size (I’ve used a custom image size, added via the add_image_size )
// The max width (In this case the max width this image is 640px)
// It will return the src, srcset and sizes attributes, you can assign your class and alt text as needed, see this example:
//<img class="my_class" <?php awesome_acf_responsive_image(get_field( 'image_1' ),'thumb-640','640px'); ? >  alt="text" /> 


include_once( 'class-autonerd-basic.php' );

// new AutoNerd(); // not singleton uses the constructor.
// AutoNerd::get_instance(); //.
add_action( 'plugins_loaded', array( 'AutoNerd', 'get_instance' ) );



/*
Patterns

Singleton

Factory


 */








/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
    global $wpdb;
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
        wp_die('No post to duplicate has been supplied!');
    }
 
    /*
     * Nonce verification
     */
    if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
        return;
 
    /*
     * get the original post id
     */
    $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
    /*
     * and all the original post data then
     */
    $post = get_post( $post_id );
 
    /*
     * if you don't want current user to be the new post author,
     * then change next couple of lines to this: $new_post_author = $post->post_author;
     */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;
 
    /*
     * if post data exists, create the post duplicate
     */
    if (isset( $post ) && $post != null) {
 
        /*
         * new post data array
         */
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'draft',
            'post_title'     => $post->post_title,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );
 
        /*
         * insert the post by wp_insert_post() function
         */
        $new_post_id = wp_insert_post( $args );
 
        /*
         * get all current post terms ad set them to the new post draft
         */
        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
 
        /*
         * duplicate all post meta just in two SQL queries
         */
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos)!=0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                if( $meta_key == '_wp_old_slug' ) continue;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query.= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }
 
 
        /*
         * finally, redirect to the edit post screen for the new draft
         */
        wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }
    return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'rd_duplicate_post_link', 10, 2 );


/**
 * Testing Storage methods
 */

class Registry {
    //private $storage = array();
    public $storage = array();

   function add( $id, $class ) {
    //echo 'added ' . $id . ' to storage ########';
    //print_r($class);

     $this->storage[$id] = $class;
     //print_r($this->get( 'header' ));
   }

   function get( $id ) {
      return array_key_exists( $id, $this->storage ) ? $this->storage[$id] : NULL;
   }
}

//$header2 = ancms_get_header_data();


global $registry;
$registry = new Registry();

function ancms_registy() {
    global $registry; 
    $header2 = ancms_get_header_data();
    //echo '<pre>Header 2';
    //print_r($header2);
    //echo '</pre>';

    if ( is_null( $registry->get( 'header' ) ) ) {
        $registry->add( 'header', $header2 );
    }


}
add_action('after_setup_theme', 'ancms_registy');




//global $ancms_header; 
//$ancms_header = 'This is my test';


function ancms_load_data() {
    echo '<pre>Before ancms_load_data: ';
    print_r($ancms_header);
    echo '</pre>';

    global $ancms_header; 
    $ancms_header = ancms_get_header_data();

    echo '<pre>After ancms_load_data: ';
    print_r($ancms_header);
    echo '</pre>';
}
//add_action('after_setup_theme', 'ancms_load_data');


add_filter( 'body_class','ancms_body_classes' );
function ancms_body_classes( $classes) {
    $body_class = array();
    
    global $registry;
    $header = $registry->get( 'header' );

    

    if ($header['ancms_side_header']) {
        $body_class[] = 'side-header';

        //$body_class[] = 'open-header';

        if ($header['ancms_side_header_options']['ancms_side_header_position'])
            $body_class[] = 'side-header-right ';

        if ($header['ancms_side_header_options']['ancms_side_header_style'])
            $body_class = array_merge($body_class, $header['ancms_side_header_options']['ancms_side_header_style']); 
    }



    $classes = array_merge( $classes, $body_class);
     
    return $classes;
     
}