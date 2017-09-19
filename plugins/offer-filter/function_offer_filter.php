<?php 
//Enqueue Ajax Scripts
//
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function enqueue_vehical_ajax_scripts() {
	if ( is_post_type_archive( 'sh_new_offer' ) ) {
    		wp_register_script( 'vehical-ajax-js', SHCMS_FILTER_URL . '../js/offer-filter.js', array( 'jquery' ), '', true );
    		wp_localize_script( 'vehical-ajax-js', 'ajax_vehical_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    		wp_enqueue_script( 'vehical-ajax-js' );
		}
}

add_action('wp_enqueue_scripts', 'enqueue_vehical_ajax_scripts');

		//Add Ajax Actions
		add_action('wp_ajax_vehical_filter', 'vehical_filter');
		add_action('wp_ajax_nopriv_vehical_filter', 'vehical_filter');

add_action( 'wp_print_scripts', 'shcms_filter_setup' );
function shcms_filter_setup() {
		
}

//echo "Is post type: " . is_post_type_archive( 'sh_new_offer' );
//if ( is_post_type_archive( 'sh_new_offer' ) ) {
//}

function vehical_filter()
{
   	$query_data = $_GET;

   	$carm = get_field('car_manufacturer', 'option');
   	$car = get_field('website_manufacturer_car_list', 'option');
   	$van = get_field('website_manufacturer_van_list', 'option');

   	$order = $query_data['order'];
   	$order_by = $query_data['orderby'];

	$add_tax_query_product = false;

	if ($query_data['offer_cat'] == 'used-car-offers' || $query_data['offer_cat'] == 'all') {
		$add_tax_query_product = true;
	}

	$tax_query_construct = array('relation' => 'AND');
	$tax_query_construct_product = array('relation' => 'AND');

	//echo '<pre>';
	//print_r( $query_data );
	//echo '</pre>';
	
	if ($query_data['vehicals'] != '0') {
			$temp_array = array('relation' => 'OR');
			$model_array = array(
							'taxonomy'=>'vehical_makes_and_models',
							'field'=> 'id',
							'terms' => $query_data['vehicals']
				);
			array_push($temp_array, $model_array);

			$no_model_array = array(
							'taxonomy'=>'vehical_makes_and_models',
							'field'=> 'slug',
							'terms' => 'all',
				);
			
			array_push($temp_array, $no_model_array);
			array_push($tax_query_construct, $temp_array);
			array_push($tax_query_construct_product, $temp_array);

			//$add_tax_query = true;
	} else {
		if ($query_data['vehical_type'] == 'car') {

			$temp_array = array('relation' => 'OR');
			$model_array = array(
							'taxonomy'=>'vehical_makes_and_models',
							'field'=> 'id',
							'terms' => $car,
				);
			array_push($temp_array, $model_array);

			$no_model_array = array(
							'taxonomy'=>'vehical_makes_and_models',
							'field'=> 'slug',
							'terms' => 'all',
				);
			
			array_push($temp_array, $no_model_array);
			array_push($tax_query_construct, $temp_array);
			array_push($tax_query_construct_product, $temp_array);

		} elseif ($query_data['vehical_type'] == 'van') {
			$temp_array = array('relation' => 'OR');
			$model_array = array(
							'taxonomy'=>'vehical_makes_and_models',
							'field'=> 'id',
							'terms' => $van,
				);
			array_push($temp_array, $model_array);

			$no_model_array = array(
							'taxonomy'=>'vehical_makes_and_models',
							'field'=> 'slug',
							'terms' => 'all',
				);
			
			array_push($temp_array, $no_model_array);
			array_push($tax_query_construct, $temp_array);
			array_push($tax_query_construct_product, $temp_array);
		}
	}

	
	if ($query_data['offer_cat'] != 'all') {
			$offer_array = array(
							'taxonomy'=>'new_offer_categories',
							'field'=> 'slug',
							'terms' => $query_data['offer_cat']
				);
			array_push($tax_query_construct, $offer_array);

	} 



	if ($query_data['offer_type'] != 'all') {
			$offer_type_array = array(
							'taxonomy'=>'new_offer_types',
							'field'=> 'slug',
							'terms' => $query_data['offer_type']
				);
			array_push($tax_query_construct, $offer_type_array);

			$add_tax_query_product = false;
	} 

    $paged = (isset($query_data['paged']) ) ? intval($query_data['paged']) : 1;

    $offer_args = array(
    	'fields' => 'ids',
    	'post_type' => 'sh_new_offer',
    	'posts_per_page' => -1,
    	'tax_query' => $tax_query_construct,	
    	'meta_query' =>  array( 	'relation' => 'AND',
    						'featured_key' => array(
    							'key' => 'offer_featured',
    							'type'    => 'NUMERIC',
    							'compare' => 'EXISTS'
    							),
    						'normal_order' => array(
    							'key' => $order_by,
    							'type'    => 'NUMERIC',
    							'compare' => 'EXISTS'
    							),
    					),
    	'orderby' => array ( 'featured_key' => 'DESC',
    						 'normal_order' => $order),

	);

	//echo '<pre>Query GET Data: ';
	//print_r($offer_args);
	//echo '</pre>';

    $offer_products_args = array(
    	'fields' => 'ids',
    	'post_type' => array('product'),
    	'posts_per_page' => -1,
    	'tax_query' => $tax_query_construct_product,
    	'meta_query' => array(
    						array( 	'key' => '_featured',
    								'value' => 'yes')
    						),
	);

	//echo '<pre>Query GET Data: ';
	//print_r($offer_products_args);
	//echo '</pre>';

	$loop = new WP_Query( $offer_args );

	if ($add_tax_query_product == true) {
		
		$loop2 = new WP_Query( $offer_products_args );
		$ids = array_merge($loop->posts, $loop2->posts);

		if (count($ids) == 0 ){
			$ids[] = 0;
		}
		
		$offer_loop_arg = array(
								'post_type' => array('product', 'sh_new_offer'), 
								'post_status'     => 'publish',
								'post__in' => $ids, 
								'posts_per_page' => 8, 
								'paged' => $paged,
								'orderby' => 'post__in'
								);
	} else {
		
		$ids = $loop->posts;
		
		// fix for if no ids found which makes wp_query return all results. Added 0 as no posts have a id of 0 so no results will be found
		if (count($ids) == 0 ){
			$ids[] = 0;
		}

		$offer_loop_arg = array(
								'post_type' => 'sh_new_offer', 
								'post_status'     => 'publish',
								'post__in' => $ids, 
								'posts_per_page' => 8, 
								'paged' => $paged,
								'orderby' => 'post__in'
								);
	}
	
	$offer_loop = new WP_Query($offer_loop_arg);

	$post_count = 0;
	
	if( $offer_loop->have_posts() ):

		echo '<nav class="sh-pagination">';
		echo '<ul class="page-numbers">';
		$big = 999999999;
		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $offer_loop->max_num_pages,
			'type'  => 'array',
		) );
		foreach ( $paginate as $page ) {
                echo '<li>' . $page . '</li>';
        }
		echo '</ul>';
		echo '</nav><br>';

		echo '<div id="ncc-offer-loop" class="col-full container-fluid nopaddingsides">';
		echo '<div class="row bottom-margin">';

		while( $offer_loop->have_posts() ): $offer_loop->the_post();
			$large = false; // to identify if we need a larger image in card template

			if ($post_count < 2) {
				$post_count ++;
				$large = true;
				echo '<div class="col-sm-6 card-large bottom-margin">';

			} else {
				$large = false;
				echo '<div class="col-md-4 card-small col-sm-6 bottom-margin">';
			}

			if (get_post_type() == 'product') {
				get_template_part('templates/element','offer-card-used');
			} else {
				include(locate_template('templates/element-offer-card.php'));
				//get_template_part('templates/element','offer-card');
			}
			
			echo '</div>';

		endwhile;

		echo '</div>';
		echo '</div>';


		echo '<nav class="sh-pagination">';
		echo '<ul class="page-numbers">';
		$big = 999999999;
		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $offer_loop->max_num_pages,
			'type'  => 'array',
		) );
		foreach ( $paginate as $page ) {
                echo '<li>' . $page . '</li>';
        }
		echo '</ul>';
		echo '</nav><br>';



		
	else:
		//get_template_part('content-none');
		echo '<div><h3>No Results</h3><p>Unfortunately there are no offers that match your configuration on this site but give us a call on <strong>' . get_default_branch_telephone() . '</stong>. We will be happy to help.</p></div>';
	endif;

	wp_reset_postdata();
	
	die();
}
?>