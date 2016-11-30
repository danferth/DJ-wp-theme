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

//======================
//=======railNav========
//======================
var railNav = $('.railNav');
var railNav_links = $('.railNav ul');
var railNav_tl = new TimelineMax();
railNav_tl.add( TweenMax.from(railNav, .5, {delay:2, left:'-3rem', ease:Sine.easeIn}) );
railNav_tl.add( TweenMax.to(railNav, .5, {delay:3, left:'-2.75rem', ease:Bounce.easeOut}) );
railNav_tl.call(function(){
	console.log('start');
	railNav_links.addClass('railNav_closed');
	console.log('done');
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
});//end doc ready