<?php
/**
 * Inisiation php file for the finance calculator
 *
 * @package AutoNerdFramework
 * @subpackage AutoNerdTemplate
 * 
 * File Version 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function shcms_insert_finance_calc() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core ' );
	wp_enqueue_script( 'jquery-ui-slider' );
	
	include('shcms-finance-calc-form.php');
}


?>