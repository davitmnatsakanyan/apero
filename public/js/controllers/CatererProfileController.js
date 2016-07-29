app.controller('CatererProfileController', ['$scope', 'CatererAccountModel', '$window', 'AuthService', '$location', function ($scope, CatererAccountModel, $window, AuthService, $location) {

    AuthService.auth('caterer');

    CatererAccountModel.getAccount().then(function (response) {
        $scope.data = response.data;
    }, function (error) {
        console.log(error);
    });


    $scope.isActive = function (viewLocation) {
        // return $location.path().indexOf(viewLocation) == 0;
        return viewLocation === $location.path();
    };

}]);
