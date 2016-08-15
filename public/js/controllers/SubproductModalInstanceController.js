app.controller('SubproductModalInstanceCtrl', function ($scope, $uibModalInstance,subproduct) {

    $scope.subproduct = subproduct;

    $scope.ok = function () {
        $uibModalInstance.close($scope.subproduct);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
