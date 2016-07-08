app.controller('CartController',  ['$scope', 'sharedProperties', function($scope, sharedProperties){


    $scope.orders = JSON.parse(localStorage.getItem('cart'));
    if(localStorage.getItem('total_price'))
        $scope.total_price = localStorage.getItem('total_price');
    else
        $scope.total_price = 0;

    var new_total_price;
    $scope.removeFromCart = function(index, total_price){

        $products = JSON.parse(localStorage.getItem('cart'));

        new_total_price = total_price -  ($products[index].price * $products[index].count);
        localStorage.setItem('total_price', new_total_price);
        $scope.total_price = new_total_price;

        $products.splice(index, 1);

        localStorage.setItem('cart', JSON.stringify( $products));
        $scope.orders = $products;

    }
}]);
