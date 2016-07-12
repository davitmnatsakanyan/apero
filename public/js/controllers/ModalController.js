app.controller('ModalController', ['$uibModalInstance', '$scope', '$uibModal', '$log', function ($uibModalInstance, $scope, $uibModal, $log) {

    $scope.items = items;
    $scope.selected = {
        item: $scope.items[0]
    };

    $scope.ok = function () {
        $uibModalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };


}]);
