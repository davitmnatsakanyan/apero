app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, product) {

    $scope.product = product;
    $scope.selected = {
        item: $scope.product.subproducts[0]
    };

    $scope.ok = function () {
        console.log('mta');
        $uibModalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
