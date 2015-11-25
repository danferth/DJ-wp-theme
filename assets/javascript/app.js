var distributors = angular.module('distributors', ['ngSanitize']);

distributors.controller('distController', ['$scope', '$http', '$sce', function($scope, $http, $sce){
    $scope.welcome = "hello world";
    
    $http.get('https://tic-wp-danferth.c9.io/wp-content/themes/TIC-f/assets/javascript/distributors.json').then(function(res){
      $scope.distributors = res.data;
    
    $scope.distId = "73";  
    $scope.singleDist = function(obj){
      $scope.distId = obj.target.attributes.value.value - 1;
    console.log(obj);
    };
    console.log($scope.distId);

    });

    $scope.sortType = 'company';
    $scope.sortReverse = false;
    $scope.filterType = "";
    

}]);