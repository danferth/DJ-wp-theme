//grab the url
var protocol = window.location.protocol;
var hostname = window.location.hostname;
var url = protocol + "//" + hostname;


//=============================================================================
//=========MAIN APP MODULE=====================================================
//=============================================================================
//one module to rull them all
var tic = angular.module('tic', ['ngSanitize']);

tic.config(function($sceDelegateProvider) {
    $sceDelegateProvider.resourceUrlWhitelist(['self']);
    });

tic.filter('trustUrl', function ($sce) {
    return function(url) {
      return $sce.trustAsResourceUrl(url);
    };
});

tic.filter('tostring', function(){
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

tic.filter('yesNo', function(){
  return function(item){
    if(item === false || item === 1){
      return "No";
    }else if(item === true || item === 0){
      return "Yes";
    }
  }
  
});

//=============================================================================
//=========MAIN SITE CONTROLLER================================================
//=============================================================================
//main controller on page set at top level div
//page specific placed on <article> & module specific controllers placed on module wraper <div>
tic.controller('ticController', ['$scope', '$http', '$sce', function($scope, $http, $sce){
  //set up data for most of site
  $http.get(url+'/wp-content/themes/TIC/assets/json/products.json').then(function(rslt){
    $scope.products = rslt.data;
  });
  $http.get(url+'/wp-content/themes/TIC/assets/json/plates.json').then(function(rslt){
    $scope.plates = rslt.data;
  });
  $http.get(url+'/wp-content/themes/TIC/assets/json/tc.json').then(function(rslt){
    $scope.tcinfo = rslt.data;
  });
  $http.get(url+'/wp-content/themes/TIC/assets/json/techlibrary.json').then(function(rslt){
    $scope.techdata = rslt.data;
  });
  
  //get query for tech note
  $scope.getQueryVariable = function(variable){
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
      var pair = vars[i].split("=");
      if(pair[0] == variable){
        return pair[1];
      }
    }
    return(false);
  };
  //set with ng-click to scroll to top used on distributors page
  $scope.scrollToTop = function(){
      window.scroll(0,0);
    };
  
  //onclick for tech items on product page
  $scope.sendId = function(techId){
    var newURL = url+"/tech?id="+techId;
    window.location.href = newURL;
  };
  
  //trigger overlay. primarily used on plate search page
  $scope.triggerOverlay = function(e){
    $('.overlay').removeClass('hidden');
		$('.overlay-content').addClass('animated fadeInUp');
  };
  
//=======================================================
//==================SESSION STORAGE======================
//=======================================================
  $scope.setStorage = function(key, value){
    sessionStorage.setItem(key, value);
    console.log(key+' just got set to '+value);
  };
  $scope.getStorage = function(key){
    var rslt = sessionStorage.getItem(key);
    console.log(key+' was requested!');
    return rslt;
  }
  
//===========site sessionStorage variables===============

  if($scope.getStorage('science')){      $scope.science      = $scope.getStorage('science'); }
  if($scope.getStorage('industry')){     $scope.industry     = $scope.getStorage('industry');  }
  //sessionStorage variables for product (COMMENTED OUT NOT IN USE)
  //if($scope.getStorage('prod_line')){    $scope.prod_line    = $scope.getStorage('prod_line'); }
  //if($scope.getStorage('prod_series')){  $scope.prod_series  = $scope.getStorage('prod_series'); }
  
  //=========various page variables==============
  //tc lookup module
  $scope.tc_type      = "";
  $scope.tc_conn      = "";
  $scope.tc_flask     = "";
  
  
}]);

//=============================================================================
//=========MODULES=============================================================
//=============================================================================

//=====inquiry module======
tic.controller('inquiryController', ['$scope', function($scope){
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
    if(sessionStorage.getItem('phone')){
    $scope.phone = sessionStorage.getItem('phone');
  }
    $scope.setter = function(formID){
    var fname   = $('#'+formID+' input[name="first-name"]').val(),
        lname   = $('#'+formID+' input[name="last-name"]').val(),
        email   = $('#'+formID+' input[name="email"]').val(),
        zipCode = $('#'+formID+' input[name="zip-code"]').val(),
        phone   = $('#'+formID+' input[name="phone"]').val();
        
    sessionStorage.setItem('fname', fname);
    sessionStorage.setItem('lname', lname);
    sessionStorage.setItem('email', email);
    sessionStorage.setItem('zipCode', zipCode);
    sessionStorage.setItem('phone', phone);
  };
  $scope.path = window.location.pathname;
}]);

//======================================================================================
//=========PAGES========================================================================
//======================================================================================

//=====distributors page=====
tic.controller('distController', ['$scope', '$http', '$sce', function($scope, $http, $sce){
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
    
  });
    //sorting default
    $scope.sortType = 'company';
    $scope.sortReverse = false;
    $scope.filterType = "";
}]);

//=====compound compatibility=====
tic.controller('compoundController', ['$scope', '$http', function($scope, $http){
  $http.get(url+'/wp-content/themes/TIC/assets/json/compound.json').then(
    function(rslt){
      $scope.compounds = rslt.data;
    });
    
    $scope.sortReverse = false;
    $scope.sortType = "drugName";
}]);

//=====chemical compatibility=====
tic.controller('chemicalIndexController', ['$scope', '$http',function($scope, $http){
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

//=====product search page=====
tic.controller('productsController', ['$scope', function($scope){
  
  $scope.sortType = "line";
  $scope.sortReverse = false;
  
  $scope.goToProduct = function(n){
    //console.log(url + "/" + n);
    window.location.href = url + "/" + n;
  };
}]);

//=====Plates search page=====
tic.controller('platesearchController', ['$scope', function($scope){

  $scope.sortType = "partNum";
  $scope.sortReverse = false;
  
  $scope.setItem = function(rslt){
    $scope.set = rslt;
  };
  
}]);

//=====Product pages=====
tic.controller('product_pageController', ['$scope', function($scope){

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
  
}]);

//=========techlibrary=================
tic.controller('techlibraryController',['$scope', '$http', '$filter', function($scope, $http, $filter){
 //check and set variables from session storage
  if($scope.getStorage('tl_line')){
    $scope.line  = $scope.getStorage('tl_line');
  }
  if($scope.getStorage('tl_subLine')){
    $scope.product = $scope.getStorage('tl_subLine');
    console.log('we have a product it is '+$scope.product);
  }else{
    $scope.product = "";
    console.log('we do not have a product');
  }
  //set select to $scope.product if has value
  if($scope.product){
    $('option[value="'+$scope.product+'"]').attr('selected', true);
    console.log('we set the select to '+$scope.product);
  }
  //get json $ set $scope.pi object from $scope.product variable and json
  $http.get(url+'/wp-content/themes/TIC/assets/json/prodinfo.json').then(function(rslt){
    $scope.prodinfo = rslt.data;
    //sets $scope.pi to object from variable
    $scope.set_pi = function(){
      $scope.pi = $filter('filter')($scope.prodinfo, {product: $scope.product })[0];
      console.log("we have product object and it is: "+$scope.pi.title);
      return $scope.pi;
    }
    //watch for changes to $scope.product
    $scope.$watch('product', function(){
      //call to set $scope.pi object to new product
      console.log('watch just detected $scope.product is now '+$scope.product);
      $scope.set_pi();
      if($scope.product != ""){
        $scope.product_select_message = "Select a Different Product";
        $scope.library_select_message = "Explore " + $scope.pi.title;
      }else{
        $scope.product_select_message = "Select a Product to Explore";
        $scope.library_select_message = "Or Explore our Full Library";
      }
    });
    
    
  });

}]);

//===============techResult======================
tic.controller('techResultController', ['$scope', '$http', '$filter', '$sce', function($scope, $http, $filter, $sce){

  $scope.techQuery = $scope.getQueryVariable('id');
  
  $http.get(url+'/wp-content/themes/TIC/assets/json/techlibrary.json').then(function(rslt){
    $scope.techlibrary = rslt.data;
    $scope.techNote = $filter('filter')($scope.techlibrary, {id: $scope.techQuery })[0];
  
    if($scope.techNote.type === 'GI'){
      $scope.pageTitle = "General Information";
    }
    if($scope.techNote.type === 'COMP'){
      $scope.pageTitle = "Comparisons to Our Products";
    }
    if($scope.techNote.type === 'FAQ'){
      $scope.pageTitle = "FAQ";
    }
    if($scope.techNote.type === 'VIDEO'){
      $scope.pageTitle = $scope.techNote.title;
    }
    if($scope.techNote.type === 'APPNOTE'){
      $scope.pageTitle = "Application Note";
    }
    if($scope.techNote.type === 'PW'){
      $scope.pageTitle = "Published Works";
    }
    
    if($scope.techNote.linkType === "pdf"){
        $scope.PDF = true;
      }
    if($scope.techNote.linkType === "page"){
        window.location = url+"/"+$scope.techNote.link;
      }
    if($scope.techNote.linkType === "link"){
        window.location = url+"/"+$scope.techNote.link;
      }
    if($scope.techNote.linkType === "mp4"){
      $scope.VIDEO = true;
      $scope.videoUrl = url + "/wp-content/uploads/video/videos/" + $scope.techNote.link + '.mp4';
      }
  });
  
}]);

//=====test page=====
tic.controller('testController', ['$scope', function($scope){
  
  $scope.welcome = "Hello, sorry but there is no test being conducted on this page at the moment. Possibly the test you were looking for has been moved to production. whatever page you are thinking was going to display is now where it should be on the site.";
  

}]);


//test also page
tic.controller('testAlsoController',['$scope', function($scope){

  
}]);


