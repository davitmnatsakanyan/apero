app.controller('SearchController', ['$scope', 'SearchModel', '$timeout', function ($scope, SearchModel, $timeout) {

    $timeout($('#datetimepicker4').datetimepicker(), 2000);


    $scope.kitchenIncludes = [];
    $scope.includeKitchen = function(kitchen){
        var i = $.inArray(kitchen, $scope.kitchenIncludes);
        if (i > -1) {
            $scope.kitchenIncludes.splice(i, 1);
        } else {
            $scope.kitchenIncludes.push(kitchen);
        }
    };

    $scope.kitchenFilter = function(caterer) {
        var exist = true;
        if ($scope.kitchenIncludes.length > 0) {
            if(caterer.kitchens.length > 0) {
                $.each(caterer.kitchens, function (index, value) {
                    if ($.inArray(value.name, $scope.kitchenIncludes) < 0) {

                        exist = false;
                    }
                    else {

                        exist = true;
                        return false;
                    }

                });
            }
            else{
                var exist = false;
            }
        }
        if(exist){
            return caterer;
        }
    };

    SearchModel.getIndex().then(function (response) {
        $scope.caterers = response.data.caterers;
        $scope.kitchens = response.data.kitchens;

    });

}]);
