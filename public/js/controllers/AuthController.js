app.controller('AuthController', ['$scope', '$http', '$location', '$uibModalInstance', 'data',   function ($scope, $http, $location, $uibModalInstance, data) {

    $scope.login_submit = function(){
        console.log($scope.data);
        return ;
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/login"
        }).then(function (response) {

            alert('dfdf');
            return;
            if(response.data == 1) {
                //$location.path('caterer/account');

            }
            if(response.data == 0){
                $location.path('/');

            }
            if(response.data == 2){
                $location.path('/');

            }

        }, function (error) {
            console.log(error);

        });
        $uibModalInstance.dismiss();
    }

    $scope.reg_submit = function(){
        event.preventDefault();
        console.log($scope.data)
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/register"
        }).then(function (response) {
            $http({
                method : "get",
                url : "caterer/account"
            })
        }, function (error) {
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
