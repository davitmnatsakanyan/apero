app.controller('CatererOrdersController', ['$scope', 'CatererAccountModel', 'AuthService','$location',  function ($scope, CatererAccountModel,  AuthService, $location) {

    AuthService.auth('caterer');

    CatererAccountModel.getOrders().then(
        function(response){
            $scope.orders = response.data.orders;
            $scope.makeTodos();
            // console.log(response.data)
        },
        function(error){
            console.log(error)
        }
    );

    $scope.currentPage = 0;

    $scope.makeTodos = function() {
        $scope.filteredTodos = [];
        $scope.currentPage = 1;
        $scope.numPerPage = 3;
        $scope.maxSize = 5;
        $scope.todos = [];

        for (var i = 0; i < $scope.orders.length; i++) {
            $scope.todos.push({
                num:i+1,
                order_id:$scope.orders[i].id,
                address: $scope.orders[i].delivery_zip + " "+
                $scope.orders[i].delivery_city,

                time : $scope.orders[i].delivery_time,
                status: $scope.orders[i].status,
            });
        }
    };


    $scope.$watch("currentPage + numPerPage", function() {
        if($scope.todos) {
            var begin = (($scope.currentPage - 1) * $scope.numPerPage), end = begin + $scope.numPerPage;
            $scope.filteredTodos = $scope.todos.slice(begin, end);
        }
    });


    $scope.isActive = function (viewLocation) {
        // return $location.path().indexOf(viewLocation) == 0;
        // console.log($location.path());
        return viewLocation === $location.path();
    };

}]);
