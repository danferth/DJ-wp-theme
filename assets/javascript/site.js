jQuery(function($){

//==============================
//Product page form TC Inversion
//==============================

$('.tc_page-form option').attr('disabled', 'disabled');
$('.tc_page-form input[type="radio"]').on('click', function(e) {
		var output = $('.tc_page-form input.radio:checked').attr('id');
		if (output == "flask-5") {
				$('.tc_page-form option').removeAttr('disabled');
		}

		if (output == "flask-16") {
				$('.tc_page-form option').removeAttr('disabled');
				$('.tc_page-form option[value="qc14"]').attr('disabled', 'disabled');
		}
});

$('.tc_page-form select#options').on('change', function(e) {
		var size = $('.tc_page-form input[type="radio"]:checked').attr('id');
		var conn = $('.tc_page-form option:selected').attr('value');
		var connText = $('.tc_page-form option:selected').text();
		var part_no = "";
		var tc_desc = "";
		var stand_part_no = "";
		var stand_desc = "";

		//switch for 1.6L part #'s

		if (size == 'flask-16') {
				switch (conn) {
						case 'qc716': part_no = '931706';
								break;
						case 'll': part_no = '931710';
								break;
						case 'cf16': part_no = '931705';
								break;
						case 'cf24': part_no = '931708';
								break;
				}
				stand_part_no = "931609";
				stand_desc = "<b>Stand with Ring for Inverting Optimum Growth&trade; 1.6L Flask</b><br><i>to use w/1.6L Inversion Transfer Caps</i>";
		}

		//switch for 5L part #'s

		if (size == 'flask-5') {
				switch (conn) {
						case 'qc14': part_no = '931594';
								break;
						case 'qc716': part_no = '931596';
								break;
						case 'll': part_no = '931616';
								break;
						case 'cf16': part_no = '931595';
								break;
						case 'cf24': part_no = '931598';
								break;
				}
				stand_part_no = "931606";
				stand_desc = "<b>Stand with Ring for Inverting Optimum Growth&trade; 5 Liter Flask</b><br><i>to use w/5L Inversion Transfer Caps</i>";
		}



		//switch for descriptions

		switch (part_no) {
				case '931706': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 1.6L Flask</b><br><i>7/16&rdquo; Male Connection -- Sterile</i>";
						break;
				case '931705': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 1.6L Flask</b><br><i>2&rsquo; Tubing to weld to 1/4&rdquo; C-Flex 16 -- Sterile</i>";
						break;
				case '931708': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 1.6L Flask</b><br><i>2&rsquo; Tubing to weld to 7/16&rdquo; C-Flex 24 -- Sterile</i>";
						break;
				case '931710': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 1.6L Flask</b><br><i>with 2&rsquo; Tubing with Luer Lock -- Sterile</i>";
						break;
				case '931594': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 5 Liter Flask</b><br><i>1/4&rdquo; Barb Connection -- Sterile</i>";
						break;
				case '931596': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 5 Liter Flask</b><br><i>7/16&rdquo; Male Connection -- Sterile</i>";
						break;
				case '931595': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 5 Liter Flask</b><br><i>2&rsquo; Tubing to weld to 1/4&rdquo; C-Flex 16 -- Sterile</i>";
						break;
				case '931598': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 5 Liter Flask</b><br><i>2&rsquo; Tubing to weld to 7/16&rdquo; C-Flex 24 -- Sterile</i>";
						break;
				case '931616': tc_desc = "<b>Inversion Transfer Cap for Optimum Growth&trade; 5L Flask</b><br><i>with 2&rsquo; Tubing with Luer Lock -- Sterile</i>";
						break;
		}

		$('.tc_page-form p.tc_part span.partNo').html(part_no);
		$('.tc_page-form p.tc_part span.tc_desc').html(tc_desc);
		$('.tc_page-form p.stand span.stand_part').html(stand_part_no);
		$('.tc_page-form p.stand span.stand_description').html(stand_desc);
		$('.tc_page-form .output').slideDown(350);
		e.preventDefault();
}); //END .on(change);


//===========
//main blocks
//=============

var mBlocks_inner = $('.main-block .inner-block');
var mBlocks = $('.main-block');

mBlocks_inner.each(function(){
  var rHue = Math.floor(Math.random() * (230 - 0)) + 0;
  $(this).css({'background-color' : 'hsl(' + rHue + ', 30%, 40%)'});
});

mBlocks.on('click',function(){
	var link = $(this).attr('data-mainblocklink');
	window.location.assign(link);
});

TweenLite.from(mBlocks, .5, {scale:.90, opacity:0, ease:Bounce.easeOut});

//==============
//app blocks
//==============

var appBlocks     = $('.appnote-block li'),
    appBlocksInnerWrap = $('.appnote-block-inner-wrap');

//hover effects
appBlocksInnerWrap.on('mouseenter', function(e){
  TweenLite.to(this, .25, {scale:.96, ease: Power2.easeOut});
});
appBlocksInnerWrap.on('mouseleave', function(e){
  TweenLite.to(this, .25, {scale:1, ease: Power2.easeIn});
});

//auto color
appBlocksInnerWrap.each(function(){
  var rHue = Math.floor(Math.random()*(200 - 0));
  $(this).css({
    'background-color': 'hsl('+ rHue +', 8%, 92%)',
    'border-color': 'hsl('+ rHue +', 15%, 40%)'
  });
});

//redirect on click
appBlocks.on('click', function(e){
	var link = $(this).attr('data-appblocklink');
	window.location.assign(link);
});

//waypoint scroll
//this is to have the li items hidden during scroll up
appBlocks.css({opacity:0});
var waypoints = $('.appnote-block').waypoint({
  handler: function(){
  appBlocks.css({opacity:1});
  TweenMax.staggerFrom(appBlocks, .6, {delay:.25, scale:.90, y:300, opacity:0, ease:Power3.easeOut},.125); 
  this.destroy();
},
  offset: '75%'
});

//===========
//prefooter
//==========
//redirect on click
$('.prefooter').on('click', function(e){
	var link = $(this).attr('data-prefooterlink');
	window.location.assign(link);
});

//===============
//tech library
//===============

//videos
var TL_vid_block = $('.tabs-content .content ul.VID li a');

$(TL_vid_block).each(function(){
	var url = $(this).attr('href');
	$(this).children('span').attr('data-vidlink', url);
});


$(TL_vid_block).on('click', function(e){
	var target = $(this).children('span');
	TweenMax.to(target, .5, {opacity:1, bottom:0, ease:Circ.easeOut});
	e.preventDefault();
});

$(TL_vid_block).children('span').on('click', function(e){
	var link = $(this).attr('data-vidlink');
	window.location.assign(link);
});



$(TL_vid_block).on('mouseenter', function(e){
	var target = $(this).children('span');
	TweenMax.to(target, .5, {opacity:1, bottom:0, height:'100%', ease:Circ.easeOut});
});


$(TL_vid_block).on('mouseleave', function(e){
	var target = $(this).children('span');
	TweenMax.to(target, 1, {opacity:0, bottom:-200, height:0, ease:Power1.easeOut});
});




});//end doc ready