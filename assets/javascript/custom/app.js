//grab the url
var protocol = window.location.protocol;
var hostname = window.location.hostname;
var url = protocol + "//" + hostname;


//=============================================================================
//=========MAIN APP MODULE=====================================================
//=============================================================================
//one module to rull them all
var tic = angular.module('tic', ['ngSanitize']);

tic.config(['$sceDelegateProvider', function($sceDelegateProvider) {
    $sceDelegateProvider.resourceUrlWhitelist(['self']);
    }]);

tic.filter('trustUrl', ['$sce', function ($sce) {
    return function(url) {
      return $sce.trustAsResourceUrl(url);
    };
}]);

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
    };
});

tic.filter('yesNo', function(){
  return function(item){
    if(item === false || item === 1){
      return "No";
    }else if(item === true || item === 0){
      return "Yes";
    }
  };
  
});

tic.factory('dataFactory', ['$http', '$filter', function($http, $filter){
  var factory = {};
  factory.get_chemical = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/chemical.json');
  };
  factory.get_compound = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/compound.json');
  };
  factory.get_distributors = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/distributors.json');
  };
  factory.get_prodinfo = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/prodinfo.json');
  };
  factory.get_products = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/products.json');
  };
  factory.get_tc = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/tc.json');
  };
  factory.get_techdata = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/techlibrary.json');
  };
  factory.get_sftofv = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/sftofv.json');
  };
  factory.get_salestips = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/salestips.json');
  };
  factory.get_tradeshow = function(){
    return $http.get(url+'/wp-content/themes/TIC/assets/json/tradeshow.json');
  };
  return factory;
}]);

//=============================================================================
//=========FOR PRODUCTION======================================================
//=============================================================================
//stuff for production see: https://docs.angularjs.org/guide/production
//DI strict mode enabled on tamplate pages with `ng-strict-di`
tic.config(['$compileProvider', function ($compileProvider) {
  $compileProvider.debugInfoEnabled(false);
  //Disable comment and css class directives
  $compileProvider.commentDirectivesEnabled(false);
  $compileProvider.cssClassDirectivesEnabled(false);
}]);



//=============================================================================
//=========MAIN SITE CONTROLLER================================================
//=============================================================================
//main controller on page set at top level div
//page specific placed on <article> & module specific controllers placed on module wraper <div>
tic.controller('ticController', ['$scope', '$sce', 'dataFactory', function($scope, $sce, dataFactory){
  //get json data
  dataFactory.get_techdata().then(function(responce){
   $scope.techdata = responce.data;
 });
 dataFactory.get_products().then(function(responce){
   $scope.products = responce.data;
 });
 dataFactory.get_tc().then(function(responce){
   $scope.tcinfo = responce.data;
 });
 dataFactory.get_tradeshow().then(function(responce){
   $scope.tradeshows = responce.data;
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
    $('.overlay-wrap').removeClass('hidden');
		$('.overlay-content').addClass('fadeInUp');
  };
  
//=======================================================
//==================SESSION STORAGE======================
//=======================================================
  $scope.setStorage = function(key, value){
    sessionStorage.setItem(key, value);
  };
  $scope.getStorage = function(key){
    var rslt = sessionStorage.getItem(key);
    return rslt;
  };
  
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
  if(sessionStorage.getItem('science')){
    $scope.science = $scope.getStorage('science');
  }
  if(sessionStorage.getItem('company')){
    $scope.company = sessionStorage.getItem('company');
  }
  if(sessionStorage.getItem('fname')){
    $scope.first_name = sessionStorage.getItem('fname');
  }
  if(sessionStorage.getItem('lname')){
    $scope.last_name = sessionStorage.getItem('lname');
  }
  if(sessionStorage.getItem('email')){
    $scope.email = sessionStorage.getItem('email');
  }
  if(sessionStorage.getItem('phone')){
    $scope.phone = sessionStorage.getItem('phone');
  }
  if(sessionStorage.getItem('address')){
    $scope.address = sessionStorage.getItem('address');
  }
  if(sessionStorage.getItem('building')){
    $scope.building = sessionStorage.getItem('building');
  }
  if(sessionStorage.getItem('city')){
    $scope.city = sessionStorage.getItem('city');
  }
  if(sessionStorage.getItem('state')){
    $scope.state = sessionStorage.getItem('state');
  }
  if(sessionStorage.getItem('zipcode')){
    $scope.zipcode = sessionStorage.getItem('zipcode');
  }
  $scope.path = window.location.pathname;
  
  $scope.setter = function(formID){
    var company   = $('#'+formID+' input[name="company"]').val(),
        fname     = $('#'+formID+' input[name="first-name"]').val(),
        lname     = $('#'+formID+' input[name="last-name"]').val(),
        email     = $('#'+formID+' input[name="email"]').val(),
        phone     = $('#'+formID+' input[name="phone"]').val(),
        address   = $('#'+formID+' input[name="address"').val(),
        building  = $('#'+formID+' input[name="building').val(),
        city      = $('#'+formID+' input[name="city"] ').val(),
        state     = $('#'+formID+' input[name="state"]').val();
        zipcode   = $('#'+formID+' input[name="zip-code"]').val();
        
    if(company != undefined){   
      sessionStorage.setItem('company', company);
    }
    sessionStorage.setItem('fname', fname);
    sessionStorage.setItem('lname', lname);
    sessionStorage.setItem('email', email);
    sessionStorage.setItem('phone', phone);
    if(address != undefined){
      sessionStorage.setItem('address', address);
    }
    if(building != undefined){
      sessionStorage.setItem('building', building);
    }
    sessionStorage.setItem('city', city);
    sessionStorage.setItem('state', state);
    if(zipcode != undefined){
      sessionStorage.setItem('zipcode', zipcode);
    }
  };
}]);

//======================================================================================
//=========PAGES========================================================================
//======================================================================================

//=====distributors page=====
tic.controller('distController', ['$scope', '$sce', 'dataFactory', '$filter', function($scope, $sce, dataFactory, $filter){
    //grab JSON data
  dataFactory.get_distributors().then(function(responce){
    $scope.distributors = responce.data;
    $scope.sd = "";
    
    $scope.$watch('distId', function(){
      if($scope.getStorage('distributor')){
        $scope.distId = $scope.getStorage('distributor');
        $scope.sd = $filter('filter')($scope.distributors, {id : $scope.distId})[0];
        $scope.distHeader = "Your Chosen Distributor";
      }else{
        $scope.distHeader = "We Ship Worldwide if you Come up Empty";
      }
    });
    
    //on click of info buttom
    $scope.singleDist = function(obj){
      $scope.sd = $filter('filter')($scope.distributors, {id : obj})[0];
      $scope.distId = $scope.sd.id;
      $scope.setStorage('distributor', $scope.distId);
      $scope.scrollToTop();
    };
    
    //sorting default
    $scope.sortType = 'company';
    $scope.sortReverse = false;
    $scope.filterType = "";
    
    //email display
    $scope.showEmail = function($event){
      var email_target = $(event.target);
      email_target.text(this.d.email);
    }

  });
}]);

//=====compound compatibility=====
tic.controller('compoundController', ['$scope', 'dataFactory', function($scope, dataFactory){
  dataFactory.get_compound().then(function(responce){
   $scope.compounds = responce.data;
 });
    
    $scope.sortReverse = false;
    $scope.sortType = "drugName";
}]);

//=====chemical compatibility=====
tic.controller('chemicalIndexController', ['$scope', 'dataFactory', function($scope, dataFactory){
  dataFactory.get_chemical().then(function(responce){
   $scope.chemical = responce.data;
  });

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
    
}]);

//=====product search page=====
tic.controller('productsController', ['$scope', function($scope){
  
  $scope.sortType = "line";
  $scope.sortReverse = false;
  $scope.search = "";
  $scope.prodLine = "";
  $scope.prodSeries = "";
  
  
  $scope.newTarget = function(e){
    $scope.prodSeries = ""
  };
  
  $scope.resetForm = function(e){
    $scope.prodLine = "";
    $scope.prodSeries = "";
    $scope.search = "";
  };
  
  $scope.goToProduct = function(n){
    window.location.href = url + "/" + n;
  };
  
  
}]);

//=====Product pages=====
tic.controller('product_pageController', ['$scope', function($scope){

  //product set with attribute on <product-inquiry product="foobar"></product-inquiry>
  $scope.product = "no product set!";
  
  $scope.isFlask  = false;
  $scope.isVial   = false;
  $scope.isPlate  = false;
  $scope.isTC     = false;
  $scope.isOther  = false;
  
  $scope.setProduct = function(rslt){
    $scope.setP = rslt;
    if($scope.setP.line == "FV"){//FILTER VIALS
      $scope.isVial   = true;
      $scope.isFlask  = false;
      $scope.isPlate  = false;
      $scope.isTC     = false;
      $scope.isOther  = false;
    }
    if($scope.setP.series == "flask" || $scope.setP.series == "special"){//FLASKS
      $scope.isVial   = false;
      $scope.isFlask  = true;
      $scope.isPlate  = false;
      $scope.isTC     = false;
      $scope.isOther  = false;
    }
    if($scope.setP.line == "TC"){//TC
      $scope.isVial   = false;
      $scope.isFlask  = false;
      $scope.isPlate  = false;
      $scope.isTC     = true;
      $scope.isOther  = false;
    }
    if($scope.setP.series != "flask" && $scope.setP.series != "special" && $scope.setP.line != "FV" && $scope.setP.line != "well plate" && $scope.setP.line != "TC"){//OTHER
      $scope.isVial   = false;
      $scope.isFlask  = false;
      $scope.isPlate  = false;
      $scope.isTC     = false;
      $scope.isOther  = true;
    }
    if($scope.setP.line == "well plate"){//WELL PLATES
      $scope.isVial   = false;
      $scope.isFlask  = false;
      $scope.isPlate  = true;
      $scope.isTC     = false;
      $scope.isOther  = false;
      if($scope.setP.series === "plate cover"){
        $scope.notAplate = true;
      }else{
        $scope.notAplate = false;
      }
    }
  };
    
  
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
tic.controller('techlibraryController',['$scope', '$filter', 'dataFactory',  function($scope, $filter, dataFactory){
  $scope.product = "";
  $scope.searchanything = "";
  $scope.gi   = "";
  $scope.v    = "";
  $scope.an   = "";
  $scope.pw   = "";
  $scope.faq  = "";
  $scope.comp = "";
  
  dataFactory.get_techdata().then(function(responce){
    $scope.techdata = responce.data;
    $scope.$watch('product', function(){
      $scope.tl_rslt = $filter('filter')($scope.techdata, {subProductLine : $scope.product});
      $scope.gi   = $filter('filter')($scope.tl_rslt, {type : 'GI'});
      $scope.faq  = $filter('filter')($scope.tl_rslt, {type : 'FAQ'});
      $scope.comp = $filter('filter')($scope.tl_rslt, {type : 'COMP'});
      $scope.v    = $filter('filter')($scope.tl_rslt, {type : 'VIDEO'});
      $scope.an   = $filter('filter')($scope.tl_rslt, {type : 'APPNOTE'});
      $scope.pw   = $filter('filter')($scope.tl_rslt, {type : 'PW'});
      //checks for length on result and dim or undim tiles
      $scope.noGo = function(main, nav){
        $(main).addClass('dim');
        $(main).attr('data-techblocklink', '');
        //prevent clicks on disabled tech nav bar links
        $(nav+" a").on('click', function(e){
          e.preventDefault();
        });
      };
      $scope.yesGo = function(main, nav, url){
        $(main).removeClass('dim');
        $(main).attr('data-techblocklink', url);
        //moved this here from site.js since the .dim class was added after site.js parsed causing a click responce from tech library blocks that were disabled with .dim
        $(main).on('click', function(e){
          window.location.assign(url);
        });
        $(nav+" a").off();
      };
      if($scope.gi.length == 0 && $scope.faq.length == 0 && $scope.comp.length == 0){
        $scope.noGo('.tl-home-gi', '.tl-nav-gi');
      }else{
        $scope.yesGo('.tl-home-gi', '.tl-nav-gi', 'tl/gi');
      }
      if($scope.v.length == 0){
        $scope.noGo('.tl-home-v', '.tl-nav-v');
      }else{
        $scope.yesGo('.tl-home-v', '.tl-nav-v', 'tl/v');
      }
      if($scope.an.length == 0){
        $scope.noGo('.tl-home-an', '.tl-nav-an');
      }else{
        $scope.yesGo('.tl-home-an', '.tl-nav-an', 'tl/an');
      }
      if($scope.pw.length == 0){
        $scope.noGo('.tl-home-pw', '.tl-nav-pw');
      }else{
        $scope.yesGo('.tl-home-pw', '.tl-nav-pw', 'tl/pw');
      }
    });
    
  });
  
  
  dataFactory.get_prodinfo().then(function(responce){
    $scope.prodinfo = responce.data;
    //watch for changes to $scope.product
    $scope.$watch('product', function(){
      $scope.pi = $filter('filter')($scope.prodinfo, {product: $scope.product})[0];
      
      
    }); //END $watch
  });

  //check and set variables from session storage
  if($scope.getStorage('tl_line')){
    $scope.line  = $scope.getStorage('tl_line');
  }
  if($scope.getStorage('tl_subLine')){
    $scope.product = $scope.getStorage('tl_subLine');
  }else{
    $scope.product = "";
  }
  //set select to $scope.product if has value
  if($scope.product){
    $('option[value="'+$scope.product+'"]').attr('selected', true);
  }
  
  
}]);

//===============techResult======================
tic.controller('techResultController', ['$scope', '$filter', '$sce', 'dataFactory', function($scope, $filter, $sce, dataFactory){

  $scope.techQuery = $scope.getQueryVariable('id');
  dataFactory.get_techdata().then(function(responce){
    $scope.techlibrary = responce.data;
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
        window.location = $scope.techNote.link;
      }
    if($scope.techNote.linkType === "mp4"){
      $scope.VIDEO = true;
      $scope.videoUrl = url + "/wp-content/uploads/video/videos/" + $scope.techNote.link + '.mp4';
      }
  
  });
}]);

//=====Sales Portal=====
tic.controller('sftofvController', ['$scope', 'dataFactory', '$filter', function($scope, dataFactory, $filter){
  dataFactory.get_sftofv().then(function(responce){
   $scope.sftofv = responce.data;
 });
 
 dataFactory.get_salestips().then(function(responce){
   $scope.salestips = responce.data;
   $scope.salesTipProduct = "";
   $scope.$watch('salesTipProduct', function(){
     if($scope.salesTipProduct == ""){
       $scope.st = "";
     } else{
        $scope.st = $filter('filter')($scope.salestips, {product: $scope.salesTipProduct})[0];
     }
    }); //END $watch
 });
  
 $scope.tweetLimit = 140;
 $scope.tweetText = "";
 $scope.$watch('tweetText', function(){
   $scope.tweetLength = $scope.tweetText.length;
   $scope.tweetWarning = false;
   if($scope.tweetLength > $scope.tweetLimit){
     $scope.tweetWarning = true;
     $('input[name="suggestTweet"]').prop('disabled', true);
   }else{
     $scope.tweetWarning = false;
     $('input[name="suggestTweet"]').prop('disabled', false);
   }
 });

}]);


//=====test page=====
tic.controller('testController', ['$scope', 'dataFactory', function($scope, dataFactory){
   
   dataFactory.get_distributors().then(function(responce){
    $scope.distributors = responce.data;
  });
  
    $scope.welcome = "whats going on";
  
  

}]);


//test also page
tic.controller('testAlsoController',['$scope', function($scope){

  
}]);


