app.factory('CatererModel', ['$http', function($http) {
    return {
        getCaterer: function (caterer_id) {
            return $http({
                method : "get",
                url : "get/caterer/"+caterer_id
            });
        },
    };
}]);
