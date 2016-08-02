app.controller('CatererOrdersController', ['$scope', 'CatererAccountModel', 'AuthService', '$location', '$routeParams','toastr',
    function ($scope, CatererAccountModel, AuthService, $location, $routeParams, toastr) {

        AuthService.auth('caterer');


        $scope.currentProductPage = 0;
        $scope.currentPackagePage = 0;

        $scope.statuses = [
            {
                name: 'Idle'
            },
            {
                name: 'Processing'
            },
            {
                name: 'Shipping'
            },
            {
                name: 'Complete'
            },
            {
                name: 'Denied'
            }
        ];

        if ($routeParams.order_id) {
            var order_id = $routeParams.order_id;
            CatererAccountModel.getOrder(order_id).then(
                function (responce) {
                    if (responce.data.success) {
                        $scope.order = responce.data.order;


                        if ($scope.order.products) {
                            $scope.currentProductPage = 1;
                            $scope.oldProductPage = 1;
                            $scope.numPerPageForProducts = 3;
                            $scope.productsMaxSize = 5;
                            $scope.filteredProducts = $scope.order.products.slice(0, $scope.numPerPageForProducts);
                        }

                        if ($scope.order.packages) {
                            $scope.currentPackagePage = 1;
                            $scope.oldPackagePage = 1;
                            $scope.numPerPageForPackages = 1;
                            $scope.packagesMaxSize = 5;
                            $scope.filteredPackage = $scope.order.packages.slice(0, $scope.numPerPageForPackages);
                        }


                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                },

                function (error) {
                    // $scope.errorMessages(error.data);
                }
            );
        }


        $scope.getOrders = function() {
            CatererAccountModel.getOrders().then(
                function (response) {
                    $scope.orders = response.data.orders;
                    $scope.caterer = response.data.caterer;
                    $scope.makeTodos();
                    $scope.filteredTodos = $scope.todos.slice(0, $scope.numPerPage);
                },
                function (error) {
                    console.log(error)
                }
            );
        };

        $scope.getOrders();

        $scope.currentPage = 0;

        $scope.makeTodos = function () {
            $scope.filteredTodos = [];
            $scope.currentPage = 1;
            $scope.oldPage = 1;
            $scope.numPerPage = 3;
            $scope.maxSize = 5;
            $scope.todos = [];

            for (var i = 0; i < $scope.orders.length; i++) {
                $scope.todos.push({
                    num: i + 1,
                    order_id: $scope.orders[i].id,
                    address: $scope.orders[i].delivery_zip + " " +
                    $scope.orders[i].delivery_city,

                    time: $scope.orders[i].delivery_time,
                    status: { name: $scope.orders[i].status },
                });
            }
        };


        $scope.$watchGroup(['currentPackagePage', 'currentPage', 'currentProductPage'], function () {
            if ($scope.todos && $scope.oldPage != $scope.currentPage) {
                var begin = (($scope.currentPage - 1) * $scope.numPerPage), end = begin + $scope.numPerPage;
                $scope.filteredTodos = $scope.todos.slice(begin, end);
                $scope.oldPage = $scope.currentPage;
            }
            if ($scope.order) {
                if ($scope.order.products && $scope.oldProductPage != $scope.currentProductPage) {
                    var begin = (($scope.currentProductPage - 1) * $scope.numPerPageForProducts), end = begin + $scope.numPerPageForProducts;
                    $scope.filteredProducts = $scope.order.products.slice(begin, end);
                    $scope.oldProductPage = $scope.currentProductPage;
                }

                if ($scope.order.packages && $scope.oldPackagePage != $scope.currentPackagePage) {
                    var begin = (($scope.currentPackagePage - 1) * $scope.numPerPageForPackages), end = begin + $scope.numPerPageForPackages;
                    $scope.filteredPackage = $scope.order.packages.slice(begin, end);
                    $scope.oldPackagePage = $scope.currentPackagePage;
                    ;
                }
            }
        });


        $scope.changeSelect = function (order_id) {
            var order = $scope.todos.find(function(todo){
                return todo.order_id == order_id;
            },order_id);

            CatererAccountModel.changeStatus(order).then(function(responce){
                if(responce.data.success){
                    toastr.success(responce.data.message);
                }
                else {
                    toastr.error(responce.data.error, 'Error');
                }
            });
        };
        
        $scope.acceptOrder= function(order_id){
            CatererAccountModel.acceptOrder(order_id).then(function(responce){
                if(responce.data.success){
                    $scope.getOrders();
                    toastr.success(responce.data.message);
                }
                else {
                    toastr.error(responce.data.error, 'Error');
                }
            });
        };

        $scope.isActive = function (viewLocation) {
            return viewLocation === $location.path();
        };

    }]);
