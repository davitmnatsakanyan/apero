app.controller('UserOrdersController',  ['$scope', 'AuthService', 'UserModel', '$location', '$routeParams','toastr',function($scope, AuthService, UserModel,$location,$routeParams,toastr){
    AuthService.auth('user');

    if($routeParams.order_id) {
        var order_id = $routeParams.order_id;
        UserModel.getOrder(order_id).then(
            function(responce){
                if(responce.data.success){
                    $scope.order = responce.data.order;
                }
                else {
                    toastr.error(responce.data.error, 'Error');
                }
            },

            function(error){
                $scope.errorMessages(error.data);
            }
        );
    }

    $scope.currentPage = 0;
    
    UserModel.getOrders().then(
        function(response){
            // console.log(response);
            if(response.data.success) {
                $scope.orders = response.data.orders;
                $scope.user = response.data.user;
                $scope.makeTodos();
            }

            else
                toastr.error(responce.data.error, 'Error');
        },
        
        function(error){
            $scope.errorMessages(error.data);
        }
    );
    

    $scope.isActive = function (viewLocation) {
        // return $location.path().indexOf(viewLocation) == 0;
        return viewLocation === $location.path();
    };

    $scope.makeTodos = function() {
        $scope.filteredTodos = [];
        $scope.currentPage = 1;
        $scope.numPerPage = 2;
        $scope.maxSize = 5;
        $scope.todos = [];

        for (var i = 0; i < $scope.orders.length; i++) {
            $scope.todos.push({
                num:i+1,
                order_id:$scope.orders[i].id,
                address: $scope.orders[i].delivery_zip + " "+
                $scope.orders[i].delivery_city,
        
                price : $scope.orders[i].total_cost,
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




    $scope.errorMessages = function (errors) {
        var data="";

        angular.forEach(errors, function(value, key) {
            data +=  value + "<br/>";
        }, data);

        toastr.error(data, 'Error');

    }

}]);



