var distributors = angular.module('distributors', []);

distributors.controller('distController', ['$scope', '$http', function($scope, $http){
    $scope.welcome = "hello world";
    
    $http.get('distributors.json').then(function(res){
      $scope.distributors = res.data;
      
      console.log($scope.distributors);
    });



}]);