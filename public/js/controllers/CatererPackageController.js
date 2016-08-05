app.controller('CatererPackageController', ['$scope', 'CatererAccountModel', 'AuthService', '$location', '$routeParams',
    function ($scope, CatererAccountModel, AuthService, $location, $routeParams) {

        AuthService.auth('caterer');


        CatererAccountModel.getPackages().then(
            function (response) {
                if (response.data.success) {
                    $scope.caterer = response.data.caterer;
                    $scope.packages = $scope.caterer.packages;

                    if ($scope.packages) {
                        $scope.currentPackagePage = 1;
                        $scope.numPerPageForPackages = 4;
                        $scope.packagesMaxSize = 5;
                        $scope.filteredPackages = $scope.packages.slice(0, $scope.numPerPageForPackages);
                    }

                }
            },
            function (error) {

            }
        );


        if ($routeParams.package_id) {
            var package_id = $routeParams.package_id;
            CatererAccountModel.getPackage(package_id).then(
                function (responce) {
                    if (responce.data.success) {
                        $scope.package = responce.data.package;
                        if ($scope.package.products) {
                            $scope.currentPackageProductsPage = 1;
                            $scope.numPerPageForPackageProducts = 1;
                            $scope.packageProductsMaxSize = 5;
                            $scope.filteredPackageProducts = $scope.package.products.slice(0, $scope.numPerPageForPackageProducts);
                        }


                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                },

                function (error) {
                    // $scope.errorMessages(error.data);
                }
            );
        }
        
        
        $scope.updateCommmon = function(){
            var data = {
                name: $scope.package.name,
                price: $scope.package.price
            };
            CatererAccountModel.updatePackgeCommonInf(data,$scope.package.id).then(
                function (responce) {
                    if (responce.data.success) {

                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                },

                function (error) {
                    // $scope.errorMessages(error.data);
                }
            );
        }
        
        $scope.updateProductCount = function () {
            var data = {
               
            }
            CatererAccountModel.updateProductCount().then(
                function (responce) {
                    if (responce.data.success) {

                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                },

                function (error) {
                    // $scope.errorMessages(error.data);
                }
            );
        }


        $scope.$watchGroup(['currentPackagePage', 'numPerPageForPackages', 'currentPackageProductsPage',
                'numPerPageForPackageProducts'],
            function (newValues, oldValues, scope) {

                var last_changed;
                if (newValues[0] != oldValues[0] || newValues[1] != oldValues[1])
                    last_changed = 'packagePage';

                if (newValues[2] != oldValues[2] || newValues[3] != oldValues[3])
                    last_changed = 'packageProductsPage';

                if (angular.isDefined(last_changed)) {
                    if (last_changed == 'packagePage') {
                        var begin = (($scope.currentPackagePage - 1) * $scope.numPerPageForPackages), end = begin + $scope.numPerPageForPackages;
                        $scope.filteredPackages = $scope.packages.slice(begin, end);
                    }

                    if (last_changed == 'packageProductsPage') {
                        var begin = (($scope.currentPackageProductsPage - 1) * $scope.numPerPageForPackageProducts), end = begin + $scope.numPerPageForPackageProducts;
                        $scope.filteredPackageProducts = $scope.package.products.slice(begin, end);
                        console.log($scope.filteredPackageProducts)
                    }
                }
            });

        $scope.isActive = function (viewLocation) {
            // return $location.path().indexOf(viewLocation) == 0;
            return viewLocation === $location.path();
        };
    }]);

