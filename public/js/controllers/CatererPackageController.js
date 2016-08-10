app.controller('CatererPackageController', ['$scope','$log', '$rootScope', 'CatererAccountModel', 'AuthService', '$location', '$routeParams','toastr','ModalService','$uibModal',
    function ($scope,$log, $rootScope, CatererAccountModel, AuthService, $location, $routeParams,toastr,ModalService,$uibModal) {

        AuthService.auth('caterer');

        $scope.selectedProducts = [];
        $scope.currentSelectedProductsPage = 1;
        $scope.numPerPageForSelected = 1;
        $scope.selectedMaxSize = 5;


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

            if( $location.path().split("/")[3] == 'edit') {
                $scope.location = 'edit';
                CatererAccountModel.getAddingProducts(package_id).then(
                    function (response) {
                        $scope.addingProducts = [];
                        angular.forEach(response.data.addingProducts, function (element) {
                            $scope.addingProducts.push(element);
                        });

                        console.log($scope.addingProducts);
                    });
            }
        }


        if( $location.path().split("/")[3] == 'add'){
            $scope.location = 'add';
            $scope.selectedProducts = [];
            $scope.package = {
                avatar:"",
                name:"",
                price:0,
                products:[],
            }
            CatererAccountModel.getAllProducts().then(
                function(response){
                    $scope.addingProducts = response.data.products;
                }
            );

        }

        $scope.createPackage = function () {
            console.log($scope.selectedProducts);
            $scope.package.products = $scope.selectedProducts;
            console.log($scope.package);
            CatererAccountModel.create($scope.package).then(
                function(response){
                    if(response.data.success)
                    {
                        toastr.success(response.data.message);
                    }
                        toastr.error(response.data.message,'Error')
                },
                function(error){
                    $scope.errorMessages(error.data);
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
                        toastr.success(responce.data.message);
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

        $scope.updateProductCount = function (product_id,subproduct_id) {
            console.log($scope.package.products)
            var updated = $scope.package.products.find(function (product) {
                return product.pivot.product_id == product_id &&  product.pivot.subproduct_id ==subproduct_id ;
            }, product_id,subproduct_id);

            var data={
                package_id: $scope.package.id,
                product_id: updated.pivot.product_id,
                subproduct_id: updated.pivot.subproduct_id,
                product_count: updated.pivot.product_count
            }
            CatererAccountModel.updateProductCount(data).then(
                function (responce) {
                    if (responce.data.success) {
                        toastr.success(responce.data.message);
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

        $scope.removeProductFromPackage = function (product_id,subproduct_id) {
            var removed = $scope.package.products.find(function (product) {
                return product.pivot.product_id == product_id &&  product.pivot.subproduct_id ==subproduct_id ;
            }, product_id,subproduct_id);

            var data={
                package_id: $scope.package.id,
                product_id: removed.pivot.product_id,
                subproduct_id: removed.pivot.subproduct_id,
            }
            CatererAccountModel.removeProductFromPackage(data).then(
                function (responce) {
                    if (responce.data.success) {
                        $scope.package.products.splice($scope.package.products.indexOf(removed), 1);
                        $scope.addingProducts.push(removed);
                        console.log( $scope.addingProducts);
                        $scope.change();
                        toastr.success(responce.data.message);
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

        $scope.addProduct = function($item, $model){
            if(! $model.subproducts.length) {
                $scope.selectedProducts.push({
                    product_id: $model.id,
                    subproduct_id: 0,
                    name: $model.name,
                    product_count: 1
                });
            }

            else
            {
                $scope.selectedSubproduct = $model.subproducts[0];
                $scope.showSubproducts($model);
            };
        }

        $scope.removeProduct = function($item, $model){
            console.log('removed!');
            var removed = $scope.selectedProducts.find(function (product) {
                return product.product_id == $model.id;
            }, $model);

            $scope.selectedProducts.splice($scope.selectedProducts.indexOf(removed), 1);
            $scope.change();
        }

        $scope.changed = 0;

        $scope.change = function () {
            if ($scope.changed)
                $scope.changed = 0;
            else
                $scope.changed = 1;
            console.log('mta')
        }
        
        $scope.showSubproducts = function (product) {
            $scope.product = product;
            $scope.open($scope.product);

        };

        $scope.addProductsToPackage = function()
        {
            CatererAccountModel.addProdcuts($scope.package.id, $scope.selectedProducts).then(
                function(response){
                    if(response.data.success){
                        toastr.success(response.data.message);
                        $scope.package.products = response.data.products;

                        console.log($scope.package.products);
                        for(var product in  $scope.selectedProducts)
                        {
                            var removed = $scope.addingProducts.find(function (addingProduct) {
                                return addingProduct.product_id == product.product_id;
                            }, product);

                            $scope.addingProducts.splice($scope.addingProducts.indexOf(removed), 1);
                        }
                        $scope.selectedProducts=[];
                        $scope.change();
                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                });

        }


        $scope.$watchGroup([ 'currentPackagePage', 'packages.length',
                'currentPackageProductsPage','changed',
                'currentSelectedProductsPage','selectedProducts.length',

            ],
            function (newValues, oldValues, scope) {
                var last_changed;
                if (newValues[0] != oldValues[0] || newValues[1] != oldValues[1])
                    last_changed = 'packagePage';

                if (newValues[2] != oldValues[2] || newValues[3] != oldValues[3])
                    last_changed = 'packageProductsPage';

                if (newValues[4] != oldValues[4] || newValues[5] != oldValues[5])
                    last_changed = 'changeSelected';

                if (angular.isDefined(last_changed)) {
                    if (last_changed == 'packagePage') {
                        var begin = (($scope.currentPackagePage - 1) * $scope.numPerPageForPackages),
                            end = begin + $scope.numPerPageForPackages;
                        $scope.filteredPackages = $scope.packages.slice(begin, end);
                    }

                    if (last_changed == 'packageProductsPage') {
                        console.log('145');
                        var begin = (($scope.currentPackageProductsPage - 1) * $scope.numPerPageForPackageProducts), end = begin + $scope.numPerPageForPackageProducts;
                        $scope.filteredPackageProducts = $scope.package.products.slice(begin, end);
                    }

                    if (last_changed == 'changeSelected') {
                        console.log(12)
                        var begin = (($scope.currentSelectedProductsPage - 1) * $scope.numPerPageForSelected), end = begin + $scope.numPerPageForSelected;
                        $scope.filteredSelectedProducts = $scope.selectedProducts.slice(begin, end);
                    }
                }
            });

        $scope.isActive = function (viewLocation) {
            // return $location.path().indexOf(viewLocation) == 0;
            return viewLocation === $location.path();
        };




        $scope.items = ['item1', 'item2', 'item3'];

        $scope.animationsEnabled = true;

        $scope.open = function (size) {
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'myModalContent.html',
                // controller: 'ModalInstanceCtrl',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    product: function () {
                        return $scope.product;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                console.log(132);
                $scope.selected = selectedItem;
                $scope.selectedProducts.push({
                    product_id: $scope.selected.product_id,
                    subproduct_id: $scope.selected.id,
                    name: $scope.product.name + " " + $scope.selected.name,
                    product_count:1,
                });
                console.log($scope.selected);
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        $scope.toggleAnimation = function () {
            $scope.animationsEnabled = !$scope.animationsEnabled;
        };


        $scope.errorMessages = function (errors) {
            if(angular.isArray(errors)) {
                var data = "";
                angular.forEach(errors, function (value, key) {
                    data += value + "<br/>";
                }, data);
                toastr.error(data, 'Error');
            }
            else  toastr.error(errors, 'Error');
        }

    }]);

