app.factory('SearchModel', ['$http', function($http) {
    return {
        getIndex: function (data) {
            if(data) {

                return $http({
                    method: "get",
                    url: "search/caterers?city=" + data.city
                });
            }
            else{
                return $http({
                    method: "get",
                    url: "search/caterers"
                });
            }
        }
    };
}]);

