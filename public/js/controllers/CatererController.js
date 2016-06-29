app.controller('CatererController', ['$scope', 'CatererModel', '$window', 'AuthService',  function ($scope, CatererModel, $window, AuthService) {

    AuthService.auth();

    $('#datetimepicker4').datetimepicker();

    $scope.link = 'caterer';

    CatererModel.getAccount().then(function (response) {
        console.log($window.localStorage.getItem('caterer_id'));
        $scope.name = response.data.company;
    }, function (error) {
        console.log(error);
    });

}]);
