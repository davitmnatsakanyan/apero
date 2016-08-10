app.factory('CatererProductModel', ['$http', function ($http) {
    return {
        getKitchens: function () {
            return $http({
                method: "get",
                url: "caterer/product/single/kitchens"
            });
        },

        getMenus: function (kitchen_id) {
            return $http({
                method: "get",
                url: "caterer/product/single/menus/" + kitchen_id
            });
        },
        
        

        changeStatus: function (order) {
            return $http({
                data: order,
                method: "post",
                url: "caterer/order/change-status"
            });
        },

    };
}]);
