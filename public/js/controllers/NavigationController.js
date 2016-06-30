app.controller('NavigationController', ['$scope', '$uibModal', '$log',  function ($scope, $uibModal, $log) {

    $scope.animationsEnabled = true;

    $scope.login = function (size) {
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            templateUrl: 'templates/login.blade.php',
            controller: 'AuthController',
            size: size,
            resolve: {
                data: function () {
                    return $scope.data;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    }

}]);
