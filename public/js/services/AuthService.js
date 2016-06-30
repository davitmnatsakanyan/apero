app.service('AuthService', ['$http', '$location', '$window', function ($http, $location, $window) {
    this.auth = function () {
           $http({
                method: "GET",
                url: "auth/check"
            })
            .success(function (response) {
                if(response.success == 0){
                    $location.path('caterer/login');
                }
            });

    }
}]);
