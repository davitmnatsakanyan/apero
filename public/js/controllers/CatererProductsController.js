app.controller('CatererProductsController', ['$scope', 'CatererAccountModel', 'AuthService','$location',  function ($scope, CatererAccountModel,  AuthService ,$location) {

    AuthService.auth('caterer');


    CatererAccountModel.getProducts().then(
        function(response){
            
        },
        function(error){
            
        }
    );

    $scope.isActive = function (viewLocation) {
        // return $location.path().indexOf(viewLocation) == 0;
        return viewLocation === $location.path();
    };
}]);

