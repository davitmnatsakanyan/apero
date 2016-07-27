app.controller('AuthController', ['$scope', '$http', '$location', '$window', 'AuthService', 'CatererAccountModel',   function ($scope, $http, $location, $window, AuthService, CatererAccountModel) {
    
    // redirect to home, if loged in
    AuthService.auth_check('user').then(function(response){
        if(response.data.success == 1){
            $location.path('/');
        }
    });

    AuthService.auth_check('caterer').then(function(response){
        if(response.data.success == 1){
            $location.path('/');
        }
    });

    
    //get some data for registration page
    if($location.path() == '/register') {
        CatererAccountModel.getRegister().then(function (response) {
            $scope.zip_codes = response.data.zip_codes;
            $scope.categories = response.data.categories;
        });
    }

    // submit registration form
    $scope.reg_submit = function(){

        event.preventDefault();

        var role = $scope.data.role;
        if($scope.data.zip) {
            $scope.data.zip = $scope.data.zip.id;
        }
        else{
            $scope.data.zip = ''
        }
        
        $http({
            data: $scope.data,
            method : "POST",
            url : "auth/register"
        }
        ).success(function (response) {
            if(response.success == 1){
                $location.path(role+'/orders');
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
    };

    // submit login form
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
                $location.path(role+'/orders');
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
