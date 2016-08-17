app.controller('CatererPackageController', ['$scope', '$log', '$rootScope', 'CatererAccountModel', 'AuthService', '$location', '$routeParams', 'toastr', 'ModalService', '$uibModal',
    function ($scope, $log, $rootScope, CatererAccountModel, AuthService, $location, $routeParams, toastr, ModalService, $uibModal) {

        AuthService.auth('caterer');


        $scope.currentSelectedProductsPage = 1;
        $scope.numPerPageForSelected = 4;
        $scope.selectedMaxSize = 5;

        CatererAccountModel.getAccount().then(
            function (response) {
                if (response.data.success) {
                    $scope.caterer = response.data.caterer;
                }
            }
        );

        if(!$scope.selectedProducts)
            $scope.selectedProducts=[];

        $scope.getPackageDatas = function () {

            if (!$scope.selectedProducts)
                $scope.selectedProducts = [];

            CatererAccountModel.getPackages().then(
                function (response) {
                    if (response.data.success) {
                        console.log(11);
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
                             console.log($scope.package);
                            if ($scope.package.products) {
                                $scope.currentPackageProductsPage = 1;
                                $scope.numPerPageForPackageProducts = 8;
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

                if ($location.path().split("/")[3] == 'edit') {
                    $scope.location = 'edit';
                    CatererAccountModel.getAddingProducts(package_id).then(
                        function (response) {
                            $scope.addingProducts = [];
                            angular.forEach(response.data.addingProducts, function (element) {
                                $scope.addingProducts.push(element);
                            });
                        });
                }
            }
        }


        if ($location.path().split("/")[3] == 'add') {
            $scope.location = 'add';
            if (!$scope.package) {
                $scope.package = {
                    avatar: "",
                    name: "",
                    price: 0,
                }
            }
            CatererAccountModel.getAllProducts().then(
                function (response) {
                    $scope.addingProducts = response.data.products;
                }
            );
        }


        $scope.createPackage = function ($files, $event, $flow) {
            $scope.package.products = $scope.selectedProducts;
            CatererAccountModel.create($scope.package).then(
                function (response) {
                    if (response.data.success) {
                        var forFlow = response.data.id;
                        $flow.opts.target = "caterer/product/package/image/" + forFlow;
                        $flow.upload();
                        toastr.success(response.data.message);
                    }
                    else
                        toastr.error(response.data.error, 'Error')
                },
                function (error) {
                    $scope.errorMessages(error.data);
                }
            );
        }

        $scope.deletePackage = function (package_id) {
            CatererAccountModel.deletePackage(package_id).then(
                function (response) {
                    if (response.data.success) {
                        var removed = $scope.packages.find(function (package) {
                            return package_id == package.id;
                        }, package_id);
                        $scope.packages.splice($scope.packages.indexOf(removed), 1);
                        toastr.success(response.data.message);
                    }
                    else {
                        toastr.error(response.data.error, 'Error');
                    }
                }
            );
        }

        $scope.updateCommmon = function () {
            var data = {
                name: $scope.package.name,
                price: $scope.package.price
            };
            CatererAccountModel.updatePackgeCommonInf(data, $scope.package.id).then(
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

        $scope.updateProductCount = function (product_id, subproduct_id) {
            var updated = $scope.package.products.find(function (product) {
                return product.pivot.product_id == product_id && product.pivot.subproduct_id == subproduct_id;
            }, product_id, subproduct_id);

            var data = {
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

        $scope.removeProductFromPackage = function (product_id, subproduct_id) {
            var removed = $scope.package.products.find(function (product) {
                return product.pivot.product_id == product_id && product.pivot.subproduct_id == subproduct_id;
            }, product_id, subproduct_id);
            var data = {
                package_id: $scope.package.id,
                product_id: removed.pivot.product_id,
                subproduct_id: removed.pivot.subproduct_id,
            }
            CatererAccountModel.removeProductFromPackage(data).then(
                function (responce) {
                    if (responce.data.success) {
                        $scope.package.products.splice($scope.package.products.indexOf(removed), 1);
                        console.log($scope.addingProducts);
                        console.log(removed);
                        $scope.addingProducts.push(responce.data.product);
                        console.log($scope.addingProducts);
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

        $scope.addProduct = function ($item, $model) {
            if (!$model.subproducts.length) {
                if(!$scope.selectedProducts)
                    $scope.selectedProducts=[];
                console.log($item);
                console.log($model);
                $scope.selectedProducts.push({
                    product_id: $item.id,
                    subproduct_id: 0,
                    name: $item.name,
                    product_count: 1
                });
            } else {
                $scope.selectedSubproduct = $item.subproducts[0];
                $scope.showSubproducts($item);
            }
            ;
        }

        $scope.removeProduct = function ($item, $model) {
            var removed = $scope.selectedProducts.find(function (product) {
                return product.product_id == $model.id;
            }, $model);

            $scope.selectedProducts.splice($scope.selectedProducts.indexOf(removed), 1);
            // $scope.change();
        }

        $scope.changed = 0;

        $scope.change = function () {
            //return $scope.changed = !$scope.changed;
            if ($scope.changed == 1)
                $scope.changed = 0;
            else
                $scope.changed = 1;
        }

        $scope.showSubproducts = function (product) {
            $scope.product = product;
            $scope.open($scope.product);
        };

        $scope.addProductsToPackage = function () {
            CatererAccountModel.addProdcuts($scope.package.id, $scope.selectedProducts).then(
                function (response) {
                    if (response.data.success) {
                        toastr.success(response.data.message);

                        $scope.p = [];
                        $scope.package.products = response.data.products;
                        console.log($scope.selectedProducts);
                        // $scope.selectedProducts.selected=[];
                        // return;
                        for (var product in  $scope.selectedProducts) {
                            console.log('--------------product-----------');
                            console.log(product);
                            var a = $scope.selectedProducts[product];
                            console.log(a);
                            console.log($scope.selectedProducts);
                            console.log('-----------adding products before---------------')
                            console.log($scope.addingProducts);
                            // $scope.selectedProducts.splice($scope.selectedProducts.indexOf(product), 1);
                            var removed = $scope.addingProducts.find(function (addingProduct) {
                                return addingProduct.product_id == a.product_id;
                            }, a);
                            console.log('-----------removed---------------')
                            console.log(removed);
                            console.log('-----------adding products after---------------')
                            $scope.addingProducts.splice($scope.addingProducts.indexOf(removed), 1);
                            console.log($scope.addingProducts);
                        }
                        $scope.selectedProducts = [];
                        $scope.selectedProductsI = [];
                        $scope.change();
                    }
                    else {
                        toastr.error(responce.data.error, 'Error');
                    }
                });
        }


        $scope.$watchGroup(['currentPackagePage', 'packages.length',
                'currentPackageProductsPage', 'changed',
                'currentSelectedProductsPage', 'selectedProducts.length',
            ],
            function (newValues, oldValues, scope) {
                var last_changed, last_changed1;
                if (newValues[0] != oldValues[0] || newValues[1] != oldValues[1])
                    last_changed = 'packagePage';

                if (newValues[2] != oldValues[2] || newValues[3] != oldValues[3])
                    last_changed1 = 'packageProductsPage';

                if (newValues[4] != oldValues[4] || newValues[5] != oldValues[5])
                    last_changed = 'changeSelected';

                if (angular.isDefined(last_changed) || angular.isDefined(last_changed1)) {
                    if (last_changed == 'packagePage') {
                        var begin = (($scope.currentPackagePage - 1) * $scope.numPerPageForPackages),
                            end = begin + $scope.numPerPageForPackages;
                        $scope.filteredPackages = $scope.packages.slice(begin, end);
                    }

                    if (last_changed1 == 'packageProductsPage') {
                        var begin = (($scope.currentPackageProductsPage - 1) * $scope.numPerPageForPackageProducts), end = begin + $scope.numPerPageForPackageProducts;
                        $scope.filteredPackageProducts = $scope.package.products.slice(begin, end);
                    }

                    if (last_changed == 'changeSelected') {
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
                $scope.selected = selectedItem;
                $scope.selectedProducts.push({
                    product_id: $scope.selected.product_id,
                    subproduct_id: $scope.selected.id,
                    name: $scope.product.name + " " + $scope.selected.name,
                    product_count: 1,
                });
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        $scope.toggleAnimation = function () {
            $scope.animationsEnabled = !$scope.animationsEnabled;
        };


        $scope.errorMessages = function (errors) {
            if (angular.isArray(errors)) {
                var data = "";
                angular.forEach(errors, function (value, key) {
                    data += value + "<br/>";
                }, data);
                toastr.error(data, 'Error');
            }
            else  toastr.error(errors, 'Error');
        }

        $scope.update = function (action, $files, $event, $flow) {
            if (action == 'edit') {
                $flow.opts.target = "caterer/product/package/image/" + $scope.package.id;
                $flow.upload();
                $scope.updateCommmon();
            }
            if (action == 'add') {
                $scope.createPackage($files, $event, $flow);
            }
        }
    }]);

