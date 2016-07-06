app.factory('SearchModel', ['$http', function($http) {
    return {
        getIndex: function () {
            return $http({
                method : "get",
                url : "search/caterers"
            });
        },
    };
}]);

