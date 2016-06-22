app.controller('AuthController', ['$scope', '$http',  function ($scope, $http) {

    $scope.login_submit = function(){
        event.preventDefault();
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/login"
        }).then(function mySucces(response) {
            console.log(response);
        }, function myError(error) {
            console.log(error);

        });
    }

    $scope.reg_submit = function(){
        event.preventDefault();
        console.log($scope.data)
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/register"
        }).then(function mySucces(response) {
            //console.log(response);
        }, function myError(error) {
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
