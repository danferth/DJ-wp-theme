//=====plate search=====
tic.directive('plateSearch', function(){
  return{
    restrict: 'E',
    replace: 'true',
    templateUrl: url+'/wp-content/themes/TIC/assets/templates/plate-search.html',
    link: function(scope, elem, attrs){
      // elem.bind('click', function(){
      //   elem.addClass('hidden');
      //   elem.children('.overlay-content').removeClass('fadeInUp');
      // });
      elem.find('.close-overlay').bind('click', function(){
        elem.children('.overlay-content').removeClass('fadeInUp');
        elem.addClass('hidden');
      });
    }
  };
});
  

//=====test directive=====

//=====Product Inquiry=====
product_page.directive('productInquiry', function(){
  return{
    restrict: 'E',
    replace: 'true',
    templateUrl: url+'/wp-content/themes/TIC/assets/templates/product-inquiry.php',
    link: function(scope, elem, attrs){
      
      //set products attribute
      scope.product = attrs["product"];

//==============================
//===PRODUCT INQUIRY MODULE=====
//==============================

var prodInqForm = $('.product-inquiry-form');
var prodInqBtn = $('.product-inquiry-button');

//hide forms
prodInqForm.hide();
//get height of module container
var product_module_height = $('.product-inquiry-module').height();
//set min-height with JQ
$('.product-inquiry-module').css({
	'min-height': product_module_height + "px"
});

//on button click
prodInqBtn.on('click', function(e) {
	var target = $(this).siblings('.product-inquiry-form');
	var btnText = $(this).attr('data-text');
	//check to see if open
	if ($(this).parent('.product-inquiry').hasClass('open')) {
		//remove classes
		$('.product-inquiry').not('.open').removeClass('closed');
		$(this).parent('.product-inquiry').removeClass('open');
		//restore button text
		$(this).text(btnText);
		//close form
		target.hide();
		//add back margin to button div
		if ($(this).parent('.product-inquiry').is(':last-of-type')) {
			$(this).parent('.product-inquiry').css({
				'margin-bottom': 0
			});
		} else { //except for last button in group
			$(this).parent('.product-inquiry').css({
				'margin-bottom': '1.5rem'
			});
		} //add padding back to module container
		$('.product-inquiry-module').css({
			'padding': '2rem 1rem'
		});
		//bring back others
		if ($('.product-inquiry').not(':visible')) {
			//gather other into array
			var hidden = $('.product-inquiry').not(':visible');
			hidden.css({ //they were hidden with JQ so set block and opacity to remain hidden
				'display': 'block',
				'opacity': 0
			}); //animate back to visible
			TweenLite.to(hidden, 1, {
				delay: .25,
				opacity: 1
			});
		}

	} else { //else if closed
		//set classes
		$(this).parent('.product-inquiry').addClass('open');
		$('.product-inquiry').not('.open').addClass('closed');
		//change button text
		$(this).text('close form');
		//JQ hide others
		$('.closed').hide();
		//slide form down
		target.slideDown(300);
		//remove margin
		$(this).parent('.product-inquiry').css({
			'margin': 0
		});
		//remove padding on module container
		$('.product-inquiry-module').css({
			'padding': '1rem'
		});
	}
});//end module jquery stuff
    
    }//end link function
  };
});
  
//=====test directive=====
