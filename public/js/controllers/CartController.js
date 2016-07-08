app.controller('CartController',  ['$scope', 'sharedProperties', function($scope, sharedProperties){

$scope.orders = sharedProperties.getProperty();

}]);
