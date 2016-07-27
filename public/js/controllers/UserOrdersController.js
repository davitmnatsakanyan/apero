app.controller('UserOrdersController',  ['$scope', 'AuthService', 'UserModel', '$location', function($scope, AuthService, UserModel,$location){
    AuthService.auth('user');

    $scope.statuses = [
        {name: "Idle", value: "Idle"},
        {name: "Processing", value: "Processing"},
        {name: "Shipping", value: "Shipping"},
        {name: "Denied", value: "Denied"}
    ];

    UserModel.getOrders().then(
        function(response){
            // console.log(response);
            if(response.data.success) {
                $scope.orders = response.data.orders;
            }
        },
        
        function(error){
            console.log(error)
        }
    );



    $scope.isActive = function (viewLocation) {
        // return $location.path().indexOf(viewLocation) == 0;
        return viewLocation === $location.path();
    };
    
}]);
