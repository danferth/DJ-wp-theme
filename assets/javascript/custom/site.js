jQuery(function($){

/*===========
//main blocks
=============*/

var mBlocks = $('.main-block');
// click to get to `data-mainblocklink`
mBlocks.on('click',function(){
	var link = $(this).attr('data-mainblocklink');
	window.location.assign(link);
});

TweenLite.to(mBlocks, .25, {opacity:1, delay:.5, ease:Power2.easeOut});
//=======================
//related products module
//=======================
var relatedModule = $('.related-product-wrap');
//click to get to `data-mainblocklink`
relatedModule.on('click',function(){
	var link = $(this).attr('data-link');
	window.location.assign(url+link);
});

//==================
//footer animations
//==================
var footer_articles = $('#footer article');
var footer_address = $('.footer_foot');
var foot_tl = new TimelineMax();
foot_tl.add( TweenMax.staggerFrom(footer_articles, .8, {delay:.25, y:300, opacity:0, ease:Circ.easeOut}, .20) );
foot_tl.add( TweenMax.from(footer_address, 1, {opacity:0}) );
foot_tl.pause();

var footer_waypint = new Waypoint({
	element: document.getElementById('footer'),
	handler: function(){
		foot_tl.play();
	},
	offset: '80%'
});

//======================
//=======railNav========
//======================
var railNav = $('.railNav');
var railNav_links = $('.railNav ul');
var railNav_tl = new TimelineMax();

railNav_tl.add( TweenMax.to(railNav, .5, {delay:2, opacity:1}) );
railNav_tl.add( TweenMax.to(railNav, .5, {delay:.5, left:'0', ease:Sine.easeIn}) );
railNav_tl.add( TweenMax.to(railNav, .5, {delay:3, left:'-2.75rem', ease:Bounce.easeOut}) );
railNav_tl.call(function(){
	railNav_links.addClass('railNav_closed');
});


railNav.mouseenter(function(){
	railNav_links.removeClass('railNav_closed');
	TweenMax.to(railNav, .25, {left:'0', ease:Sine.easeIn});
	
});
railNav.mouseleave(function(){
	TweenMax.to(railNav, .5, {left:'-2.75rem', ease:Bounce.easeOut});	
	railNav_links.addClass('railNav_closed');
});

//==================================
//=======twitter page module========
//==================================
var tpm = $('.tweet-link');
var tpm_tl = new TimelineMax();
tpm_tl.add( TweenMax.to(tpm, .5, {delay:1.5, opacity:1}) );

tpm.mouseenter(function(){
	$(this).addClass('tada');
});
tpm.mouseleave(function(){
	$(this).removeClass('tada');
});

//==========================================
//=======New Order payment selection========
//==========================================
var po_payment    = $('#order .po'),
    cc_payment    = $('#order .credit-card'),
    cc_trigger    = $('#order .payment-trigger #cc-payment'),
    po_trigger    = $('#order .payment-trigger #po-payment'),
    company_info  = $('#order fieldset.company-info'),
    pa_info       = $('#order fieldset.pa-info'),
    eu_info       = $('#order fieldset.eu-info'),
    billing_info  = $('#order fieldset.billing-info'),
    shipping_info = $('#order fieldset.shipping-info'),
    order_info    = $('#order fieldset.order-info'),
    submit_info   = $('#order fieldset.submit-info');

//hide payment options & wait for selection
po_payment.hide();
cc_payment.hide();
//dim all fieldsets & wait for triggers
var fieldOff = function(target){
  target.css({opacity: .25});
  target.prop('disabled', true);
};
var fieldOn = function(target){
  target.css({opacity: 1});
  target.prop('disabled', false);
};
fieldOff(company_info);
fieldOff(pa_info);
fieldOff(eu_info);
fieldOff(billing_info);
fieldOff(shipping_info);
fieldOff(order_info);
fieldOff(submit_info);
//show po or credit card fieldsets
cc_trigger.change(function(){
  if($(this).is(':checked')){
    cc_payment.slideDown(350);
    po_payment.hide();
  }
});
po_trigger.change(function(){
  if($(this).is(':checked')){
    po_payment.slideDown(350);
    cc_payment.hide();
  }
});

//show next on focus of any input from previous
$('#order .po input').focus(function(){
  fieldOn(company_info);
});
$('#order .credit-card input').focus(function(){
  fieldOn(company_info);
});

$('#order .company-info input[required]').focus(function(){
  fieldOn(pa_info);
});

$('#order .pa-info input[required]').focus(function(){
  fieldOn(eu_info);
});

$('#order .eu-info input').focus(function(){
  fieldOn(billing_info);
});

$('#order .billing-info input[required]').focus(function(){
  fieldOn(shipping_info);
  fieldOn(order_info);
  fieldOn(submit_info);
});

//copy purchasing info to end user info
$('#order #copy-pa-info').on('click', function(){
  if($('#order #copy-pa-info').is(':checked')){
    var pa_fname = $('#order input[name="purchFname"]').val();
    var pa_lname = $('#order input[name="purchLname"]').val();
    var pa_email = $('#order input[name="purchEmail"]').val();
    var pa_phone = $('#order input[name="purchPhone"]').val();
    $('#order input[name="userFname"]').val(pa_fname);
    $('#order input[name="userLname"]').val(pa_lname);
    $('#order input[name="userEmail"]').val(pa_email);
    $('#order input[name="userPhone"]').val(pa_phone);
  }else{
    $('#order input[name="userFname"]').val("");
    $('#order input[name="userLname"]').val("");
    $('#order input[name="userEmail"]').val("");
    $('#order input[name="userPhone"]').val("");
  }
});
$('#order #copy-billing-info').on('click', function(){
  if($('#order #copy-billing-info').is(':checked')){
    var billing_1 = $('#order input#billing-1').val();
    var billing_2 = $('#order input#billing-2').val();
    var billing_3 = $('#order input#billing-3').val();
    var billing_4 = $('#order input#billing-4').val();
    var billing_5 = $('#order input#billing-5').val();
    var billing_6 = $('#order input#billing-6').val();
    var billing_7 = $('#order input#billing-7').val();
    var billAttn = $('#order input#billAttn').val();
    $('#order input#shipping-1').val(billing_1);
    $('#order input#shipping-2').val(billing_2);
    $('#order input#shipping-3').val(billing_3);
    $('#order input#shipping-4').val(billing_4);
    $('#order input#shipping-5').val(billing_5);
    $('#order input#shipping-6').val(billing_6);
    $('#order input#shipping-7').val(billing_7);
    $('#order input#shipAttn').val(billAttn);
  }else{
    $('#order input#shipping-1').val("");
    $('#order input#shipping-2').val("");
    $('#order input#shipping-3').val("");
    $('#order input#shipping-4').val("");
    $('#order input#shipping-5').val("");
    $('#order input#shipping-6').val("");
    $('#order input#shipping-7').val("");
    $('#order input#shipAttn').val("");
  }
});

//==========================================
//==============Sales Portal================
//==========================================
var salesTiles      = $('.downloadable-files li'),
    refTiles        = $('.top-inputs li'),
    twitterTiles    = $('.twitter li'),
    excelTiles      = $('.excel li'),
    powerpointTiles = $('.powerpoint li'),
    wordTiles       = $('.word li'),
    zipTiles        = $('.zipfiles li');
    
    // console.log(salesTiles.length);
    // console.log(refTiles.length);
    // console.log(twitterTiles.length);
    // console.log(excelTiles.length);
    // console.log(powerpointTiles.length);
    // console.log(wordTiles.length);
    // console.log(zipTiles.length);
var sales_ref_tl = new TimelineMax();
sales_ref_tl.add( TweenMax.staggerFrom(refTiles, 1, {delay:.25, y:300, opacity:0, ease:Circ.easeOut}, .20) );
sales_ref_tl.play();

// var sales_waypoint = new Waypoint({
// 	element: document.getElementById('footer'),
// 	handler: function(){
// 		sales_tl.play();
// 	},
// 	offset: '80%'
// });


//end doc ready
});


var inputs = document.querySelectorAll( '.file-input' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		// if( this.files && this.files.length > 1 )
		// 	fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		// else
			fileName = e.target.value.split( '\\' ).pop();

		if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});