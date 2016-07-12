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

    }

    this.auth_check = function(){

        $http({
            method: "GET",
            url: "auth/check/user"
        })
            .success(function(response){

                if(response.success == 1){
                    $rootScope.is_logedin = 1;
                }
                else{
                    $rootScope.is_logedin = 0
                }
            });
    }

}]);
