app.controller('AuthController', ['$scope', '$http', '$location', '$window', 'AuthService', 'CatererAccountModel',   function ($scope, $http, $location, $window, AuthService, CatererAccountModel) {

    if($location.path() == '/register') {
        CatererAccountModel.getRegister().then(function (response) {
            $scope.zip_codes = response.data.zip_codes;
            $scope.categories = response.data.categories;
        });
    }

    $scope.reg_submit = function(){
        event.preventDefault();
        var role = $scope.data.role;
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/register"
        }
        ).success(function (response) {
            if(response.success == 1){
                $location.path(role+'/account');
            }
        }).error( function (error) {
            if(role == 'user'){
                $scope.user_error = error;
            }
                else{
                if(role == 'caterer'){
                    $scope.caterer_error = error;
                }
            }

        });
    }

    $scope.login_submit = function(){
        event.preventDefault();
        var role = $scope.data.role;
        $http({
                data: $scope.data,
                method : "POST",
                url : "auth/login"
            }
        ).success(function (response) {
                if(response.success == 1){
                    $location.path(role+'/account');
                }
                else{
                    if(response.success == 0){
                        if(role == 'user') {
                            $scope.user_error = '';
                            $scope.user_error_msg = 1;
                            $scope.user_error_msg_text = 'Incorrect Username/Password';
                        }
                        else{
                            if(role == 'caterer'){
                                $scope.caterer_error = '';
                                $scope.caterer_error_msg = 1;
                                $scope.caterer_error_msg_text = 'Incorrect Username/Password';
                            }
                        }
                    }
                }
            }).error( function (error) {
                if(role == 'user') {
                    $scope.user_error_msg = 0;
                    $scope.user_error = error;
                }
                else{
                    if(role == 'caterer'){
                        $scope.caterer_error_msg = 0;
                        $scope.caterer_error = error;
                    }
                }
            });
    }
}]);
