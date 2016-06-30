app.controller('AuthController', ['$scope', '$http', '$location', '$window', 'AuthService', 'CatererModel',   function ($scope, $http, $location, $window, AuthService, CatererModel) {

    CatererModel.getRegister().then(function(response){
        $scope.zip_codes = response.data.zip_codes;
        $scope.categories = response.data.categories;
    });

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
