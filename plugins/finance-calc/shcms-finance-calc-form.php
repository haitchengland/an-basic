<?php
/**
 * Finance calculator form and js script
 *
 * @package AutoNerdFramework
 * @subpackage AutoNerdTemplate
 * 
 * File Version 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<link rel="stylesheet" id="finance-form-css" href="http://wordpressmu-20272-44480-142523.cloudwaysapps.com/citroen/wp-content/plugins/01-haitch-cars/finance-calc/shcms-finance-calc-styles.css" type="text/css" media="all">


<style>



</style>

<div class="container">
	<form id="finance-calc" class="finance-calc">
		<div class="row">
			<div class="finance-calc-area col-md-8">
				<div class="apr-rating-buttons">
					<h2>Car Finance Calculator</h2>
					<h5>Please select your credit history</h5>
					<ul class="apr-rating left">
						<!-- <li class="calcbad"><span class="option" amount="36.99">Bad</span></li>
						<li class="poor"><span class="option" amount="27.99">Poor</span></li>
						<li class="fair"><span class="option" amount="12.99">Fair</span></li>
						<li class="calcgood"><span class="option" amount="10.99">Good</span></li>
						<li class="exc selected"><span class="option" amount="4.99">Excellent</span></li> -->
						
						<li class="exc selected"><span class="option" amount="4.9">Excellent</span></li>
						<li class="calcgood"><span class="option" amount="9.9">Good</span></li>
						<li class="fair"><span class="option" amount="14.5">Fair</span></li>
						<li class="poor"><span class="option" amount="22.9">Poor</span></li>
						<li class="calcbad"><span class="option" amount="29.8">Bad</span></li>
					</ul>
					<div class="clear"></div>
				</div>
				<!--end of creditabs-->
				<div class="calc-area left">
					<h5>Price of vehicle</h5>

					<div class="clear"></div>

					<div id="slider-range-price" class="float-left ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
						<div class="ui-slider-range ui-widget-header ui-slider-range-max"></div>
						<a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
					</div>

					<span class="float-right ">
						<span class="priceminus user-select-none">-</span>
						<span class="pound">£</span> 
						<input type="text" id="priceamount" style="border: 0; font-weight: bold;" value="">
						<span class="priceplus user-select-none">+</span>
					</span>

					<div class="clear"></div>

					<h5>Deposit / part exchange</h5>
						
					
					<div class="clear"></div>

					<div id="partex" class="float-left ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
						<div class="ui-slider-range ui-widget-header ui-slider-range-max"></div>
						<a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
					</div>

					<span class="float-right">
						<span class="partexminus user-select-none">-</span>
						<span class="pound">£</span> 
						<input type="text" id="deposit" style="border: 0; font-weight: bold;" value="">
						<span class="partexplus user-select-none">+</span>
					</span>

					<div class="clear"></div>

					<h5>I would like to pay it over</h5>

					<div class="clear"></div>

					<div id="loan_term" class="float-left ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
						<div class="ui-slider-range ui-widget-header ui-slider-range-max"></div>
						<a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
					</div>

					<span class="float-right">
						<span class="loantermminus left user-select-none">-</span>
						<input name="loanterm" id="loanterm" style="border: 0; font-weight: bold;" value=""> 
						<span class="month">months</span>
						<span class="loantermplus right user-select-none">+</span>
					</span>

					<div class="clear"></div>
				</div>
			</div>

			<div class="finance-calc-results col-md-4">

				<div class="display-results">
					<h3>Your Repayments</h3>
					<div id="result-apr">
						<h5>APR Representative</h5>
						<span class="right-block">
							<strong><span id="apr-rate"></span>%</strong>
						</span>
					</div>
					<div id="result-repayments">
						<h5>Total Payable</h5>
						<span class="right-block">
							<strong><div id="payable" class="payable"></div></strong>
						</span>
						<div class="clear"></div>
					</div>
					<div id="result-total">
						<h5>Total Cost Of Credit</h5>
						<span class="right-block">
							<strong><div id="creditcost" class="creditcost"></div></strong>
						</span>
						<div class="clear"></div>
					</div>
					<a href="#finance-apply">
					<div id="result-monthly">
						<h5>Your estimated Monthly payment</h5>
						<span class="right-block">
							<div id="installments" class="installments"></div>
						</span>
						<div class="clear"></div>
					</div>
					</a>
					
				</div>
				<div class="clear"></div>

				<input type="hidden" id="apr-rating" name="apr-rating" value="">
			</div>
		</div>

		<article class="text">

			<br>
			<p><strong>Representative example:</strong> Borrowing £10,000.00 over 48 months with a representative APR of 9.9%, an annual interest rate of 9.9% and a deposit of £1000.00, the amount payable would be: £226.01 a month, with a total cost of credit of £2,848 and total amount payable of £11,848.51.</p>

			<p>Our hire purchase car finance calculator is built to demonstrate likely APR costs, monthly repayments and total repayments (according to your stated credit history). These figures can only be taken as a guidance as finance lenders base their decision on many factors not taken into account here. Our staff will endeavour to provide the best possible finance package for you (according to your personal circumstances) and the vehicle you are looking to buy. Customers are advised to have a conversation with us about your intended purchase so we can best ascertain the most affordable route of car finance. Please note: This calculation above is based upon a "hire purchase" agreement or loan amount only (where you own the vehicle outright at the end of your contract). Personal Contract Purchase (PCP) are offered by Charters but quotes are not given currently in this finance calculator as these are based upon the guaranteed future value of the vehicle and mileage covered. As a rule of thumb, Personal Contract Purchase car finance prices are generally much less per month. </p>

		
			<div class="clear"></div>
		</article>

	</form>

</div>



<script>

// JavaScript Document
jQuery(document).ready(function($) {
	var startapr = $('.selected .option').attr('amount');
	$("#apr-rating").val(startapr);
	$('#apr-rate').text(startapr);
	//$("#repay").text('£3569.70');
	//$("#creditcost").text('£569.70');
	//$("#install").text('£148.74');

	

	if ($('.price-now').text()) {
		var car_price_text = $('.price-now').text();
	} else {
		var car_price_text = $('.price-normal').text();
	}
	var car_price = Number(car_price_text.replace(/[^0-9\.]+/g,""));

	// inisiate sliders
	$("#slider-range-price").slider({
		range: "max",
		min: 1000,
		max: 50000,
		value: car_price,
		step: 10,
		slide: function(event, ui) {
			$("#priceamount").val(ui.value);
			change();
		}
	});

	$("#partex").slider({
		range: "max",
		min: 0,
		max: 10000,
		value: 1000,
		step: 100,
		slide: function(event, ui) {
			$("#deposit").val(ui.value);
			change();
		}
	});

	$("#loan_term").slider({
		range: "max",
		min: 12,
		max: 60,
		value: 48,
		step: 12,
		slide: function(event, ui) {
			$("#loanterm").val(ui.value);
			change();
		}
	});

	$("#priceamount").val($("#slider-range-price").slider("value"));
	$("#deposit").val($("#partex").slider("value"));
	$("#loanterm").val($("#loan_term").slider("value"));

	change();
	
	// plus and minus buttons

	$(".priceplus").click(function() {
		var value = $("#slider-range-price").slider("value"),
			step = $("#slider-range-price").slider("option", "step");
		$("#slider-range-price").slider("value", value + step);
		if (value == '50000') {
			var valuetot = value
		} else {
			var valuetot = value + step
		}
		$('#priceamount').val(valuetot);
		change()
	});


	$(".priceminus").click(function() {
		var value = $("#slider-range-price").slider("value"),
			step = $("#slider-range-price").slider("option", "step");
		$("#slider-range-price").slider("value", value - step);
		if (value == '1000') {
			var valuetot = value
		} else {
			var valuetot = value - step
		}
		$('#priceamount').val(valuetot);
		change()
	});


	$(".partexplus").click(function() {
		var value = $("#partex").slider("value"),
			step = $("#partex").slider("option", "step");
		if (value == '10000') {
			var valuetot = value
		} else {
			var valuetot = value + step
		}
		var dep = value + step;
		$("#partex").slider("value", value + step);
		$('#deposit').val(valuetot);

		change();
	});

	$(".partexminus").click(function() {
		var value = $("#partex").slider("value"),
			step = $("#partex").slider("option", "step");
		if (value == '0') {
			var valuetot = value
		} else {
			var valuetot = value - step
		}
		$("#partex").slider("value", value - step);
		$('#deposit').val(valuetot);
		change()
	});

	
	$(".loantermplus").click(function() {
		var value = $("#loan_term").slider("value"),
			step = $("#loan_term").slider("option", "step");
		$("#loan_term").slider("value", value + step);
		if (value == '60') {
			var valuetot = value
		} else {
			var valuetot = value + step
		}
		$('#loanterm').val(valuetot);
		change()
	});

	$(".loantermminus").click(function() {
		var value = $("#loan_term").slider("value"),
			step = $("#loan_term").slider("option", "step");

		$("#loan_term").slider("value", value - step);
		if (value == '24') {
			var valuetot = value
		} else {
			var valuetot = value - step
		}
		$('#loanterm').val(valuetot);
		change()
	});



	// text box on change	

	$('#priceamount').on('input', function() {
		var input = $("#priceamount").val();

		if ($.isNumeric( input )) {
			$("#slider-range-price").slider("value", $("#priceamount").val());
    		change();
		} else {
			$("#priceamount").val($("#slider-range-price").slider("value"));
		}
		
	});
	
	$('#deposit').on('input', function() {
		var input = $("#deposit").val();

		if ($.isNumeric( input )) {
			$("#partex").slider("value", $("#deposit").val());
    		change();
		} else {
			$("#deposit").val($("#partex").slider("value"));
		}
	
	});

	$('#loanterm').on('input', function() {
		
		var input = $("#loanterm").val();

		if ($.isNumeric( input )) {
			$("#loan_term").slider("value", $("#loanterm").val());
    	change();
		} else {
			$("#loanterm").val($("#loan_term").slider("value"));
		}
	
	});
	

	// APR buttons

	$('.apr-rating .option').click(function(e) {
		$("input[name='apr-rating']").val($(this).attr('amount'));
		change();
	});
	
	$('.apr-rating li').click(function(e) {
		$('.apr-rating li').each(function(e) {
			$(this).removeClass('selected');
		});
		$(this).addClass('selected');
	});




	function clearSelection() {
		if (document.selection && document.selection.empty) {
			document.selection.empty();
		} else if (window.getSelection) {
			var sel = window.getSelection();
			sel.removeAllRanges();
		}
	}
	
	function numberWithCommas(n) {
	    var parts=n.toString().split(".");
	    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
	}
	//sidebar calculator
	function change() {

		/*
		var loanterm = Number($('#loanterm').val());
		var loantermmon = (loanterm / 12);  // year
		var aprbyyear = (aprrating / 2);
		var aprbymon = (aprbyyear * loantermmon);
		var totalapr = Number(aprbymon.toFixed(3));

		//Function To find out Total Cost Of Credit
		var price = Number($('#priceamount').val());
		var deposit = Number($('#deposit').val());
		var y = (price - deposit);
		var totalcreditmath = (y * totalapr) / 100;
		var totalcredit = Number(totalcreditmath.toFixed(2));

		//Function To find out Total Repayment
		var totalrepayment = (y + totalcredit);
		var totalrepaymenttot = Number(totalrepayment.toFixed(2));
		
		//Function to find out monthly installments
		var totalrepay = (totalrepaymenttot / loanterm);
		var totalinstall = Number(totalrepay.toFixed(2));
		//clearSelection();
		//
		//
		*/
		
		//var aprrating = Number($("#apr-rating").val());
		var annualRate = Number($("#apr-rating").val());
		var amount = Number($('#priceamount').val());
		var months = Number($('#loanterm').val());
		var deposit = Number($('#deposit').val());
		
		monthlyRate = Math.pow(((annualRate / 100) + 1), 1 / 12) - 1;
		monthlyPayment = ((amount - deposit) * monthlyRate) / (1 - Math.pow((1 + monthlyRate), -months));
		totalRepayment = (monthlyPayment * months) + deposit;
		creditCharge = totalRepayment - (amount - deposit);


		$("#apr-rate").text(annualRate);
		$("#creditcost").html('&pound;' + numberWithCommas(creditCharge.toFixed(2)));
		$("#payable").html('&pound;' + numberWithCommas(totalRepayment.toFixed(2)));
		$("#installments").html('&pound;' + numberWithCommas(monthlyPayment.toFixed(2)));




		//var rating = parseFloat($('#rating').val());
		//var finalpc = (loanterm * 41.985); 
		//var months = (loanterm * 12);
		//var midpm = (y * finalpc)/100;
		//var missing = (midpm + y);
		//var finalpm = (missing / months);
		//var apr = (rating * 2);
		//var total = Number(finalpm.toString().match(/^\d+(?:\.\d{0,2})?/));
		//$("#test").html($('.price-now').text());

		// Output Results
		////$("#apr-rate").text(aprrating);
		////$("#creditcost").html('&pound;' + totalcredit.toFixed(2));
		////$("#repay").html('&pound;' + totalrepaymenttot.toFixed(2));
		////$("#install").html('&pound;' + totalinstall.toFixed(2));
		//alert(total);
	}

	/*var corners = [
		'bottomLeft', 'bottomRight', 'bottomMiddle',
		'topRight', 'topLeft', 'topMiddle',
		'leftMiddle', 'leftTop', 'leftBottom',
		'rightMiddle', 'rightBottom', 'rightTop'
	];
	var opposites = [
		'topRight', 'topLeft', 'topMiddle',
		'bottomLeft', 'bottomRight', 'bottomMiddle',
		'rightMiddle', 'rightBottom', 'rightTop',
		'leftMiddle', 'leftTop', 'leftBottom'
	];*/
	//var i = 0;

	/*$('.apr-rating li span[tooltip]').each(function() {
		$(this).qtip({
			content: $(this).attr('tooltip'),
			position: {
				my: 'topMiddle', // Use the corner...
				at: 'bottomMiddle' // ...and opposite corner
			},
			style: {
				border: {
					classes: 'rounded'
				},
				tip: true, // Give it a speech bubble tip with automatic corner detection
				// Style it according to the preset 'cream' style
			} // Set the tooltip content to the current corner

		});

	});*/

	//$('.calculate').click(function(e) {
	//	calculateme();
	//});

	/*function calculateme() {

		var price = parseFloat($('#priceamount').val());
		var deposit = parseFloat($('#deposit').val());
		var y = (price - deposit);
		var loanterm = parseFloat($('#loanterm').val());
		var rating = parseFloat($('#rating').val());
		var finalpc = (loanterm * rating);
		var months = (loanterm * 12);
		var midpm = (y * finalpc) / 100;
		var missing = (midpm + y);
		var finalpm = (missing / months);
		var apr = (rating * 2);
		var total = Number(finalpm.toString().match(/^\d+(?:\.\d{0,2})?/));
		$("#results").show();
		$("#results .monnum").text(months);
		$("#results .payamount").text(total);
		$("#results .apr").text(apr);
	} */


	//autotrader
	// calculateLoanCost: function(price, term, apr)
	/* calculateLoanCost: function(e, t, n) {
                var r = n / 100 / 2
                  , i = (e * r * (t / 12) + e) / t;
                return i.toFixed(2)
            } */


/*
 this.calculate = function (loanAmount, term, apr, monthlyRepaymentAmount, isAnnualRepayment) {

    var calculatedValues = {monthlyPayment: ' -', loanAmountAvailable: ' -', totalRepayment: ' -', creditCharge: ' -'};
    var amount = parseFloat(loanAmount);
    var monthlyRepayment = parseFloat(monthlyRepaymentAmount);
    var months = parseFloat(term);
    var annualRate = parseFloat(apr);

    var monthlyRate, monthlyPayment, totalRepayment, creditCharge;

    if (this.isParametersValid(amount, monthlyRepayment, months, annualRate)) {

      monthlyRate = Math.pow(((annualRate / 100) + 1), 1 / 12) - 1;

      if (isAnnualRepayment) {

        monthlyPayment = (amount * monthlyRate) / (1 - Math.pow((1 + monthlyRate), -months));
        totalRepayment = monthlyPayment * months;

        creditCharge = totalRepayment - amount;

        calculatedValues.monthlyPayment = $filter('currency')(parseFloat(monthlyPayment).toFixed(2), '£');
      }
      else {
        loanAmount = (monthlyRepayment * (1 - Math.pow((1 + monthlyRate), -months))) / monthlyRate;
        totalRepayment = monthlyRepayment * months;
        creditCharge = totalRepayment - loanAmount;

        calculatedValues.loanAmountAvailable = $filter('currency')(parseFloat(loanAmount).toFixed(2), '£');
        calculatedValues.actualLoanAmountAvailable = parseFloat(loanAmount).toFixed(0);

      }

      calculatedValues.totalRepayment = $filter('currency')(parseFloat(totalRepayment).toFixed(2), '£');
      calculatedValues.creditCharge = $filter('currency')(parseFloat(creditCharge).toFixed(2), '£');
    }

    return calculatedValues;
  };

 */

});
</script>