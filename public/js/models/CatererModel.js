app.factory('CatererModel', ['$http', function($http) {
    return {
        getAccount: function () {
            return $http({
                method : "get",
                url : "caterer/account"
            });
        }
    };
}]);
