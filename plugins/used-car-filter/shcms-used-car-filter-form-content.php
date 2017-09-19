<?php

/**
 * Sub Plugin Name: Used Car Filter
 *
 * This page holds all the form elements
 * $load = Make ID (passed from dropdown as ID) to load into the dropdown
 * Return Car Make Dropdown (wordpress dropdown)
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
function get_make_filters($load){

   if( empty( $load ) ) { //if $load has no value
        $load = 0;
    } else {
        //should really add some validation
        if( !is_int( $load ) ) {
            if( !ctype_digit( $load ) ) {
                $load = 0;
            }
        }
    }

    $args = array(
                    'show_option_all'    => 'Any Make',
                    'show_option_none'   => '',
                    'option_none_value'  => '-1',
                    'orderby'            => 'NAME', 
                    'order'              => 'ASC',
                    'show_count'         => 1,
                    'hide_empty'         => 1, 
                    'echo'               => 0,
                    'selected'           => $load,
                    'hierarchical'       => 1, // used for depth
                    'depth'              => 1, // Shows only 1st parents (root) of hierarchical
                    'name'               => 'makedd',
                    'id'                 => 'makedd',
                    'class'              => 'form-control',
                    'tab_index'          => 0,
                    'taxonomy'           => 'product_cat',
                    'hide_if_empty'      => false,
                    'value_field'        => 'term_id'
                    );

    $filters_html = wp_dropdown_categories( $args);

    return $filters_html; 
}
*/

function get_make_model_tax(){
    return $categories = get_terms( 'product_cat', array('orderby' => 'NAME', 'order' => 'ASC' ) );
}

//function get_make_model_tax2($parent){
    //return $categories = get_terms( 'product_cat', array('orderby'    => 'count', ) );
//     $categories = get_terms( 'product_cat', array('parent' => $parent  ));
 //    return  $categories;
//}



// This function is used only on first load (I think) The dynmic loading is done via ajax in shcms-used-car-filter.php and equilivant js file
/*function get_model_filter($load){
    $filter_html = '';
    if( empty( $load ) ) { //if $load has no value
        $filter_html = '<option value="0">Any Models</option>';
    } else {
        $cat = get_cat_name( $load );
        $filter_html = '<option value="' . $load . '">' . $cat . '</option>';
    }

    return $filter_html;
}
*/


function get_min_price_filter($load){
    $filter_html = '';
    if( empty( $load ) ) { //if $load has no value
        $load = 0;
    } else {
        if( !is_int( $load ) ) {
            if( !ctype_digit( $load ) ) {
                $load = 0;
            }
        }
    }

    $max_price = 40000;
    $display = '';

    for ($i = 0; $i <= $max_price; $i = $i + 1000) {
        $display = '£' . $i;
        if ($i == 0) {
            $display = 'Any Min. Price';
        }

        if( $load == $i) {
            $filter_html = $filter_html . '<option selected value="' . $i . '">' . $display . '</option>';
        } else {
            $filter_html = $filter_html . '<option value="' . $i . '">' . $display . '</option>';
        }
    }

    return $filter_html;
}



function get_max_price_filter($load){

    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 0;

    } else {

        if( !is_int( $load ) ) {

            if( !ctype_digit( $load ) ) {

                $load = 0;

            }

        }

    }



    $max_price = 45000;

    $display = '';



    for ($i = 0; $i <= $max_price; $i = $i + 1000) {

        $display = '£' . $i;

        $val = $i;

        if ($i == 0) {

            $display = 'Any Max. Price';

            $val = 1000000;

        }



        if( $load == $i) {

            $filter_html = $filter_html . '<option selected value="' . $val . '">' . $display . '</option>';



        } else {

            $filter_html = $filter_html . '<option value="' . $val . '">' . $display . '</option>';

        }



    }

    return $filter_html;

}



function get_loc_filter($load){



    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $filter_html = '<option value="any" selected>Any Location</option>';

        foreach ( get_location_array() as $loc ) {

                            $filter_html = $filter_html . '<option value="' . $loc[1] . '">' . $loc[1] . '</option>';

        }

    } else {

        $filter_html = '<option value="any" >Any Location</option>';

        foreach ( get_location_array() as $loc ) {

            $filter_html = $filter_html . '<option ';

            if($load == $loc[1]){

                $filter_html = $filter_html . 'selected ';

            }

             $filter_html = $filter_html . 'value="' . $loc[1] . '">' . $loc[1] . '</option>';

        }

    }

    return $filter_html;

}



function get_mileage_filter($load){

    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 1000000;

    } else {

        if( !is_int( $load ) ) {

            if( !ctype_digit( $load ) ) {

                $load = 1000000;

            }

        }

    }



    $filter_html = $filter_html . '<option value="1000000">Any Mileage</option>';

    $filter_html = $filter_html . '<option value="1000">Up to 1,000</option>';

    $filter_html = $filter_html . '<option value="5000">Up to 5,000</option>';

    $filter_html = $filter_html . '<option value="10000">Up to 10,000</option>';

    $filter_html = $filter_html . '<option value="20000">Up to 20,000</option>';

    $filter_html = $filter_html . '<option value="30000">Up to 30,000</option>';

    $filter_html = $filter_html . '<option value="40000">Up to 40,000</option>';

    $filter_html = $filter_html . '<option value="50000">Up to 50,000</option>';

    $filter_html = $filter_html . '<option value="75000">Up to 75,000</option>';

    $filter_html = $filter_html . '<option value="100000">Up to 100,000</option>';



        $return_html = str_replace('"' . $load . '"','"' . $load . '" selected',$filter_html);

    

    return $return_html;

}



function get_age_filter($load){

    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 'all';

    } else {

        if( !is_int( $load ) ) {

            if( !ctype_digit( $load ) ) {

                if (!$load == 'over') {

                    $load = 'all';

                }

            }

        }

    }



    $filter_html = $filter_html . '<option value="all">Any Age</option>';

    $filter_html = $filter_html . '<option value="1">Up to 1 Year</option>';

    $filter_html = $filter_html . '<option value="2">Up to 2 Years</option>';

    $filter_html = $filter_html . '<option value="3">Up to 3 Years</option>';

    $filter_html = $filter_html . '<option value="4">Up to 4 Years</option>';

    $filter_html = $filter_html . '<option value="5">Up to 5 Years</option>';

    $filter_html = $filter_html . '<option value="over">Over 5 Years</option>';



        $return_html = str_replace('"' . $load . '"','"' . $load . '" selected',$filter_html);

    

    return $return_html;

}



function get_engine_from_filter($load){

    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 0;

    } else {

        if( !is_int( $load ) ) {

            if( !ctype_digit( $load ) ) {

                    $load = 0;

            }

        }

    }

   

    $filter_html = $filter_html . '<option value="0">Engine Size From</option>';

    $filter_html = $filter_html . '<option value="900">1.0 litre</option>';

    $filter_html = $filter_html . '<option value="1197">1.2 litre</option>';

    $filter_html = $filter_html . '<option value="1396">1.4 litre</option>';

    $filter_html = $filter_html . '<option value="1560">1.6 litre</option>';

    $filter_html = $filter_html . '<option value="1760">1.8 litre</option>';

    $filter_html = $filter_html . '<option value="1997">2.0 litre</option>';

    $filter_html = $filter_html . '<option value="2497">2.5 litre</option>';

    $filter_html = $filter_html . '<option value="2900">3.0 litre</option>';

    $filter_html = $filter_html . '<option value="3900">4.0 litre</option>';



    $return_html = str_replace('"' . $load . '"','"' . $load . '" selected',$filter_html);



    return $return_html;

}



function get_engine_to_filter($load){

    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 10000;

    } else {

        if( !is_int( $load ) ) {

            if( !ctype_digit( $load ) ) {

                    $load = 10000;

            }

        }

    }

   

    $filter_html = $filter_html . '<option value="10000">Engine Size To</option>';

    $filter_html = $filter_html . '<option value="900">1.0 litre</option>';

    $filter_html = $filter_html . '<option value="1197">1.2 litre</option>';

    $filter_html = $filter_html . '<option value="1396">1.4 litre</option>';

    $filter_html = $filter_html . '<option value="1560">1.6 litre</option>';

    $filter_html = $filter_html . '<option value="1760">1.8 litre</option>';

    $filter_html = $filter_html . '<option value="1997">2.0 litre</option>';

    $filter_html = $filter_html . '<option value="2497">2.5 litre</option>';

    $filter_html = $filter_html . '<option value="2900">3.0 litre</option>';

    $filter_html = $filter_html . '<option value="3900">4.0 litre</option>';



        $return_html = str_replace('"' . $load . '"','"' . $load . '" selected',$filter_html);



    return $return_html;

}



function get_fuel_filter($load){

    $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 'any';

    }

    $filter_html = $filter_html . '<option value="any">Any Fuel Type</option>';

    $filter_html = $filter_html . '<option value="Petrol">Petrol</option>';

    $filter_html = $filter_html . '<option value="Diesel">Diesel</option>';

    $filter_html = $filter_html . '<option value="Hybrid">Hybrid</option>';

    $filter_html = $filter_html . '<option value="Electric">Electric</option>';



    $return_html = str_replace('"' . $load . '"','"' . $load . '" selected',$filter_html);



    return $return_html;

}



function get_transmission_filter($load){

  $filter_html = '';

    if( empty( $load ) ) { //if $load has no value

        $load = 'any';

    } 

    $filter_html = $filter_html . '<option value="any">Any Transmission</option>';

    $filter_html = $filter_html . '<option value="manual">Manual</option>';

    $filter_html = $filter_html . '<option value="automatic">Automatic</option>';





        $return_html = str_replace('"' . $load . '"','"' . $load . '" selected',$filter_html);



    return $return_html;

}



// passes an array of checked checkboxes

function get_bodystyle_filter($load){

    

   $bodystyle = array( array( 'id' => 'hatchback',  'check' => 0, 'title' => 'Hatchback') ,

                       array( 'id' => 'estate',     'check' => 0, 'title' => 'Estate') ,

                       array( 'id' => 'saloon',     'check' => 0, 'title' => 'Saloon') ,

                       array( 'id' => 'coupe',      'check' => 0, 'title' => 'Coupe') ,

                       array( 'id' => 'convertible','check' => 0, 'title' => 'Convertible') ,

                       array( 'id' => 'mpv',        'check' => 0, 'title' => 'MPV') ,

                       array( 'id' => 'suv',        'check' => 0, 'title' => 'SUV / 4x4') ,

                       array( 'id' => 'van',        'check' => 0, 'title' => 'Van') 

                       );



   $filter_html = '';



    // Lowercase all checked Body styles

    // & is a reference
if (is_array($load) || is_object($load)) {
    
    if (strtolower($load[0]) == 'car') {
        $load = array('Hatchback','Estate','Saloon','Coupe','Convertible','MPV','SUV');
    }

    foreach ($load as &$val) {

        $val = strtolower($val);

    }

    unset($val);

    foreach ($bodystyle as &$arr  ) {

      //  echo 'CHECK = id:' . $arr['id'] . ' | check:' . $arr['check'] . ' | title: ' . $arr['title'] . '<br>';

        if(in_array ( $arr['id'] , $load , FALSE) ) {

                $arr['check'] = 1;

        }

    }

    unset($arr);
}
    

 //print_r($bodystyle);

    $checked = '';

    $checkedcss = '';

    $count = 0;

    foreach( $bodystyle as $style) {



        if($style['check'] == 1 ) {

            $checked = 'checked="checked"';

            $checkedcss = $style['id'] . '-icon-ch';

        }



        $filter_html = $filter_html . '<div id="' . $style['id'] . '-icon" title="' . $style['title'] . '" class="image-checkbox-container">';

        $filter_html = $filter_html . '<input type="checkbox" name="bodystylemcb[]" id="bodystylemcb-' . $count . '" value="' . $style['title'] . '" ' . $checked . '>';

        $filter_html = $filter_html . '<div class="' . $style['id'] . '-icon bodystyle-checkbox ' . $checkedcss . '"><div class="checkbox-title">' . $style['title'] . '</div></div>';

        $filter_html = $filter_html . '</div>';

        $count++;

        $checked = '';

        $checkedcss = '';

    }



    return $filter_html; 



}



// passes an array of checked checkboxes

function get_colour_filter($load){



    $colours = array( array( 'id' => 'blue',       'check' => 0, 'title' => 'Blue') ,

                       array( 'id' => 'red',        'check' => 0, 'title' => 'Red') ,

                       array( 'id' => 'orange',     'check' => 0, 'title' => 'Orange') ,

                       array( 'id' => 'yellow',     'check' => 0, 'title' => 'Yellow') ,

                       array( 'id' => 'green',      'check' => 0, 'title' => 'Green') ,

                       array( 'id' => 'purple',     'check' => 0, 'title' => 'Purple') ,

                       array( 'id' => 'pink',       'check' => 0, 'title' => 'Pink') ,

                       array( 'id' => 'black',      'check' => 0, 'title' => 'Black'),

                       array( 'id' => 'brown',      'check' => 0, 'title' => 'Brown'),

                       array( 'id' => 'grey',       'check' => 0, 'title' => 'Grey'),

                       array( 'id' => 'white',      'check' => 0, 'title' => 'White'),

                       array( 'id' => 'silver',     'check' => 0, 'title' => 'Silver'),

                       );



   $filter_html = '';



    // Lowercase all checked Body styles

    // & is a reference
if (is_array($load) || is_object($load)) {
    foreach ($load as &$val) {

        $val = strtolower($val);

    }
}
    unset($val);

 //print_r($load);
if (is_array($load) || is_object($load)) {
    foreach ($colours as &$arr  ) {

      //  echo 'CHECK = id:' . $arr['id'] . ' | check:' . $arr['check'] . ' | title: ' . $arr['title'] . '<br>';

        if(in_array ( $arr['id'] , $load , FALSE) ) {

                $arr['check'] = 1;

        }

    }
}
    unset($arr);

 //print_r($colours);

    

    $count = 0;

    foreach( $colours as $colour) {



        if($colour['check'] == 1 ) {

            $checked = 'checked="checked"';

            $checkedcss = $colour['id'] . '-icon-ch';

        } else {
            $checked = '';
            $checkedcss = '';
        }



        $filter_html = $filter_html . '<div id="' . $colour['id'] . '-icon" title="' . $colour['title'] . '" class="image-checkbox-container">';

        $filter_html = $filter_html . '<input type="checkbox" name="colourmcb[]" id="colourmcb-' . $count . '" value="' . $colour['title'] . '" ' . $checked . '>';

        $filter_html = $filter_html . '<div class="' . $colour['id'] . '-icon ' . $checkedcss . '"></div>';

        $filter_html = $filter_html . '</div>';

        $count++;

        $checked = '';

        $checkedcss = '';



    }



    return $filter_html;



}



function get_options_filter($load){



   $options = array(   array( 'id' => 'Cruise Control',  'check' => 0, 'title' => 'Cruise Control') ,

                       array( 'id' => 'Sat Nav',         'check' => 0, 'title' => 'Sat Nav') ,

                       array( 'id' => 'Bluetooth',       'check' => 0, 'title' => 'Bluetooth') ,

                       array( 'id' => 'Leather',         'check' => 0, 'title' => 'Leather') ,

                       array( 'id' => 'Alloy Wheels',    'check' => 0, 'title' => 'Alloy Wheels') ,

                       array( 'id' => 'Parking Sensors', 'check' => 0, 'title' => 'Parking Sensors') ,

                       array( 'id' => 'Air Conditioning','check' => 0, 'title' => 'Air Conditioning') ,

                       array( 'id' => 'MP3',             'check' => 0, 'title' => 'MP3'),

                       );



   $filter_html = '';



   // Lowercase all checked Body styles

   // & is a reference

   // foreach ($load as &$val) {

   //     $val = strtolower($val);

   // }

 //print_r($load);
if (is_array($load) || is_object($load)) {
    foreach ($options as &$arr  ) {

      //  echo 'CHECK = id:' . $arr['id'] . ' | check:' . $arr['check'] . ' | title: ' . $arr['title'] . '<br>';

        if(in_array ( $arr['id'] , $load , FALSE) ) {

                $arr['check'] = 1;

        }

    }
}
    unset($arr);

 //print_r($options)

    $count = 0;

    foreach( $options as $option) {



        if($option['check'] == 1 ) {

            $checked = 'checked';

        } else {
            $checked = '';
        }



        $filter_html = $filter_html . '<label for="optionsmcb-' . $count . '" class="checkbox-inline ' . $checked . '">';

        $filter_html = $filter_html . '<input type="checkbox" name="optionsmcb[]" id="optionsmcb-' . $count . '" value="' . $option['id'] . '" ' . $checked . ' />';

        $filter_html = $filter_html . $option['id'];

        $filter_html = $filter_html . '</label>';

        $count++;

        $checked = '';



    }



    return $filter_html; 



}



function get_doors_filter($load){

   $doors =   array(   array( 'id' => '2',    'check' => 0, 'title' => '2') ,

                       array( 'id' => '3',    'check' => 0, 'title' => '3') ,

                       array( 'id' => '4',    'check' => 0, 'title' => '4') ,

                       array( 'id' => '5',    'check' => 0, 'title' => '5') ,

                       );



   $filter_html = '';


if (is_array($load) || is_object($load)) {
    foreach ($load as &$door  ) {

       if( empty( $door ) ) { //if $load has no value

            $door = 0;

        } else {

            //should really add some validation

            if( !is_int( $door ) ) {

                if( !ctype_digit( $door ) ) {

                    $door = 0;

                }

            }

        }

    }
}


if (is_array($load) || is_object($load)) {
   foreach ($doors as &$door  ) {

      //  echo 'CHECK = id:' . $arr['id'] . ' | check:' . $arr['check'] . ' | title: ' . $arr['title'] . '<br>';

        if(in_array ( $door['id'] , $load , FALSE) ) {

                $door['check'] = 1;

        }

    }
}

    unset($door);



    $count = 2;

    foreach( $doors as $door) {



        if($door['check'] == 1 ) {

            $checked = 'checked';

        } else {
            $checked = '';
        }



        $filter_html = $filter_html . '<label for="doorsmcb-' . $count . '" class="checkbox-inline ' . $checked . '">';

        $filter_html = $filter_html . '<input type="checkbox" name="doorsmcb[]" id="doorsmcb-' . $count . '" value="' . $door['id'] . '" ' . $checked . ' />';

        $filter_html = $filter_html . $door['id'];

        $filter_html = $filter_html . '</label>';

        $count++;

        $checked = '';

    }



    return $filter_html; 

}

/**
 * Get updated make and model terms list with extra data on each term, This makes creating the filtering system easier 
 * new fields added
 * [type] => Car or Van
 * [has_cars] => 1 or 0 (true or false)
 * [has_vans] => 1 or 0 (true or false)
 * @return [WP_Object] [returns an object very similar to WP_Terms]
 */
function shcms_get_updated_terms_for_filter(){

  delete_transient( 'shcms_updated_make_model_terms' );
  if ( false === ( $base_cats = get_transient( 'shcms_updated_make_model_terms' ) ) ) {

    $args = array(
                    'taxonomy'           => 'product_cat',
                    'orderby'            => 'menu_order', 
                    'order'              => 'ASC',
                    //'child_of'           => $child_of, 
                    //'parent'             => '0',
                    //'hierarchical'       => 1, // used for depth
                    'hide_if_empty'      => false,
                    );

    $base_cats = get_terms(  $args  );

    

    foreach ($base_cats as $cats) {
      if ($cats->parent != 0) {
        $type = shcms_is_term_car_or_van($cats);
        $cats->type = $type;
      } else {
        $cats->type = 'manufacturer';
      }
    }

    foreach ($base_cats as $cats2) {
      if ($cats2->parent == 0) {
       $car_van = shcms_does_manufacturer_have_vans_or_cars($base_cats, $cats2->term_id); //citroen id

          if ($car_van['cars'] == 1) {
            $cats2->has_cars = 1;
          } else {
            $cats2->has_cars = 0;
          }

          if ($car_van['vans'] == 1) {
            $cats2->has_vans = 1;
          } else {
            $cats2->has_vans = 0;
          }

         // $cats2->car_count = $car_van['car_count'];
         // $cats2->van_count = $car_van['van_count'];
      } 
    }

   // echo '<Pre>';
   // print_r($base_cats);
   // echo '</pre>';

    // Put the results in a transient. Expire after 12 hours.
    set_transient( 'shcms_updated_make_model_terms', $base_cats, 60*60*12 );
  } 

  return $base_cats;
}

/**
 * Get a list of updated makes only (with additional fields)
 * @param  [Object] $terms [Updated WP_Terms object]
 * @return [Object]        [Returns an array of Updated WP_Terms that are only makes (parent = 0)]
 */
function shcms_get_updated_term_manufactures($terms) {
  delete_transient( 'shcms_updated_make_only_terms' );
  if ( false === ( $manufacturers = get_transient( 'shcms_updated_make_only_terms' ) ) ) {

    foreach ($terms as $term) {
      if ($term->parent == 0) {
        $manufacturers[] = $term;
      }
    }
    set_transient( 'shcms_updated_make_only_terms', $manufacturers, 60*60*12 );
  } 

  return $manufacturers; 
}

function shcms_is_term_car_or_van($name) {
  $terms = get_terms(array( 'taxonomy' => 'vehical_makes_and_models', 'name' => $name));
    
    foreach ($terms as $term) {
      $name = get_term_by( 'id', $term->parent, 'vehical_makes_and_models' );

      if ($name->name != 'Car' && $name->name != 'Van') {
        $name = get_term_by( 'id', $name->parent, 'vehical_makes_and_models' );
      }
    }
  return $name->name;
}

function shcms_does_manufacturer_have_vans_or_cars($terms, $id) {
    $contains_vans = false;
    $contains_cars = false;
   // $car_count = 0;
   // $van_count = 0;
    
    foreach ($terms as $term) {
      
      if ($term->parent == $id) {
       // echo '<br>name: ' . $term->name . ' | Type: ' . $term->type;
        if ($term->type == 'Car') {
          $contains_cars = true;
          //$car_count ++;
        } elseif ($term->type == 'Van') {
          $contains_vans = true;
          //$van_count ++;
        }
      }   
    }

    return array('cars' => $contains_cars, 'vans' => $contains_vans);
}