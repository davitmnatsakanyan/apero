app.controller('SearchController', ['sharedProperties', '$scope', 'SearchModel', '$timeout', function (sharedProperties, $scope, SearchModel, $timeout) {

    // $timeout($('#datetimepicker4').datetimepicker(), 2000);

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


    $scope.cookingTimeFilter = function(caterer){
        if($scope.cooking_time && $scope.group){
             return caterer.cookingtime[$scope.group] <= $scope.cooking_time;
        }
        else return true;
    }

    if(sharedProperties.getProperty()){

        var data = sharedProperties.getProperty();
       
        $scope.caterers = data.caterers;
        $scope.kitchens = data.kitchens;
    }
    else {
        SearchModel.getIndex().then(function (response) {
            $scope.caterers = response.data.caterers;
            $scope.kitchens = response.data.kitchens;

        });
    }

    if(localStorage.getItem('delivery_time')) {
        $scope.delivery_time = new Date(JSON.parse(localStorage.getItem('delivery_time')))
    }


    $scope.setPeoplesCount = function (group) {
        $scope.group = group;
    }

    $scope.$watchGroup(['delivery_time','group'],
        function (newValues, oldValues, scope) {
            var last_changed,last_changed1;
            if (newValues[0] != oldValues[0]) {
                last_changed = 'delivery_time';
            }

            if (newValues[1] != oldValues[1]) {
                last_changed1 = 'group';
            }

            if (angular.isDefined(last_changed) || angular.isDefined(last_changed1)) {
                if (last_changed == 'delivery_time') {
                    localStorage.setItem('delivery_time', JSON.stringify($scope.delivery_time));
                    if($scope.peoplesCount){
                        var dTime = moment($scope.delivery_time.toUTCString()).format("DD/MM/YYYY HH:mm:ss");
                         var now  = moment(new Date().toUTCString()).format("DD/MM/YYYY HH:mm:ss");
                        $scope.cooking_time = $scope.countTimeDif(dTime,now);
                    }
                }

                if(last_changed1 == 'group'){
                    if($scope.delivery_time){
                        var dTime = moment($scope.delivery_time.toUTCString()).format("DD/MM/YYYY HH:mm:ss");
                        var now  = moment(new Date().toUTCString()).format("DD/MM/YYYY HH:mm:ss");
                        $scope.cooking_time = $scope.countTimeDif(dTime,now);
                    }
                }
            }
        });


            $scope.countTimeDif = function (dTime,now) {
                var ms = moment(dTime,"DD/MM/YYYY HH:mm:ss").diff(moment(now,"DD/MM/YYYY HH:mm:ss"));
                var d = moment.duration(ms);
                var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");
                var v = s.split(':');
                var minutes;
                if (v[1] !== "00")
                     minutes = v[0] * 60 + parseInt(v[1]);
                else
                     minutes = v[0] * 60
                return minutes;
            }
        }]);
