app.controller('HomeController', ['$location', 'sharedProperties', 'SearchModel', '$http', '$scope', '$timeout', function ($location, sharedProperties, SearchModel, $http, $scope, $timeout) {

    $('#datetimepicker4').datetimepicker();

    $scope.search = function(){
        SearchModel.getIndex($scope.data).then(function (response) {
            sharedProperties.setProperty(response.data);
            
            $location.path('caterers');

        });
    }
}]);
