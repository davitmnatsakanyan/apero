app.controller('CatererController', ['$scope', 'CatererModel', '$window', 'AuthService',  function ($scope, CatererModel, $window, AuthService) {

    AuthService.auth('caterer');

    $('#datetimepicker4').datetimepicker();

    $scope.link = 'caterer';

    CatererModel.getAccount().then(function (response) {
        $scope.name = response.data.company;
    }, function (error) {
        console.log(error);
    });

}]);
