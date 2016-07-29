app.controller('UserProfileController', ['$scope', 'UserModel', 'AuthService', '$location', 'toastr',
    function ($scope, UserModel, AuthService, $location, toastr) {

        AuthService.auth('user');


        UserModel.getUser().then(
            function (response) {
                if (response.data.success) {
                    $scope.user = response.data.user;
                    $scope.zips = response.data.zips;
                    // $scope.selected = $scope.user.user_zip;
                    console.log($scope.selected);
                }
            },

            function (error) {
                console.log(error);
            }
        );

        $scope.update = function () {
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

        $scope.updateSelect = function () {
            console.log("kmk");
        }
        

        $scope.errorMessages = function (errors) {
            var data = "";
            angular.forEach(errors, function (value, key) {
                data += value + "<br/>";
            }, data);
            toastr.error(data, 'Error');
        }


    }]);
