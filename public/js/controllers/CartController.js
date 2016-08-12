app.controller('CartController',  ['$scope', function($scope){
    $('#datetimepicker4').datetimepicker();

    if(JSON.parse(localStorage.getItem('cart'))){
        $scope.products = JSON.parse(localStorage.getItem('cart'))[0].products;
        $scope.packages = JSON.parse(localStorage.getItem('cart'))[0].packages;
    }
    else{
        $scope.products = '';
        $scope.packages = '';
    }

    if(localStorage.getItem('total_price'))
        $scope.total_price = localStorage.getItem('total_price');
    else
        $scope.total_price = 0;

    var new_total_price;
    $scope.removeFromCart = function(index, total_price, type){

        $products = JSON.parse(localStorage.getItem('cart'))[0].products;
        $packages = JSON.parse(localStorage.getItem('cart'))[0].packages;

        if(type == 'product')
            new_total_price = total_price -  ($products[index].price * $products[index].count);
        else
            new_total_price = total_price -  ($packages[index].price * $packages[index].count);

        localStorage.setItem('total_price', new_total_price);
        $scope.total_price = new_total_price;

        if(type == 'product') {
            $products.splice(index, 1);

            if ($products.length == 0 && $packages.length == 0) {
                localStorage.removeItem('cart');
                localStorage.removeItem('total_price');
            }
            else {
                var orders = JSON.parse(localStorage.getItem('cart'));
                orders[0].products = $products;
                localStorage.setItem('cart', JSON.stringify(orders));
            }

            $scope.products = $products;
        }
        else{
            $packages.splice(index, 1);

            if ($products.length == 0 && $packages.length == 0) {
                localStorage.removeItem('cart');
                localStorage.removeItem('total_price');
            }
            else {
                var orders = JSON.parse(localStorage.getItem('cart'));
                orders[0].packages = $packages;
                localStorage.setItem('cart', JSON.stringify(orders));
            }

            $scope.packages = $packages;
        }

    }
}]);
