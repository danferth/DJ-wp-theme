//grab the url
var protocol = window.location.protocol;
var hostname = window.location.hostname;
var url = protocol + "//" + hostname;

var distributors = angular.module('distributors', ['ngSanitize']);

distributors.controller('distController', ['$scope', '$http', '$sce', function($scope, $http, $sce){
    //grab JSON data
    $http.get(url+'/wp-content/themes/TIC/assets/javascript/distributors.json').then(function(res){
      $scope.distributors = res.data;
    
    //set defaults for single distributor view
    $scope.distId = "73";
    $scope.hasTel2 = true;
    $scope.hasFax = true;
    $scope.hasWeb = true;
    $scope.hasEmail = true;
    $scope.hasNotes = false;
    //on click of info buttom
    $scope.singleDist = function(obj){
      //set id
      $scope.distId = obj.target.attributes.value.value;
      //check for tel2
      if($scope.distributors[$scope.distId].tel2 == "" || !$scope.distributors[$scope.distId].hasOwnProperty('tel2')){
        $scope.hasTel2 = false;
      }else{
        $scope.hasTel2 = true;
      }
      //check for fax
      if($scope.distributors[$scope.distId].fax == "" || !$scope.distributors[$scope.distId].hasOwnProperty('fax')){
        $scope.hasFax = false;
      }else{
        $scope.hasFax = true;
      }
      //check for notes (special)
      if($scope.distributors[$scope.distId].special == "" || !$scope.distributors[$scope.distId].hasOwnProperty('special')){
        $scope.hasNotes = false;
      }else{
        $scope.hasNotes = true;
      }
      //check for web
      if($scope.distributors[$scope.distId].web == "" || !$scope.distributors[$scope.distId].hasOwnProperty('web')){
        $scope.hasWeb = false;
      }else{
        $scope.hasWeb = true;
      }
      //check for email
      if($scope.distributors[$scope.distId].email == "" || !$scope.distributors[$scope.distId].hasOwnProperty('email')){
        $scope.hasEmail = false;
      }else{
        $scope.hasEmail = true;
      }
      
    };
    
    $scope.scrollToTop = function(){
      window.scroll(0,0);
    };
    

    });
    //sorting default
    $scope.sortType = 'company';
    $scope.sortReverse = false;
    $scope.filterType = "";
    

}]);

var compound = angular.module('compound', []);

compound.controller('compoundController', ['$scope', '$http', function($scope, $http){
  $http.get(url+'/wp-content/themes/TIC/assets/javascript/compound.json').then(
    function(rslt){
      $scope.compounds = rslt.data;
    });
    
    $scope.sortReverse = false;
    $scope.sortType = "drugName";
}]);


var chemicalIndex = angular.module('chemicalIndex', []);

chemicalIndex.controller('chemicalIndexController', ['$scope', '$http',function($scope, $http){
  $http.get(url+'/wp-content/themes/TIC/assets/javascript/chemical.json').then(function(rslt){
    $scope.chemical = rslt.data;
    
    
    $scope.sortType = "chemical";
    $scope.sortReverse = false;
    
    $scope.legend = function(n){
      var legendSet = {
        "R" : "Recommended",
        "GR" : "Generally Recommended",
        "LTD" : "Limited Recommendation",
        "NR" : "Not Recommended",
        "GNR" : "Generally Not Recommended",
        "TST" : "Testing Recommended",
        "ND" : "No Data Presently Available "
      };
      
      return legendSet[n];
      
    };
  
  });
  
}]);

var products = angular.module('products', []);
products.controller('productsController', ['$scope', '$http',function($scope, $http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/javascript/products.json').then(function(rslt){
    $scope.products = rslt.data;
  });
  
  $scope.sortType = "line";
  $scope.sortReverse = false;
}]);

var plates = angular.module('platesearch', []);
plates.controller('platesearchController', ['$scope','$http', function($scope,$http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/javascript/plates.json').then(function(rslt){
    $scope.plates = rslt.data;
  });
  
  $scope.sortType = "partNum";
  $scope.sortReverse = false;
}]);


var product_page = angular.module('product_page', []);
product_page.controller('product_pageController', ['$scope', '$http', function($scope,$http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/javascript/products.json').then(function(rslt){
    $scope.products = rslt.data;

  });
  
  $scope.setPart = function(p, $index){
    $scope.set = p.partNumber[0].num;
  };
  
  $scope.triggerOverlay = function(e){
    $('.overlay').removeClass('hidden');
		$('.overlay-content').addClass('animated fadeInUp');
  };
  
}]);

