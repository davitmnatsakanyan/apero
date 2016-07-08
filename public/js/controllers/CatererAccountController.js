app.controller('CatererAccountController', ['$scope', 'CatererAccountModel', '$window', 'AuthService',  function ($scope, CatererAccountModel, $window, AuthService) {

    AuthService.auth('caterer');

    $('#datetimepicker4').datetimepicker();

    $scope.link = 'caterer';

    CatererAccountModel.getAccount().then(function (response) {
        $scope.name = response.data.company;
    }, function (error) {
        console.log(error);
    });

}]);
