app.controller('UploadImageModalInstanceCtrl', function ($scope, $uibModalInstance,product_id) {

    $scope.product_id = product_id;

    $scope.submit =  function($files, $event, $flow) {
        $flow.opts.target = "caterer/product/single/image/" + product_id;
        $flow.upload();
        $uibModalInstance.close();
    }

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
