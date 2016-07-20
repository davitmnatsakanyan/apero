app.controller('CatererProductsController', ['$scope', 'CatererAccountModel', 'AuthService',  function ($scope, CatererAccountModel,  AuthService) {

    AuthService.auth('caterer');


    CatererAccountModel.getProducts().then(
        function(response){
            
        },
        function(error){
            
        }
    );
}]);

