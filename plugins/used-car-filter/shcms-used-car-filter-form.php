<?php

/**
 * Sub Plugin Name: Used Car Filter
 *
 * This page holds the filter form structure only
 * All elements in form are created in shcms-used-car-filter-form-content.php
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$base_style = '';
$custom_style = '';
$classes = '';

$pt = sh_get_post_type();
if (is_front_page()) {
  $custom_style = get_field('sh_uc_filter_home_page_filter_style','options');
  $style_vars = get_filter_style($custom_style);
} elseif (is_shop()) {
  $custom_style = get_field('sh_uc_filter_used_car_archive_style','options');
  $style_vars = get_filter_style($custom_style);
} elseif (is_product()) {
  $custom_style = get_field('sh_uc_filter_used_car_product_filter_style','options');
  $style_vars = get_filter_style($custom_style);
} elseif ($pt == 'sh_new_offer_') {
  $custom_style = get_field('sh_uc_filter_offer_filter_style','options');
  $style_vars = get_filter_style($custom_style);
} elseif ( $pt == 'sh_new_car_' || $pt == 'sh_new_van_' ) {

  if (is_post_type_archive( array('sh_new_car', 'sh_new_van'  ) ) ) {
     $custom_style = get_field('sh_uc_filter_general_filter_style','options');
     $style_vars = get_filter_style($custom_style);
  } else {
     $custom_style = get_field('sh_uc_filter_car_van_filter_style','options');
     $style_vars = get_filter_style($custom_style);
  }
  
} else {
  $custom_style = get_field('sh_uc_filter_general_filter_style','options');
  $style_vars = get_filter_style($custom_style);
}

// echo '<pre> ';
// echo 'pt' . $pt;
// print_r($style_vars);
// echo '</pre>';


// Check if we need to display filter form
if ($custom_style != 'none') : 

  include_once('shcms-used-car-filter-form-content.php');
  $results_page = woocommerce_get_page_id( 'shop' );


  $base_style = $style_vars['base_style'];

  if ($style_vars['btn_adv_pos'] == 'right') {
    $right_btn = '<button type="button"  value="adv-search" id="adv-search" name="adv-search" class="btn btn-adv"><i class="fa fa-angle-down" aria-hidden="true" style="
      font-size: 2.5em;"></i></button>';
    $right_btn_bottom = '<button type="button"  value="adv-search-bottom" id="adv-search-bottom" name="adv-search-bottom" class="btn btn-adv"><i class="fa fa-angle-down" aria-hidden="true" style="font-size: 2.5em;"></i></button>';
  }

  switch($base_style){
    case 'full_width':
      $classes = 'full-width';
      break;
    case 'fixed_width':
      $classes = 'fixed-width';
      $style_vars['open'] = true;
      break;
    case 'fixed_width_overlay':
      $classes = 'fixed-width-overlay';
      $style_vars['open'] = true;
      break;
  }

  if ($style_vars['open']) {
    $draw_arrows = 'fa-angle-double-up';
  } else {
    $draw_arrows = 'fa-angle-double-down';
  }

  if ($style_vars['shadow']) {
    $shadowcss = array('0px 6px 26px rgba(0,0,0,0.5)','0px 6px 26px -5px rgba(0,0,0,0.5)');
  }




//  $shcms_terms = shcms_get_updated_terms_for_filter();
//  $shcms_manufactures = shcms_get_updated_term_manufactures($shcms_terms);
  
 // echo '<pre>POST: ';
 // print_r($_POST);
 // echo '</pre>';

 // echo '<pre>POST: ';
 // print_r( $shcms_manufactures);
 // echo '</pre>';
if ( isset( $_GET['make'] ) ) {
  if ($_GET['make'] != '') {
    $load_make = get_term_id_from_slug($_GET['make'], 'product_cat');
  } else {
    $load_make = "''";
  }
} else {
  $load_make = "''";
}

if ( isset( $_GET['model'] ) ) {
  if ($_GET['model'] != '') {
    $load_model = get_term_id_from_slug($_GET['model'], 'product_cat');
  } else {
    $load_model = "''";
  }
} else {
  $load_model = "''";
}

if ( isset( $_GET['bodystyle'] ) ) {
  if ($_GET['bodystyle'] != '') {
    $body_var = explode(',', $_GET['bodystyle']);
  } else {
    if ( isset( $_POST['bodystylemcb'] ) ) {
      if ($_POST['bodystylemcb'] != '') {
        $body_var = $_POST['bodystylemcb'];
      } else {
        $body_var = array();
      }
    }
  }
} else {
    if ( isset( $_POST['bodystylemcb'] ) ) {
      if ($_POST['bodystylemcb'] != '') {
        $body_var = $_POST['bodystylemcb'];
      } else {
        $body_var = array();
      }
    }
}

if ( isset( $_GET['mileage'] ) ) {
  if ($_GET['mileage'] != '') {
    $mileage_var = $_GET['mileage'];
  } else {
    if ( isset( $_POST['mileagedd'] ) ) {
      if ($_POST['mileagedd'] != '') {
        $mileage_var = $_POST['mileagedd'];
      }
    }
    
  }
} else {
  if ( isset( $_POST['mileagedd'] ) ) {
      if ($_POST['mileagedd'] != '') {
        $mileage_var = $_POST['mileagedd'];
      }
    }
}

if ( isset( $_GET['age'] ) ) {
  if ($_GET['age'] != '') {
    $age_var = $_GET['age'];
  } else {
    
    if ( isset( $_POST['agedd'] ) ) {
      if ($_POST['agedd'] != '') {
        $age_var = $_POST['agedd'];
      }
    }
  }
} else {
   if ( isset( $_POST['agedd'] ) ) {
      if ($_POST['agedd'] != '') {
        $age_var = $_POST['agedd'];
      }
    }
}

//$loaded_car_or_van


shcms_get_updated_terms_for_filter();

if ( isset( $shadowcss ) ) { ?>
  <style>
    /* leave on this page as no identifier on #intro to determin css class*/
    #intro {
      box-shadow: <?php echo $shadowcss[0]; ?>;
    }
  </style> 
<?php } ?>

    <script>

          var termFromPHP = <?php echo json_encode(shcms_get_updated_terms_for_filter()); ?>;
          var termMakeFromPHP = <?php echo json_encode(shcms_get_updated_term_manufactures(shcms_get_updated_terms_for_filter())); ?>;

          var load_data = <?php echo json_encode($_POST); ?>;
          var load_make = <?php echo $load_make; ?>;
          var load_model = <?php echo $load_model; ?>;
          var load_body = <?php echo json_encode( (isset($body_var) ? $body_var : '') ); ?>;

    </script>

    <?php 
  

  /*if ($_POST['makedd'] == '') {
    echo '1 ';
    $make_var = $_GET['make'];
  } else {
    echo '2 ';
    $make_var = $_POST['makedd'];
  }

  if ($_POST['bodystylemcb'] == '') {
    $body_var = explode(',', $_GET['body']);
  } else {
    $body_var = $_POST['bodystylemcb'];
  }*/


  //echo '<pre>POST: ';
  //print_r($_POST);
  //echo '</pre>';

  //echo '<pre>GET: ';
  //print_r($_GET);
  //echo '</pre>';

 // echo '<pre>REQUEST: ';
 // print_r($_REQUEST);
 /// echo '</pre>';

 //  echo '<pre>make: ';
 // echo $make_var;
 // echo ' | body: ';
 // echo $body_var;
 // echo '</pre>';
  ?>

    <div id="filter-form-container" class="container-fluid filter-form-container <?php echo $classes ?> <?php echo $custom_style; ?> clear">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <form id="filter-form" action='<?php echo get_permalink($results_page); ?>#results' method="POST">
              <div id="header-filter">

                <div class="container-fluid">
                  <!-- border -->
                  <div class="row">
                    <h2 class="col-md-12 filter-title"><?php echo $style_vars['title']; ?></h2>
                  </div>
                  <div class="row">

                    <div id="select-options" class="col-lg-12 col-md-12 col-sm-12 nopadding">

                      <div class="col-md-2">
                        <div class="btn-group car-van-toggle">
                         
                          <button type="button" id="uc-car-toggle" class="btn btn-md active btn-primary-col">Cars</button>
                          <button type="button" id="uc-van-toggle" class="btn btn-md btn-default">Vans</button>
                          <input type="hidden" id="car_van_hid" name="car_van_hid" value="">
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-2">
                        <select id="makedd" name="makedd" class="form-control">
                        <?php //echo 'makedd: ' . $_POST['locationdd']; ?>
                        <?php //echo get_make_filters($make_var); ?>
                        </select>
                        <input type="hidden" id="makedd-hid" name="makedd-hid" value="">
                      </div>


                      <div id="model-result" class="col-sm-6 col-md-2">

                        <select id="modeldd" name="modeldd" class="form-control">

                                 <?php
                                 // now loaded via javascript in file shcms-used-car-filter-form
                                 // echo get_model_filter($_POST['modeldd']); 
                                 ?>

                        </select>
                        <input type="hidden" id="modeldd-hid" name="modeldd-hid" value="">
                      </div>


                      <div class="col-sm-6 col-md-2">

                        <select id="minpricedd" name="minpricedd" class="form-control">

                                 <?php echo get_min_price_filter( (isset($_POST['minpricedd']) ? $_POST['minpricedd'] : '') ); ?>

                              </select>

                      </div>


                      <div class="col-sm-6 col-md-2">

                        <select id="maxpricedd" name="maxpricedd" class="form-control">

                                 <?php echo get_max_price_filter( (isset($_POST['maxpricedd']) ? $_POST['maxpricedd'] : '') ); ?>

                              </select>

                      </div>

                      

                      <div class="col-sm-12 col-md-2 right">

                        <?php
                                  // if page is results page load just a button, if not type is submit to load the form
                                  if ( is_shop() ) {

                                     echo '<button type="button"  value="Filter" id="filterbtn" name="filterbtn" class="btn btn-primary-col">'  . $style_vars['btn_txt'] . '</button>' .  ( (isset($right_btn) ? $right_btn : '') );

                                  } else {

                                      echo '<button type="submit"  value="Filter" id="filterbtnremote" name="filterbtnremote" class="btn btn-primary-col">'  . $style_vars['btn_txt'] . '</button>' . ( (isset($right_btn) ? $right_btn : '') );

                                  }



                            ?>


                      </div>

                    </div>

                  </div>

                </div>

              </div>

              


              <div id="body-filter">

                <div class="col-full container-fluid">
                  <!-- border -->

                  <div class="row">

                    <div id="select-options" class="col-lg-5 col-md-5 col-sm-6">
                      
                      <label class="control-label" for="doorsmcb">Location</label>
                      <div class="row">
                        <div class="col-md-12">
                        <select id="locationdd" name="locationdd" class="form-control">

                                  <?php echo get_loc_filter( (isset($_POST['locationdd']) ? $_POST['locationdd'] : '') );

                             ?>

                              </select>
                              </div>

                      </div>

                      <label class="control-label" for="checkboxes">Options</label>

                      <div class="row">


                        <div class="col-md-6 col-sm-12">


                          <select id="mileagedd" name="mileagedd" class="form-control">

                                      <?php //echo get_mileage_filter($_POST['mileagedd']); ?>
                                      <?php echo get_mileage_filter( (isset($mileage_var) ? $mileage_var : '') ); ?>
                                      

                              </select>

                        </div>

                        <div class="col-md-6 col-sm-12">

                          <select id="agedd" name="agedd" class="form-control">

                                  <?php //echo get_age_filter($_POST['agedd']); ?>
                                  <?php echo get_age_filter( (isset($age_var) ? $age_var : '') ); ?>
                              </select>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                          <select id="enginefromdd" name="enginefromdd" class="form-control">

                                  <?php echo get_engine_from_filter( (isset($_POST['enginefromdd']) ? $_POST['enginefromdd'] : '') ); ?>

                              </select>

                        </div>

                        <div class="col-md-6">

                          <select id="enginetodd" name="enginetodd" class="form-control">

                                  <?php echo get_engine_to_filter( (isset($_POST['enginetodd']) ? $_POST['enginetodd'] : '') ); ?>

                              </select>

                        </div>

                      </div>


                      <div class="row">

                        <div class="col-md-6">

                          <select id="fueltypedd" name="fueltypedd" class="form-control">

                                      <?php echo get_fuel_filter( (isset($_POST['fueltypedd']) ? $_POST['fueltypedd'] : '') ); ?>

                              </select>

                        </div>

                        <div class="col-md-6">

                          <select id="transmissiondd" name="transmissiondd" class="form-control">

                                      <?php echo get_transmission_filter( (isset($_POST['transmissiondd']) ? $_POST['transmissiondd'] : '') ); ?>

                              </select>

                        </div>

                      </div>

                      <label class="control-label" for="doorsmcb">Doors</label>
                      <div id="doors-cb" class="row">
                        <div class="col-md-12 general-check-box">

                          <?php echo get_doors_filter( (isset($_POST['doorsmcb']) ? $_POST['doorsmcb'] : '') ); ?>

                        </div>
                      </div>
                      
                      

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">

                      <div id="bodystyle-cb" class="form-group">

                        <label class="control-label" for="checkboxes">Body Style</label>

                        <div>

                          <?php echo get_bodystyle_filter( (isset($body_var) ? $body_var : '') ); ?>

                          <br class="clearBoth" />

                        </div>

                      </div>

                      <div id="colour-cb" class="form-group">

                        <label class="control-label" for="colourmcb">Colour</label>

                        <div>

                          <?php echo get_colour_filter( (isset($_POST['colourmcb']) ? $_POST['colourmcb'] : '') ); ?>

                          <br class="clearBoth" />

                        </div>

                      </div>

                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">

                      <!-- Multiple Checkboxes -->

                      <div id="options-cb" class="form-group">

                        <label class="control-label" for="optionsmcb">Vehicle Options</label>

                        <div class="col-md-12 general-check-box nopadding">

                          <?php echo get_options_filter( (isset($_POST['optionsmcb']) ? $_POST['optionsmcb'] : '') ); ?>

                        </div>

                      </div>

                    </div>

                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-2 left">
                      <button type="button"  value="clear" id="filterclear" name="clearbtn" class="btn">Clear</button>
                    </div>
                    <div class="col-md-8 left">
                    </div>
                    <div class="col-sm-6 col-md-2 right">
                          <?php
                                    // if page is results page load just a button, if not type is submit to load the form
                                    if ( is_shop() ) {
                                       echo '<button type="button"  value="Filter" id="filterbtn2" name="filterbtn" class="btn btn-primary-col">'  . $style_vars['btn_txt'] . '</button>' . (isset($right_btn_bottom) ? $right_btn_bottom : '');
                                    } else {
                                        echo '<button type="submit"  value="Filter" id="filterbtnremote2" name="filterbtnremote" class="btn btn-primary-col">'  . $style_vars['btn_txt'] . '</button>' . (isset($right_btn_bottom) ? $right_btn_bottom : '');
                                    }
                              ?>
                    </div>
                  </div>
                </div>
                
              </div>
              <?php if ($style_vars['btn_adv_pos'] == 'bottom') : ?>
                <div id="adv-search" class="row">
                  
                  <div class="col-md-4 col-md-offset-4">
                  <button type="button"  value="Filter" id="filterbtn2" name="filterbtn" class="btn btn-adv">
                  <i class="fa fa-angle-down" aria-hidden="true" style="font-size: 1.25em;"></i> &nbsp; <?php echo $style_vars['btn_adv_txt']; ?> &nbsp; <i class="fa fa-angle-down" aria-hidden="true" style="font-size: 1.25em;"></i></div>
                  </button>
                </div>
              <?php endif; ?>
            </form>

          </div>
        </div>
      </div>
    </div>

     <div id="filter-drop-down" class="row <?php echo $custom_style; ?>">
      <div class="col-md-4 col-sm-3 hidden-xs"></div>
      <div class="col-md-4 col-sm-6 col-xs-12 center button">
        <div class="col-md-12">
          <div class="col-xs-2 arrows"><i class="fa <?php echo $draw_arrows; ?>" aria-hidden="true"></i></div>
          <div class="col-xs-8 search"><?php echo $style_vars['tab_txt']; ?></div>
          <div class="col-xs-2 arrows"><i class="fa <?php echo $draw_arrows; ?>" aria-hidden="true"></i></div>
        </div>
      </div>
      <div class="col-md-4 col-sm-3 hidden-xs"></div>
    </div>





<?php endif; ?>