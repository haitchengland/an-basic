<?php 

$header_var_1 = array(
	'design' => array(
		'header_style' => 'transparent-header full-header', // dark | transparent-header | transparent-header semi-transparent | full-header
		'nav_style' => 'style-3 dark', 	// Can use a combination of several. Left blank defualts to logo left menu right
						// style-2 (Menu aligns beside the Logo) | 
						// style-3 (Menu Items with Theme Scheme Background Colors) | 
						// style-4  (Menu Items with Theme Scheme Border Colors) | 
						// style-5 (Menu Items with Large Icons on top of the Menu Name) | 
						// style-6 (Menu Items with a top animating border on Mouse Hover) | 
						// dark | sub-title | with-arrows | on-click
		//'is_sticky' => true,
		'sticky_style' => 'not-dark', // dark | not-dark | transparent semi-transparent
		'sticky_offset' => '',
		'is_top_bar' => false, // cant be used with transparent-header | transparent-header semi-transparent
		'is_notice_bar' => false, //this is a message bar that could be added accross the site like a promotion

	),
	'standard-logo' => ANCMS_IMAGES_URL . 'logo-dark.png',
	'retina-logo' => ANCMS_IMAGES_URL . 'logo-dark@2x.png',
);

$header_var_2 = array(
	'design' => array(
		'header_style' => '', // dark | transparent-header | transparent-header semi-transparent | full-header
		'nav_style' => 'style-3', 	// Can use a combination of several. Left blank defualts to logo left menu right
						// style-2 (Menu aligns beside the Logo) | 
						// style-3 (Menu Items with Theme Scheme Background Colors) | 
						// style-4  (Menu Items with Theme Scheme Border Colors) | 
						// style-5 (Menu Items with Large Icons on top of the Menu Name) | 
						// style-6 (Menu Items with a top animating border on Mouse Hover) | 
						// dark | sub-title | with-arrows | on-click
		//'is_sticky' => true,
		'sticky_style' => 'not-dark', // dark | not-dark | transparent semi-transparent
		'sticky_offset' => '',
		'is_top_bar' => true, // cant be used with transparent-header | transparent-header semi-transparent
		'is_notice_bar' => true, //this is a message bar that could be added accross the site like a promotion

	),
	'standard-logo' => ANCMS_IMAGES_URL . 'logo.png',
	'retina-logo' => ANCMS_IMAGES_URL . 'logo@2x.png',
);


$header_var = $header_var_2;


/*
    [ancms_header_styles] => Array
        (
            [ancms_side_header] => 
            [ancms_colour_scheme] => light
            [ancms_header_options] => Array
                (
                    [ancms_header_style] => Array
                        (
                            [0] => style-1
                        )

                    [ancms_is_sticky] => 1
                    [ancms_static_sticky] => 
                    [ancms_full_width_header] => 1
                )

            [ancms_side_header_options] => Array
                (
                    [ancms_side_header_position] => 
                    [ancms_side_header_style] => Array
                        (
                        )

                )

            [ancms_nav_options] => Array
                (
                    [ancms_nav_style] => Array
                        (
                            [0] => style-1
                        )

                    [ancms_menu_arrows] => 1
                    [ancms_open_menu_on_click] => 1
                )

        )

    [ancms_header_content] => Array
        (
            [ancms_standard_logo] => 378
            [ancms_retina_logo] => 379
        )

)
 */

//$header = get_field('ancms_header_styles', 'options');
//$header = ancms_get_header_data(); // use transient
//$options = get_fields($post_id);

//$test = get_fields();
//echo '<pre>';
//print_r($test);
//echo '</pre>';

//$header is global setup in the theme-settings this should move or we need to create a class???
	//global $header;
	
	global $registry;
	$header = $registry->get( 'header' );

	/**
	 * Applies a filter in header.php to add additional classses to the header
	 * @param  [type] $class [description]
	 * @return [type] $class [description]
	 */
	function ancms_header_class( $class ) {
        // Separates classes with a single space, collates classes for body element
        
        //$class = apply_filters( 'header_class', $classes, $class );

      //echo '<h2>In Filter</h2>';
      //echo = 'class="' . join( ' ', get_body_class( $class ) ) . '"';
        $class[] = 'haitch';
       // $class[] = 'not-dark';
        return $class;
	}
	add_filter( 'header_class','ancms_header_class' );


echo '<pre>New ANCMS instance : ';
	//WC();
	
	//$breadcrumbs_data = new ANCMS_Data();
	//print_r(WC()->structured_data->output_structured_data());
	//
	print_r(WC());
	echo '</pre>';

add_action( 'ancms_before_main_content', 'ancms_breadcrumb', 20, 0 );

function ancms_breadcrumb( $args = array() ) {
	echo '<br>### IN ancms_breadcrumb ###';

	//echo '<pre>ancms_breadcrumb $args : ';
	//print_r($args);
	//echo '</pre>';

	$args = wp_parse_args( $args, apply_filters( 'ancms_breadcrumb_defaults', array(
		'delimiter'   => '&nbsp;&#47;&nbsp;',
		'wrap_before' => '<nav class="woocommerce-breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	) ) );

	//echo '<pre>ancms_breadcrumb $args : ';
	//print_r($args);
	//echo '</pre>';

	$breadcrumbs = new ANCMS_Breadcrumb();

	$args['breadcrumb'] = $breadcrumbs->generate();

	//echo '<pre>ancms_breadcrumb $breadcrumbs->get_breadcrumb() : ';
	//print_r($breadcrumbs->get_breadcrumb());
	//echo '</pre>';

	/**
	 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
	 */
	//$args = do_action( 'ancms_breadcrumb_action', $breadcrumbs, $args );
	//$args = wp_parse_args( $args, do_action( 'ancms_breadcrumb', $breadcrumbs, $args ) );
	//echo '<pre>ancms_breadcrumb $args : ';
	//print_r($args);
	//echo '</pre>';

	$args = apply_filters( 'ancms_breadcrumb', $args, $breadcrumbs );
	//$args = wp_parse_args( $args, 
	
	//wc()->structured_data->generate_breadcrumblist_data( $breadcrumbs, $args );
	do_action( 'ancms_breadcrumb_1', $breadcrumbs, $args ) ;

	//echo '<pre>ancms_breadcrumb $args : ';
	//print_r($args);
	//echo '</pre>';
	//wc_get_template( 'global/breadcrumb.php', $args );
}

function overide_ancms_breadcrumb_defaults( $args ) {
	echo '<br>### overide_ancms_breadcrumb_defaults ###';
    $args = array(
		'delimiter'   => '--',
		'wrap_before' => '<nav class="haitch">',
		'wrap_after'  => '</nav>',
		'before'      => '123',
		'after'       => '456',
		//'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	) ;
	return $args;
}
add_filter( 'ancms_breadcrumb_defaults','overide_ancms_breadcrumb_defaults' );

function overide_ancms_breadcrumb( $args, $breadcrumbs  ) {
	echo '<br>### overide_ancms_breadcrumb ###';
    //echo '<pre>overide_ancms_breadcrumb $args : ';
	//print_r($args);
	//echo '</pre>';

	//echo '<pre>overide_ancms_breadcrumb $breadcrumbs : ';
	//print_r($breadcrumbs);
	//echo '</pre>';

	//$args = wp_parse_args( $args, array(
	//	'delimiter'   => '##',
	//	'before'      => '789',
	//	'after'       => '012',
		//'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	//) );

	$args['delimiter'] = '##';
	$args['before'] = '789';
	$args['after'] = '012';

    //$args = array(
	//	'delimiter'   => '##',
	//	'before'      => '789',
	//	'after'       => '012',
		//'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	//) ;

	//echo '<pre>overide_ancms_breadcrumb $args : ';
	//print_r($args);
	//echo '</pre>';

	return $args;
}
//add_action( 'ancms_breadcrumb_action', 'overide_ancms_breadcrumb', 20, 2 );
add_filter( 'ancms_breadcrumb', 'overide_ancms_breadcrumb', 20, 2 );


	echo '<pre>ancms_before_main_content : ';
	do_action( 'ancms_before_main_content' );
	echo '</pre>';

	echo '<pre>ANCMS instance : ';
	//WC();
	
	//$breadcrumbs_data = new ANCMS_Data();
	//print_r(WC()->structured_data->output_structured_data());
	//
	print_r(WC());
	echo '</pre>';

	//add_filter('ancms_breadcrumb_defaults',)
	//add_filter('ancms_breadcrumb',)



	/**
	 * Idea 
	 */
	//echo '<pre>Reg in header.php';
//print_r( $registry->get( 'header' ) );
//echo '</pre>';


	//$header = ancms_get_header_data();
	//$header = get_field('ancms_header_styles', 'options');
	//echo '<pre>';
	//print_r($header);
	//echo '</pre>';

	if ( $header ) {
	
		$header_class  = array();
		$data_class = array();


		

		//$body_class = array();
		//$nav_class = '';

		if ($header['ancms_side_header']) {
			$header_class[] = 'no-sticky';
			$header_class[] = 'solid-header';
		} else {
			foreach ($header['ancms_header_options']['ancms_header_style'] as $style) {
				$header_class[] = $style;

				if ($style == 'transparent-header' || $style == 'transparent-header semi-transparent') {
					if ( $header['ancms_colour_scheme'] == 'light') {
						$header_class[] = 'not-dark';
					}

				}
			}

			if ( $header['ancms_header_options']['ancms_full_width_header'] ) {
				$header_class[] = 'full-header';
			}

			

			if ( $header['ancms_is_sticky'] ) {
				if ( $header['ancms_sticky_options']['ancms_static_sticky'] ) {
					$header_class[] = 'static-sticky';
				}
				if ( $header['ancms_sticky_options']['ancms_sticky_colour_scheme'] == 'dark' ) {
					$data_class[] = 'data-sticky-class="dark"';
				} elseif ( $header['ancms_sticky_options']['ancms_sticky_colour_scheme'] == 'light' ) {
					$data_class[] = 'data-sticky-class="not-dark"';
				}
			} else {
				$header_class[] = 'no-sticky';
			}

		}

		$header_class[] = $header['ancms_colour_scheme'];

		$header_class = apply_filters( 'header_class', $header_class );
		$header_class_output = 'class="' . join( ' ', $header_class ) . '"';

		$data_class = apply_filters( 'data_header_class', $data_class);
		$data_class_output = join( ' ', $data_class );

		//$data_sticky_offset = 'data-sticky-offset=""';
		

		//$header['ancms_standard_logo']
		//$header['ancms_retina_logo']
		//$header['ancms_sticky_logo']
		
		//$header['ancms_standard_logo']
		

		//echo '<pre>';
		//print_r($header['ancms_logos_options']['ancms_standard_logo']);
		//print_r($header['ancms_logos_options']['ancms_retina_logo']);
		//print_r(wp_get_attachment_image_src( $header['ancms_logos_options']['ancms_standard_logo'], $size));
		/*Array
		(
		    [0] => http://dev.autonerd.co.uk/wp-content/uploads/2017/09/logo.png
		    [1] => 184
		    [2] => 100
		    [3] => 
		)*/
		//print_r( wp_get_attachment_image_src( $header['ancms_logos_options']['ancms_standard_logo'], $size)[0] );
		//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/logo.png
		//echo '</pre>';
		$size = 'full';
		$sticky_logo_src = wp_get_attachment_image_src( $header['ancms_sticky_options']['ancms_sticky_logo'], $size)[0];
		$mobile_logo_src = wp_get_attachment_image_src( $header['ancms_sticky_options']['ancms_sticky_logo'], $size)[0];
		$retina_logo_src = wp_get_attachment_image_src( $header['ancms_logos_options']['ancms_retina_logo'], $size)[0];
		$standard_logo_src = wp_get_attachment_image_src( $header['ancms_logos_options']['ancms_standard_logo'], $size)[0];

		$standard_logo = '<a href="' . site_url() . '" class="standard-logo" data-sticky-logo="' . $sticky_logo_src . '" data-mobile-logo="' . $mobile_logo_src . '"><img src="' . $standard_logo_src . '" alt="' . get_bloginfo('title') . '"></a>';

		$retina_logo = '<a href="' . site_url() . '" class="retina-logo" data-sticky-logo="' . $sticky_logo_src . '" data-mobile-logo="' . $mobile_logo_src . '"><img src="' . $retina_logo_src . '" alt="' . get_bloginfo('title') . '"></a>';

		//<a href="index.html" class="standard-logo" data-dark-logo="images/logo-dark.png" data-sticky-logo="demos/media-agency/images/logo-media.png" data-mobile-logo="demos/media-agency/images/logo-media.png">
		//<img src="images/logo.png" alt="Canvas Logo">
		//</a>

		//<a href="index.html" class="retina-logo" data-dark-logo="images/logo-dark@2x.png" data-sticky-logo="demos/media-agency/images/logo-media@2x.png" data-mobile-logo="demos/media-agency/images/logo-media@2x.png">
		//<img src="images/logo@2x.png" alt="Canvas Logo">
		//</a>

		/*

		wp_get_attachment_image( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false, string|array $attr = '' )
		wp_get_attachment_image_src( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false )
		wp_get_attachment_image_srcset( int $attachment_id, array|string $size = 'medium', array $image_meta = null )
		
		$img_atts = array(
	      'src'   => wp_get_attachment_image_url( $entry['slide_image_id'], $img_size_class, false ),
	      'class' => 'attachment-' . $img_size_class . ' size-' . $img_size_class,
	      'alt'   => trim(strip_tags( get_post_meta( $entry['slide_image_id'], '_wp_attachment_image_alt', true) ) )
	    );

	    //If an 'alt' attribute was not specified, try to create one from attachment post data
	    if( empty( $img_atts[ 'alt' ] ) )
	      $img_atts[ 'alt' ] = trim(strip_tags( $attachment->post_excerpt ));
	    if( empty( $img_atts[ 'alt' ] ) )
	      $img_atts[ 'alt' ] = trim(strip_tags( $attachment->post_title ));


		
*/
		

		//echo '<pre>';
		//print_r($body_classes);
		//print_r($header['ancms_side_header_options']['ancms_side_header_style']);
		//echo '</pre>';
		//

	}
	

		



add_action( 'body_class', function($classes) use ( $body_class ) {
    $classes = $classes + $body_class;
     
    return $classes;
    }, 11 
);

?>
<?php //echo 'video ' . $slider_var[1]['video']['mp4']; ?>
<?php //echo '<pre>';
//print_r($slider_var['slides']);
//echo '</pre>'; ?>
<!-- http://dev.autonerd.co.uk/wp-content/plugins/autonerd-basic/templates/assets/images/slider/swiper/1.jpg -->
<?php if ($header['ancms_side_header']) : ?>
	<div id="header-trigger"><i class="icon-line-menu"></i><i class="icon-line-cross"></i></div>
<?php endif; ?>

<?php if ( $header['ancms_show_top_menu'] ) : ?>
	<?php ancms_get_template_part( 'template-parts/header/header', 'top-bar' ); ?>
<?php endif; ?>
		
<style>
/* need to add this to css */
#top-bar {
    z-index: 10;
    background: #fff;
}

#header.solid-header {
    z-index: 10;
}

#slider {
    top: -40px; 
}

@media (min-width: 992px) {
	.side-header.side-header-right #header.dark {
	    border-left: 1px solid #333;
	}

	.side-header.open-header #header-trigger {
        z-index: 100;
	}
}

</style>
<!-- Header
============================================= -->
<!-- <header id="header" class="<?php echo $header_class ?>" data-sticky-class="<?php echo $header_var['design']['sticky_style']; ?>" > -->
<!-- <header id="header" class="transparent-header full-header  dark"> -->
<header id="header" <?php echo $header_class_output; ?> <?php echo $data_class_output; ?>> <!--class="full-header solid-header"> -->
	<div id="header-wrap">

		<div class="container clearfix">

			<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
			

			<!-- Logo
			============================================= -->
			<div id="logo">
				<?php echo $standard_logo; ?>
				<?php echo $retina_logo; ?>

						
						

			</div><!-- #logo end -->
			<?php include( ancms_get_template_part( 'template-parts/header/nav', 'main', false ) ); // include as I am doing the varible in the header page to keep them together?>
			<?php //ancms_get_template_part( 'template-parts/header/nav', 'main' ); ?>

		</div>

	</div>

</header><!-- #header end -->

<?php
/**
 * Need to identify if a slider needs loading
 * if homepage() ??
 */
 ancms_get_template_part( 'template-parts/header/slider', 'canvas' ); ?>


<section id="content">
	<div class="content-wrap">
		
		<?php if ( $header['ancms_show_notifications'] ) : ?>
			<?php ancms_get_template_part( 'template-parts/header/header', 'notification' ); ?>
		<?php endif; ?>
		
		

		<?php ancms_get_template_part( 'template-parts/header/nav', 'sub' ); ?>

		