<?php 
/**
 * Import Scripts for wp-all-imports and wp-all-export
 *
 * @package 01 Haitch Cars plugin
 * 
 * File Version 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


//add_action('pmxi_before_xml_import', 'shcms_before_xml_import', 10, 1);
function shcms_before_xml_import($import_id) { // Used car feed - import 7


    if ( $import_id == 7 ) {
    	$date_now = date('Y-m-d H:i:s');
    	$output = '<pre>' . $date_now . '</pre>';
    	$output .= '<pre>' . print_r($_GET,true) . '</pre>';
    	update_field('sh_debug_import_export', $output, 'options');

    	$date_now = date('Y-m-d H:i:s');

    	$output = '<pre>Before Import: ' . $date_now . '</pre>';
    	$output .= '<pre>' . print_r($_GET,true) . '</pre>';
    	$output .= '#######################################<br>';

    	update_field('sh_debug_import_export', $output, 'options');
    	update_field('sh_import_processing', true, 'options');
    	update_field('sh_import_start_time', $date_now, 'options');
    }
}


//add_action('pmxi_after_xml_import', 'shcms_after_xml_import', 10, 1);
function shcms_after_xml_import($import_id) { // Used car feed - import 7
    if ( $import_id == 7 ) {
    	
    	$date_now = date('Y-m-d H:i:s');
    	$start_date = get_field('sh_import_start_time',options);
    	$total_time =  strtotime($date_now) - strtotime($start_date);

    	$hours = intval($total_time / 3600);   
		$seconds_remain = ($total_time - ($hours * 3600)); 
		$minutes = intval($seconds_remain / 60);   
		$seconds = ($seconds_remain - ($minutes * 60)); 

		$total_time_str = $hours .' h :' . $minutes . ' m :' . $seconds . ' s'; 

    	$output .= get_field('sh_debug_import_export',options);
    	$output .= '<pre>After Import: ' . $date_now . '</pre>';
    	$output .= '<pre>Total Time: '. $total_time_str . '</pre>';
    	$output .= '<pre>' . print_r($_GET,true) . '</pre>';
    	$output .= '#######################################<br>';

    	update_field('sh_debug_import_export', $output, 'options');
    	update_field('sh_import_processing', false, 'options');
    	update_field('sh_import_end_time', $date_now, 'options');
    	update_field('sh_import_total_time', $total_time_str , 'options');
    }
}


//do_action('pmxe_before_export', $export->id);
//add_action('pmxe_before_export', 'shcms_before_export', 10, 1);
function shcms_before_export($import_id) { 
    if ( $import_id == 2 ) {
    	$date_now = date('Y-m-d H:i:s');

    	$output .= get_field('sh_debug_import_export',options);
    	$output .= '<pre>Before Export: ' . $date_now . '</pre>';
    	$output .= '<pre>' . print_r($_GET,true) . '</pre>';
    	$output .= '#######################################<br>';

    	update_field('sh_debug_import_export', $output, 'options');
    	update_field('sh_export_processing', true, 'options');
    	update_field('sh_export_start_time', $date_now, 'options');
    }
}

//do_action('pmxe_after_export', $export->id, $export);
//add_action('pmxe_after_export', 'shcms_after_export', 10, 1);
function shcms_after_export($import_id) { 
    if ( $import_id == 2 ) {
    	
    	$date_now = date('Y-m-d H:i:s');
    	$start_date = get_field('sh_export_start_time',options);
    	$total_time =  strtotime($date_now) - strtotime($start_date);

    	$hours = intval($total_time / 3600);   
		$seconds_remain = ($total_time - ($hours * 3600)); 
		$minutes = intval($seconds_remain / 60);   
		$seconds = ($seconds_remain - ($minutes * 60)); 

		$total_time_str = $hours .' h :' . $minutes . ' m :' . $seconds . ' s'; 

    	$output .= get_field('sh_debug_import_export',options);
    	$output .= '<pre>After Export: ' . $date_now . '</pre>';
    	$output .= '<pre>Total Time: '. $total_time_str . '</pre>';
    	$output .= '<pre>' . print_r($_GET,true) . '</pre>';
    	$output .= '#######################################<br>';

    	update_field('sh_debug_import_export', $output, 'options');
    	update_field('sh_export_processing', false, 'options');
    	update_field('sh_export_end_time', $date_now, 'options');
    	update_field('sh_export_total_time', $total_time_str , 'options');
    }
}


add_action('pmxi_saved_post', 'shcms_check_original_price', 10, 1);
function shcms_check_original_price($post_id) {

	//$output = '<pre>' . print_r($_GET,true) . '</pre>';
	

	if (isset($_GET['import_id'])) {
		$import_id = $_GET['import_id'];
	} elseif (isset($_GET['id'])) {
		$import_id = $_GET['id'];
	} else {
		$import_id = 0;
	}

	//$output .= '<pre>Import ID: ' . $import_id . '</pre>';
	
	if ($import_id == 1 || $import_id == 7){ // Import running is the used car import
		//$output .= '<pre>In Code Block for ids 1 and 7</pre>';

		$postType = get_post_type($post_id);
    
	    if($postType=='product') {
		
			$postmeta = get_post_meta($post_id);
			$original_price = $postmeta['product_original_price'][0];
		    $product_price = $postmeta['_regular_price'][0];
		    $sale_price = $postmeta['_sale_price'][0];


		    // check $product has a price
		    /* if(!$product_price) {
		    	if(!$original_price) {
		    		if(!$sale_price) {
		    			//no price information present
		    			return;
		    		} else {
		    			update_post_meta( $post_id, '_regular_price', $sale_price );
		    			update_post_meta( $post_id, 'product_original_price', $sale_price );
		    		}
		    	} else {
		    		update_post_meta( $post_id, '_regular_price', $original_price );
		    	}
		    } */

		    if($product_price) {

			    if ($original_price) {
			    	// product price is under original - add price to sale
			    	if ( $product_price < $original_price ) {
			    		update_post_meta( $post_id, '_sale_price', $product_price );
			    		update_post_meta( $post_id, '_regular_price', $original_price );

			    	} elseif ( $product_price == $original_price ) {
			    		update_post_meta( $post_id, '_sale_price', '' );

			    	} elseif ( $product_price > $original_price ) {
			    		update_post_meta( $post_id, '_sale_price', '' );
			    	}
			    } else {
			    	update_post_meta( $post_id, 'product_original_price', $product_price );
			    }

		    }
		}

	}
	
	//update_field('sh_debug_import_export', $output, 'options');
	
}


//add_filter('wp_all_export_implode_delimiter', 'shcms_wp_all_export_implode_delimiter', 10, 2);
function shcms_wp_all_export_implode_delimiter( $implode_delimiter, $export_id ){
	return ",";
}


// http://www.charterstest.com/testfeed/BP12ZPR1.jpg,BP12ZPR2.jpg,BP12ZPR3.jpg,BP12ZPR4.jpg,BP12ZPR5.jpg,BP12ZPR6.jpg,BP12ZPR7.jpg,BP12ZPR8.jpg,BP12ZPR9.jpg
// // not used
function jaei_img_path($image) {

	$img_array = explode(",", $image);
	$img_loc = "http://www.moshly.co.uk/feeds/images/";
	$return_string = "";

	foreach ($img_array as $img) {
	     $return_string = $return_string . $img_loc . $img .",";
	}

	$return_string2 = rtrim($return_string, ",");

	return $return_string2;

}

// http://www.supercar.co.uk/ContentDelivery/VehicleImage.axd?OfficeId=1&VehicleId=605388223&View=1&Width=1500&Height=1000
function get_used_car_img_path($image, $id) {

	$img_array = explode(",", $image);
	$img_loc = "http://www.supercar.co.uk/ContentDelivery/VehicleImage.axd?OfficeId=1";
	$img_id =  "&VehicleId=" . $id;
	$img_number = "&View=";
	$img_width = "&Width=1200";
	$img_height = "&Height=801";
	$return_string = "";
	$img_count = 1;
	foreach ($img_array as $img) {
	     //$return_string = $return_string . $img_loc . $img_id . $img_number . $img_count . $img_width . $img_height . ",";
	     $return_string = $return_string . stristr($img, '&Width', true) . $img_width . $img_height . ",";
	     $img_count ++;
	}

	$return_string2 = rtrim($return_string, ",");

	return $return_string2;

}

// Split out options. use [jaei_car_options({options[1]})]
function jaei_car_options($txtoptions) {

	$options_array = explode(",", $txtoptions);
	$return_string = "<ul>";

	foreach ($options_array as $option) {
	     $return_string = $return_string . "<li>" . $option . "<li>";
	}

	$return_string = $return_string . "<\ul>";

	return $return_string;

}

function check_branch_import_number($dealer_id, $model) {
	
	if ($dealer_id == '3774906') { //check dealer is aldershot before sperating out ds branch
		if (substr( $model, 0, 2 ) === "DS") {
	    	$dealer_id = '19750607';
	    }
	}

    return $dealer_id;
}

function get_location_feed_id($dealer_id, $model) {
	$dealer_id = str_replace("_CS", "", "$dealer_id"); // manheim added _CS to end of feed id for comming soon 10/10/2016
	
	$dealer_id = check_branch_import_number($dealer_id, $model);
	//return $dealer_id;
	return $dealer_id;
}

// used in import to get location name from ID number
function get_location_string($dealer_id, $model) {
	$dealer_id = str_replace("_CS", "", "$dealer_id"); // manheim added _CS to end of feed id for comming soon 10/10/2016
	
	$dealer_id = check_branch_import_number($dealer_id, $model);
	//return $dealer_id;
	return get_location_name($dealer_id);
}

// Check if bodystyle is the list, if not substitue it for one of the options if its present
// [get_bodystyle({bodytype[1]})]
function get_bodystyle($x) {

  $return_val = $x;
  // loop through repeater ACF options from settings page used car filter (wp-admin/admin.php?page=acf-options-used-car-filter) 
  if (get_field('bodystyle_varients', 'option')) {
	  foreach(get_field('bodystyle_varients', 'option') as $arr) {

	    if (in_array($x, $arr, true)) {
	        $return_val = $arr['bodystyle_array'];
	    }
	  }
	 }

  if (strtolower($x) == 'unknown') {
  	$return_val = '';
  }

  return $return_val;
}

function get_ds_make($make, $model) {
	if ($make == 'Citroen') {
		if (substr( $model, 0, 2 ) === "DS") {
			$make = 'DS';
		} else {
			$make = '';
		}
	} else {
		$make = '';
	}

	return $make;
}

function get_ds_cat($make, $model, $cat) {
	if (get_ds_make($make, $model) === 'DS') {
		if ($cat == 'COMM') {
			return 'Van';
		} else {
			return 'Car';
		}
	} else {
		return '';
	}
}

function get_ds_model($make, $model) {
	if (get_ds_make($make, $model) === 'DS') {
		return $model;
	} else {
		return '';
	}
}


//////////////////////////////////////////////////////////////
//		Returns clean Model
//////////////////////////////////////////////////////////////
// find door within model name (3 door, 3-door, 5 Door, 5-Door .....)
function get_numerics ($str) {
  //  preg_match_all('/\b\d[- ][dD]oor\b/', $str, $matches);
        $ret = preg_replace('/\b\d[- ][dD]oor\b/', '', $str); //5 Door, 5-Door, 5 door, #-door
        $ret = preg_replace('/\b\d[- ][dD]r\b/', '', $ret); //5 dr, 5-dr
        $ret = preg_replace('/\b\d[- ][dD]r\b/', '', $ret);
        $ret = str_replace('  ', ' ', $ret);
        $ret = preg_replace('/\b[Nn][Ee][Ww] \b/', '', $ret);
        $ret = preg_replace('/\b[Vv]an\b/', '', $ret);
        $ret = str_replace('  ', ' ', $ret);
        return $ret;
}

// get clean model from: 5-door Captiva 5-Door Station Wagon 3 Door to: Captiva
// Uses values from Charters Misc admin settings
function get_clean_model($x, $model) {
	if ($x == 'Mini') {
		$return = 'Testing';
	} else {
		$return = $x;
	}
	
	$return = get_numerics($return);

	$bodyStyleArr = get_model_clean_filter();

	foreach ($bodyStyleArr as $body) {
	//	$return = str_replace($body, '', $return);
	//	$return = str_replace(strtolower($body), '', $return);
	}
	$return = str_replace('  ', ' ', $return);
	$return = str_replace('  ', ' ', $return);
	return $return;
}

//////////////////////////////////////////////////////////////
//		Returns unique id to allimport
//////////////////////////////////////////////////////////////
function haitch_unique_number() {
  return uniqid();
}

function return_stock_image($model) {
	//http://moshly.co.uk/stock-images/[return_stock_image({model[1]})]/[rand(1,6)].jpg
	$return_str = strtolower($model);
	$return_str = str_replace(' ', '-', $return_str);

	return $return_str;
}

function return_stock_image_url($image_url, $model) {

	

	if(empty($image_url)){
		
		$random_img_no = rand(1, 8);

		$model_str = strtolower($model);
		$model_str = str_replace(' ', '-', $model_str);

		$return_str = get_field('stock_image_location', 'option') . $model_str . '/' . $random_img_no . '.jpg';
	} else {
		$return_str = $image_url;
	}

	return $return_str;
}

/*
TITLE / EXCEPT???

if title is null

[C1] [Feel 3dr Vti 68 PureTech] for £[999] deposit and £[99] per month on [SimplyDrive/Elect 3/Hire Purchase....]
[C1] [Feel 3dr Vti 68 PureTech] from only a £[999] deposit on [SimplyDrive/Elect 3/Hire Purchase....]
[C1] [Feel 3dr Vti 68 PureTech] from only £[99] per month on [SimplyDrive/Elect 3/Hire Purchase....]
[C1] [Feel 3dr Vti 68 PureTech] for only £[9999]
Get a £[999] deposit contrabution for the [C1] [Feel 3dr Vti 68 PureTech]

Finance Lease / contract hire
[C1] [Feel 3dr Vti 68 PureTech] for an Initial Payment of £[999] and £[99] per month [(+VAT)]
[C1] [Feel 3dr Vti 68 PureTech] for an Initial Payment of £[99] [(exc VAT)]
[C1] [Feel 3dr Vti 68 PureTech] for only £[99] per month [(exc VAT)]
[C1] [Feel 3dr Vti 68 PureTech] for only £[] [(exc VAT)]

Motability
[C1] [Feel 3dr Vti 68 PureTech] with an Advance Paypemnt of £[]

SEO TITLE
SimplyDrive | £1999 deposit | £299 per month| Berlingo Multispace [trim]
Finance Lease | £299 monthly | Berlingo Multispace [trim]
Motability Offer | £1999 Advance Payment | Berlingo Multispace [trim]
[Title]


IMAGE NAME
[C1]-[Feel-3dr-Vti-68-PureTech]-£[]-deposit-£[]-per-month

SHORT DESCRIPTION
[TITLE] at [location]

DESCRIPTION
????


Yoast SEO custom fields
Name					Custom Field						Values
Focus Keyword			_yoast_wpseo_focuskw				Text string
SEO Title				_yoast_wpseo_title					Text string
Meta Description		_yoast_wpseo_metadesc				Text string
Meta Robots Index		_yoast_wpseo_meta-robots-noindex	Blank for default, 1 for noindex, or 2 for index
Meta Robots Follow		_yoast_wpseo_meta-robots-nofollow	Blank for follow, 1 for nofollow
Meta Robots Advanced	_yoast_wpseo_meta-robots-adv		Blank for default, none, noodp, noydir, noimageindex, noarchive, or nosnippet
Include in Sitemap		_yoast_wpseo_sitemap-include		Blank for auto, always, or never
Sitemap Priority		_yoast_wpseo_sitemap-prio			Blank for auto, 1 to .1
Canonical URL			_yoast_wpseo_canonical				Canonical URL of post
301 Redirect			_yoast_wpseo_redirect				URL to redirect post to
Facebook Title			_yoast_wpseo_opengraph-title		Text string
Facebook Description	_yoast_wpseo_opengraph				Text string
Facebook Image			_yoast_wpseo_opengraph-image		URL to image

TODO: on DS store make no index
*/




function get_offer_title($title, $make, $model, $trim, $offer_cat, $offer_type, $apr, $price, $deposit, $montly_payment, $deposit_contribution, $vat){
	$return_str = '';
	if (empty($title)) {
		
		$start_str = ''; //offer type
		$mid_str = ''; 	// discount values
		$end_str = ''; //make and trim

		$start_str = get_offer_string_part('', $model, '');
		$start_str .= get_offer_string_part(' ', $trim, '');

		if ($offer_cat == 'Motability Offers') {
			$mid_str = get_offer_string_part(' with an Advance Payment of £', get_deposit_str( $deposit ), '');
			$end_str = get_offer_string_part(' on ', $offer_type, '');
		} else  {
			

			if ($offer_cat == 'Business Offers') {
				$mid_str = get_offer_string_part(' for an Initial Payment of £', $deposit, '');
			} else {
				$mid_str = get_offer_string_part(' for £', $deposit, ' deposit');
			}

			if ($deposit != '' && $montly_payment != '' ) {
				$mid_str .= get_offer_string_part(' ', 'and', '');
			}
			
			$mid_str .= get_offer_string_part(' £', $montly_payment, ' per month');
			$mid_str .= get_offer_string_part(' for only £', $price, '');

			if ($vat) {
				$end_str = ' (+VAT) ';
			}
			
			if($price == '' || empty($price)) {
				$end_str .= get_offer_string_part( ' on ', $offer_type, '');
			}
			
		}

		if(isset($deposit_contribution) && $deposit_contribution != '') {
			$start_str = get_offer_string_part('Get a £', $deposit_contribution, ' deposit contribution on the');
			$mid_str = get_offer_string_part(' ', $model, '');
			$mid_str .= get_offer_string_part(' ', $trim, '');

		}

		$return_str = $start_str . $mid_str . $end_str; 
	} else {
		$return_str = $title;
	}

	return esc_html($return_str);
	
}
//[get_offer_title({title[1]},{make[1]},{model[1]},{trimlevel[1]}, {categoryofoffer[1]},{typeofoffer[1]},{apr[1]},{price[1]},{deposit[1]},{monthlypayment[1]},{ourdepositcontribution[1]},{vat[1]})]

function get_offer_short_description($title, $make, $model, $trim, $offer_cat, $offer_type, $apr, $price, $deposit, $montly_payment, $deposit_contribution, $vat) {
	$return_str = get_offer_title($title, $make, $model, $trim, $offer_cat, $offer_type, $apr, $price, $deposit, $montly_payment, $deposit_contribution, $vat);

	//$return_str .= ' at ' . get_offer_location();
	return esc_html($return_str);
}
//[get_offer_short_description({title[1]},{make[1]},{model[1]},{trimlevel[1]},{categoryofoffer[1]},{typeofoffer[1]},{apr[1]},{price[1]},{deposit[1]},{monthlypayment[1]},{ourdepositcontribution[1]},{vat[1]})]
//

function get_offer_seo_title($title, $make, $model, $trim, $offer_cat, $offer_type, $price, $deposit, $montly_payment, $deposit_contribution){
	$return_str = '';
	if (empty($title)) {
		
		$start_str = ''; //offer type
		$mid_str = ''; // discount values
		$end_str = ''; //make and trim

		if ($offer_cat == 'Motability Offers') {
			$start_str = get_offer_string_part('', $offer_type, ' Offer | ');
			$mid_str = get_offer_string_part('£', get_deposit_str( $deposit ), ' Advance Payment  | ');
		} else  {
			$start_str = get_offer_string_part('', $offer_type, ' | ');

			if ($offer_cat != 'Business Offers') {
				$mid_str = get_offer_string_part('£', $deposit, ' deposit | ');
			}
			
			$mid_str .= get_offer_string_part('£', $montly_payment, ' per month | ');
			$mid_str .= get_offer_string_part('£', $price, ' for a ');
		}

		if(isset($deposit_contribution) && $deposit_contribution != '') {
			$mid_str = get_offer_string_part('£', $deposit_contribution, ' deposit contribution on the ');
		}

		$end_str = get_offer_string_part('', $model, ' ');
		$end_str .= get_offer_string_part('', $trim, '');

		$return_str = $start_str . $mid_str . $end_str; 
	} else {
		$return_str = $title;
	}

	return esc_html($return_str);
}

//[get_offer_slug({title[1]},{make[1]},{model[1]},{trimlevel[1]}, {categoryofoffer[1]},{typeofoffer[1]},{price[1]},{deposit[1]},{monthlypayment[1]},{ourdepositcontribution[1]})]
function get_offer_slug($title, $make, $model, $trim, $offer_cat, $offer_type, $price, $deposit, $montly_payment, $deposit_contribution){
	$return_str = '';
	if (empty($title)) {
		
		$start_str = ''; //offer type
		$mid_str = ''; // discount values
		$end_str = ''; //make and trim

		if ($offer_cat == 'Motability Offers') {
			$start_str = get_offer_string_part('', $offer_type, ' Offer ');
			$mid_str = get_offer_string_part('£', get_deposit_str( $deposit ), ' Advance Payment ');
		} else  {
			$start_str = get_offer_string_part('', $offer_type, ' ');

			if ($offer_cat != 'Business Offers') {
				$mid_str = get_offer_string_part('£', $deposit, ' deposit ');
			}
			
			$mid_str .= get_offer_string_part('£', $montly_payment, ' per month ');
			$mid_str .= get_offer_string_part('£', $price, ' for a ');
		}

		if(isset($deposit_contribution) && $deposit_contribution != '') {
			$mid_str = get_offer_string_part('£', $deposit_contribution, ' deposit contribution ');
		}

		$end_str = get_offer_string_part('', $model, ' ');
		$end_str .= get_offer_string_part('', $trim, '');

		$return_str = $start_str . $mid_str . $end_str; 
	} else {
		$return_str = $title;
	}

	//clean url
	$remove = array('£','&','+',',','?');
	foreach ($remove as $str) {
		$return_str = str_replace($str,"", $return_str);
	}
	$return_str = str_replace("/","-", strtolower($return_str));
	$return_str = str_replace(" ","-", strtolower($return_str));

	return esc_html($return_str);
}

//[get_offer_seo_title({title[1]},{make[1]},{model[1]},{trimlevel[1]}, {categoryofoffer[1]},{typeofoffer[1]},{price[1]},{deposit[1]},{monthlypayment[1]},{ourdepositcontribution[1]})]

function get_offer_file_name($title, $make, $model, $trim, $offer_cat, $offer_type, $apr, $price, $deposit, $montly_payment, $deposit_contribution, $vat) {
	$return_str = get_offer_seo_title($title, $make, $model, $trim, $offer_cat, $offer_type, $price, $deposit, $montly_payment, $deposit_contribution);
	$return_str = strtolower( $return_str ); // lower case
	$return_str = preg_replace( '/[£|%_\-]/', '', $return_str ); //remove £, | and %
	$return_str = preg_replace( '/[^a-z0-9_\-]/', '-', $return_str ); // replace anything that isnt lowercase a-z or 0-9 to a -

	return sanitize_key($return_str); //sanitize_key just incase (shouldnt need to do anything but incase there are odd characters missed in the previous code)
}
//[get_offer_file_name({title[1]}, {make[1]}, {model[1]}, {trimlevel[1]}, {categoryofoffer[1]}, {typeofoffer[1]},{apr[1]},{price[1]},{deposit[1]},{monthlypayment[1]},{ourdepositcontribution[1]}, {vat[1]})]


// if this is buggie might need to run function at the end of post creation at get slug from created post instead
function get_canonical($url, $title, $make, $model, $trim, $offer_cat, $offer_type, $price, $deposit, $montly_payment, $deposit_contribution) {
	$return_str = '';

	if($url != ''){
		// validate url		
		$slug = get_offer_slug($title, $make, $model, $trim, $offer_cat, $offer_type, $price, $deposit, $montly_payment, $deposit_contribution);
		$url = filter_var($url, FILTER_SANITIZE_URL);

		if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
			//check if there is a slash at the end of url
			if (substr($url, -1) === '/') {
				$return_str = $url . $slug . '/' ;
			} else {
				$return_str = $url . '/' . $slug . '/';
			}
		} 
	}

	return $return_str;
}
//[get_canonical({canonical[1]} , {title[1]},{make[1]},{model[1]},{trimlevel[1]}, {categoryofoffer[1]},{typeofoffer[1]},{price[1]},{deposit[1]},{monthlypayment[1]},{ourdepositcontribution[1]})]


function get_noindex($url){
	$return_str = '';

	if($url != ''){
		// validate url		
		$url = filter_var($url, FILTER_SANITIZE_URL);

		if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
			$return_str = '1';		
		} 
	} else {
		$return_str = '2';
	}

	return $return_str;

}
//[get_noindex({canonical[1]})]

function get_offer_string_part($start, $str, $end){
	if (isset($str) && $str != '') {
		return $start . $str . $end;
	} else {
		return '';
	}
}

function get_true_false_value($val) {
	$return_str = false;
	if ($val == 'y' || $val== 'Y') {
		$return_str = true;
	}
	return $return_str;
}

function get_offer_location() {

	if( have_rows('shcms_branch_details', 'option') ) {

	    while( have_rows('shcms_branch_details', 'option') ) {
	    	the_row();
    		if (get_sub_field('shcms_website_base')) {
    			return get_sub_field('shcms_short_name');
    		}
	    }
	}
}

function get_deposit_str( $deposit ) {
	if ( $deposit == 0 ) {
		return 'Nil';
	} else {
		return $deposit;
	}
}






						
//[shcms_get_used_car_description({year[1]}, {make[1]}, {series[1]}, {series[1]}, {variant[1]}, {bodytype[1]}, {transmission[1]}, {mileage[1]}, {colour[1]}, {category[1]}, {fueltype[1]}, {price[1]}, {feed_id[1]}, {mpgcombined[1]}, {fourwheeldrive[1]}, {exdemo[1]}, {franchiseapproved[1]})]
function shcms_get_used_car_description($year, $make, $model, $series, $variant, $bodystyle, $transmission, $milleage, $colour, $cat, $fuel, $price, $dealer_id, $mpg, $fourwheel, $exdemo, $approved ) {
	$return_html = '';

	$model = get_clean_model($model);
	$bodystyle = get_bodystyle($bodystyle);
	$cat = ($cat === 'COMM') ? 'van' : 'car';
	//$dealer_id = check_branch_import_number($dealer_id, $model);
	$dealer_id = get_location_string($dealer_id, $model);
	$milleage = $milleage == '' ? '10' : $milleage;
	
	$replace 	= array($year, $make, $model, $series, $variant, strtolower($bodystyle), strtolower($transmission), $milleage, strtolower($colour), $cat, strtolower($fuel), $price, $dealer_id, $mpg);
	$str_fields = array('[YEAR]','[MAKE]','[MODEL]','[SERIES]','[VARIANT]','[BODYSTYLE]','[TRANSMISSION]','[MILLEAGE]','[COLOUR]','[CAT]','[FUEL]','[PRICE]','[DEALER]','[MPG]');

	$start_html = '<p>';
	$end_html = '</p>';

	$description = '';
	$description .= get_offer_string_part($start_html, get_field('product_description_text','option'), $end_html);

	if ($exdemo == 'Y') {
		$description .= get_offer_string_part($start_html, get_field('product_ex_demo_text','option'), $end_html);
	}
	if ($approved == 'Y') {
		$description .= get_offer_string_part($start_html, get_field('product_franchise_approved_text','option'), $end_html);
	}
	if ($mpg) {
		$description .= get_offer_string_part($start_html, get_field('product_mpg_text','option'), $end_html);
	}
	if ($fourwheel == 'Y') {
		$description .= get_offer_string_part($start_html, get_field('product_four_wheel_drive_text','option'), $end_html);
	}

	$return_html = str_replace($str_fields, $replace, $description );

	//$return_html = $description;
	return $return_html;
}

//[shcms_get_used_car_description({year[1]}, {make[1]}, {series[1]}, {series[1]}, {variant[1]}, {bodytype[1]}, {transmission[1]}, {mileage[1]}, {colour[1]}, {category[1]}, {fueltype[1]}, {price[1]}, {feed_id[1]}, {mpgcombined[1]})]
function shcms_get_used_car_short_description($year, $make, $model, $series, $variant, $bodystyle, $transmission, $milleage, $colour, $cat, $fuel, $price, $dealer_id, $mpg ) {
	$return_html = '';

	$model = get_clean_model($model);
	$bodystyle = get_bodystyle($bodystyle);
	$cat = ($cat === 'COMM') ? 'van' : 'car';
	//$dealer_id = check_branch_import_number($dealer_id, $model);
	$dealer_id = get_location_string($dealer_id, $model);
	$milleage = $milleage == '' ? '10' : $milleage;
	
	$replace 	= array($year, $make, $model, $series, $variant, strtolower($bodystyle), strtolower($transmission), $milleage, strtolower($colour), $cat, strtolower($fuel), $price, $dealer_id, $mpg);
	$str_fields = array('[YEAR]','[MAKE]','[MODEL]','[SERIES]','[VARIANT]','[BODYSTYLE]','[TRANSMISSION]','[MILLEAGE]','[COLOUR]','[CAT]','[FUEL]','[PRICE]','[DEALER]','[MPG]');

	$start_html = '<p>';
	$end_html = '</p>';

	$description = '';
	$description .= get_offer_string_part($start_html, get_field('product_description_text','option'), $end_html);

	$return_html = str_replace($str_fields, $replace, $description );

	//$return_html = $description;
	return $return_html;
}



//[shcms_get_used_car_seo_title({year[1]}, {make[1]}, {series[1]}, {variant[1]}, {price[1]}, {feed_id[1]})]
function shcms_get_used_car_seo_title($year, $make, $model, $variant, $price, $dealer_id ){
	//$dealer_id = check_branch_import_number($dealer_id, $model);
	$dealer_id = get_location_string($dealer_id, $model);
	$model = get_clean_model($model);

	$return_str = '';
	$return_str .= $year . ' ' . $make . ' ' . $model  . ' used car | £' . $price  . ' | ' . $dealer_id; 

	return esc_html($return_str);
}

//[shcms_get_used_car_seo_desc({year[1]}, {make[1]}, {series[1]}, {variant[1]}, {colour[1]}, {mileage[1]}, {price[1]}, {feed_id[1]})]
function shcms_get_used_car_seo_desc($year, $make, $model, $variant, $colour, $milleage, $price, $dealer_id ){
	//$dealer_id = check_branch_import_number($dealer_id, $model);
	$dealer_id = get_location_string($dealer_id, $model);
	$model = get_clean_model($model);

	$return_str = '';
	$return_str .= $year . ' ' . $colour  . ' ' . $make . ' ' . $model  .  ' ' . $variant . ' has ' . $milleage  . ' miles and is priced to sell: £' . $price . '. This vehicle and others are available on easy finance from ' . $dealer_id; 

	return esc_html($return_str);
}

//[shcms_get_used_car_slug({make[1]}, {series[1]}, {variant[1]}, {vehicle_id[1]})]
function shcms_get_used_car_slug($make, $model, $variant, $uc_id){
	$return_str = '';
	$model = get_clean_model($model);
	$return_str .= $make . '-' . $model  . '-' .  $variant . '-' . $uc_id; 

	//clean url
	$remove = array('£','&','+',',','?','.','/','<','>','(',')');
	foreach ($remove as $str) {
		$return_str = str_replace($str,"", $return_str);
	}
	$return_str = str_replace(" ","-", strtolower($return_str));
	$return_str = filter_var($return_str, FILTER_SANITIZE_URL);
	return esc_html($return_str);
}


//[shcms_get_used_car_canonical({make[1]}, {series[1]}, {variant[1]}, {feed_id[1]})]
// if this is buggie might need to run function at the end of post creation at get slug from created post instead
function shcms_get_used_car_canonical($make, $model, $variant, $dealer_id, $uc_id ) {
	$return_str = '';

	$dealer_id = check_branch_import_number($dealer_id, $model);

    if( have_rows('shcms_branch_details', 'option') ) {
        while( have_rows('shcms_branch_details', 'option') ) {
            the_row();
            if (get_sub_field('shcms_import_no') == $dealer_id) {

            	$url = get_sub_field('shcms_website_url_base');

            }           
        }           
    }

	if($url != ''){
		$slug = shcms_get_used_car_slug($make, $model, $variant, $uc_id);
		

		if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
			//check if there is a slash at the end of url
			if (substr($url, -1) === '/') {
				$return_str = $url . 'used-cars/' . $slug . '/' ;
			} else {
				$return_str = $url . '/used-cars/' . $slug . '/';
			}
		} 
		//$url = filter_var($url, FILTER_SANITIZE_URL);

	} 

	return $return_str;
}

function shcms_get_vat_value($vat) {
	$return_html = '';

	if($vat == '+ VAT') {
		$return_html = '+ VAT';
	}
	return $return_html;
}
//[shcms_get_vat_value({tradepriceextra[1]})]



function shcms_get_vat_boolean($vat) {
	$return_html = 0;

	if($vat == '+ VAT') {
		$return_html = 1;
	}
	return $return_html;
}



