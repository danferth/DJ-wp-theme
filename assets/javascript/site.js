jQuery(function($){

//===========
//main blocks
//=============

var mBlocks = $('.main-block');
//click to get to `data-mainblocklink`
mBlocks.on('click',function(){
	var link = $(this).attr('data-mainblocklink');
	window.location.assign(link);
});

//var below used for random colors
//var mBlocks_border = $('.main-block-image-wrap');
//random color
// mBlocks_border.each(function(){
// 	var randomColors = ["CFDEE6", "DEE6CF", "E6DECF", "CFE6E4"];
// 	var colorLength = randomColors.length;
// 	var random = Math.floor(Math.random() * (colorLength - 0)) + 0;
// 	$(this).css({'border-top' : "2px solid #" + randomColors[random]});
// });

/*
old function that created random colors from hue selection worked
but wasn't happy with color results went with
something simpler with more controll of colors
mBlocks_inner.each(function(){
  var rHue = Math.floor(Math.random() * (230 - 0)) + 0;
  $(this).css({'background-color' : 'hsl(' + rHue + ', 30%, 40%)'});
});
*/


//on load animation
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



//===========
//prefooter
//==========
//redirect on click
$('.prefooter').on('click', function(e){
	var link = $(this).attr('data-prefooterlink');
	window.location.assign(link);
});

//==================
//footer animations
//==================
var footer_articles = $('#footer article');
var footer_address = $('.footer_foot');
var foot_tl = new TimelineMax();
foot_tl.add( TweenMax.staggerFrom(footer_articles, .8, {delay:.25, y:300, opacity:0, ease:Circ.easeOut}, .20) );
foot_tl.add( TweenMax.from(footer_address, 1, {opacity:0}) );
// foot_tl.add(  );
// foot_tl.add(  );
// foot_tl.add(  );
foot_tl.pause();

var footer_waypint = new Waypoint({
	element: document.getElementById('footer'),
	handler: function(){
		foot_tl.play();
	},
	offset: '80%'
});


});//end doc ready