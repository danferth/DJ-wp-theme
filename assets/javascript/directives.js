//=====plate search=====
plates.directive('plateSearch', function(){
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

//=====Product Inquery=====
test.directive('productInquery', function(){
  return{
    restrict: 'E',
    replace: 'true',
    templateUrl: url+'/wp-content/themes/TIC/assets/templates/product-inquery.php',
    link: function(scope, elem, attrs){
      
      //set products attribute
      scope.product = attrs["product"];
      
//==============================
//===PRODUCT INQUERY MODULE=====
//==============================

var prodInqForm = $('.product-inquery-form');
var prodInqBtn = $('.product-inquery-button');

//hide forms
prodInqForm.hide();
//get height of module container
var product_module_height = $('.product-inquery-module').height();
//set min-height with JQ
$('.product-inquery-module').css({
	'min-height': product_module_height + "px"
});

//on button click
prodInqBtn.on('click', function(e) {
	var target = $(this).siblings('.product-inquery-form');
	//check to see if open
	if ($(this).parent('.product-inquery').hasClass('open')) {
		//remove classes
		$('.product-inquery').not('.open').removeClass('closed');
		$(this).parent('.product-inquery').removeClass('open');
		//close form
		target.hide();
		//add back margin to button div
		if ($(this).parent('.product-inquery').is(':last-of-type')) {
			$(this).parent('.product-inquery').css({
				'margin-bottom': 0
			});
		} else { //except for last button in group
			$(this).parent('.product-inquery').css({
				'margin-bottom': '1.5rem'
			});
		} //add padding back to module container
		$('.product-inquery-module').css({
			'padding': '2rem 1rem'
		});
		//bring back others
		if ($('.product-inquery').not(':visible')) {
			//gather other into array
			var hidden = $('.product-inquery').not(':visible');
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
		$(this).parent('.product-inquery').addClass('open');
		$('.product-inquery').not('.open').addClass('closed');
		//JQ hide others
		$('.closed').hide();
		//slide form down
		target.slideDown(300);
		//remove margin
		$(this).parent('.product-inquery').css({
			'margin': 0
		});
		//remove padding on module container
		$('.product-inquery-module').css({
			'padding': '1rem'
		});
	}
});//end module jquery stuff
    
    }//end link function
  };
});
  
//=====test directive=====
