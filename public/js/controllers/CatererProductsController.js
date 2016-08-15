app.controller('CatererProductsController', ['$scope', 'CatererProductModel', 'AuthService', '$location', '$uibModal','$routeParams', 'toastr',
    function ($scope,CatererProductModel, AuthService, $location,$uibModal, $routeParams, toastr) {

        AuthService.auth('caterer');


        CatererProductModel.getKitchens().then(
            function (response) {
                if (response.data.success) {
                    $scope.caterer = response.data.caterer;
                    $scope.kitchens = $scope.caterer.kitchens;
                    $scope.currentKitchensPage = 1;
                    $scope.numPerPageForKitchens = 4;
                    $scope.kitchensMaxSize = 5;
                    $scope.filteredKitchens = $scope.kitchens.slice(0, $scope.numPerPageForKitchens);
                }
            },
            function (error) {
            }
        );


        if ($routeParams.kitchen_id) {
            console.log('mta');
            $scope.kitchen_id = $routeParams.kitchen_id;
            CatererProductModel.getMenus($scope.kitchen_id).then(
                function (response) {
                    if (response.data.success) {
                        $scope.menus = [];
                            for(menu in response.data.menus)
                                $scope.menus.push(response.data.menus[menu]);
                        console.log($scope.menus);

                        // if($scope.menus.length)
                        //     $scope.menus.length=1;

                        $scope.currentMenusPage = 1;
                        $scope.numPerPageForMenus = 4;
                        $scope.menusMaxSize = 5;

                        $scope.filteredMenus = $scope.menus.slice(0, $scope.numPerPageForMenus);
                    }
                },
                function (error) {
                }
            );

        }

        if ($routeParams.menu_id && $routeParams.k_id) {
            var kitchen_id = $routeParams.k_id;
            var menu_id = $routeParams.menu_id;
            console.log($routeParams.k_id);
            CatererProductModel.getProducts(kitchen_id, menu_id).then(
                function (response) {
                    if (response.data.success) {
                        $scope.products = response.data.products;
                        $scope.currentProductsPage = 1;
                        $scope.numPerPageForProducts = 4;
                        $scope.productsMaxSize = 5;
                        $scope.filteredProducts = $scope.products.slice(0, $scope.numPerPageForProducts);
                    }
                },
                function (error) {
                }
            );

        }

        var route = $location.path().split("/")[3];
        if (route == 'add') {
            if (!$scope.addingProduct) {
                $scope.addingProduct = {
                    name: "",
                    price: "",
                    ingredients: "",
                    kitchen: "",
                    menu: "",
                    customize: []
                }
                console.log($scope.addingProduct);
                CatererProductModel.getAllKitchens().then(
                    function (response) {
                        $scope.allKitchens = response.data.kitchens;
                    },

                    function (error) {

                    }
                );
            }
        }

        $scope.selectKitchen = function ($item, $model) {
            $scope.addingProduct.kitchen = $model.id;
            CatererProductModel.getAllMenus($scope.addingProduct.kitchen).then(
                function (response) {
                    $scope.allMenus = response.data.menus;
                },

                function (error) {

                }
            );
        }


        $scope.selectMenu = function ($item, $model) {
            $scope.addingProduct.menu = $model.id;
        }


        $scope.customize = function () {
            $scope.add();

            $scope.currentCustomizePage = 1;
            $scope.numPerPageForCustomize = 7;
            $scope.customizeMaxSize = 5;
            $scope.filteredCustomize = $scope.addingProduct.customize.slice(0, $scope.numPerPageForCustomize);
        }

        $scope.add = function () {
            console.log($scope.addingProduct.customize);
            $scope.addingProduct.customize.push({
                name: "",
                price: ""
            });
            console.log($scope.addingProduct.customize);
        }

        $scope.remove = function (index) {
            $scope.addingProduct.customize.splice(index, 1);
        },

            $scope.createProduct = function () {
                console.log($scope.addingProduct);
                CatererProductModel.createProduct($scope.addingProduct).then(
                    function (response) {
                        if (response.data.success) {
                            // toastr.success(response.data.message);
                            $scope.created_product_id = response.data.product.id;
                            $scope.open('sm',$scope.created_product_id);
                        }
                        else {
                            toastr.error(response.data.error, 'Error')
                        }
                    },
                    function (error) {
                        $scope.errorMessages(error.data);
                    }
                );
            }


        if ($routeParams.product_id) {
            var product_id = $routeParams.product_id;
            var route = $location.path().split("/")[3];
            switch (route) {
                case 'show':
                    CatererProductModel.getProduct(product_id).then(
                        function (response) {
                            $scope.product = response.data.product;
                            $scope.subproducts = $scope.product.subproducts;
                            $scope.currentSubproductsPage = 1;
                            $scope.numPerPageForSubproducts = 1;
                            $scope.subproductsMaxSize = 5;
                            $scope.filteredSubproducts = $scope.subproducts.slice(0, $scope.numPerPageForSubproducts);
                        },
                        function (error) {

                        }
                    );
                    // $scope.showProduct(product_id);
                    break;
                case 'delete':
                    $scope.deleteProduct(product_id);
                    break;
            }

        }

        $scope.showProduct = function (product_id) {
            CatererProductModel.getProduct(product_id).then(
                function (response) {
                    $scope.product = response.data.product;
                    $scope.subproducts = $scope.product.subproducts;
                    $scope.currentSubproductsPage = 1;
                    $scope.numPerPageForSubproducts = 1;
                    $scope.subproductsMaxSize = 5;
                    $scope.filteredSubproducts = $scope.subproducts.slice(0, $scope.numPerPageForSubproducts);
                },
                function (error) {

                }
            );
        }

        $scope.$watchGroup(['currentKitchensPage', 'currentMenusPage', 'currentProductsPage', 'products.length',
                'currentSubproductsPage', 'subproducts.length', 'currentCustomizePage', 'addingProduct.customize.length'],
            function (newValues, oldValues, scope) {

                var last_changed;
                if (newValues[0] != oldValues[0])
                    last_changed = 'currentKitchens';
                if (newValues[1] != oldValues[1])
                    last_changed = 'currentMenus';
                if (newValues[2] != oldValues[2] || newValues[3] != oldValues[3])
                    last_changed = 'currentProducts';
                if (newValues[4] != oldValues[4] || newValues[5] != oldValues[5])
                    last_changed = 'currentSubproducts';
                if (newValues[6] != oldValues[6] || newValues[7] != oldValues[7])
                    last_changed = 'customize';

                if (angular.isDefined(last_changed)) {
                    if (last_changed == 'currentKitchens') {
                        var begin = (($scope.currentKitchensPage - 1) * $scope.numPerPageForKitchens), end = begin + $scope.numPerPageForKitchens;
                        $scope.filteredKitchens = $scope.kitchens.slice(begin, end);
                    }

                    if (last_changed == 'currentMenus') {
                        var begin = (($scope.currentMenusPage - 1) * $scope.numPerPageForMenus), end = begin + $scope.numPerPageForMenus;
                        $scope.filteredMenus = $scope.menus.slice(begin, end);
                    }

                    if (last_changed == 'currentProducts') {
                        var begin = (($scope.currentProductsPage - 1) * $scope.numPerPageForProducts), end = begin + $scope.numPerPageForProducts;
                        $scope.filteredProducts = $scope.products.slice(begin, end);
                    }

                    if (last_changed == 'currentSubproducts') {
                        var begin = (($scope.currentSubproductsPage - 1) * $scope.numPerPageForSubproducts), end = begin + $scope.numPerPageForSubproducts;
                        $scope.filteredSubproducts = $scope.subproducts.slice(begin, end);
                    }

                    if (last_changed == 'customize') {
                        var begin = (($scope.currentCustomizePage - 1) * $scope.numPerPageForCustomize), end = begin + $scope.numPerPageForCustomize;
                        $scope.filteredCustomize = $scope.addingProduct.customize.slice(begin, end);
                    }
                }


            });

        $scope.isActive = function (viewLocation) {
            // return $location.path().indexOf(viewLocation) == 0;
            return viewLocation === $location.path();
        };

        $scope.errorMessages = function (errors) {
                var data = "";
                console.log(145);
                angular.forEach(errors, function (value, key) {
                    data += value + "<br/>";
                }, data);
                toastr.error(data, 'Error');
        }
        

        $scope.animationsEnabled = true;
        $scope.open = function (size,product_id) {
            console.log(123);
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'myModalContent.html',
                controller: 'UploadImageModalInstanceCtrl',
                size: size,
                resolve: {
                    product_id: function () {
                        return product_id;
                    }
                }
            });

            modalInstance.result.then(function (edit) {
                // CatererAccountModel.editCookingTime(edit).then(function (response) {
                //         if (response.data.success) {
                //             $scope.cooking_time[edit.group] = edit.time;
                //             toastr.success(response.data.message);
                //         }
                //         else {
                //             toastr.error(responce.data.error, 'Error');
                //         }
                //     },
                //     function (error) {
                //         $scope.errorMessages(error.data);
                //     });
                console.log('sax lava');

            }, function () {
                console.log('Modal dismissed at: ' + new Date());
            });
        };


    }]);
