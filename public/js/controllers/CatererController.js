app.controller('CatererController', ['$rootScope', '$log', '$uibModal', '$scope', '$routeParams', 'CatererModel', 'sharedProperties', '$timeout',   function ($rootScope, $log, $uibModal, $scope, $routeParams, CatererModel, sharedProperties, $timeout) {
    // $timeout($('#datetimepicker4').datetimepicker(), 2000);

    var caterer_id = $routeParams.caterer_id;
    if(cart = localStorage.getItem('cart')) {
        $scope.cat_id = JSON.parse(cart)[0].products[0] ? JSON.parse(cart)[0].products[0].caterer_id: JSON.parse(cart)[0].packages[0].caterer_id;
        if ( $scope.cat_id!= caterer_id) {
            localStorage.removeItem('cart');
            localStorage.removeItem('total_price');
        }
    }

    var caterer = CatererModel.getCaterer(caterer_id).then(function(response){
        $scope.packages = response.data.packages;
        
        $scope.menus = response.data.menus;
        $scope.caterer  = response.data.caterer;

    });

    if (localStorage.getItem('cart')) {
        var orders = [{
            'products': JSON.parse(localStorage.getItem('cart'))[0].products,
            'packages': JSON.parse(localStorage.getItem('cart'))[0].packages
        }]
    }
    else {
        var orders = [{
            'products': [],
            'packages': []
        }];
    }

    if(localStorage.getItem('total_price')) {
        var total_price = localStorage.getItem('total_price');
    }
    else {
        var total_price = 0;
    }



    $scope.delivery_time = new Date();
    if(localStorage.getItem('delivery_time')) {
        $scope.delivery_time = new Date(JSON.parse(localStorage.getItem('delivery_time')));
    }

    $scope.$watch("delivery_time",function (newValues, oldValues, scope) {
        localStorage.setItem('delivery_time', JSON.stringify($scope.delivery_time));
    });

    
    $rootScope.total_price = total_price;
    $rootScope.products = orders[0].products;
    $rootScope.packages = orders[0].packages;

    var i=0;
    $scope.addToCart = function(order, count, type){
        console.log(order);
        console.log(count);
        console.log(type);
        if(type == 'product') {
            if (order.subproducts.length > 0 && count > 0) {
                $scope.items = order.subproducts;
                $scope.animationsEnabled = true;
                var size = '';
                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'templates/modals/subproducts_modal.blade.php',
                    controller: 'SubPrdModalController',
                    size: size,
                    resolve: {
                        items: function () {
                            return $scope.items;
                        },
                        product: function () {
                            return order;
                        },
                        product_count: function () {
                            return count;
                        }
                    }
                });

                $scope.toggleAnimation = function () {
                    $scope.animationsEnabled = !$scope.animationsEnabled;
                };

            }
            else {
                if (count > 0) {
                    if (localStorage.getItem('cart')) {
                        var orders = [{
                            'products': JSON.parse(localStorage.getItem('cart'))[0].products,
                            'packages': JSON.parse(localStorage.getItem('cart'))[0].packages
                        }]
                    }
                    else {
                        var orders = [{
                            'products': [],
                            'packages': []
                        }];
                    }

                    var data = {};

                    data.count = count;
                    data.avatar = order.avatar;
                    data.caterer_id = order.caterer_id;
                    data.id = order.id;
                    data.ingredinets = order.ingredinets;
                    data.menu_id = order.menu_id;
                    data.name = order.name;
                    data.price = order.price;

                    orders[0].products.push(data);

                    var total_price = 0;
                    $.each(orders[0].products, function (index, value) {
                        total_price = total_price + (value.price * value.count);
                    });
                    $.each(orders[0].packages, function (index, value) {
                        total_price = total_price + (value.price * value.count);
                    });


                    localStorage.setItem('cart', JSON.stringify(orders));
                    localStorage.setItem('total_price', total_price);



                    $rootScope.products = JSON.parse(localStorage.getItem('cart'))[0].products;

                    $rootScope.total_price = localStorage.getItem('total_price');
                }
            }
        }
        else{
            if(type == 'package'){
                if(count > 0) {
                    if (localStorage.getItem('cart')) {
                        var orders = [{
                            'products': JSON.parse(localStorage.getItem('cart'))[0].products,
                            'packages': JSON.parse(localStorage.getItem('cart'))[0].packages
                        }]
                    }
                    else {
                        var orders = [{
                            'products': [],
                            'packages': []
                        }];
                    }

                    var data = {};

                    data.count = count;
                    data.avatar = order.avatar;
                    data.caterer_id = order.caterer_id;
                    data.id = order.id;
                    data.name = order.name;
                    data.price = order.price;

                    orders[0].packages.push(data);

                    var total_price = 0;
                    $.each(orders[0].products, function (index, value) {
                        total_price = total_price + (value.price * value.count);
                    });
                    $.each(orders[0].packages, function (index, value) {
                        total_price = total_price + (value.price * value.count);
                    });


                    localStorage.setItem('cart', JSON.stringify(orders));
                    localStorage.setItem('total_price', total_price);



                    $rootScope.packages = JSON.parse(localStorage.getItem('cart'))[0].packages;

                    $rootScope.total_price = localStorage.getItem('total_price');
                }
            }
        }

    }

    $scope.show_modal = function(order, product_count){

        if(order.subproducts.length > 0 && product_count > 0){
            $scope.items = order.subproducts;

            $scope.animationsEnabled = true;
            var size = '';

            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'templates/modals/subproducts_modal.blade.php',
                controller: 'SubPrdModalController',
                size: size,
                resolve: {
                    items: function () {

                        return $scope.items;
                    },
                    product: function(){
                        return order;
                    },
                    product_count : function(){
                        return product_count;
                    }

                }
            });


            $scope.toggleAnimation = function () {
                $scope.animationsEnabled = !$scope.animationsEnabled;
            };
        }
        else {
            if (product_count > 0) {

                $scope.animationsEnabled = true;
                var size = '';

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'templates/modals/custom_product_modal.blade.php',
                    controller: 'CustomPrdModalController',
                    size: size,
                    resolve: {
                        product: function () {
                            return order;
                        },
                        product_count: function () {
                            return product_count;
                        }

                    }
                });


                $scope.toggleAnimation = function () {
                    $scope.animationsEnabled = !$scope.animationsEnabled;
                };
            }
        }
    }

}]);

