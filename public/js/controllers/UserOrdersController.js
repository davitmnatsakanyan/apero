app.controller('UserOrdersController',  ['$scope', 'AuthService', 'UserModel', function($scope, AuthService, UserModel){
    AuthService.auth('user');

    UserModel.getOrders().then(
        function(response){
            console.log(response)
        },
        
        function(error){
            console.log(error)
        }
    );
    
}]);
