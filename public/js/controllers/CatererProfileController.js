app.controller('CatererProfileController', ['$scope', 'CatererAccountModel', '$window', 'AuthService',  function ($scope, CatererAccountModel, $window, AuthService) {

    AuthService.auth('caterer');

    CatererAccountModel.getAccount().then(function (response) {
        $scope.data = response.data;
    }, function (error) {
        console.log(error);
    });

}]);
