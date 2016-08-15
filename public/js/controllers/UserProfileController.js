app.controller('UserProfileController', ['$scope', 'UserModel', 'AuthService', '$location', 'toastr',
    function ($scope, UserModel, AuthService, $location, toastr) {

        AuthService.auth('user');


        UserModel.getUser().then(
            function (response) {
                if (response.data.success) {
                    $scope.user = response.data.user;
                    $scope.zips = response.data.zips;
                    $scope.countries = response.data.countries;
                    $scope.selectedCountry = response.data.user.user_country;
                    $scope.zip_codes = [];
                    $scope.selectedZipCode = {
                        id: $scope.user.user_zip.id,
                        name: $scope.user.user_zip.ZIP + " " + $scope.user.user_zip.city,
                    }
                    for (zip in $scope.zips) {
                        $scope.zip_codes.push({
                            id: $scope.zips[zip].id,
                            name: $scope.zips[zip].ZIP + " " + $scope.zips[zip].city,
                        });
                    }
                    // $scope.selected = $scope.user.user_zip;
                    // console.log($scope.selected);
                }
            },

            function (error) {
                $scope.errorMessages(error.data);
            }
        );

        $scope.update = function () {
            console.log($scope.user);
            // $scope.user.zip = $scope.user.user_zip.id;
            UserModel.update($scope.user).then(
                function (response) {
                    if (response.data.success)
                        toastr.success(response.data.message);
                    else
                        toastr.error(response.data.error, 'Error');
                },

                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }

        $scope.selectZip = function ($select, $model) {
            $scope.user.zip = $model.id;
        }

        $scope.selectCountry = function ($select, $model) {
            $scope.user.country = $model.id;
        }

        $scope.changePassword = function () {
            UserModel.changePassword($scope.data).then(
                function (response) {
                    if (response.data.success)
                        toastr.success(response.data.message);
                    else
                        toastr.error(response.data.error, 'Error');
                },

                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }


        $scope.isActive = function (viewLocation) {
            if (viewLocation == "/user/account")
                if (viewLocation === $location.path() || $location.path() == "/user/account/changePassword")
                    return true;
        };

        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }


    }]);
