app.controller('CatererController', ['$scope', '$routeParams', 'CatererModel', 'sharedProperties',   function ($scope, $routeParams, CatererModel, sharedProperties) {

    $('#datetimepicker4').datetimepicker();

    var caterer_id = $routeParams.caterer_id;
    var caterer = CatererModel.getCaterer(caterer_id).then(function(response){
        console.log(response.data.caterer);
        $scope.menus = response.data.menus;
        $scope.caterer  = response.data.caterer;

    });
    var orders = [];
    var i=0;
    $scope.getData = function(order, product_count){
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
        $scope.orders = orders;

        var total_price = 0;
        $.each(orders, function(index, value){
            total_price = total_price + (value.price * value.count);
        });

        $scope.total_price = total_price;

        sharedProperties.setProperty(orders);
    }

}]);

