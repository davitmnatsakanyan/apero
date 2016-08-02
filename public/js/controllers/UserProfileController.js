app.controller('UserProfileController', ['$scope', 'UserModel', 'AuthService', '$location', 'toastr',
    function ($scope, UserModel, AuthService, $location, toastr) {

        AuthService.auth('user');


        UserModel.getUser().then(
            function (response) {
                if (response.data.success) {
                    $scope.user = response.data.user;
                    $scope.zips = response.data.zips;
                    console.log($scope.user);
                    // $scope.selected = $scope.user.user_zip;
                    // console.log($scope.selected);
                }
            },

            function (error) {
                console.log(error);
            }
        );

        $scope.update = function () {
            console.log($scope.user);
            // $scope.user.zip = $scope.user.user_zip.id;
            UserModel.update($scope.user).then(
                function (response) {
                    console.log(response);
                },

                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }


        $scope.isActive = function (viewLocation) {
            // return $location.path().indexOf(viewLocation) == 0;
            return viewLocation === $location.path();
        };

        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }


    }]);
