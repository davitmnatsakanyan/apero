app.controller('CatererController', ['$scope', 'CatererModel', function ($scope, CatererModel) {

    //$('#datetimepicker4').datetimepicker();

    $scope.link = 'caterer';

    CatererModel.getAccount().then(function (response) {
        $scope.caterer = response.data.name;
    }, function (error) {
        console.log(error);

    });

}]);
