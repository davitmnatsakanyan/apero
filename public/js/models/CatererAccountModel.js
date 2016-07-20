app.factory('CatererAccountModel', ['$http', function($http) {
    return {
        getAccount: function () {
            return $http({
                method : "get",
                url : "caterer/account"
            });
        },

        getRegister: function(){
            return $http({
                method : "get",
                url : "auth/register"
            });
        },
        
        getOrders: function(){
            return $http({
                method : "get",
                url : "caterer/order"
            });
        },

        getProducts: function(){
        return $http({
            method : "get",
            url : ""
        });
    },
        
        
    };
}]);
