<?php

/**
 * Sub Plugin Name: Used Car Filter.#
 * This page loads all css, js and ajax files
 * and general ajax data loading
 *
 * The template file is located in autonerd-base/content-single-used-car-results
 */

/*
*
* TODO: change php.ini
* Make sure max file upload is set at 32 - 64MB for pdf brochures
* Network dashboard-> Network Settings-> (at bottom) Max upload file size = 64000
 */

//block direct access to the plugins.php files


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Constance for plugin directory
define('SHCMS_FILTER_DIR', plugin_dir_path(__FILE__));
define('SHCMS_FILTER_URL', plugin_dir_url(__FILE__));


//load css and js files for general filter on every page
function shcms_plugin_admin_enqueue_scripts() {
  if (!is_admin()) {
    //  wp_enqueue_style('shcms-main-filter-form', SHCMS_FILTER_URL . '../css/shcms-filter-form.css');
    //  wp_enqueue_style('shcms-sprits', SHCMS_FILTER_URL . '../css/sprites.css');
      wp_enqueue_script('shcms-general', SHCMS_FILTER_URL . '../js/shcms-used-car-filter-form.js', array('jquery'));
     // wp_enqueue_script( 'shcms-make-model-ajax-js', SHCMS_FILTER_URL . '../js/shcms-used-car-filter-form.js?ver=8.1', array( 'jquery' ));
  }
}
add_action( 'wp_enqueue_scripts', 'shcms_plugin_admin_enqueue_scripts' );



// add form (shcms-form-content.php) just below nav
//add_filter('woo_content_before','shcms_insert_filter');
function shcms_insert_filter(){
	include('shcms-used-car-filter-form.php'); // set up post types
}

function shcms_insert_filter_menu(){
	include('shcms-used-car-filter-form-menu.php'); // set up post types
}

//add_filter( 'loop_shop_post_in', array( $this, 'shcms_test_filter' ) );
//function shcms_test_filter(){
	//echo '<h1>In test filter</h1>';
	//include('shcms-used-car-filter-form.php'); // set up post types
//}



/////////////////////////////////////////////////////////////////////////////////////////////////
///
///		Used Car Results Filter	
///
////////////////////////////////////////////////////////////////////////////////////////////////

//Enqueue Ajax Scripts for used car results, only load on results page
function enqueue_used_car_ajax_scripts1() {

	if ( is_shop() ) {
    	wp_register_script( 'shcms-used-car-ajax-js', SHCMS_FILTER_URL . '../js/shcms-used-car-filter.js', array( 'jquery' ), '', true );
    	wp_localize_script( 'shcms-used-car-ajax-js', 'ajax_used_car_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    	wp_enqueue_script( 'shcms-used-car-ajax-js' );
	}
}
add_action('wp_enqueue_scripts', 'enqueue_used_car_ajax_scripts1');

//Add Ajax Actions
add_action('wp_ajax_used_car_filter', 'used_car_filter');
add_action('wp_ajax_nopriv_used_car_filter', 'used_car_filter');









// function used in js file used-car-filter.js - action: 'used_car_filter'
function used_car_filter()
{


   	
   	$query_data = $_POST; // get ajax data

   	  //echo '<pre>POST: ';
 // print_r($_POST);
 // echo '</pre>';

 // echo '<pre>GET: ';
//  print_r($_GET);
 // echo '</pre>';

  //  echo '<pre>REQUEST: ';
 // print_r($_POST);
 // echo '</pre>';
   //	echo '<pre>Query GET Data: ';
	//print_r($query_data);
	//echo '</pre>';

	//beta_message('<p style="background: green; color:white">Query GET Data: ');
	//beta_message(print_r($query_data));
	//beta_message('</p>');

 	$make = $query_data['make']; // get ajax data - make: getmake
    $model = $query_data['model']; // model: getmodel
    $minprice = $query_data['minprice'];
    $maxprice = $query_data['maxprice'];
    $location = $query_data['location'];
    $mileage = $query_data['mileage'];
    $age = $query_data['age'];
    $enginefrom = $query_data['enginefrom'];
    $engineto = $query_data['engineto'];
    $fueltype = $query_data['fueltype'];
   // $tax = $query_data['tax'];
   // $mpg = $query_data['mpg'];
   // $co2 = $query_data['co2'];
    $transmission = $query_data['transmission'];
   // $transmission = ($query_data['transmission']) ? explode(',',$query_data['transmission']) : false;
    $doors = ($query_data['doors']) ? explode(',',$query_data['doors']) : false;
    $bodystyle = ($query_data['bodystyle']) ? explode(',',$query_data['bodystyle']) : false;
    $options = ($query_data['options']) ? explode(',',$query_data['options']) : false;
   // $colourstyle = ($query_data['colourstyle']) ? explode(',',$query_data['colourstyle']) : false;
    $colour = ($query_data['colour']) ? explode(',',$query_data['colour']) : false;
    $car_van = $query_data['carvan'];

	$paged = (isset($query_data['paged']) ) ? intval($query_data['paged']) : 1;
	
	$page_size = (isset($query_data['pagesize']) ) ? intval($query_data['pagesize']) : 10;
	$sortby = $query_data['order'];


	switch ($sortby) {
	    case 'priceLowest':
	    	$order_by = '_price';
			$order = 'ASC';
	        break;
	    case 'priceHighest':
	    	$order_by = '_price';
	    	$order = 'DESC';
	        break;
	    case 'ageYoungest':
	    	$order_by = 'year';
	       	$order = 'DESC';
	        break;
	    case 'ageOldest':
	       	$order_by = 'year';
	       	$order = 'ASC';
	        break;
	    case 'mileageLowest':
	    	$order_by = 'mileage';
	       	$order = 'ASC';
	        break;
	    case 'mileageHighest':
	       	$order_by = 'mileage';
	       	$order = 'DESC';
	        break;
	    default:
	    	$order_by = '_price';
	    	$order = 'ASC';
	}



	$car_meta_query = array('relation' => 'AND');
	$price_array = array(
										'key' => '_price',
										'value' => array($minprice, $maxprice),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC');
	array_push($car_meta_query, $price_array);

	//$location = array(
	//array('3774906', 'Charters Citroen - Aldershot'), 	// $location[0][0] $location[0][1]
	//array('1495640', 'Reading Used Car Centre'),		// $location[1][0] $location[1][1]
	//array('208780', 'Charters Peugeot - Aldershot')		// $location[2][0] $location[2][1]
	//);
	
	if ($location != 'any') {
		$location_array = array( // some other filter value
										'key' => 'location',
										'value' => $location,
										'compare' => '=');
		array_push($car_meta_query, $location_array);

	}

	$millage_array = array( // some other filter value
										'key' => 'mileage',
										'value' => $mileage,
										'compare' => '<=',
										'type' => 'NUMERIC');
	array_push($car_meta_query, $millage_array);

	if ( $age == 'all' ){

	} elseif ( $age == 'over' ){
		$over_five_year = intval(date("Y") - 6);
		
		//beta_message('<p style="background: green; color:white">age: ' . $over_five_year . '</p>');

		$age_array = array( // some other filter value
										'key' => 'year',
										'value' => array( 1900, intval($over_five_year)),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC');
	    array_push($car_meta_query, $age_array);
	} else {
		$age_array = array( // some other filter value
										'key' => 'year',
										'value' => array( intval(getage($age)), intval(date("Y"))), //function at end of page
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC');
		array_push($car_meta_query, $age_array);
	}

	$engine_array = array( // some other filter value
										'key' => 'enginesize',
										'value' => array($enginefrom, $engineto),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC');
	array_push($car_meta_query, $engine_array);

	if ($fueltype != 'any') {
		$fuel_array = array( // some other filter value
										'key' => 'fueltype',
										'value' => $fueltype,
										'compare' => '=');
		array_push($car_meta_query, $fuel_array);
	}

	if ( $transmission != 'any' ) {
		$transmission_array = array( // some other filter value
										'key' => 'transmission', //need fixing as custom name is misspelt
										'value' => $transmission,
										'compare' => 'IN');
		array_push($car_meta_query, $transmission_array);
	}

	if ( !empty( $doors ) ) {
		$doors_array = array( // some other filter value
										'key' => 'doors',
										'value' => $doors,
										'compare' => 'IN');
		array_push($car_meta_query, $doors_array);
	}

	if ($car_van == 'van') {
		$bodystyle = 'Van';
	} 

	if ( !empty( $bodystyle ) ) {
		// Issue with Panel Vans not being displayed. This might also effect other bodystyles that do not follow the norm
		$bodystyle_array = array( // some other filter value
										'key' => 'bodystyle',
										'value' => $bodystyle,
										'compare' => 'IN');
		array_push($car_meta_query, $bodystyle_array);
	} elseif ($car_van == 'car') {
		$bodystyle_array = array( // some other filter value
										'key' => 'bodystyle',
										'value' => 'Van',
										'compare' => 'NOT IN');
		array_push($car_meta_query, $bodystyle_array);
	}

	if ( !empty( $options ) ) {
		foreach ($options as $option) {
				$options_array = array( // some other filter value
										'key' => 'used_car_options',
										'value' => $option,
										'compare' => 'LIKE');
				array_push($car_meta_query, $options_array);
				$options_array = array();
		}
	}

	// boolean to decide if we are adding make and model to the search criteria.
	$add_tax_query = false;

	//beta_message('<p style="background: green; color:white">Make id: ' . $make . '</p>');
	//beta_message('<p style="background: green; color:white">Model id: ' . $model . '</p>');

	$tax_query_construct = array('relation' => 'AND');
	if (!$make == 0) {
		$make_array = array('taxonomy'=>'product_cat',
							'field'=> 'id',
							'terms' => $make);
		array_push($tax_query_construct, $make_array);
		$add_tax_query = true;

		//beta_message('<p style="background: green; color:white">Make Array: ');
		//beta_message(print_r($make_array));
		//beta_message('</p>');
	}

	if (!$model == '0') {
		$model_array = array('taxonomy'=>'product_cat',
							'field'=> 'id',
							'terms' => $model);
		array_push($tax_query_construct, $model_array);
		$add_tax_query = true;

		//beta_message('<p style="background: green; color:white">Model Array: ');
		//beta_message(print_r($model_array));
		//beta_message('</p>');
	}

	//beta_message('<p style="background: green; color:white">Tax Array: ');
	//beta_message(print_r($tax_query));
	//beta_message('</p>');

	$tax_query = array();

	if($add_tax_query) {
		array_push($tax_query, $tax_query_construct	);
	}

	// add OR to colour choices
	$colour_query_construct = array('relation' => 'OR');
	if ( !empty( $colour ) ) {
		// needs to be in the OR section really
		foreach ($colour as $colour2) {
				$colour_array = array( // some other filter value
										'key' => 'colour',
										'value' => $colour2,
										'compare' => 'LIKE');
				array_push($colour_query_construct, $colour_array);
				$colour_array = array();
		}
		array_push($car_meta_query, $colour_query_construct);
	}

//	beta_message('<p style="background: blue; color:white">Color Array: ');
//	beta_message(print_r($colour_query_construct));
//	beta_message('</p>');

//	beta_message('<p style="background: green; color:white">Car Array: ');
//	beta_message(print_r($car_args));
//	beta_message('</p>');

	$test = array(
		'relation' => 'AND',
		//array ('key' => '_regular_price',
		//		'value' => array('1000', '5000'),
		//		'compare' => 'BETWEEN',
		//		'type' => 'NUMERIC'),
		array( 'key' => 'pa_fuel_type',
				'value' => 'petrol',
				'compare' => '='),
		);

	$test2 = array(
		'relation' => 'AND',
		//array ('key' => '_regular_price',
		//		'value' => array('1000', '5000'),
		//		'compare' => 'BETWEEN',
		//		'type' => 'NUMERIC'),
		array( 'taxonomy' => 'pa_fuel_type',
			'field' => 'slug',
				'terms' => 'Petrol',
				),
		);
    $car_args = array(
    	'post_type' => 'product',
    	'post_status'     => 'publish',
    	'posts_per_page' => $page_size,
    	'meta_query' => $car_meta_query,
    	'paged' => $paged,
    	'orderby' => 'meta_value_num',
    	'meta_key' => $order_by,
    	'order' => $order,
    	'tax_query' => $tax_query
	);

	//echo '<pre>Query GET Data: ';
	//print_r($car_args);
	//echo '</pre>';

	//beta_message('<pre style="background: red; color:white">Car Array After: ');
	//beta_message(print_r($car_args));
	//beta_message('</pre>');

    // Used if we want to access cars accross multiply sites
    //switch_to_blog(11);

	$car_loop = new WP_Query($car_args);
	$car_count = $car_loop->found_posts;
	//echo 'count: ' . $car_count;

?>

<div id="used-car-order" class="container-fluid break-out" style="background: #d8d8d8; padding: 30px; margin-bottom:30px; ">
    <div class="container">
   <div class="row">
		<?php if( $car_count > 12 ): ?>
 
			    <div class="col-md-12">
				    <?php if($car_count) {
				    	echo 'Available Used Vehicles: ' . $car_count;
				    } ?>
			    </div>

	    <?php endif; ?>
	    
	    
		    <div class="col-md-6 nopadding">
				<div class="col-md-12" style="line-height: 2em; text-align:left;">
				  	<?php
				  		if( $car_count > 12 ):
							echo '<nav class="woocommerce-pagination">';
							echo '<ul class="page-numbers">';
							$big = 999999999;

							$paginate = paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, $paged ),
								'total' => $car_loop->max_num_pages,
								'type'  => 'array',
							) );
							foreach ( $paginate as $page ) {
					                echo "<li>$page</li>";
					        }

							echo '</ul>';
							echo '</nav>';	
						else:
							echo 'Available Used Vehicles: ' . $car_count;
						endif;
				  	?>
				</div>
		    </div>

		    <div class="col-sm-12 col-md-6  nopadding">
		    	<div class="col-xs-4 col-sm-1 right  nopadding" style="line-height: 2em">Show</div>
				<div class="col-xs-8 col-sm-4"> 
					<select class="form-control" name="resultsize" id="resultsize">
					    <option value="10" <?php echo ($page_size == 10 ? 'selected' : '') ?>>10 per page</option>
					    <option value="20" <?php echo ($page_size == 20 ? 'selected' : '') ?>>20 per page</option>
					    <option value="30" <?php echo ($page_size == 30 ? 'selected' : '') ?>>30 per page</option>
					</select>
				</div>
				<div class="col-xs-4 col-sm-2 right  nopadding" style="line-height: 2em">Sort By</div>
				<div class="col-xs-8 col-sm-5">
					<select class="form-control" name="sortBy" id="sortBy">
					    <option value="priceLowest" <?php echo ($sortby == 'priceLowest' ? 'selected' : '') ?>>Price (lowest first)</option>
					    <option value="priceHighest" <?php echo ($sortby == 'priceHighest' ? 'selected' : '') ?>>Price (highest first)</option>
					    <option value="ageYoungest" <?php echo ($sortby == 'ageYoungest' ? 'selected' : '') ?>>Age (youngest first)</option>
					    <option value="ageOldest" <?php echo ($sortby == 'ageOldest' ? 'selected' : '') ?>>Age (oldest first)</option>
					    <option value="mileageLowest" <?php echo ($sortby == 'mileageLowest' ? 'selected' : '') ?>>Mileage (lowest first)</option>
					    <option value="mileageHighest" <?php echo ($sortby == 'mileageHighest' ? 'selected' : '') ?>>Mileage (highest first)</option>
					</select>
				</div>
		    </div>    
    	</div>
    </div>
</div>


<?php










	if( $car_loop->have_posts() ):
		
		echo '<section class="used-car">';
	    echo '<section id="used-car-list" class="container-fluid">';
		while( $car_loop->have_posts() ): $car_loop->the_post();
			// loads content-usedcar.php
			get_template_part('content','usedcar');
		endwhile;
		
		echo '</div>';
		echo '</div>';

//echo '<div class="vehical-filter-navigation">';
		echo '<nav class="woocommerce-pagination">';
		echo '<ul class="page-numbers">';
		$big = 999999999;

		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $car_loop->max_num_pages,
			'type'  => 'array',
			//'add_fragment' => '#results',
		) );
		foreach ( $paginate as $page ) {
                echo "<li>$page</li>";
        }

		echo '</ul>';
		echo '</nav>';	

	else:
		//get_template_part('content-none');
		echo '<div><h3>No Results</h3><p>Unfortunately there are no vehicles that match your configuration on this site but give us a call on <strong>' . get_default_branch_telephone() . '</stong>. We will be happy to help.</p></div>';
	endif;

	wp_reset_postdata();

	//reset data back to original site
	//restore_current_blog();
	die();
}

function getage($age_in_years) {
		$min_year = 0;
		$current_year = date("Y");
		$min_year = intval($current_year) - intval($age_in_years);
		return $min_year;
	}


//Check page has been created
function shcms_filter_load(){

	$new_page_title = 'Used Car Results';
	$new_page_slug = 'used-car-results';
	$page_check = get_page_by_title($new_page_title);

	if(!isset($page_check->ID)){
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $new_page_title,
			'post_slug' => $new_page_slug,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
		);

		$new_page_id = wp_insert_post($new_page);
	}
}

//shcms_filter_load();

	/* EXAMPLE OF COMPEX QUERY (show me productss where color=orange OR color=red&size=small)
	$args = array(
		'post_type'  => 'product',
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key'     => 'color',
				'value'   => 'orange',
				'compare' => '=',
			),
	        array(
	                'relation' => 'AND',
	                array(
	                        'key' => 'color',
	                        'value' => 'red',
	                        'compare' => '=',
	                ),
	                array(
	                        'key' => 'size',
	                        'value' => 'small',
	                        'compare' => '=',
	                ),
			),
		),
	);
	$query = new WP_Query( $args );
	*/

/* NOT USED CURRENTLY

   Load form into action hook in theme

   add to themepage were you want filter

   add_action( 'shcms_add_filter_form' );

*/

//function shcms_add_filter_form() {

//	include('shcms-form-content.php'); // set up post types

//}

//add_action('shcms_add_filter_form','shcms_add_filter_form');


//load ajax page if results page
/* function shcms_make_model_ajax_scripts1() {
	if (!is_admin()) {
		wp_register_script( 'shcms-make-model-ajax-js', SHCMS_FILTER_URL . '../js/make-model-filter.js', array( 'jquery' ), '', true );
    	wp_localize_script( 'shcms-make-model-ajax-js', 'ajax_make_model_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    	wp_enqueue_script( 'shcms-make-model-ajax-js' );
	}
}
add_action('wp_enqueue_scripts', 'shcms_make_model_ajax_scripts1');

//Add Ajax Actions
add_action('wp_ajax_make_model_filter', 'make_model_filter');
add_action('wp_ajax_nopriv_used_car_filter', 'make_model_filter');

*/

/*function make_model_filter() {

	$query_data = $_GET;
	$make = $query_data['make'];
	$body = $query_data['bodystyle'];

	if ($make == 0) {
		echo '<select id="modeldd" name="modeldd" class="form-control">';
		echo '<option value="0">All Models</option>';
		echo '</select>';
	} else {
		$args = array(
			'show_option_all'    => 'All Models',
			//'show_option_none'   => '',
			//'option_none_value'  => '-1',
			'orderby'            => 'NAME', 
			'order'              => 'ASC',
			'show_count'         => 1,
			'hide_empty'         => 1, 
			'child_of'           => $make,
			//'exclude'            => '',
			'echo'               => 1,
			//'selected'           => 0,
			'hierarchical'       => 1, 
			'name'               => 'modeldd',
			'id'                 => 'modeldd',
			'class'              => 'form-control',
			//'depth'              => 0,
			//'tab_index'          => 0,
			'taxonomy'           => 'product_cat',
			'hide_if_empty'      => true,
			'value_field'	     => 'term_id'
			);

		wp_dropdown_categories( $args);

		}
	die();
} */
?>