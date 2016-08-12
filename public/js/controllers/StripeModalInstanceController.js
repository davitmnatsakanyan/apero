app.controller('StripeModalInstanceCtrl', function ($scope, $uibModalInstance) {
    
    $scope.ok = function () {
        console.log('mta');
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
