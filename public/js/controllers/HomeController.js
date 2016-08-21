app.controller('HomeController', ['$q', '$location', 'sharedProperties', 'SearchModel', '$http', '$scope', '$timeout', function ($q, $location, sharedProperties, SearchModel, $http, $scope, $timeout) {

    // $('#datetimepicker4').datetimepicker();

    $scope.delivery_time = new Date();
    if(localStorage.getItem('delivery_time')) {
        $scope.delivery_time = new Date(JSON.parse(localStorage.getItem('delivery_time')));
    }

    $scope.$watch("delivery_time",function (newValues, oldValues, scope) {
        localStorage.setItem('delivery_time', JSON.stringify($scope.delivery_time));
    });

    $scope.search = function(){
        SearchModel.getIndex($scope.data).then(function (response) {

            var filtered = [];
            var i = 0;
            var count = response.data.caterers.length;

            while(count>0){
                deliveryDuration(response.data.caterers[i].city, $scope.data.city).then(function(delivery_time){
                    var group = $scope.group;
                    var cooking_time =response.data.caterers[i].cookingtime[group] * 60;
                    var duration = delivery_time + cooking_time;
                    var will_be_delivered = Date.now()/1000 + duration;

                    var date = new Date($('#datetimepicker4').val());
                    
                    if(will_be_delivered <= Date.parse(date)/1000) {
                        filtered.push(response.data.caterers[i]);
                    }
                    i++;

                });
                count--;
            }

            $timeout(function() {
                var data = {};
                data.caterers = filtered;
                data.kitchens = response.data.kitchens;
                console.log(data);
                sharedProperties.setProperty(data);
                $location.path('caterers');

            }, 2000);

        });
    };

    function deliveryDuration(origin, destination){

        var deferred = $q.defer();

        var geocoder = new google.maps.Geocoder;
        var duration ;
        var service = new google.maps.DistanceMatrixService;
         service.getDistanceMatrix({
            origins: [origin],
            destinations: [destination],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        }, function(response, status) {

            if (status !== google.maps.DistanceMatrixStatus.OK) {
                alert('Error was: ' + status);
                deferred.reject('error');
            } else {
                var originList = response.originAddresses;
                var destinationList = response.destinationAddresses;

                for (var i = 0; i < originList.length; i++) {
                    var results = response.rows[i].elements;
                    geocoder.geocode({'address': originList[i]});
                    for (var j = 0; j < results.length; j++) {
                        geocoder.geocode({'address': destinationList[j]});
                        duration =  results[j].duration.value;
                        deferred.resolve(duration);
                    }
                }
            }
        });

        return deferred.promise;
    }
}]);
