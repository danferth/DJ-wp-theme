//grab the url
var protocol = window.location.protocol;
var hostname = window.location.hostname;
var url = protocol + "//" + hostname;

//=====distributors page=====
var distributors = angular.module('distributors', ['ngSanitize']);
distributors.controller('distController', ['$scope', '$http', '$sce', function($scope, $http, $sce){
    //grab JSON data
    $http.get(url+'/wp-content/themes/TIC/assets/json/distributors.json').then(function(res){
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

//=====compound compatibility=====
var compound = angular.module('compound', []);
compound.controller('compoundController', ['$scope', '$http', function($scope, $http){
  $http.get(url+'/wp-content/themes/TIC/assets/json/compound.json').then(
    function(rslt){
      $scope.compounds = rslt.data;
    });
    
    $scope.sortReverse = false;
    $scope.sortType = "drugName";
}]);

//=====chemical compatibility=====
var chemicalIndex = angular.module('chemicalIndex', []);
chemicalIndex.controller('chemicalIndexController', ['$scope', '$http',function($scope, $http){
  $http.get(url+'/wp-content/themes/TIC/assets/json/chemical.json').then(function(rslt){
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

//=====product search=====
var products = angular.module('products', []);
products.controller('productsController', ['$scope', '$http',function($scope, $http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/json/products.json').then(function(rslt){
    $scope.products = rslt.data;
  });
  
  $scope.sortType = "line";
  $scope.sortReverse = false;
  
  $scope.goToProduct = function(n){
    //console.log(url + "/" + n);
    window.location.href = url + "/" + n;
  };
}]);

//=====Plates search page=====
var plates = angular.module('platesearch', []);
plates.controller('platesearchController', ['$scope','$http', function($scope,$http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/json/plates.json').then(function(rslt){
    $scope.plates = rslt.data;
  });
  
  $scope.sortType = "partNum";
  $scope.sortReverse = false;
  
  $scope.setItem = function(rslt){
    $scope.set = rslt;
  };
  
  $scope.triggerOverlay = function(e){
    $('.overlay').removeClass('hidden');
		$('.overlay-content').addClass('animated fadeInUp');
  };
  
}]);

plates.filter('tostring', function(){
    return function(item){
        var rslt = "";
        for(var i = 0; i < item.length; i++){
            if(i < item.length-1){
                rslt += item[i] + ", ";
            }else{
              rslt += item[i];
            }
        }
      return rslt;
    }
});

plates.filter('yesNo', function(){
  return function(item){
    if(item === false || item === 1){
      return "No";
    }else if(item === true || item === 0){
      return "Yes";
    }
  }
});

//=====Product pages=====
var product_page = angular.module('product_page', []);
product_page.controller('product_pageController', ['$scope', '$http', function($scope,$http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/json/products.json').then(function(rslt){
    $scope.products = rslt.data;
  });
}]);

//=====test page=====
var test = angular.module('test', []);
test.controller('testController', ['$scope', '$http', function($scope, $http){
  $http.get(url+'/wp-content/themes/TIC/assets/json/products.json').then(function(rslt){
    $scope.products = rslt.data;
  });
  
  //product set with attribute on <product-inquiry product="foobar"></product-inquiry>
  $scope.product = "no product set!";
  //select

    $scope.UYF_options = [
      { "value" : "ecoli", "label" : "E. Coli" },
      { "value" : "microbial", "label" : "Microbial" },
      { "value" : "pink backtirium", "label" : "Pink Bacterium" },
      { "value" : "streptomyces" , "label" : "streptomyces" } 
    ];


  $scope.industry = { "value" : "", "label" : "no industry selected" };
  
  
  //form

  if(sessionStorage.getItem('fname')){
    $scope.first_name = sessionStorage.getItem('fname');
  }
    if(sessionStorage.getItem('lname')){
    $scope.last_name = sessionStorage.getItem('lname');
  }
    if(sessionStorage.getItem('email')){
    $scope.email = sessionStorage.getItem('email');
  }
    if(sessionStorage.getItem('zipCode')){
    $scope.zip_code = sessionStorage.getItem('zipCode');
  }
  
    $scope.setter = function(formID){
    var fname   = $('#'+formID+' input[name="first-name"]').val(),
        lname   = $('#'+formID+' input[name="last-name"]').val(),
        email   = $('#'+formID+' input[name="email"]').val(),
        zipCode = $('#'+formID+' input[name="zip-code"]').val();
        
    sessionStorage.setItem('fname', fname);
    sessionStorage.setItem('lname', lname);
    sessionStorage.setItem('email', email);
    sessionStorage.setItem('zipCode', zipCode);
  };
  

}]);


//test also page
var testAlso = angular.module('testAlso',['ngSanitize']);

testAlso.controller('testAlsoController',['$scope','$http', function($scope,$http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/json/techlibrary.json').then(function(rslt){
    $scope.techdata = rslt.data;
  });
  
  $scope.sortType = "index";
  $scope.sortReverse = false;
  
  $scope.key = "";
  $scope.value = "";
  
}]);

//=========techlibrary=================

var techlibrary = angular.module('techlibrary', ['ngSanitize']);
techlibrary.controller('techlibraryController',['$scope', '$http', function($scope, $http){
  
  $http.get(url+'/wp-content/themes/TIC/assets/json/techlibrary.json').then(function(rslt){
    $scope.techdata = rslt.data;
  
var productLineArray = [];

for(var pl in $scope.techdata){
productLineArray.push($scope.techdata[pl].subProductLine);
	}
			
productLineArray = productLineArray.sort();
$scope.productLine = productLineArray.filter(function(elem, index, self){
	return index == self.indexOf(elem);
});
			
  });
  
  $scope.product = "";
			
}]);


