app.controller('ModalController', ['$rootScope', '$uibModalInstance', '$scope', '$uibModal', 'items', 'product', 'product_count', function ($rootScope, $uibModalInstance, $scope, $uibModal, items, product, product_count) {

    if(localStorage.getItem('cart'))
        var orders = JSON.parse(localStorage.getItem('cart'));
    else
        var orders = [];


    $scope.items = items;
    $scope.i = {
        sub_id: 0,
        price: 0,
        description: ""
    };

    $scope.product = product;
    $scope.product_count = product_count;

    $scope.add = function () {
        
        var data = {};

        data.count = product_count;
        data.avatar = product.avatar;
        data.caterer_id = product.caterer_id;
        data.parent_product = product.id;
        data.ingredinets = product.ingredinets;
        data.menu_id = product.menu_id;
        data.name = product.name;
        data.price = $scope.i.price;
        data.description = $scope.i.description;
        data.sub_id = $scope.i.sub_id;

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
