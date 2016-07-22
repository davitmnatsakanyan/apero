app.controller('SubPrdModalController', ['$rootScope', '$uibModalInstance', '$scope', '$uibModal', 'items', 'product', 'product_count', function ($rootScope, $uibModalInstance, $scope, $uibModal, items, product, product_count) {

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

    $scope.items = items;
    
    $scope.description = "";
    $scope.i = {
        product : {
            sub_id : $scope.items[0].id,
            price : $scope.items[0].price
        }
    };

    $scope.product = product;
    $scope.product_count = product_count;

    $scope.add = function () {
        
        var data = {};

        data.count = product_count;
        data.avatar = product.avatar;
        data.caterer_id = product.caterer_id;
        data.id = product.id;
        data.ingredinets = product.ingredinets;
        data.menu_id = product.menu_id;
        data.name = product.name;
        data.price = $scope.i.product.price;
        data.description = $scope.description;
        data.sub_id = $scope.i.product.sub_id;

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

        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
}]);
