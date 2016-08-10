app.controller('CatererProductsController', ['$scope', 'CatererProductModel', 'AuthService','$location', '$routeParams','toastr', 
    function ($scope, CatererProductModel,  AuthService ,$location,$routeParams,toastr) {

    AuthService.auth('caterer');


    CatererProductModel.getKitchens().then(
        function(response){
            if(response.data.success) {
                $scope.caterer = response.data.caterer;
                $scope.kitchens =$scope.caterer.kitchens;
                $scope.currentKitchensPage = 1;
                $scope.numPerPageForKitchens = 1;
                $scope.kitchensMaxSize = 5;
                $scope.filteredKitchens = $scope.kitchens.slice(0, $scope.numPerPageForKitchens);
            }
        },
        function(error){
         }
    );
        
        
        if($routeParams.kitchen_id){

            console.log(12);
            $scope.kitchen_id = $routeParams.kitchen_id;
            CatererProductModel.getMenus($scope.kitchen_id).then(
                function(response){
                    if(response.data.success) {
                        console.log(response.data);
                        $scope.menus =response.data.menus;
                        console.log($scope.menus);
                        $scope.currentMenusPage = 1;
                        $scope.numPerPageForMenus = 1;
                        $scope.menusMaxSize = 5;
                        $scope.filteredMenus = $scope.menus.slice(0, $scope.numPerPageForMenus);
                    }
                },
                function(error){
                }
            );

        }

    $scope.$watchGroup(['currentKitchensPage', 'currentMenusPage'], function (newValues, oldValues, scope) {

        var last_changed;
        if (newValues[0] != oldValues[0])
            last_changed = 'currentKitchens';
        if (newValues[1] != oldValues[1])
            last_changed = 'currentMenus';

        if (angular.isDefined(last_changed)) {
            if (last_changed == 'currentKitchens') {
                var begin = (($scope.currentKitchensPage - 1) * $scope.numPerPageForKitchens), end = begin + $scope.numPerPageForKitchens;
                $scope.filteredKitchens =  $scope.kitchens.slice(begin, end);
            }

            if (last_changed == 'currentMenus') {
                var begin = (($scope.currentMenusPage - 1) * $scope.numPerPageForMenus), end = begin + $scope.numPerPageForMenus;
                $scope.filteredMenus =  $scope.menus.slice(begin, end);
            }
        }


    });

    $scope.isActive = function (viewLocation) {
        // return $location.path().indexOf(viewLocation) == 0;
        return viewLocation === $location.path();
    };
}]);

