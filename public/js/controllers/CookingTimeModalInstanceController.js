app.controller('CookingTimeModalInstanceCtrl', function ($scope, $uibModalInstance,data) {

    $scope.editCooking = data;
    console.log($scope.editCooking);

    $scope.ok = function () {
        $uibModalInstance.close($scope.editCooking);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
