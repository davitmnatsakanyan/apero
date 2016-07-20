app.controller('UserProfileController', ['$scope', 'UserModel', 'AuthService', function ($scope, UserModel, AuthService) {

    AuthService.auth('user');


    UserModel.getUser().then(
        function (response) {
            if (response.data.success) {
                $scope.data = response.data.data;
            }
        },

        function (error) {
            console.log(error);
        }
    );

    $scope.update = function () {
        UserModel.update($scope.data).then(
            function (response) {
                console.log(response);
            },

            function (error) {
                console.log(error);
            }
        );
    }

}]);
