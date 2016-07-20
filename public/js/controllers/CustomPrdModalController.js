app.controller('CustomPrdModalController', ['$rootScope', '$uibModalInstance', '$scope', '$uibModal',  'product', 'product_count', function ($rootScope, $uibModalInstance, $scope, $uibModal, product, product_count) {

    if(localStorage.getItem('cart'))
        var orders = JSON.parse(localStorage.getItem('cart'));
    else
        var orders = [];

    $scope.product = product;
    $scope.product_count = product_count;
    $scope.price = product.price;

    $scope.add = function () {

        var data = {};

        data.count = product_count;
        data.avatar = product.avatar;
        data.caterer_id = product.caterer_id;
        data.product_id = product.id;
        data.ingredinets = product.ingredinets;
        data.menu_id = product.menu_id;
        data.name = product.name;
        data.price = product.price;
        data.description = $scope.description;

        orders.push(data);

        var total_price = 0;
        $.each(orders, function (index, value) {
            total_price = total_price + (value.price * value.count);
        });
        
        localStorage.setItem('cart', JSON.stringify(orders));
        localStorage.setItem('total_price', total_price);

        $rootScope.orders = JSON.parse(localStorage.getItem('cart'));
        $rootScope.total_price = localStorage.getItem('total_price');


        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };


}]);

