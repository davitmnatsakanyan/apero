/**
 * Created by Designer on 27.07.2016.
 */
function HeaderController($scope, $location)
{
    $scope.isActive = function (viewLocation) {
        return viewLocation === $location.path();
    };
}