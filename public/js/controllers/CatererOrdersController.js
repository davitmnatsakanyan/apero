app.controller('CatererOrdersController', ['$scope', 'CatererAccountModel', 'AuthService',  function ($scope, CatererAccountModel,  AuthService) {

    AuthService.auth('caterer');

    CatererAccountModel.getOrders().then(
        function(response){
            console.log(response.data)
        },
        function(error){
            console.log(error)
        }
    );

}]);
