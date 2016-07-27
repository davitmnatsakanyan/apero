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
        
        getOrders: function(){
            return  $http({
                method : "get",
                url : "user"
            });

        }
    };
}]);
