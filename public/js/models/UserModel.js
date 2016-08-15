app.factory('UserModel', ['$http', function($http) {
    return {
        getUser: function () {
            return $http({
                method : "get",
                url : "user/settings/update"
            });
        },
        
        update: function(data){
            return  $http({
                data: data,
                method : "post",
                url : "user/settings/update"
            });
        },
        
        changePassword:function(data){
            return  $http({
                data: data,
                method : "post",
                url : "user/settings/changePassword"
            });
        },
        
        getOrders: function(){
            return  $http({
                method : "get",
                url : "user"
            });

        },
        
        getOrder: function(order_id){
            return $http({
                method :"get",
                url : "user/order/show/" + order_id
            });
        },
        
    };
}]);
