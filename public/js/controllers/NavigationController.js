app.controller('NavigationController', ['$rootScope', '$scope', '$uibModal', '$log', '$http', '$location',  function ($rootScope, $scope, $uibModal, $log, $http, $location) {


     $http({
        method : "GET",
        url : "auth/logedin"
    }).success(function(response){
         $rootScope.is_logedin = response.success;
         $rootScope.role = response.role;
     });

    $scope.logout = function () {
        $http({
                data: $scope.data,
                method : "GET",
                url : "auth/logout"
            }
        ).success(function (response) {
                if(response.success == 1){
                    $location.path('login');
                }
            }).error( function (error) {
                console.log(error);

            });
    };

}]);
