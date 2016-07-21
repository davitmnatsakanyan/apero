app.service('AuthService', ['$rootScope', '$http', '$location',  function ($rootScope, $http, $location) {
    this.auth = function (role) {
           $http({
                method: "GET",
                url: "auth/check/"+role
            })
            .success(function (response) {
                if(response.success == 0){
                    $location.path('login');
                }
            });

    };

    this.auth_check = function(role){
       return  $http({
            method: "GET",
            url: "auth/check/"+role
        });
    }
}]);
