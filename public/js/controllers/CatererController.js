app.controller('CatererController', ['$scope', '$routeParams', 'CatererModel', 'sharedProperties', '$timeout',   function ($scope, $routeParams, CatererModel, sharedProperties, $timeout) {

    $timeout($('#datetimepicker4').datetimepicker(), 2000);

    var caterer_id = $routeParams.caterer_id;
    var caterer = CatererModel.getCaterer(caterer_id).then(function(response){

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
        var  data = {};

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
        $.each(orders, function(index, value){
            total_price = total_price + (value.price * value.count);
        });


        localStorage.setItem('cart', JSON.stringify(orders));
        localStorage.setItem('total_price', total_price);

        $scope.orders = JSON.parse(localStorage.getItem('cart'));
        $scope.total_price = localStorage.getItem('total_price');

    }

}]);

