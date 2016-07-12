app.controller('CatererController', ['$uibModal', '$scope', '$routeParams', 'CatererModel', 'sharedProperties', '$timeout',   function ($uibModal, $scope, $routeParams, CatererModel, sharedProperties, $timeout) {


console.log(JSON.parse(localStorage.getItem('cart')))
    $timeout($('#datetimepicker4').datetimepicker(), 2000);

    var caterer_id = $routeParams.caterer_id;
    if(localStorage.getItem('cart')) {
        if (JSON.parse(localStorage.getItem('cart'))[0].caterer_id != caterer_id) {
            localStorage.removeItem('cart');
            localStorage.removeItem('total_price');
        }
    }

    var caterer = CatererModel.getCaterer(caterer_id).then(function(response){
//console.log(response.data.menus);

        $scope.menus = response.data.menus;
        $scope.caterer  = response.data.caterer;

    });
    if(localStorage.getItem('cart'))
        var orders = JSON.parse(localStorage.getItem('cart'));
    else
        var orders = [];


    if(localStorage.getItem('total_price')) {
        var total_price = localStorage.getItem('total_price');

    }
    else {
        var total_price = 0;
    }

    $scope.total_price = total_price;
    $scope.orders = JSON.parse(localStorage.getItem('cart'));


    var i=0;
    $scope.addToCart = function(order, product_count){

        if(order.subproducts.length > 0){

            $scope.items = ['item1', 'item2', 'item3'];

            $scope.animationsEnabled = true;
            var size = '';

            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'templates/subproducts_modal.blade.php',
                controller: 'ModalController',
                size: size,
                resolve: {
                    items: function () {
                        alert($scope.items)
                        return $scope.items;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });


            $scope.toggleAnimation = function () {
                $scope.animationsEnabled = !$scope.animationsEnabled;
            };

        }
        else {

            var data = {};

            data.count = product_count;
            data.avatar = order.avatar;
            data.caterer_id = order.caterer_id;
            data.id = order.id;
            data.ingredinets = order.ingredinets;
            data.menu_id = order.menu_id;
            data.name = order.name;
            data.price = order.price;
            data.price = order.price;

            orders.push(data);

            var total_price = 0;
            $.each(orders, function (index, value) {
                total_price = total_price + (value.price * value.count);
            });


            localStorage.setItem('cart', JSON.stringify(orders));
            localStorage.setItem('total_price', total_price);

            $scope.orders = JSON.parse(localStorage.getItem('cart'));
            $scope.total_price = localStorage.getItem('total_price');
        }

    }

}]);

