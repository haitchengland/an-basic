<?php


if ( ! defined( 'WPINC' ) ) { die; }

ancms_construct();

function ancms_construct() {

    include_files();

    add_action( 'init',                     'ancms_register_post_type', 0 );
    add_action( 'init',                     'ancms_register_taxonomy', 0 );
    add_action( 'init',                     'ancms_add_tags_to_attachments' ); // add make and model taxonomy to attachments

    add_action( 'wp_enqueue_scripts',       'ancms_load_css' ); // load css (templates/theme-settings.php)
    add_action( 'wp_enqueue_scripts',       'ancms_load_js' ); // load js (templates/theme-settings.php)
    add_action( 'admin_enqueue_scripts',    'ancms_load_admin_js' ); // load admin js (templates/theme-settings.php)
    add_action( 'wp_print_styles',          'ancms_deregister_styles', 100 ); // Remove unwanted styles (templates/theme-settings.php)
    add_filter( 'script_loader_tag',        'ancms_add_async_attribute', 10, 2); // Add async to js (templates/theme-settings.php)

    if ( ! is_admin() ) 
        add_action ( 'wp_head',             'ancms_send_js_to_footer' , 1, 0 ); // Send jquery to footer (templates/theme-settings.php)

    add_action( 'after_setup_theme',        'ancms_clean_head'); // remove unwanted meta from head (templates/theme-settings.php)
    add_filter( 'jpeg_quality',             create_function( '', 'return 80;' ) ); //reduce jpeg compression from 90 to 80
    add_action( 'template_redirect',        'ancms_template_redirect' ); // Redirect attachment to parent and author/date to 404 page (templates/theme-settings.php)
    add_filter( 'wp_resource_hints',        'ancms_resource_hints', 10, 2 ); // Add preconnect for Google Fonts (templates/theme-settings.php)

    add_filter('acf/settings/remove_wp_meta_box', '__return_true'); // drastically speed up the load times of the post edit page by removing WP custom fields meta box

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
        $path = get_template_directory() . '/admin/acf-json';
        return $path;
    });

    //add_action( 'admin_notices', array($this, 'admin_notice') );

}

function include_files() {
    include_once( 'ancms-settings.php' );
    include_once( 'templates/theme-settings.php' );
    include_once( get_stylesheet_directory() . '/ancms/ancms-settings.php' );
    include_once( 'includes/helper-functions.php' );


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
}



function ancms_register_post_type() {
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
}

function ancms_register_taxonomy {
    include_once( 'admin/create-post-types/ancms-taxonomies.php' );
}

// add make and model taxonomy to attachments
function ancms_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'vehical_makes_and_models', 'attachment' );
}







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








