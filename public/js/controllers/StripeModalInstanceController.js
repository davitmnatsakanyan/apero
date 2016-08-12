app.controller('StripeModalInstanceCtrl', function ($scope, $uibModalInstance) {
    
    $scope.ok = function () {
        $uibModalInstance.close($scope.token);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.stripeCallback = function (code, result) {
        $scope.token = result.id;
        if (result.error) {
            window.alert('it failed! error: ' + result.error.message);
        } else {
            $scope.ok();
        }
    };

});
