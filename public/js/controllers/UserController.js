app.controller('UserController', ['$scope', 'CatererAccountModel', '$window', 'AuthService',  function ($scope, CatererModel, $window, AuthService) {

    AuthService.auth('user');

    //$('#datetimepicker4').datetimepicker();
    //
    //$scope.link = 'caterer';
    //
    //CatererModel.getAccount().then(function (response) {
    //    $scope.name = response.data.company;
    //}, function (error) {
    //    console.log(error);
    //});

}]);
