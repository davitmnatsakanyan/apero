app.controller('UserOrdersController',  ['$scope', 'AuthService', 'UserModel', function($scope, AuthService, UserModel){
    AuthService.auth('user');

    UserModel.getOrders().then(
        function(response){
            if(response.data.success) {
                $scope.orders = response.data.orders;
            }
        },
        
        function(error){
            console.log(error)
        }
    );
    
}]);
