app.controller('NavigationController', ['$scope', '$uibModal', '$log', '$http', '$location',  function ($scope, $uibModal, $log, $http, $location) {


     $http({
        method : "GET",
        url : "auth/logedin"
    }).success(function(response){
         $scope.is_logedin = response.success;
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
