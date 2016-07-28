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


    $scope.filteredTodos = [];
        $scope.currentPage = 1;
        $scope.numPerPage = 10;
        $scope.maxSize = 5;
        $scope.a = 100;

    $scope.makeTodos = function() {
        $scope.todos =[];
        for (i=1;i<=1000;i++) {
            $scope.todos.push({ text:"todo "+i, done:false});
        }

    };
    $scope.makeTodos();
    
    $scope.$watch("currentPage + numPerPage", function() {
        alert(122);
        var begin = (($scope.currentPage - 1) * $scope.numPerPage)
            , end = begin + $scope.numPerPage;

        $scope.filteredTodos = $scope.todos.slice(begin, end);
    });
    
    
}]);



