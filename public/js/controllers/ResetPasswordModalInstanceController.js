app.controller('ResetPasswordModalInstanceCtrl', function ($scope, $uibModalInstance) {
   
    $scope.email="";

    $scope.ok = function ( email) {
        $uibModalInstance.close($scope.email);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
