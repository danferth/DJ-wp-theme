var protocol = window.location.protocol;
var hostname = window.location.hostname;
var url = protocol + "//" + hostname;

  product_page.directive('test', function(){
    return{
      restrict: 'E',
      replace: 'true',
      templateUrl: url+'/wp-content/themes/TIC/assets/templates/test.html',
      link: function(scope, elem, attrs){
          elem.bind('click', function(){
              elem.addClass('hidden');
              elem.children('.overlay-content').removeClass('fadeInUp');
          });
      }
    };
  });