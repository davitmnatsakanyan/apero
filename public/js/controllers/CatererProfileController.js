app.controller('CatererProfileController', ['$scope', 'CatererAccountModel', '$window', 'AuthService', '$location', 'toastr',
    function ($scope, CatererAccountModel, $window, AuthService, $location, toastr) {

        AuthService.auth('caterer');

            CatererAccountModel.getAccount().then(function (response) {
                if (response.data.success) {
                    $scope.caterer = response.data.caterer;
                    $scope.contact_person = response.data.caterer.contact_person;
                    $scope.caterer_zips = response.data.caterer.zips;
                    console.log($scope.caterer);
                }
            }, function (error) {
                console.log(error);
            });

        
        $scope.isActive = function (viewLocation) {
            return viewLocation === $location.path();
        };

        $scope.updateContactPerson = function () {
            CatererAccountModel.updateContactPerson($scope.contact_person).then(function (response) {
                if (response.data.success) {
                    toastr.success(response.data.message);
                }
                else{
                    toastr.error(responce.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        }


        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }
        
        $scope.removeDeliveryArea = function(zip_id){
            CatererAccountModel.removeDeliveryArea(zip_id).then(function (response) {
                if (response.data.success) {
                    $scope.caterer_zips = response.data.zips;
                    toastr.success(response.data.message);
                }
                else{
                    toastr.error(responce.data.error, 'Error');
                }
            }, function (error) {
                $scope.errorMessages(error.data);
            });
        }

    }]);
