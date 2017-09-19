<?php

function ancms_load_css() {

	if ( ! is_admin() ) {

		//wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
		wp_enqueue_style( 'ancms-fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic', array(), null );
		
		wp_enqueue_style( 'ancms_bootstrap', ANCMS_TEMPLATE_URL . 'assets/css/bootstrap.css' );
		wp_enqueue_style( 'ancms_style', ANCMS_TEMPLATE_URL . 'style.css' );
		wp_enqueue_style( 'ancms_swiper', ANCMS_TEMPLATE_URL . 'assets/css/swiper.css' );
		wp_enqueue_style( 'ancms_dark', ANCMS_TEMPLATE_URL . 'assets/css/dark.css' );
		wp_enqueue_style( 'ancms_font-icons', ANCMS_TEMPLATE_URL . 'assets/css/font-icons.css' );
		wp_enqueue_style( 'ancms_animate', ANCMS_TEMPLATE_URL . 'assets/css/animate.css' );
		wp_enqueue_style( 'ancms_magnific-popup', ANCMS_TEMPLATE_URL . 'assets/css/magnific-popup.css' );

		wp_enqueue_style( 'ancms_responsive', ANCMS_TEMPLATE_URL . 'assets/css/responsive.css' );
	}

}
add_action( 'wp_enqueue_scripts', 'ancms_load_css' );

function ancms_load_js() {
	if ( ! is_admin() ) {

		//wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
		//wp_enqueue_script( 'ancms_bootstrap', ANCMS_TEMPLATE_URL . 'assets/js/jquery.js' );
		wp_enqueue_script( 'ancms_plugin', ANCMS_TEMPLATE_URL . 'assets/js/plugins.js',  array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'ancms_functions', ANCMS_TEMPLATE_URL . 'assets/js/functions.js',  array( 'jquery' ), '1.0', true );
		
	}
}
add_action( 'wp_enqueue_scripts', 'ancms_load_js' );



/**
 * Remove certain css style sheets
 * @return [type] [description]
 */
function ancms_deregister_styles() {
	//ACF
	wp_dequeue_style( 'acf-front-end-editor-medium' );
	wp_deregister_style( 'acf-front-end-editor-medium' );

	wp_dequeue_style( 'acf-front-end-editor-theme' );
	wp_deregister_style( 'acf-front-end-editor-theme' );

	wp_dequeue_style( 'acf-front-end-editor' );
	wp_deregister_style( 'acf-front-end-editor' );
	//wp_deregister_style( 'acfv_theme_dark' );

	//Woocommerce
	wp_dequeue_style( 'woocommerce-layout' );
	wp_deregister_style( 'woocommerce-layout' );

	wp_dequeue_style( 'woocommerce-smallscreen' );
	wp_deregister_style( 'woocommerce-smallscreen' );

	wp_dequeue_style( 'woocommerce-general' );
	wp_deregister_style( 'woocommerce-general' );

	wp_dequeue_script( 'acf-front-end-editor-medium');
    wp_deregister_script('acf-front-end-editor-medium');

    wp_dequeue_script( 'acf-front-end-editor');
    wp_deregister_script('acf-front-end-editor');

}
add_action( 'wp_print_styles', 'ancms_deregister_styles', 100 );

//if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

/**
 * Add the async attribute to selected js
 * @param [type] $tag    [description]
 * @param [type] $handle [description]
 */
function ancms_add_async_attribute($tag, $handle) {
    if ( 'ancms_plugin' !== $handle 
    	&& 'ancms_functions' !== $handle )
        return $tag;
    return str_replace( ' src', ' async="async" src', $tag );
}
//add_filter('script_loader_tag', 'ancms_add_async_attribute', 10, 2);


/**
 * Move wordpress jquery to footer
 */
function ancms_send_js_to_footer () {
    global $wp_scripts;
    $wp_scripts->add_data( 'jquery', 'group', 1 ); // Instead of $wp_scripts->registered['jquery']->extra['group'] = 1;
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
    $wp_scripts->add_data( 'html5', 'group', 1 );
}
if ( ! is_admin() ) add_action ( 'wp_head', 'ancms_send_js_to_footer' , 1, 0 );


/**
 * Cleans unessecry tags from <head>
 * @return [type] [description]
 */
function ancms_clean_head () {
    remove_action('wp_head', 'wp_generator');                // removes the “generator” meta tag
    remove_action('wp_head', 'wlwmanifest_link');            // removes the “wlwmanifest” link
    remove_action('wp_head', 'rsd_link');                    // The RSD is an API to edit your blog from external services and clients
    remove_action('wp_head', 'wp_shortlink_wp_head');        // remove shortlink

    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); //https://developer.wordpress.org/reference/functions/wp_oembed_add_discovery_links/

    remove_action( 'wp_head','feed_links', 2 ); 			// remove feeds
	remove_action( 'wp_head','feed_links_extra', 3 );

    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);    // Removes a link to the next and previous post

    add_filter('the_generator', '__return_false');            // Removes the generator name from the RSS feeds.
    //add_filter('show_admin_bar','__return_false');            // Removes the administrator’s bar

    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // Removes WP 4.2 emoji styles and JS
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	add_filter('emoji_svg_url', '__return_false'); // removes <link rel="dns-prefetch" href="//s.w.org"> which has somthing to do with  emoji


    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // removes api.w.org json 
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

}
add_action('after_setup_theme', 'ancms_clean_head');



/**
 * reduce jpeg compression from 90 to 80
 */
add_filter('jpeg_quality', create_function( '', 'return 80;' ) );



/**
 * Redirect attachment to parent and author/date to 404 page
 * @return [type] [description]
 */
function ancms_template_redirect () {
    global $wp_query, $post;

    if ( is_attachment() ) {
        $post_parent = $post->post_parent;

        if ( $post_parent ) {
            wp_redirect( get_permalink($post->post_parent), 301 );
            exit;
        }

        $wp_query->set_404();

        return;
    }

    if ( is_author() || is_date() ) {
        $wp_query->set_404();
    }
}
add_action( 'template_redirect', 'ancms_template_redirect' );


/**
 * Add preconnect for Google Fonts. taken from twentyseventeen
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ancms_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'ancms-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ancms_resource_hints', 10, 2 );


