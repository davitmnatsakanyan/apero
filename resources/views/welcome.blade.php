<!DOCTYPE html>
<html>
<head>
    <title>Distance Matrix service</title>

</head>
<body>
<div id="right-panel">

    <div>
        <strong>Results</strong>
    </div>
    <div id="output"></div>
</div>
<div id="map"></div>
<script>
    function initMap() {

        var origin = 'Yegvard';

        var destination = 'Ashtarak';

        var geocoder = new google.maps.Geocoder;

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
            } else {
                var originList = response.originAddresses;
                var destinationList = response.destinationAddresses;
                var outputDiv = document.getElementById('output');
                outputDiv.innerHTML = '';


                for (var i = 0; i < originList.length; i++) {
                    var results = response.rows[i].elements;
                    geocoder.geocode({'address': originList[i]});
                    for (var j = 0; j < results.length; j++) {
                        geocoder.geocode({'address': destinationList[j]});
                        outputDiv.innerHTML =  results[j].distance.text + ' in ' + results[j].duration.text + '<br>';
                        console.log(results[j].duration);
                    }
                }
            }
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb-bWFpEeZ2AN5uAlZQG2iY8n5GhQOkE4">
</script>
</body>
</html>
