app.controller('AuthController', ['$scope', '$http', '$location', '$window', 'AuthService',   function ($scope, $http, $location, $window, AuthService) {


    //$scope.reg_submit = function(){
    //    console.log('dfdfdf');
    //    return ;
    //    $http({
    //        data: $scope.data,
    //        method : "POST",
    //        url : "auth/login"
    //    }).then(function (response) {
    //
    //        alert('dfdf');
    //        return;
    //        if(response.data == 1) {
    //            //$location.path('caterer/account');
    //
    //        }
    //        if(response.data == 0){
    //            $location.path('/');
    //
    //        }
    //        if(response.data == 2){
    //            $location.path('/');
    //
    //        }
    //
    //    }, function (error) {
    //        console.log(error);
    //
    //    });
    //    $uibModalInstance.dismiss();
    //}

    $scope.reg_submit = function(){
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/register"
        }
        ).success(function (response) {
            if(response.success == 1){
                $location.path('caterer/account');
            }
        }).error( function (error) {
            console.log(error);

        });
    }

    //$scope.ok = function () {
    //    $uibModalInstance.close($scope.selected.item);
    //};
    //
    //$scope.cancel = function () {
    //    $uibModalInstance.dismiss('cancel');
    //};

}]);
